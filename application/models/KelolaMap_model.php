<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaMAp_model extends CI_Model
{
    function get_provinsi()
    {
        $this->db->select('*');
        $this->db->from('map');
        $this->db->join('wilayah_provinsi', 'wilayah_provinsi.id = map.id_prov');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_id_prov($id_prov)
    {
        $this->db->where('id_prov', $id_prov);
        $query = $this->db->get('map');
        return $query->row();
    }

    function get_provinsi_select()
    {
        $this->db->select('*');
        $this->db->from('wilayah_provinsi');
        $query = $this->db->get();
        return $query->result();
    }

    function get_map_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('map');
        $this->db->where('id_prov', $id);
        $query = $this->db->get();

        log_message('debug', 'Query: ' . $this->db->last_query());

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    function save_data($data)
    {
        return $this->db->insert('map', $data);
    }

    public function countByProv($id_prov)
    {
        $this->db->where('id_prov', $id_prov);
        $this->db->from('data_map');
        return $this->db->count_all_results();
    }


    // kode untuk import data map excel
    public function upload_file($filename)
    {
        $this->load->library('upload');

        $config['upload_path'] = './upload/excel/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size'] = '2048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;

        $this->upload->initialize($config);
        if ($this->upload->do_upload('file')) {
            return array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
        } else {
            return array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
        }
    }

    public function insert_multiple($data)
    {
        $this->db->insert_batch('data_map', $data);
        return $this->db->affected_rows();
    }

    public function get_svg_by_id($id_prov) {
        $this->db->select('svg_map');
        $this->db->from('map');
        $this->db->where('id_prov', $id_prov);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->svg_map;
        } else {
            return null;
        }
    }

    public function update_svg($id_prov, $updated_svg_path) {
        // Update query
        $this->db->where('id_prov', $id_prov);
        return $this->db->update('map', array('svg_map' => $updated_svg_path));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // kode datatables KOTA

    var $column_order = array(null, 'wilayah_kota.id_kota', 'wilayah_kota.nama_kota');
    var $column_search = array('wilayah_kota.id_kota', 'wilayah_kota.nama_kota', 'wilayah_provinsi.nama');
    var $ordertrx = array('wilayah_kota.id_kota' => 'ASC');

    private function _get_datatables_trx($prov_filter)
    {

        $this->db->select('wilayah_kota.id_kota, wilayah_kota.nama_kota, wilayah_provinsi.nama AS nama_provinsi');
        $this->db->from('wilayah_kota');
        $this->db->join('wilayah_provinsi', 'wilayah_provinsi.id = wilayah_kota.provinsi_id');
        $this->db->order_by('wilayah_kota.id_kota', 'ASC');


        if ($prov_filter !== '') {
            $this->db->where('wilayah_kota.provinsi_id', $prov_filter);
        }

        $i = 0;
        foreach ($this->column_search as $trx) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($trx, $_POST['search']['value']);
                } else {
                    $this->db->or_like($trx, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $order_column = $this->column_order[$_POST['order']['0']['column']];
            if ($order_column === 'tanggal') {
                $this->db->order_by('keuangan.tanggal', $_POST['order']['0']['dir']);
            } else {
                $this->db->order_by($order_column, $_POST['order']['0']['dir']);
            }
        } else if (isset($this->ordertrx)) {
            $order = $this->ordertrx;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatablest($prov_filter)
    {
        $this->_get_datatables_trx($prov_filter);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($prov_filter)
    {
        $this->_get_datatables_trx($prov_filter);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from('wilayah_kota');
        return $this->db->count_all_results();
    }
}