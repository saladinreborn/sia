<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skripsi extends CI_Controller {
	
	function __construct(){
        parent::__construct();        
        session_start();
		$this->load->helper(array('form','url', 'text_helper','date'));
		$this->load->model('mdl_skripsi');
		$this->load->library(array('Pagination','image_lib'));
    }

	function index(){
		$login['nim'] = '09650031';
		$this->session->set_userdata($login);		
		if ($this->session->userdata('nim')) {     
			$this->load->view('skripsi/mhs/page/header');
			$this->load->view('skripsi/mhs/page/content');
				if($this->cek_matkul_akhir()){
					$dt['cek_menu'] = '1';
					$this->load->view('skripsi/mhs/homeskripsi/contentspace',$dt);
				}else{
					$dt['cek_menu'] = '0';
					$this->load->view('skripsi/mhs/homeskripsi/contentspace',$dt);
				}
			$this->load->view('skripsi/mhs/page/footer');								
        }
	}	
	
	function getuploadproposal(){
		if ($this->session->userdata('nim')) {	
			$sta = '';
			$dt['msg'] = '';			
			$this->load->view('skripsi/mhs/page/header');
			$this->load->view('skripsi/mhs/page/content');
			if($this->cek_matkul_akhir()){
				$dt['proposal'] = $this->get_data_proposal();
				$dt['cek_menu'] = '1';
				$dt['sts']		= $this->get_status_proposal();
				$this->load->view('skripsi/mhs/proposal/uploadproposal',$dt);
			}else{
				$dt['cek_menu'] = '0';
				$this->load->view('skripsi/mhs/homeskripsi/contentspace',$dt);
			}			
			$this->load->view('skripsi/mhs/page/footer');
			//print_r ($dt['sts']);
		}
	}
	private function get_status_proposal(){			
		if ($this->cek_upload_proposal() > 0){
			foreach (($this->get_data_proposal()) as $isi=>$qry) {						
				if ($qry['STATUS_DOSEN_PA'] == 'p' AND $qry['STATUS_KAPRODI'] == 'p'){
					$dt['status'] = 'p';
				}
				elseif ($qry['STATUS_DOSEN_PA'] == 's' AND $qry['STATUS_KAPRODI'] == 's' ){
					$dt['status'] = 's';			
				}			
			}
		} else{
			$dt['status'] = 'k';
		}
		//print_r ($dt['status']);
		return $dt['status'];
	}
	
	function datauploadproposal(){
		if ($this->session->userdata('nim')) {
			if($this->cek_matkul_akhir()){
				$tgl 	= "%m-%d-%Y";
				$jam 	= "%h:%i:%a";
				$time 	= time();
				
				$no = 1;
				if ($this->cek_upload_proposal()){
					$no = $no + $this->cek_upload_proposal();
				}
				$dt['ID_DOSEN_PA']		= $this->cek_dosen_pa();
				$dt['ID_KAPRODI']		= $this->cek_kaprodi();
				$dt['NIM']				= $this->session->userdata('nim');
				$dt['DATE_PROPOSAL']	= mdate($tgl,$time);
				$dt['JAM'] 				= mdate($jam,$time);
				$dt['STATUS_DOSEN_PA']	= 'p';
				$dt['STATUS_KAPRODI']	= 'p';
				$dt['URL_MASUK']		= substr(($_FILES['userfile']['name']), -3);
				
				$config['upload_path'] 		= './media/file';
				$config['file_name'] 		= $this->session->userdata('nim').'_PROPOSAL_'.$no;
				$config['allowed_types'] 	= 'doc|pdf';				
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload()){
					$dt['msg'] 		= $this->upload->display_errors();					
					$dt['proposal'] = $this->get_data_proposal();
					$dt['sts']		= $this->get_status_proposal();
					if($this->cek_matkul_akhir()){
						$dt['cek_menu'] = '1';
						$this->load->view('skripsi/mhs/page/header');
						$this->load->view('skripsi/mhs/page/content');
						$this->load->view('skripsi/mhs/proposal/uploadproposal',$dt);
						$this->load->view('skripsi/mhs/page/footer');
					}
				}
				else {
					if($dt['URL_MASUK']=='doc'){
						$dt['URL_PROPOSAL']= "media/file/".$config['file_name'].".doc";
					}elseif($dt['URL_MASUK']=='pdf'){
						$dt['URL_PROPOSAL']= "media/file/".$config['file_name'].".pdf";
					}
					$data = $this->mdl_skripsi->get_api(
						'sia_skripsi_proposal/data_uploadproposal',
						'json',
						'POST',
						array(	'api_kode' => 1000,
								'api_subkode' => 1,
								'api_search' => array(
									$dt['ID_DOSEN_PA'],$dt['ID_KAPRODI'],$dt['NIM'],
									$dt['URL_PROPOSAL'],$dt['DATE_PROPOSAL'],$dt['JAM'],
									$dt['STATUS_DOSEN_PA'],$dt['STATUS_KAPRODI']))
						);					
					redirect('skripsi/getuploadproposal');
				}
			}
		}
	}
	

	function getskripsi(){
		$this->load->view('skripsi/mhs/page/header');
		$this->load->view('skripsi/mhs/page/content');		
		$this->load->view('skripsi/mhs/homeskripsi/contentspace');		
		$this->load->view('skripsi/mhs/page/footer');	
	}
	
	
	
	function getbimbingan(){
		$this->load->view('skripsi/mhs/page/header');
		$this->load->view('skripsi/mhs/page/content');
		$this->load->view('skripsi/mhs/bimbingan/proses');
		$this->load->view('skripsi/mhs/page/footer');
	}

	
	private function cek_matkul_akhir(){
		$data = $this->mdl_skripsi->get_api(
					'sia_skripsi_mhs/data_matkul_akhir',
					'json',
					'POST',
					array(	'api_kode' => 1000,
							'api_subkode' => 1,
							'api_search' => array($this->session->userdata('nim')))
		);			
		if (count($data) > 0){
			foreach ($data as $isi=>$qry) {
				$nm_status = $qry['NM_STATUS'];
				if ($nm_status == 'Aktif'){
					return TRUE;
				}
				else{
					return FALSE;
				}
			}
		}else{
			return FALSE;
		}			
	}
	
	private function cek_upload_proposal(){
		$data = $this->mdl_skripsi->get_api(
					'sia_skripsi_mhs/cek_upload_proposal',
					'json',
					'POST',
					array(	'api_kode' 		=> 1000,
							'api_subkode' 	=> 1,
							'api_search' 	=> array($this->session->userdata('nim')))
		);		
		return (count($data));
	}
	
	private function cek_dosen_pa(){
		$data = $this->mdl_skripsi->get_api(
					'sia_skripsi_mhs/cek_dosen_pa',
					'json',
					'POST',
					array(	'api_kode' => 1000,
							'api_subkode' => 1,
							'api_search' => array($this->session->userdata('nim')))
		);			
		
		foreach ($data as $isi=>$qry) {
			$kd_dosen = $qry['KD_DOSEN_WALI'];								
		}
		return $kd_dosen;
	}
	
	private function cek_kaprodi(){
		$data = $this->mdl_skripsi->get_api(
					'sia_skripsi_mhs/cek_kaprodi',
					'json',
					'POST',
					array(	'api_kode' => 1000,
							'api_subkode' => 1,
							'api_search' => array($this->session->userdata('nim')))
		);			
		//print_r($data);		
		foreach ($data as $isi=>$qry) {
			$kd_dosen = $qry['KD_DOSEN'];								
		}
		return $kd_dosen;
	}
	
	private function get_data_proposal(){
		$data = $this->mdl_skripsi->get_api(
					'sia_skripsi_proposal/gettabelproposal',
					'json',
					'POST',
					array(	'api_kode' => 1000,
							'api_subkode' => 1,
							'api_search' => array($this->session->userdata('nim')))
		);			
		return $data;				
	}
	
	/* function coba(){
		foreach (($this->get_data_proposal()) as $isi=>$qry) {						
			if ($qry['STATUS_DOSEN_PA'] == 'p' AND $qry['STATUS_KAPRODI'] == 'p'){
				$dt['status'] = 'p';
			}
			elseif ($qry['STATUS_DOSEN_PA'] == 's' AND $qry['STATUS_KAPRODI'] == 's' ){
				$dt['status'] = 's';			
			}			
		}
		echo $dt['status'];
	} */

	function logout() {
        $this->session->unset_userdata('nim');       
    } 	
}
