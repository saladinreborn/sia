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

/*	function get_data($table,$ujian){
		$sql = "select * from $table where substr(KD_JADWAL, 0,2)='$ujian'";
		$q = $this->db->query($sql);
		return $q;
	}*/

	/*function count_peserta($kode_j, $kode_k){
		$q = $this->db->query("select count(*) as JUMLAH from PBBA_PESERTA_UJIAN where KD_JADWAL='$kode_j' and KD_KELAS='$kode_k'");
		return $q;
	}*/

	function get_data($table,$ujian){
		$sql = "select KD_JADWAL, KD_KELAS, KD_RUANG, TGL, JAM_MULAI, JAM_SELESAI, KUOTA,
		 (select count(*)
		 	from PBBA_PESERTA_UJIAN
		 	where PBBA_JADWAL.KD_JADWAL = PBBA_PESERTA_UJIAN.KD_JADWAL
		 	and
		 	PBBA_JADWAL.KD_KELAS = PBBA_PESERTA_UJIAN.KD_KELAS)
		as JUMLAH
		from $table where substr(KD_JADWAL, 0,2)='$ujian'";

		$q = $this->db->query($sql);
		return $q;
	}

	function select_data($table,$ujian,$date){
		$sql = "select KD_JADWAL, KD_KELAS, KD_RUANG, TGL, JAM_MULAI, JAM_SELESAI, KUOTA,
		 (select count(*)
		 	from PBBA_PESERTA_UJIAN
		 	where PBBA_JADWAL.KD_JADWAL = PBBA_PESERTA_UJIAN.KD_JADWAL
		 	and
		 	PBBA_JADWAL.KD_KELAS = PBBA_PESERTA_UJIAN.KD_KELAS)
		as JUMLAH
		from $table where substr(KD_JADWAL, 0,2)='$ujian' and TGL < $date";

		$q = $this->db->query($sql);
		return $q;
	}

	function taken_jadwal()	{

	}

}