<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klub extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Klub_model');
	}

	public function index()
	{
		$data['judul'] = "Klub";
		$data['klub'] = $this->Klub_model->get_all_klub();
		$this->load->view('templates/header', $data);
		$this->load->view('klub/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_klub()
	{
		$data['judul'] = "Klub";
		$this->load->view('templates/header', $data);
		$this->load->view('klub/tambah_klub');
		$this->load->view('templates/footer');
	}

	public function proses_tambah_klub()
	{
		$this->form_validation->set_rules('nama_klub', 'Nama Klub', 'required|trim|is_unique[t_klub.nama_klub]');
		$this->form_validation->set_rules('asal_kota_klub', 'Asal Kota Klub', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_klub();
		} else {
			$data_klub = [
				'nama_klub' => $this->input->post('nama_klub'),
				'asal_kota_klub' => $this->input->post('asal_kota_klub')
			];

			$result = $this->Klub_model->add_klub($data_klub);
			if ($result) {
				$this->session->set_flashdata('pesan', 'Data klub <strong>berhasil ditambahkan</strong>');
			} else {
				$this->session->set_flashdata('pesan', 'Data klub <strong>gagal ditambahkan</strong>');
			}
			redirect('klub');
		}
	}

	public function edit_klub()
	{
		$data['judul'] = "Klub";
		$data['klub'] = $this->Klub_model->get_one_klub($this->input->post('id_klub'));
		$this->load->view('templates/header', $data);
		$this->load->view('klub/edit_klub', $data);
		$this->load->view('templates/footer');
	}

	public function proses_edit_klub()
	{
		$check_data_klub = $this->Klub_model->get_one_klub($this->input->post('id_klub'));
		if ($this->input->post('nama_klub') != $check_data_klub->nama_klub) {
			$this->form_validation->set_rules('nama_klub', 'Nama Klub', 'required|trim|is_unique[t_klub.nama_klub]');
		}
		$this->form_validation->set_rules('asal_kota_klub', 'Asal Kota Klub', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->edit_klub();
		} else {
			$data_klub = [
				'nama_klub' => $this->input->post('nama_klub'),
				'asal_kota_klub' => $this->input->post('asal_kota_klub')
			];

			$result = $this->Klub_model->edit_klub($this->input->post('id_klub'), $data_klub);
			if ($result) {
				$this->session->set_flashdata('pesan', 'Data klub <strong>berhasil diedit</strong>');
			} else {
				$this->session->set_flashdata('pesan', 'Data klub <strong>tidak ada yang diedit</strong>');
			}
			redirect('klub');
		}
	}

	public function hapus_klub()
	{
		$id_klub = $this->input->post('id_klub');
		$result = $this->Klub_model->delete_klub($id_klub);
		if ($result) {
			$this->session->set_flashdata('pesan', 'Data klub <strong>berhasil dihapus</strong>');
		} else {
			$this->session->set_flashdata('pesan', 'Data klub <strong>gagal dihapus</strong>');
		}
		redirect('klub');
	}
}
