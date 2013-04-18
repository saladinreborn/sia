<div id="content">
	<div class="topline-content"></div>
		<ul class="navigation">				
			<a href="<?php echo base_url(); ?>pbba/pendaftaran"><li id="tab">Pendaftaran</li></a>
			<a href="<?php echo base_url(); ?>pbba/pilihjadwal"><li id="tab">Pilih Jadwal</li></a>
			<a href="<?php echo base_url(); ?>pbba/infojadwal"><li id="tab">Info Jadwal</li></a>
			<a href="<?php echo base_url(); ?>pbba/infonilai"><li id="end-tab" class="current">Info Nilai</li></a>
		</ul>		
<div id="content-space">
		<h2>Informasi Nilai Ujian TOEC dan IKLA</h2>
			<h3>Nilai Ujian Terbaru</h3>
			<table class="table table-bordered table-hover mid">
			<thead>
				<tr>
					<th rowspan="2">No.</th>
					<th rowspan="2">Ujian</th>
					<th colspan="4">Jadwal</th>
					<th rowspan="2">Nilai</th>
					<th rowspan="2">Keterangan</th>
				</tr>
				<tr>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Ruang</th>
				</tr>
			</thead>
				<tbody>
				<?php 
				$i = 0;
				foreach ($info as $isi => $value) {
					$i++;
					if ($value['UJIAN']=='en'){
						$ujian = 'TOEC';
					}
					else {
						$ujian = 'IKLA';
					} 
						
					$ruang = $value['NM_RUANG'];
					$date = $value['TGL'];
					$mulai = $value['JAM_MULAI'];
					$selesai = $value['JAM_SELESAI'];
					$nilai = $value['NILAI'];
					
					if ($nilai >= 400)
						$status='Lulus';
					else 
						$status='Belum Lulus';
			?>
				<tr class="warning">
					<td><?php echo $i;?></td>
					<td><?php echo $ujian;?></td>
					<td><?php echo strftime("%A", strtotime($date));?></td>
					<td><?php echo $date;?></td>
					<td><?php echo $mulai." - ".$selesai;?></td>
					<td><?php echo $ruang;?></td>
					<td><?php echo $nilai;?></td>
					<td><?php echo $status;?></td>
				</tr>
			<?php } ?>
			</tbody>
			</table>

			<h3>Nilai Ujian yang Pernah Diikuti</h3>
			<table class="table table-bordered table-hover mid">
				<thead>
				<tr>
					
					<th >Ujian</th>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Ruang</th>
					<th >Nilai</th>
					<th >Keterangan</th>
				</tr>
			</thead>
			</table>
		</div>
	</div>