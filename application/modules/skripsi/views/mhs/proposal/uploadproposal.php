<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/enhance.js"></script>		
<script type="text/javascript">
	// Run capabilities test
	enhance({
		loadScripts: [
			'<?php echo base_url(); ?>asset/js/jquery-1.9.1.min.js',
			'<?php echo base_url(); ?>asset/js/jQuery.fileinput.js',
			'<?php echo base_url(); ?>asset/js/file-upload.js'
		],
		loadStyles: ['<?php echo base_url(); ?>asset/css/enhanced.css']	
	});   
</script>
<div id="content">
	<?php 	if($cek_menu == '1') {
				echo "<ul class='navigation'>";
				echo"	<a href='".base_url()."skripsi/getuploadproposal'><li id='tab' class='current'>Upload Proposal</li></a>
						<a href='".base_url()."skripsi/getbimbingan'><li id='tab'>Proses Bimbingan</li></a>
						<a href='".base_url()."skripsi/getdfraft'><li id='end-tab'>Upload Draft</li></a>";
			}
			if($cek_menu == '0') {
				echo "<ul class='disable'>";
				echo"	<a href='".base_url()."skripsi/#'><li id='tab'>Upload Proposal</li></a>
						<a href='".base_url()."skripsi/#'><li id='tab'>Proses Bimbingan</li></a>
						<a href='".base_url()."skripsi/#'><li id='end-tab'>Upload Draft</li></a>";
			};?>
	</ul>						
	<div id="content-space">
		<?php echo $msg;?>
		<!--form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>skripsi/datauploadproposal"-->
		
		<?php $attributes = array('class' => 'form-horizontal'); 
			echo form_open_multipart('skripsi/datauploadproposal' , $attributes);?>
			<div id="separate"></div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Masukkan Proposal Skripsi</label>
				<div class="controls">
					<div id="input-file">
						<input type='file' name='userfile' id='userfile'/>						
					</div>
				</div>
				</div>							
				<div class="control-group">
				<label class="control-label" for="inputEmail"></label>
				<div class="controls">
					<i>Tipe file yang diperbolehkan adalah <font color='red'><b>.doc</b> atau <b>.pdf</b></font></i>
				</div>
				</div>	
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<input class="btn" id="btnSimpan" type="submit" value="Kirim Proposal">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Status Proposal Terakhir</label>
						<div class="controls">
							<div class="statussudah">Disetujui</div>
						</div>
				</div>
		</form>
						<div id="separate" ></div>
						
						<table class="table table-bordered table-hover">
							<tr>
								<th width="10px"><center>No</center></th>
								<th><center>File Proposal</center></th>
								<th><center>Tanggal Upload</center></th>
								<th width="125px"><center>Status</center></th>
								<th width="125px"><center>Aksi</center></th>
							</tr>							
							<?php 								
								$no=1;
								foreach ($proposal as $isi=>$qry) {																	
									if ($sts =='p'){
										echo "<tr class='info'>";
										echo"   <td align='center'>".$no."</td>
												<td align='center'>".$qry['NM_FILE']."</td>
												<td align='center'>".$qry['TANGGAL']."</td>
												<td align='center'>Sedang diproses</td>												
												<td align='center'><a class='btn btn-mini' href='http://docs.google.com/viewer?url=".base_url()."".$qry['URL_PROPOSAL'].".doc&embedded=true' target='_blank'><i class='icon-file'></i> View</a></td>												
											</tr>";
									} 
									if ($sts =='s'){
										echo"<tr class='success'>";
										echo"   <td align='center'>".$no."</td>
												<td align='center'>".$qry['NM_FILE']."</td>
												<td align='center'>".$qry['TANGGAL']."</td>
												<td align='center'>Proposal Diterima</td>
											</tr>";
									}																			
									$no++;
								}
								if ($sts == 'k'){
										echo"<tr>";
										echo"	<td colspan='5' align='center'>BELUM ADA DATA PROPOSAL</td>												
											</tr>";
									}
								//echo $sts;
							?>
						</table>						
	</div>					
</div>					