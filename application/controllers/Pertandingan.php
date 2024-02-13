<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertandingan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pertandingan_model');
		$this->load->model('Klub_model');
	}

	public function index()
	{
		$data['judul'] = "Skor Pertandingan";
		$data['pertandingan'] = $this->Pertandingan_model->get_all_pertandingan();
		$this->load->view('templates/header', $data);
		$this->load->view('pertandingan/index', $data);
		$this->load->view('templates/footer');
	}


	public function tambah_pertandingan()
	{
		$data['judul'] = "Skor Pertandingan";
		$data['klubs'] = $this->Klub_model->get_all_klub();
		$this->load->view('templates/header', $data);
		$this->load->view('pertandingan/tambah_pertandingan');
		$this->load->view('templates/footer');
	}

	public function check_duplicate()
	{
		$id_kandang = $this->input->post('id_kandang');
		$id_tandang = $this->input->post('id_tandang');

		$this->db->where('id_kandang', $id_kandang);
		$this->db->where('id_tandang', $id_tandang);
		$query = $this->db->get('t_pertandingan');

		$duplicate = ($query->num_rows() > 0);

		echo json_encode(array('duplicate' => $duplicate));
	}

	public function proses_tambah_pertandingan()
	{
		for ($i = 0; $i < count($_POST['id_tandang']); $i++) {
			$data =  [
				'id_kandang' => $_POST['id_kandang'][$i],
				'id_tandang' => $_POST['id_tandang'][$i],
				'skor_kandang' => $_POST['skor_kandang'][$i],
				'skor_tandang' => $_POST['skor_tandang'][$i],
			];

			$result = $this->db->insert('t_pertandingan', $data);

			// Update data klub kandang
			$this->db->set('goal', 'goal + ' . $_POST['skor_kandang'][$i], false);
			$this->db->set('kebobolan', 'kebobolan + ' . $_POST['skor_tandang'][$i], false);
			$this->db->set('menang', 'menang + ' . ($_POST['skor_kandang'][$i] > $_POST['skor_tandang'][$i] ? 1 : 0), false);
			$this->db->set('seri', 'seri + ' . ($_POST['skor_kandang'][$i] == $_POST['skor_tandang'][$i] ? 1 : 0), false);
			$this->db->set('kalah', 'kalah + ' . ($_POST['skor_kandang'][$i] < $_POST['skor_tandang'][$i] ? 1 : 0), false);
			$this->db->set('point', 'point + ' . ($_POST['skor_kandang'][$i] > $_POST['skor_tandang'][$i] ? 3 : ($_POST['skor_kandang'][$i] == $_POST['skor_tandang'][$i] ? 1 : 0)), false);

			$this->db->where('id_klub', $_POST['id_kandang'][$i]);
			$this->db->update('t_klub');

			// Update data klub tandang
			$this->db->set('goal', 'goal + ' . $_POST['skor_tandang'][$i], false);
			$this->db->set('kebobolan', 'kebobolan + ' . $_POST['skor_kandang'][$i], false);
			$this->db->set('menang', 'menang + ' . ($_POST['skor_tandang'][$i] > $_POST['skor_kandang'][$i] ? 1 : 0), false);
			$this->db->set('seri', 'seri + ' . ($_POST['skor_tandang'][$i] == $_POST['skor_kandang'][$i] ? 1 : 0), false);
			$this->db->set('kalah', 'kalah + ' . ($_POST['skor_tandang'][$i] < $_POST['skor_kandang'][$i] ? 1 : 0), false);
			$this->db->set('point', 'point + ' . ($_POST['skor_tandang'][$i] > $_POST['skor_kandang'][$i] ? 3 : ($_POST['skor_tandang'][$i] == $_POST['skor_kandang'][$i] ? 1 : 0)), false);

			$this->db->where('id_klub', $_POST['id_tandang'][$i]);
			$this->db->update('t_klub');
		}

		if ($result) {
			$this->session->set_flashdata('pesan', 'Data skor pertandingan <strong>berhasil ditambahkan</strong>');
		} else {
			$this->session->set_flashdata('pesan', 'Data skor pertandingan <strong>tidak ada yang ditambahkan</strong>');
		}
		redirect('pertandingan');
	}

	public function edit_pertandingan()
	{
		$data['judul'] = "Skor Pertandingan";
		$data['klubs'] = $this->Klub_model->get_all_klub();
		$data['pertandingan'] = $this->Pertandingan_model->get_one_pertandingan($this->input->post('id_pertandingan'));
		$this->load->view('templates/header', $data);
		$this->load->view('pertandingan/edit_pertandingan');
		$this->load->view('templates/footer');
	}

	public function proses_edit_pertandingan()
	{
		$this->form_validation->set_rules('id_kandang', 'Tim Kandang', 'required');
		$this->form_validation->set_rules('id_tandang', 'Tim Tandang', 'required');
		$this->form_validation->set_rules('skor_kandang', 'Skor Tim Kandang', 'required');
		$this->form_validation->set_rules('skor_tandang', 'Skorn Tim Tandang', 'required');

		if ($this->form_validation->run() == false) {
			$this->edit_pertandingan();
		} else {
			echo "masuk";
		}
	}

	public function hapus_pertandingan()
	{
		$id_pertandingan = $this->input->post('id_pertandingan');
		$result = $this->Pertandingan_model->delete_pertandingan($id_pertandingan);
		if ($result) {
			$this->session->set_flashdata('pesan', 'Data pertandingan <strong>berhasil dihapus</strong>');
		} else {
			$this->session->set_flashdata('pesan', 'Data pertandingan <strong>gagal dihapus</strong>');
		}
		redirect('pertandingan');
	}
}
