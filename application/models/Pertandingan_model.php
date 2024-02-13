<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertandingan_model extends CI_Model
{
    public function get_all_pertandingan()
    {
        $query = $this->db->get('t_pertandingan');
        return $query->result();
    }

    public function get_one_pertandingan($id_pertandingan)
    {
        $this->db->where('id_pertandingan', $id_pertandingan);
        $query = $this->db->get('t_pertandingan');
        return $query->row();
    }

    public function add_pertandingan($data)
    {
        $this->db->insert('t_pertandingan', $data);
        return $this->db->insert_id();
    }

    public function delete_pertandingan($id_pertandingan)
    {
        $this->db->where('id_pertandingan', $id_pertandingan);
        $this->db->delete('t_pertandingan');
        return $this->db->affected_rows();
    }

    public function edit_pertandingan($id_pertandingan, $data)
    {
        $this->db->where('id_pertandingan', $id_pertandingan);
        $this->db->update('t_pertandingan', $data);
        return $this->db->affected_rows();
    }
}
