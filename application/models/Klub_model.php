<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klub_model extends CI_Model
{
    public function get_all_klub()
    {
        $query = $this->db->get('t_klub');
        return $query->result();
    }

    public function get_one_klub($id_klub)
    {
        $this->db->where('id_klub', $id_klub);
        $query = $this->db->get('t_klub');
        return $query->row();
    }

    public function add_klub($data)
    {
        $this->db->insert('t_klub', $data);
        return $this->db->insert_id();
    }

    public function delete_klub($id_klub)
    {
        $this->db->where('id_klub', $id_klub);
        $this->db->delete('t_klub');
        return $this->db->affected_rows();
    }

    public function edit_klub($id_klub, $data)
    {
        $this->db->where('id_klub', $id_klub);
        $this->db->update('t_klub', $data);
        return $this->db->affected_rows();
    }
}
