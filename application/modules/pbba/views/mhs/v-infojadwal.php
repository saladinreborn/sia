<div id="content">
	<ul class="navigation">				
		<a href="<?php echo base_url(); ?>pbba/pendaftaran"><li id="tab">Pendaftaran</li></a>
		<a href="<?php echo base_url(); ?>pbba/pilihjadwal"><li id="tab">Pilih Jadwal</li></a>
		<a href="<?php echo base_url(); ?>pbba/infojadwal"><li id="tab" class="current">Info Jadwal</li></a>
		<a href="<?php echo base_url(); ?>pbba/infonilai"><li id="end-tab">Info Nilai</li></a>
	</ul>

<div id="content-space">
		<h2>Jadwal Ujian TOEC dan IKLA</h2>
			<h3>Jadwal yang telah diambil</h3>
			<table class="table table-bordered table-hover ">
			<thead>
				<tr>
					<th>No.</th>
					<th>Ujian</th>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Ruang</th>
					<th>Keterangan</th>
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
					if (date("Y-M-d", strtotime($date)) >= date("Y-M-d"))
						$status = 'Akan Diikuti';
					else
						$status = 'Sudah Lewat';
			?>
				<tr class="warning">
					<td><?php echo $i;?></td>
					<td><?php echo $ujian;?></td>
					<td><?php echo strftime("%A", strtotime($date));?></td>
					<td><?php echo $date;?></td>
					<td><?php echo $mulai." - ".$selesai;?></td>
					<td><?php echo $ruang;?></td>
					<td><?php echo $status;?></td>
				</tr>
			<?php } ?>
			</tbody>
			</table>
		</div>
	</div>