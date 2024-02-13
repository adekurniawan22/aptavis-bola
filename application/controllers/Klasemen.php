<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klasemen extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['judul'] = "Klasemen";
		$this->db->select('*');
		$this->db->from('t_klub');
		$this->db->order_by('point', 'DESC');
		$data['klasemen'] = $this->db->get()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('klasemen/index', $data);
		$this->load->view('templates/footer');
	}
}
