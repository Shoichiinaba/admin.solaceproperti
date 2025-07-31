<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Properti extends AUTH_Controller
{

    var $template = 'template/index';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Properti_model');
        $this->load->library('upload');
        $this->load->helper('encryption_helper');
    }

    public function index()
    {
        $data['tittle']             = 'kanpa.co.id | Properti';
        $data['userdata']           = $this->userdata;
        $data['type']               = $this->Properti_model->get_type();
        $data['type_properti']      = $this->Properti_model->get_filter_type();
        $data['jenis_penawaran']    = $this->Properti_model->get_penawaran();
        $data['filter_agency']      = $this->Properti_model->get_agency();
        $data['kota']               = $this->Properti_model->get_kota_select();
        $data['status']             = $this->Properti_model->get_status_select();
        $data['agent']              = $this->Properti_model->get_agent_select();
        $data['content']            = 'page_admin/properti/properti';
        $data['script']             = 'page_admin/properti/properti_js';
        $this->load->view($this->template, $data);
    }

    public function fetch()
    {
        $output = '';
        $limit              = $this->input->post('limit');
        $start              = $this->input->post('start');
        $search             = $this->input->post('search');
        $filter_type        = $this->input->post('properti_type');
        $filter_penawaran   = $this->input->post('jenis_penawaran');
        $filter_agent       = $this->input->post('filter_agency');

        $data = $this->Properti_model->get_properti($limit, $start, $search, $filter_type,  $filter_penawaran, $filter_agent);
        $total_data = $this->Properti_model->count_properti($search, $filter_type,  $filter_penawaran, $filter_agent);
        $total_pages = ceil($total_data / $limit);

        $output = '';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $prop) {
                $date = new DateTime($prop->dibuat);
                $formattedDate = $date->format('j F Y');

                $output .= '
                            <div class="col-lg-12 col-md-12 col-sm-12 pb-3">
                                <!-- Tampilan Desktop -->
                                <div class="row d-none d-md-flex align-items-center p-2">
                                    <div class="card position-relative">
                                        <div class="row">
                                            <div class="image-pro position-relative">
                                            <div class="ribbon ribbon-top-left"><span>' . $prop->jenis_penawaran . '</span></div>
                                                <img class="card-img card-img-left" src="' . base_url('upload/gambar_properti/' . $prop->gambar) . '"
                                                    alt="Card image" />
                                                <a href="' . base_url('Properti/detail/' . encode_id($prop->id_properti)) . '" class="btn btn-primary btn-view"><i class="menu-icon tf-icons bx bx-bot"></i>Lihat</a>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="desk pt-2 pb-1">
                                                    <div class="row mb-3">
                                                        <div class="col-lg-5">
                                                            <p class="card-text badge bg-warning rounded-3">
                                                                <small class="text-white text-uppercase">' . $prop->nama_type . '</small>
                                                            </p>
                                                        </div>
                                                    </div>';
                                                    $output .= '<h3 class="harga text-primary mb-2">Rp. ' . (floor($prop->harga) == $prop->harga ? number_format($prop->harga, 0, ',', '.') : number_format($prop->harga, 1, ',', '.')) . ' ' . $prop->satuan . '</h3>';

                                                    $output .= '

                                                    <h4 class="display-7 unit pt-0 mb-1 d-flex align-items-center">' . $prop->judul_properti . '
                                                    <span class="badge bg-label-warning ms-2 shadow-lg rounded-3 px-8 py-7 fs-6">' . $prop->luas_bangunan . '/' . $prop->luas_tanah . '</span>
                                                    </h4>
                                                    <p class="card-text">' . $prop->alamat . '</p>
                                                    <div>
                                                        <small class="footer-link me-4">LT : ' . $prop->luas_tanah . ' m2</small>
                                                        <small class="footer-link me-4">LB : ' . $prop->luas_bangunan . ' m2</small>
                                                        <small class="footer-link me-4">KT : ' . $prop->jml_kamar . '</small>
                                                        <small class="footer-link me-4">KM : ' . $prop->jml_kamar_mandi . '</small>
                                                        <small class="footer-link">LV : ' . $prop->level . '</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-absolute bottom-0 end-0 p-2 d-flex align-items-center me-3">
                                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                    class="avatar avatar-md pull-up" title="' . $prop->nama_agent . '">
                                                    <img src="' . base_url('upload/agent/' . $prop->foto_profil) . '" alt="Avatar" class="rounded-circle" />
                                                </li>
                                            </ul>
                                            <span class="ms-2 fs-5 fw-bold">' . $prop->nama_agent . '</span>
                                        </div>
                                        <div class="position-absolute top-0 end-0 mt-2 me-3">
                                            <p class="card-text"><small class="text-muted tayang">Tayang Sejak ' . $formattedDate . '</small></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tampilan Mobile -->
                                <div class="d-block d-md-none">
                                    <div class="card shadow-sm">
                                        <img class="card-img-top" src="' . base_url('upload/gambar_properti/' . $prop->gambar) . '" alt="Card image">
                                        <div class="card-body pt-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <p class="card-text badge bg-warning rounded-3 mb-0">
                                                    <small class="text-white text-uppercase">' . $prop->nama_type . '</small>
                                                </p>
                                                <p class="card-text mb-0">
                                                    <small class="text-muted">Tayang Sejak ' . $formattedDate . '</small>
                                                </p>
                                            </div>
                                            <h3 class="harga text-primary mb-2">Rp. ' . (floor($prop->harga) == $prop->harga ? number_format($prop->harga, 0, ',', '.') : number_format($prop->harga, 1, ',', '.')) . '</h3>
                                            <h4 class="unit mb-1">' . $prop->judul_properti . '</h4>
                                            <p class="card-text text-muted mb-2">' . $prop->alamat . '</p>
                                            <div class="d-flex justify-content-between mb-3">
                                                <small class="footer-link">LT : ' . $prop->luas_tanah . ' m2</small>
                                                <small class="footer-link">LB : ' . $prop->luas_bangunan . ' m2</small>
                                                <small class="footer-link">KT : ' . $prop->jml_kamar . '</small>
                                                <small class="footer-link">KM : ' . $prop->jml_kamar_mandi . '</small>
                                                <small class="footer-link">LV : ' . $prop->level . '</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="' . base_url('upload/agent/' . $prop->foto_profil) . '" alt="' . $prop->nama_agent . '" class="rounded-circle me-2"
                                                    width="40" height="40">
                                                <div class="d-flex flex-column">
                                                    <span>' . $prop->nama_agent . '</span>
                                                    <small class="text-muted">' . $prop->alamat . '</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }

            echo json_encode([
                'data' => $output,
                'total_pages' => $total_pages,
                'total_data' => $total_data
            ]);
        } else {
            echo json_encode([
                'data' => '',
                'total_pages' => $total_pages,
                'total_data' => 0
            ]);
        }
    }

    // code multiple select untuk mengambil data
    public function getKotaByProvinsi()
    {
        $provinsi_id = $this->input->get('id_provinsi');
        $kota = $this->Properti_model->getKotaByProvinsiId($provinsi_id);
        echo json_encode($kota);
    }

    public function store() {
        // Simpan data properti
        $id_kota        = $this->input->post('id_kota');
        $id_type        = $this->input->post('id_type');
        $id_status      = $this->input->post('id_status');
        $area_terdekat  = $this->input->post('area_terdekat');

        if (empty($id_kota) || empty($id_type)) {
            echo json_encode(['status' => 'error', 'message' => 'Kota dan tipe properti harus dipilih.']);
            return;
        }

        $jenis_penawaran = $this->input->post('penawaran') ? $this->input->post('penawaran') : 'Dijual';

        $data_properti = [
            'id_kota'           => $id_kota,
            'id_type'           => $id_type,
            'id_status'         => $id_status,
            'jenis_penawaran'   => $jenis_penawaran,
            'judul_properti'    => $this->input->post('judul_properti'),
            'alamat'            => $this->input->post('alamat'),
            'lokasi'            => $this->input->post('lokasi'),
            'area_terdekat'     => $area_terdekat,
            'dibuat'            => date('Y-m-d H:i:s')
        ];

        $id_properti = $this->Properti_model->insert_properti($data_properti);

       // Update warna peta berdasarkan id_kota
        $data_map = [
            'code' => $id_kota,
            'color' => '#104C98'
        ];

         $this->Properti_model->ubah_warna($data_map);

         // input nama agent ke listing
        $data_agency = [
            'id_properti' => $id_properti,
            'id_agency'   => $this->input->post('id_agency')
        ];

         $this->Properti_model->insert_agency($data_agency);

        // Simpan detail properti
        $data_detail = [
            'id_properti' => $id_properti,
            'jml_kamar' => $this->input->post('jml_kamar'),
            'jml_kamar_mandi' => $this->input->post('jml_kamar_mandi'),
            'luas_bangunan' => $this->input->post('luas_bangunan'),
            'luas_tanah' => $this->input->post('luas_tanah'),
            'daya_listrik' => $this->input->post('daya_listrik'),
            'carport' => $this->input->post('carport'),
            'ruang_tamu' => $this->input->post('ruang_tamu'),
            'taman' => $this->input->post('taman'),
            'ruang_makan' => $this->input->post('ruang_makan'),
            'level' => $this->input->post('level'),
            'balkon' => $this->input->post('balkon'),
            'harga' => $this->input->post('harga'),
            'satuan' => $this->input->post('satuan'),
            'deskripsi' => $this->input->post('deskripsi')
        ];
        $this->Properti_model->insert_detail_properti($data_detail);

        // Cek apakah fasilitas ada di POST sebelum menyimpan
        if ($this->input->post('jalan') || $this->input->post('masjid') || $this->input->post('taman_bermain') ||
        $this->input->post('area_ruko') || $this->input->post('kolam_renang') || $this->input->post('one_gate') ||
        $this->input->post('security') || $this->input->post('cctv')) {

            $data_fasilitas = [
                'id_properti' => $id_properti,
                'jalan' => $this->input->post('jalan'),
                'masjid' => $this->input->post('masjid'),
                'taman_bermain' => $this->input->post('taman_bermain'),
                'area_ruko' => $this->input->post('area_ruko'),
                'kolam_renang' => $this->input->post('kolam_renang'),
                'one_gate' => $this->input->post('one_gate'),
                'security' => $this->input->post('security'),
                'cctv' => $this->input->post('cctv')
            ];
            $this->Properti_model->insert_fasilitas_properti($data_fasilitas);
         }

        // Proses file gambar

        $files = $_FILES['gambar_properti'];
        $error_occurred = false;

        if (!empty($files['name'][0])) {
            $count = count($files['name']);

            for ($i = 0; $i < $count; $i++) {
                // Memisahkan tiap file ke dalam $_FILES
                $_FILES['file']['name'] = $files['name'][$i];
                $_FILES['file']['type'] = $files['type'][$i];
                $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['file']['error'] = $files['error'][$i];
                $_FILES['file']['size'] = $files['size'][$i];

                // Inisialisasi ulang konfigurasi upload untuk tiap file
                $this->upload->initialize($this->set_upload_options());

                if ($this->upload->do_upload('file')) {
                    $data_gambar = [
                        'id_properti' => $id_properti,
                        'gambar' => $this->upload->data('file_name')
                    ];
                    $this->Properti_model->insert_gambar_properti($data_gambar);
                } else {
                    $error = $this->upload->display_errors();
                    log_message('error', 'Upload error: ' . $error);
                    $error_occurred = true;
                }
            }

            if ($error_occurred) {
                echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat mengunggah gambar.']);
                return;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada file gambar yang dipilih.']);
            return;
        }

        // Proses file meta properti
        log_message('debug', 'FILES: ' . print_r($_FILES, true));
        log_message('debug', 'POST: ' . print_r($_POST, true));

        if (!isset($_FILES['meta_properti'])) {
            log_message('error', 'meta_properti tidak diatur dalam $_FILES');
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada file yang diunggah untuk meta_properti.']);
            return;
        }


        if (!isset($_FILES['meta_properti'])) {
            log_message('error', 'meta_properti tidak diatur dalam $_FILES');
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada file yang diunggah untuk meta_properti.']);
            return;
        }

        $meta_file = $_FILES['meta_properti'];

        // Cek jika file meta_properti tidak kosong
        if (!empty($meta_file['name'])) {
            $_FILES['file_meta']['name'] = $meta_file['name'];
            $_FILES['file_meta']['type'] = $meta_file['type'];
            $_FILES['file_meta']['tmp_name'] = $meta_file['tmp_name'];
            $_FILES['file_meta']['error'] = $meta_file['error'];
            $_FILES['file_meta']['size'] = $meta_file['size'];

            // Inisialisasi ulang konfigurasi upload untuk file meta
            $this->upload->initialize($this->set_upload_options_meta('./upload/meta_properti'));

            if ($this->upload->do_upload('file_meta')) {
                $uploaded_data = $this->upload->data();
                if (isset($uploaded_data['file_name'])) {
                    // Konfigurasi untuk meresize gambar
                    $resize_config = [
                        'image_library' => 'gd2',
                        'source_image' => $uploaded_data['full_path'], // Path gambar yang diupload
                        'maintain_ratio' => true,
                        'width' => 140,
                        'height' => 140,
                    ];

                    // Muat library image_lib
                    $this->load->library('image_lib', $resize_config);

                    // Resize gambar
                    if (!$this->image_lib->resize()) {
                        // Jika terjadi error saat resize
                        log_message('error', 'Resize error: ' . $this->image_lib->display_errors());
                        echo json_encode(['status' => 'error', 'message' => 'Gambar berhasil diunggah tetapi gagal melakukan resize.']);
                        return;
                    }

                    // Insert data meta properti ke database
                    $data_meta_gambar = [
                        'id_properti' => $id_properti,
                        'foto_meta' => $uploaded_data['file_name']
                    ];
                    $this->Properti_model->insert_meta_properti($data_meta_gambar);
                } else {
                    log_message('error', 'File uploaded but no file name returned: ' . print_r($uploaded_data, true));
                    echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat mengunggah gambar meta.']);
                    return;
                }
            } else {
                $meta_error = $this->upload->display_errors();
                log_message('error', 'Meta upload error: ' . $meta_error);
                echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat mengunggah gambar meta.']);
                return;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada file yang dipilih untuk meta properti.']);
            return;
        }

        echo json_encode(['status' => 'success', 'message' => 'Properti berhasil disimpan.']);
    }

    private function set_upload_options() {
        $config = [
            'upload_path' => './upload/gambar_properti',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size' => 2048,
            'overwrite' => false,
            'encrypt_name' => true,
        ];
        return $config;
    }

    private function set_upload_options_meta() {
        $config = [
            'upload_path' => './upload/meta_properti',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size' => 2048,
            'overwrite' => false,
            'encrypt_name' => true,
        ];

        return $config;
    }

    public function detail()
    {
        $encoded_id_properti = $this->uri->segment(3);
        $id_properti = decode_id($encoded_id_properti);

        $data['tittle']         = 'kanpa.co.id | Detail Properti';
        $data['userdata']       = $this->userdata;
        $data['status']         = $this->Properti_model->get_status_select();
        $data['detail']         = $this->Properti_model->get_properti_det($id_properti);
        $data['promo']          = $this->Properti_model->get_promo($id_properti);
        $data['kota']           = $this->Properti_model->get_kota_select();
        $data['agent']          = $this->Properti_model->get_agent_select();
        $data['content']        = 'page_admin/detail_properti/detail';
        $data['script']         = 'page_admin/detail_properti/detail_js';
        $this->load->view($this->template, $data);
    }

    public function save_promo() {
        $id_properti = $this->input->post('id_properti');
        $nama_promo = $this->input->post('nama_promo');

        if (!empty($id_properti) && !empty($nama_promo)) {
            $data = [
                'id_properti' => $id_properti,
                'nama_promo' => $nama_promo
            ];

            $insert_id = $this->Properti_model->insert_promo($data);

            if ($insert_id) {
                echo json_encode(['status' => 'success', 'message' => 'Promo berhasil disimpan!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan promo.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
        }
    }

    public function get_promo_by_id()
    {
        $id_promo = $this->input->post('id_promo');
        $promo = $this->Properti_model->get_promo_by_id($id_promo);
        echo json_encode($promo);
    }

    public function update_promo()
    {
        $id_promo = $this->input->post('id_promo');
        $id_properti = $this->input->post('id_properti');
        $nama_promo = $this->input->post('nama_promo');

        $data = array(
            'id_properti' => $id_properti,
            'nama_promo' => $nama_promo
        );

        $this->Properti_model->update_promo($id_promo, $data);

        echo json_encode(['status' => 'success']);
    }


    public function upload_gambar()
    {
        $this->load->library('upload');

        $id_properti = $this->input->post('id_properti');

        $config['upload_path'] = './upload/gambar_properti/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;

        $this->upload->initialize($config);

        $files = $_FILES['gambar'];
        $file_count = count($files['name']);

        $response = [];

        for ($i = 0; $i < $file_count; $i++) {
            $_FILES['file']['name'] = $files['name'][$i];
            $_FILES['file']['type'] = $files['type'][$i];
            $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['file']['error'] = $files['error'][$i];
            $_FILES['file']['size'] = $files['size'][$i];

            if ($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();

                $file_name = md5(time() . $uploadData['file_name']) . '.' . $uploadData['file_ext'];

                rename($uploadData['full_path'], $uploadData['file_path'] . $file_name);

                $this->Properti_model->simpan_gambar($file_name, $id_properti);
                $response[] = $file_name;

            } else {
                echo json_encode(array('error' => $this->upload->display_errors()));
                return;
            }
        }

        echo json_encode(array('success' => 'Gambar berhasil diunggah!', 'files' => $response));
    }

    public function get_gambar()
    {
        $id_properti = $this->input->post('id_properti');

        $gambar = $this->Properti_model->get_gambar($id_properti);
        echo json_encode(['gambar' => $gambar]);
    }

    public function hapus_gambar()
    {
        $id_properti = $this->input->post('id_properti');
        $gambar = $this->input->post('gambar');

        if ($id_properti && $gambar) {
            $properti = $this->Properti_model->get_gambar_by_nama($id_properti, $gambar);

            if ($properti) {
                $foto_name = $properti->gambar;

                if (!empty($foto_name) && file_exists('./upload/gambar_properti/' . $foto_name)) {
                    unlink('./upload/gambar_properti/' . $foto_name);
                }

                $this->Properti_model->hapus_gambar($id_properti, $gambar);

                echo json_encode([
                    'status' => 'success',
                    'message' => 'Gambar berhasil dihapus.'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gambar tidak ditemukan.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak valid.'
            ]);
        }
    }

    public function updateProperti() {

        $id_properti = $this->input->post('id_properti');
        $id_kota = $this->input->post('id_kota');

        // Mengambil nilai data properti
        $data_properti = array(
            'judul_properti'   => $this->input->post('judul_properti'),
            'alamat'           => $this->input->post('alamat'),
            'lokasi'           => $this->input->post('lokasi'),
            'area_terdekat'    => implode(', ', $this->input->post('area_terdekat')),
            'id_status'        => $this->input->post('id_status'),
            'id_type'          => $this->input->post('id_type'),
            'jenis_penawaran'  => $this->input->post('penawaran'),
            'id_kota'          => $this->input->post('id_kota'),
        );

        // Mengambil nilai detail properti
        $data_detail = array(
            'jml_kamar'        => $this->input->post('jml_kamar'),
            'jml_kamar_mandi'  => $this->input->post('jml_kamar_mandi'),
            'luas_bangunan'    => $this->input->post('luas_bangunan'),
            'luas_tanah'       => $this->input->post('luas_tanah'),
            'level'            => $this->input->post('level'),
            'daya_listrik'     => $this->input->post('daya_listrik'),
            'carport'          => $this->input->post('carport'),
            'ruang_tamu'       => $this->input->post('ruang_tamu'),
            'ruang_keluarga'   => $this->input->post('ruang_keluarga'),
            'taman'            => $this->input->post('taman'),
            'ruang_makan'      => $this->input->post('ruang_makan'),
            'balkon'           => $this->input->post('balkon'),
            'harga'            => $this->input->post('harga'),
            'satuan'           => $this->input->post('satuan'),
            'deskripsi'        => $this->input->post('deskripsi'),
        );

        // Verifikasi dan mengambil nilai checkbox, memastikan hanya 1 atau 0
        $data_fasilitas = array(
            'jalan'            => $this->input->post('jalan'),
            'masjid'           => $this->input->post('masjid') == 1 ? 1 : 0,
            'taman_bermain'    => $this->input->post('taman_bermain') == 1 ? 1 : 0,
            'area_ruko'        => $this->input->post('area_ruko') == 1 ? 1 : 0,
            'kolam_renang'     => $this->input->post('kolam_renang') == 1 ? 1 : 0,
            'one_gate'         => $this->input->post('onegate') == 1 ? 1 : 0,
            'security'         => $this->input->post('security') == 1 ? 1 : 0,
            'cctv'             => $this->input->post('cctv') == 1 ? 1 : 0,
        );

        $data_agency = [
            'id_agency'   => $this->input->post('id_agency')
        ];

        $data_map = [
            'code' => $id_kota,
            'color' => '#104C98'
        ];


        // Update data properti
        $result = $this->Properti_model->update_properti($id_properti, $data_properti);
        $result_detail = $this->Properti_model->update_detail($id_properti, $data_detail);
        $result_fasilitas = $this->Properti_model->update_fasilitas($id_properti, $data_fasilitas);
        $result_agent = $this->Properti_model->update_agent($id_properti, $data_agency);
        $result_map = $this->Properti_model->ubah_warna($data_map);

        if (!empty($_FILES['foto_meta']['name'][0])) {
            // Proses upload jika ada gambar yang dipilih
            $upload_path = './upload/meta_properti/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }

            $this->load->library('upload');
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;

            $files = $_FILES;
            $count = count($_FILES['foto_meta']['name']);
            for ($i = 0; $i < $count; $i++) {
                $_FILES['foto_meta']['name'] = $files['foto_meta']['name'][$i];
                $_FILES['foto_meta']['type'] = $files['foto_meta']['type'][$i];
                $_FILES['foto_meta']['tmp_name'] = $files['foto_meta']['tmp_name'][$i];
                $_FILES['foto_meta']['error'] = $files['foto_meta']['error'][$i];
                $_FILES['foto_meta']['size'] = $files['foto_meta']['size'][$i];

                $this->upload->initialize($config);
                if ($this->upload->do_upload('foto_meta')) {
                    $uploadData = $this->upload->data();

                    $ext = pathinfo($uploadData['file_name'], PATHINFO_EXTENSION);
                    $encrypted_name = md5(time() . $uploadData['file_name']) . '.' . $ext;
                    $new_file_path = $upload_path . $encrypted_name;

                    if (rename($uploadData['full_path'], $new_file_path)) {
                        if ($old_file_path && file_exists($upload_path . $old_file_path)) {
                            unlink($upload_path . $old_file_path);
                        }

                        // Resize
                        $config_resize['image_library'] = 'gd2';
                        $config_resize['source_image'] = $new_file_path;
                        $config_resize['maintain_ratio'] = true;
                        $config_resize['width'] = 140;
                        $config_resize['height'] = 140;

                        $this->load->library('image_lib', $config_resize);
                        if (!$this->image_lib->resize()) {
                            log_message('error', 'Gagal mengubah ukuran gambar: ' . $this->image_lib->display_errors());
                        }

                        $this->image_lib->clear();

                        $data_meta = array('foto_meta' => $encrypted_name);
                        $this->Properti_model->update_meta_properti($data_meta, $id_properti);
                    } else {
                        log_message('error', 'Gagal mengganti nama file: ' . $uploadData['full_path']);
                    }
                } else {
                    log_message('error', 'Upload gagal: ' . $this->upload->display_errors());
                }
            }
        } else {
            // Jika tidak ada gambar baru, simpan gambar lama
            if ($old_meta) {
                $data_meta = array('foto_meta' => $old_file_path);
                $this->Properti_model->update_meta_properti($data_meta, $id_properti);
            }
        }

        if ($result) {
            echo json_encode(['message' => 'Data properti berhasil diupdate']);
        } else {
            echo json_encode(['message' => 'Gagal mengupdate data properti'], 500);
        }

    }

}