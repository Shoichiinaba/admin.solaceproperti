<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_banner extends AUTH_Controller
{

    var $template = 'template/index';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Banner_model');
    }

    public function index()
    {
        $data['tittle']          = 'kanpa.co.id | Banner';
        $data['userdata']        = $this->userdata;
        $data['prop_select']     = $this->Banner_model->get_properti_select();
        $data['filter_type']     = $this->Banner_model->get_filter_type();
        $data['content']         = 'page_admin/banner/banner';
        $data['script']          = 'page_admin/banner/banner_js';
        $this->load->view($this->template, $data);
    }

    public function fetch_banner()
    {
        $output = '';
        $limit       = $this->input->post('limit');
        $start       = $this->input->post('start');
        $search      = $this->input->post('search');
        $filter_type = $this->input->post('bannerType');

        // var_dump($filter_type);
        // exit;

        $data = $this->Banner_model->get_banner($limit, $start, $search, $filter_type);
        $total_data = $this->Banner_model->count_banner($search, $filter_type);
        $total_pages = ceil($total_data / $limit);

        $output = '';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $ban) {
                $date = new DateTime($ban->created);
                $formattedDate = $date->format('j F Y');

                $output .= '<div class="col-lg-12 col-md-12 col-sm-12 pb-3">';
                $output .= '<div class="row d-none d-md-flex align-items-center p-2">';
                $output .= '<div class="card position-relative">';
                $output .= '<div class="row">';

                $output .= '<div class="' . (
                    $ban->type_banner === 'Full'
                        ? 'image-full'
                        : (
                            $ban->type_banner === 'KPR'
                            ? 'image-kpr'
                            : (
                                in_array($ban->type_banner, ['Properti Dijual', 'Properti Disewa', 'All Properti'])
                                ? 'image-group'
                                : 'image-split'
                            )
                        )
                ) . ' position-relative pl-0">';

                $banner_text = $ban->type_banner;

                if ($banner_text == 'Properti Disewa') {
                    $banner_text = 'P. Disewa';
                } elseif ($banner_text == 'Properti Dijual') {
                    $banner_text = 'P. Dijual';
                } elseif ($banner_text == 'All Properti') {
                    $banner_text = 'All';
                }

                $output .= '<div class="ribbon ribbon-top-left"><span>' . $banner_text . '</span></div>';
                $output .= '<img class="card-img card-img-left" src="' . base_url('upload/banner/' . $ban->foto_banner) . '" alt="Card image" />';
                $output .= '</div>';

                $output .= '<div class="col-md-8">';
                $output .= '<div class="desk pt-2 pb-1">';
                $output .= '<div class="row mb-3">';
                $output .= '<div class="col-lg-5">';

                $badgeClass = ($ban->penawaran == 'Dijual') ? 'bg-warning' : 'bg-success';

                $output .= '<p class="card-text badge ' . $badgeClass . ' rounded-3">';
                $output .= '<small class="text-white text-uppercase">' . $ban->penawaran . '</small>';
                $output .= '</p>';
                $output .= '</div>';
                $output .= '</div>';

                $output .= '<h3 class="harga text-primary mb-2 d-inline-block">' . $ban->judul_properti . '</h3>';
                if (!empty($ban->luas_tanah) && !empty($ban->luas_bangunan)) {
                    $output .= '<span class="badge bg-label-primary ms-2 d-inline-block shadow-lg">' . $ban->luas_tanah . '/' . $ban->luas_bangunan . '</span>';
                }

                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';

                $output .= '<div class="action-buttons position-absolute bottom-0 end-0 me-3 mb-2">';
                $output .= '<button class="btn btn-danger btn-sm shadow rounded-2 btn-delete" title="hapus" data-id="' . $ban->id_banner . '">';
                $output .= '<i class="bx bx-trash"></i>';
                $output .= '</button>';
                $output .= '<button type="button" class="btn btn-sm btn-success btn-edit ubah-data rounded-3 ms-2" data-bs-toggle="modal" data-bs-target="#edit-banner"
                                data-id_banner="' . $ban->id_banner . '" data-id_properti="' . $ban->id_properti . '" data-penawaran="' . $ban->jenis_penawaran . '" data-type_banner="' . $ban->type_banner . '"
                                data-judul="' . $ban->judul_properti . '" data-foto="' . $ban->foto_banner . '">
                                <i class="bx bx-message-rounded-edit"></i>
                            </button>';
                $output .= ' </div>';

                $output .= '<div class="position-absolute top-0 end-0 mt-2 me-3">';
                $output .= '<p class="card-text"><small class="text-muted tayang">Tayang Sejak ' . $formattedDate . '</small></p>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }

            echo json_encode([
                'data' => $output,
                'total_pages' => $total_pages
            ]);
        } else {
            echo json_encode([
                'data' => '',
                'total_pages' => $total_pages
            ]);
        }

    }

    public function upload_banner() {
        $id_properti = $this->input->post('id_properti');
        $type_banner = $this->input->post('type_banner');
        $jenis_penawaran = $this->input->post('penawaran');

        if (empty($_FILES['foto_banner']['name'])) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada file yang diunggah']);
            return;
        }

        $config['upload_path'] = './upload/banner/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 1024;

        if (in_array($type_banner, ['Properti Dijual', 'Properti Disewa', 'All Properti'])) {
            $config['file_name'] = $type_banner;
        } else {
            $config['file_name'] = $type_banner . '_' . time();
        }

        $this->load->library('upload');

        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto_banner')) {
            $uploadData = $this->upload->data();
            $foto_banner = $uploadData['file_name'];

            $data = array(
                'id_properti' => $id_properti,
                'type_banner' => $type_banner,
                'jenis_penawaran' => $jenis_penawaran,
                'foto_banner' => $foto_banner,
                'created' => date('Y-m-d H:i:s')
            );

            $this->Banner_model->insert_banner($data);

            echo json_encode(['status' => 'success', 'message' => 'Banner berhasil diupload']);
        } else {
            $error_message = $this->upload->display_errors();
            echo json_encode(['status' => 'error', 'message' => $error_message]);
        }
    }

    public function hapus_banner()
    {
        $id_banner = $this->input->post('id_banner');

        $banner = $this->Banner_model->get_banner_by_id($id_banner);
        if ($banner) {
            $foto_name = $banner->foto_banner;

            if (!empty($foto_name) && file_exists('./upload/banner/' . $foto_name)) {
                unlink('./upload/banner/' . $foto_name);
            }

            $this->Banner_model->delete_banner($id_banner);

            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID Agent tidak ditemukan.'
            ]);
        }
    }

    // code ubah banner
    public function updateBannerData() {
        $id_banner = $this->input->post('id_banner');

        $current_banner = $this->Banner_model->get_banner_by_id($id_banner);
        $old_foto_banner = isset($current_banner->foto_banner) ? $current_banner->foto_banner : '';

        $data = array(
            'id_properti' => $this->input->post('id_properti'),
            'type_banner' => $this->input->post('type_banner'),
            'jenis_penawaran' => $this->input->post('penawaran'),
            'created' => date('Y-m-d H:i:s')
        );

        if (!empty($_FILES['foto_banner']['name'])) {
            $upload_path = FCPATH . 'upload/banner/';

            if (!is_dir($upload_path)) {
                error_log('Directory does not exist: ' . $upload_path);
                echo json_encode(['status' => 'error', 'message' => 'Jalur upload tidak ada: ' . $upload_path]);
                return;
            }

            if (!is_writable($upload_path)) {
                echo json_encode(['status' => 'error', 'message' => 'Jalur upload tidak dapat ditulisi: ' . $upload_path]);
                return;
            }

            // Konfigurasi upload
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024;
            if (in_array($type_banner, ['Properti Dijual', 'Properti Disewa', 'All Properti'])) {
                $config['file_name'] = $type_banner;
            } else {
                $config['file_name'] = $type_banner . '_' . time();
            }
            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto_banner')) {
                $upload_data = $this->upload->data();
                $new_foto_banner = $upload_data['file_name'];

                // Hapus banner lama jika ada
                if ($old_foto_banner && file_exists($upload_path . $old_foto_banner)) {
                    unlink($upload_path . $old_foto_banner);
                }

                $data['foto_banner'] = $new_foto_banner;
            } else {
                $error = $this->upload->display_errors();
                echo json_encode(['status' => 'error', 'message' => $error]);
                return;
            }
        } else {
            $data['foto_banner'] = $old_foto_banner;
        }

        $this->Banner_model->update_banner($id_banner, $data);

        echo json_encode(['status' => 'success']);
    }


}