<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pbba extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_pbba');
	}

	function index()
	{
		$this->pendaftaran();
	}


	function pendaftaran()
	{
 		
 		$this->load->view('pbba/mhs/header');
		$this->load->view('pbba/mhs/content');
		$this->load->view('pbba/mhs/v-pendaftaran');
		$this->load->view('pbba/mhs/footer');
 		
	}

	function pilihjadwal()
	{

		$en_test = $this->show_jadwal('PBBA_JADWAL','en');
		$ar_test = $this->show_jadwal('PBBA_JADWAL','ar');
		$prd_test = $this->show_periode('PBBA_JADWAL',-1);
		

		$m = array('english' => $en_test,
					'arabic' => $ar_test,
					'periode' => $prd_test);
 		$this->load->view('pbba/mhs/header');
 		$this->load->view('pbba/mhs/content');
		$this->load->view('pbba/mhs/v-pilihjadwal',$m);
		$this->load->view('pbba/mhs/footer');
		
	}

	private function show_jadwal($table='',$ujian=''){
		$data = $this->mdl_pbba->get_api(
					'sia_pbba_mhs/get_data',
					'json',
					'POST',
					array(	'api_kode' 		=> 1000,
							'api_subkode' 	=> 1,
							'api_search' 	=> array($table,$ujian))
		);		
		return $data;
	}
	
	private function show_periode($table='',$minus=''){
		$data = $this->mdl_pbba->get_api(
					'sia_pbba_mhs/select_periode',
					'json',
					'POST',
					array(	'api_kode' 		=> 1000,
							'api_subkode' 	=> 1,
							'api_search' 	=> array($table,$minus))
		);		
		return $data;
	}

	/* fungsi untuk page INFO JADWAL */
	function infojadwal()
	{
		$info_j = $this->show_info_j('09650051');
		$m = array('info' => $info_j );
		$this->load->view('pbba/mhs/header');
 		$this->load->view('pbba/mhs/content');
		$this->load->view('pbba/mhs/v-infojadwal', $m);
		$this->load->view('pbba/mhs/footer');
	}

	private function show_info_j($nim){
		$data = $this->mdl_pbba->get_api(
					'sia_pbba_mhs/get_info_j',
					'json',
					'POST',
					array(	'api_kode' 		=> 1000,
							'api_subkode' 	=> 1,
							'api_search' 	=> array($nim))
		);		
		return $data;
	}



	function infonilai()
	{
		$info_j = $this->show_info_j('09650051');
		$m = array('info' => $info_j );
		$this->load->view('pbba/mhs/header');
 		$this->load->view('pbba/mhs/content');
		$this->load->view('pbba/mhs/v-infonilai',$m);
		$this->load->view('pbba/mhs/footer');
	}

}