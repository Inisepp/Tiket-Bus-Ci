<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('username_admin');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('login');
		}
	}
	public function index(){
	$data['title'] = "List Tiket";
	$data['tiket'] = $this->db->query("SELECT * FROM tbl_tiket ")->result_array();
	// die(print_r($data));
	$this->load->view('tiket', $data);	
	}
	public function viewtiket($tiket){
		$data['title'] = "List Tiket";
		$data['tiket'] = $this->db->query("SELECT * FROM tbl_tiket WHERE kd_tiket = '".$tiket."'")->row_array();
		if ($data['tiket']) {
			$this->load->view('view_tiket', $data);
		}else{
			$this->session->set_flashdata('message', 'swal("Kosong", "Tiket Tidak Ada", "error");');
    		redirect('tiket');
		}	
	}

}