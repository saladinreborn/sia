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
		$en_test = $this->mdl_pbba->get_data('PBBA_JADWAL','en');
		$ar_test = $this->mdl_pbba->get_data('PBBA_JADWAL','ar');

/*		foreach ($en_test->result() as $isi) {	
			$kd_j = $isi->KD_JADWAL;
			$kd_k = $isi->KD_KELAS;
			$mulai = $isi->JAM_MULAI;
			$selesai = $isi->JAM_SELESAI;
			$ruang = $isi->KD_RUANG;
			$jumlah = $this->jumlah_peserta($kd_j, $kd_k);
		}
*/		$m = array('english' => $en_test,
					'arabic' => $ar_test);
 		$this->load->view('pbba/mhs/header');
 		$this->load->view('pbba/mhs/content');
		$this->load->view('pbba/mhs/v-pilihjadwal',$m);
		$this->load->view('pbba/mhs/footer');
		
	}

	/*private function jumlah_peserta($kd_j,$kd_k){
		$jumlah = $this->mdl_pbba->count_peserta($kd_j,$kd_k);
		foreach ($jumlah->result() as $jml ) {
			$jml->JUMLAH;
		}
	}*/

	function infojadwal()
	{
		$this->load->view('pbba/mhs/header');
 		$this->load->view('pbba/mhs/content');
		$this->load->view('pbba/mhs/v-infojadwal');
		$this->load->view('pbba/mhs/footer');
	}

	function infonilai()
	{
		$this->load->view('pbba/mhs/header');
 		$this->load->view('pbba/mhs/content');
		$this->load->view('pbba/mhs/v-infonilai');
		$this->load->view('pbba/mhs/footer');
	}

}