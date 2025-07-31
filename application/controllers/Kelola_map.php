<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_map extends AUTH_Controller
{
    var $template = 'template/index';
    public function __construct()
    {

        parent::__construct();
        $this->load->model('KelolaMap_model');
        $this->load->model('Map_model');
    }


    public function index()
    {

        $data['tittle']         = 'kanpa.co.id | Kelola Maps';
        $data['userdata']       = $this->userdata;
        $data['map_prov']       = $this->KelolaMap_model->get_provinsi();
        $data['provinsi']       = $this->KelolaMap_model->get_provinsi_select();
        $data['content']        = 'page_admin/kelola_map/map';
        $data['script']         = 'page_admin/kelola_map/map_js';

        $this->load->view($this->template, $data);
    }

    public function allColor()
    {
        $ids = Map_model::all();
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode([
                'message' => '',
                'results' => $ids->toArray(),
            ]));
    }

    public function get_map()
    {
        $id = $this->input->post('id');

        $map_data = $this->KelolaMap_model->get_map_by_id($id);
        if ($map_data) {
            $response = array(
                'svg_map' => $map_data->svg_map
            );

            echo json_encode($response);
        } else {
            echo json_encode(array('error' => 'Data peta tidak ditemukan'));
        }
    }

    public function tambah_maps()
    {
        $data = array(
            'id_prov' => $this->input->post('provinsi_id'),
            'svg_map' => $this->input->post('maps_code'),
        );

        $result = $this->KelolaMap_model->save_data($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    public function countDataByProv()
    {
        $id_prov = $this->input->post('id_prov');
        $count = $this->KelolaMap_model->countByProv($id_prov);
        echo json_encode(['count' => $count]);
    }


    // code untuk import file excel
    private $filename = "import_data_map";

    public function preview()
    {
        $data = array();

        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $upload = $this->KelolaMap_model->upload_file($this->filename);

            if ($upload['result'] == "success") {
                include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

                $excelreader = new PHPExcel_Reader_Excel2007();
                $loadexcel = $excelreader->load('upload/excel/' . $this->filename . '.xlsx');
                $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

                $data['sheet'] = $sheet;
                $data['kosong'] = 0;

                foreach ($sheet as $row) {
                    $code = isset($row['A']) ? $row['A'] : '';
                    $color = isset($row['B']) ? $row['B'] : '';

                    if (empty($code) || empty($color)) {
                        $data['kosong']++;
                    }
                }

                $data['id_prov'] = $this->input->post('id_prov');
            } else {
                $data['upload_error'] = $upload['error'];
            }
        } else {
            $data['upload_error'] = 'No file uploaded';
        }

        // Load view dengan data preview
        $this->load->view('page_admin/kelola_map/preview_result', $data);
    }

    public function import()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $id_prov = $this->input->post('id-prov');
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('upload/excel/' . $this->filename . '.xlsx');
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

        $data = array();

        $numrow = 1;
        foreach ($sheet as $row) {
            if ($numrow > 1) {
                array_push($data, array(
                    'id_prov' => $id_prov,
                    'code' => $row['A'],
                    'color' => $row['B'],
                ));
            }

            $numrow++;
        }

        $result = $this->KelolaMap_model->insert_multiple($data);

        if ($result > 0) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    public function update_svg_id()
    {
        $id_prov = $this->input->post('id_prov');
        $updated_svg_path = $this->input->post('updated_svg_path');

        if (!$id_prov || !$updated_svg_path) {
            echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap.'));
            return;
        }

        // Ambil data SVG yang sudah ada di database
        $existing_svg = $this->KelolaMap_model->get_svg_by_id($id_prov);

        if (!$existing_svg) {
            echo json_encode(array('status' => 'error', 'message' => 'SVG tidak ditemukan.'));
            return;
        }

        // Gabungkan data SVG yang baru dengan yang lama
        $updated_svg = $this->merge_svg_data($existing_svg, $updated_svg_path);

        // Update SVG di database
        $result = $this->KelolaMap_model->update_svg($id_prov, $updated_svg);

        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'ID berhasil disimpan!'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Gagal menyimpan ID.'));
        }
    }

    private function merge_svg_data($existing_svg, $updated_svg_path) {
        $dom_existing = new DOMDocument();
        $dom_existing->loadXML($existing_svg);

        $dom_updated = new DOMDocument();
        $dom_updated->loadXML($updated_svg_path);

        $xpath_existing = new DOMXPath($dom_existing);
        $xpath_updated = new DOMXPath($dom_updated);

        // Ambil semua path dari SVG yang diperbarui
        $paths_updated = $xpath_updated->query('//path');

        // Hapus semua path yang ada di SVG lama
        $existing_paths = $xpath_existing->query('//path');
        foreach ($existing_paths as $path_existing) {
            $path_existing->parentNode->removeChild($path_existing);
        }
        log_message('debug', 'Removed all existing paths.');

        // Tambahkan semua path yang diperbarui ke SVG lama
        foreach ($paths_updated as $path_updated) {
            $updated_id = $path_updated->getAttribute('id');
            $new_node = $dom_existing->importNode($path_updated, true);
            $new_node->setAttribute('id', $updated_id); // Set ID pada node baru
            $dom_existing->documentElement->appendChild($new_node);
            log_message('debug', 'Added New Path with ID: ' . $updated_id);
        }

        // Simpan hasil SVG yang diperbarui
        $updated_svg = $dom_existing->saveXML();
        log_message('debug', 'Final Updated SVG: ' . $updated_svg);

        return $updated_svg;
    }


    // private function merge_svg_data($existing_svg, $updated_svg_path) {
    //     $dom_existing = new DOMDocument();
    //     $dom_existing->loadXML($existing_svg);

    //     $dom_updated = new DOMDocument();
    //     $dom_updated->loadXML($updated_svg_path);

    //     $xpath_existing = new DOMXPath($dom_existing);
    //     $xpath_updated = new DOMXPath($dom_updated);

    //     // Ambil semua path dari SVG yang diperbarui
    //     $paths_updated = $xpath_updated->query('//path');

    //     foreach ($paths_updated as $path_updated) {
    //         $updated_id = $path_updated->getAttribute('id');
    //         $updated_path_data = $path_updated->getAttribute('d');
    //         log_message('debug', 'Processing Path with ID: ' . $updated_id . ' and Data: ' . $updated_path_data);

    //         // Cari path yang ada dengan ID yang sama (hapus path dengan ID yang sama jika ada)
    //         $existing_paths_by_id = $xpath_existing->query("//path[@id='$updated_id']");
    //         foreach ($existing_paths_by_id as $path_existing_by_id) {
    //             log_message('debug', 'Removing Existing Path with ID: ' . $updated_id);
    //             $path_existing_by_id->parentNode->removeChild($path_existing_by_id);
    //         }

    //         // Cari path yang ada dengan data (d) yang sama tanpa memperhatikan ID
    //         $existing_paths_by_data = $xpath_existing->query("//path[@d='$updated_path_data']");
    //         foreach ($existing_paths_by_data as $path_existing_by_data) {
    //             log_message('debug', 'Removing Existing Path with Data: ' . $updated_path_data);
    //             $path_existing_by_data->parentNode->removeChild($path_existing_by_data);
    //         }

    //         // Tambahkan path yang diperbarui ke posisi paling atas dengan ID yang benar
    //         $new_node = $dom_existing->importNode($path_updated, true);
    //         $new_node->setAttribute('id', $updated_id); // Set ID pada node baru
    //         $dom_existing->documentElement->insertBefore($new_node, $dom_existing->documentElement->firstChild);

    //         log_message('debug', 'New Path Added to Top with ID: ' . $updated_id);
    //     }

    //     // Simpan hasil SVG yang diperbarui
    //     $updated_svg = $dom_existing->saveXML();
    //     log_message('debug', 'Final Updated SVG: ' . $updated_svg);

    //     return $updated_svg;
    // }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // kode untuk halaman daftar kota

    public function daftar_kota()
    {
        $data['tittle']         = 'kanpa.co.id | Daftar Kota & Kabupaten';
        $data['userdata']       = $this->userdata;
        $data['provinsi']       = $this->KelolaMap_model->get_provinsi_select();
        $data['content']        = 'page_admin/kota/kota';
        $data['script']         = 'page_admin/kota/kota_js';

        $this->load->view($this->template, $data);
    }

    function get_data_kota()
    {
        $prov_filter = $this->input->post('fil_provinsi');
        $kota = $this->KelolaMap_model->get_datatablest($prov_filter);
        $data = array();
        $no = @$_POST['start'];
        foreach ($kota as $kt) {

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $kt->id_kota;
            $row[] = $kt->nama_kota;
            $row[] = $kt->nama_provinsi;

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->KelolaMap_model->count_all(),
            "recordsFiltered" => $this->KelolaMap_model->count_filtered($prov_filter),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
}