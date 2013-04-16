<script>
	(function($){
		$(window).load(function(){
			$("#content_scroll").mCustomScrollbar({
				scrollButtons:{
					enable:true
				},
				theme:"dark-thick"
			});
		});
	})(jQuery);
</script>

<div id="content">
	<ul class="navigation">				
		<a href="<?php echo base_url(); ?>pbba/pendaftaran"><li id="tab" >Pendaftaran</li></a>
		<a href="<?php echo base_url(); ?>pbba/pilihjadwal"><li id="tab" class="current">Pilih Jadwal</li></a>
		<a href="<?php echo base_url(); ?>pbba/infojadwal"><li id="tab">Info Jadwal</li></a>
		<a href="<?php echo base_url(); ?>pbba/infonilai"><li id="end-tab" >Info Nilai</li></a>
	</ul>		
	
	<div id="content-space">
		<h2>Jadwal Ujian Sertifikasi (TOEC dan IKLA)</h2>
		<div class="scroll" id="content_scroll">
			<div class="jadwal">
				<h3>Jadwal Ujian TOEC yang tersedia</h3>
			<table class="table table-bordered table-hover table-condensed">
			<thead>
				<tr>
					<th>No.</th>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Ruang</th>
					<th>Terisi</th>
					<th>Kuota</th>
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$i = 0;
						foreach ($english->result() as $isi) {
						$i++;
						$mulai = $isi->JAM_MULAI;
						$selesai = $isi->JAM_SELESAI;
						$ruang = $isi->KD_RUANG;
						$kelas= $isi->KD_KELAS;
						$terisi = $isi->JUMLAH;

						//foreach ($this->mdl_pbba->count_peserta($kd['j'],$kd['k'])->result() as $jml) {						
				?>
				<tr class="success">
					<td><?php echo $i; ?></td>
					<td><?php echo strftime("%A", strtotime($isi->TGL)); ?></td>
					<td><?php echo date("d F Y", strtotime($isi->TGL)); ?></td>
					<td><?php echo $mulai." - ".$selesai;?></td>
					<td><?php echo $ruang; ?></td>
					<td><?php echo $terisi; ?> </td>
					<td><?php echo $isi->KUOTA; ?></td>
					<td><a href="" class="btn btn-small">Daftar</a></td>
				</tr>
				<?php //}
				 } ?>
			</tbody>
			</table>
			
			<h3>Jadwal Sebelumnya</h3>
			<form class="form-horizontal" name="pilihbulan">
				<div class="control-group">
					<span ><strong>Bulan</strong></span>
					<!-- <div class="controls controls-row">-->
						<select>
						<option>Maret 2013</option>
						<option>Februari 2013</option>
						<option>Januari 2013</option>
						<option>Desember 2012</option>
						<option>November 2012</option>
					</select>
					<!-- </div> -->
				</div>
			</form>

			<table class="table table-bordered table-hover table-condensed">
			<thead>
				<tr>
					<th>No.</th>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Ruang</th>
					<th>Terisi</th>
					<th>Kuota</th>
					<th>Keterangan</th>
				</tr>
				</thead>
				<tbody>
				<tr class="success">
					<td>1</td>
					<td>Senin</td>
					<td>5 Maret 2013</td>
					<td>07.30 - 09.00</td>
					<td>Ujian</td>
					<td>23</td>
					<td>30</td>
					<td>Penuh</td>
				</tr>
				<tr class="error">
					<td>2</td>
					<td>Senin</td>
					<td>5 Maret 2013</td>
					<td>07.30 - 09.00</td>
					<td>Ujian</td>
					<td>30</td>
					<td>30</td>
					<td>Penuh</td>
				</tr>
				<tr class="error">
					<td>3</td>
					<td>Senin</td>
					<td>5 Maret 2013</td>
					<td>07.30 - 09.00</td>
					<td>Ujian</td>
					<td>31</td>
					<td>30</td>
					<td>Penuh</td>
				</tr>
			</tbody>
			</table>
			</div>

	<div class="jadwal">
	<h3>Jadwal Ujian IKLA yang tersedia</h3>
	<table class="table table-bordered table-hover table-condensed">
			<thead>
				<tr>
					<th>No.</th>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Ruang</th>
					<th>Terisi</th>
					<th>Kuota</th>
					<th>Keterangan</th>
				</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
						foreach ($arabic->result() as $isi) {
						$i++;
						$mulai = $isi->JAM_MULAI;
						$selesai = $isi->JAM_SELESAI;
						$ruang = $isi->KD_RUANG;
						$kelas= $isi->KD_KELAS;
						$terisi = $isi->JUMLAH;

						//foreach ($this->mdl_pbba->count_peserta($kd['j'],$kd['k'])->result() as $jml) {						
				?>
				<tr class="warning">
					<td><?php echo $i; ?></td>
					<td><?php echo strftime("%A", strtotime($isi->TGL)); ?></td>
					<td><?php echo date("d F Y", strtotime($isi->TGL)); ?></td>
					<td><?php echo $mulai." - ".$selesai;?></td>
					<td><?php echo $ruang; ?></td>
					<td><?php echo $terisi; ?> </td>
					<td><?php echo $isi->KUOTA; ?></td>
					<td><a href="" class="btn btn-small">Daftar</a></td>
				</tr>
			<?php } 
				//} ?>
				
			</tbody>
			</table>
		</div>

	</div>
	</div>
</div>