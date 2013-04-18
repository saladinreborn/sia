<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_pbba extends CI_Model
{
	//fungsi untuk memanggil api
	function get_api($url, $output='json', $postorget='GET', $parameter){	
		$api_url = 'http://localhost/apisia/sia_public/'.$url.'/'.$output;
		$hasil = null;
		if ($postorget == 'POST'){
			$hasil = $this->curl->simple_post($api_url, $parameter);
		} else {
			$hasil = $this->curl->simple_get($api_url);
		}
		return json_decode($hasil, TRUE);
	}

	function select_periode($table,$minus){
		$sql = "SELECT DISTINCT TO_CHAR(TGL, 'MONTH YYYY') as PERIODE from $table WHERE TGL < add_months(SYSDATE, $minus)";
		$q = $this->db->query($sql);
		
		return $q;
	}

}