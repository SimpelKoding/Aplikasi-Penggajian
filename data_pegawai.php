<?php include "header.php"; ?>
<div class="container">
	

	<?php
	$view = isset($_GET['view']) ? $_GET['view'] :null;

	switch ($view) {
		default:
			?>

           <!--menampilkan pesan-->
			<?php
           if(isset($_GET['e'])&& $_GET['e']=='sukses'){
           	?>
           	<div class="row">
           		<div class="col-md-4 col-md-offset-4">
           			<div class="alert alert-success alert-dismissible" role="alert">
           				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           				<strong>Selamat</strong> Proses berhasil !
           			</div>
           		</div>
           	</div>
           	<?php
           }elseif (isset($_GET['e']) && $_GET['e']=='gagal') {
           	 	?>
           	<div class="row">
           		<div class="col-md-4 col-md-offset-4">
           			<div class="alert alert-danger alert-dismissible" role="alert">
           				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           				<strong>Erorr</strong> Proses gagal !
           			</div>
           		</div>
           	</div>
           	<?php
           }
			?>
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">
							Data Pegawai
						</h3>
					</div>

					<div class="panel-body">
						<a href="data_pegawai.php?view=tambah" style="margin-bottom: 10px;" class="btn btn-primary">Tambah Data</a>
						<table class="table table-bordered table-striped">
							<tr>
								<th style="text-align: center;">No</th>
								<th style="text-align: center;">NIP</th>
								<th style="text-align: center;">Nama Pegawai</th>
								<th style="text-align: center;">Jabatan</th>
								<th style="text-align: center;">Golongan</th>
								<th style="text-align: center;">Status</th>
								<th style="text-align: center;">Jumlah Anak</th>
								<th style="text-align: center;">Aksi</th>
							</tr>
                          <?php
                          $sql = mysqli_query($konek, "SELECT pegawai.*, jabatan.nama_jabatan, golongan.nama_golongan 
                          	FROM pegawai 
                          	INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan 
                          	INNER JOIN golongan ON pegawai.kode_golongan=golongan.kode_golongan 
                          	ORDER BY pegawai.nama_pegawai ASC");
                          $no=1;

                          while($d=mysqli_fetch_array($sql)){
                          	echo "<tr>
                              <td width='40px' align='center'>$no</td>
                              <td align='center'>$d[nip]</td>
                              <td align='center'>$d[nama_pegawai]</td>
                              <td align='center'>$d[nama_jabatan]</td>
                              <td align='center'>$d[nama_golongan]</td>
                                <td align='center'>$d[status]</td>
                                  <td align='center'>$d[jumlah_anak]</td>
                                    

                                 <td width='160px' align='center'>
                                 <a class='btn btn-warning active btn-sm'
                                 href='data_pegawai.php?view=edit&id=$d[nip]'>Edit</a>
                                  
                                   <a class='btn btn-danger active btn-sm'
                                 href='aksi_pegawai.php?act=del&id=$d[nip]'>Hapus</a>

                                 </td>
                               </tr>";
                          	$no++;
                          }
                          ?>
						</table>
					</div>

				</div>
			</div>	
			<?php
			break;
		
		case"tambah":
		?>
		<?php
           if(isset($_GET['e'])&& $_GET['e']=='bl'){
           	?>
           	<div class="row">
           		<div class="col-md-8 col-md-offset-2">
           			<div class="alert alert-danger alert-dismissible" role="alert">
           				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           				<strong>Peringatan</strong> Form anda belum lengkap !
           			</div>
           		</div>
           	</div>
           	<?php
           }
           	 	?>

     <div class="row">
     	<div class="panel panel-primary">
     			<div class="panel-heading">
						<h3 class="panel-title">
							Tambah Data Pegawai
						</h3>
					</div>

					<div class="panel-body">

                      <form method="post" action="aksi_pegawai.php?act=insert">
                      <table class="table">
                      		<tr>
									<td width="160">NIP</td>
									<td>
                      			<input type="text" name="nip" class="form-control" required>
                      		</td>
                      	</tr>

                      	<tr>
                      		<td>Nama Pegawai</td>
                      		<td>
                             <input class="form-control" type="text" name="namapegawai" required>
                      		</td>
                           </tr>

                           	<tr>
                      		<td>Jabatan</td>
                      		<td>
                            <select name="jabatan" class="form-control">
                            	<option value="">- Pilih -</option>
                            	<?php
                            	$sqlJabatan=mysqli_query($konek,"SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                            	while ($j=mysqli_fetch_array($sqlJabatan)) {
                            		echo "<option value ='$j[kode_jabatan] '>$j[kode_jabatan] - $j[nama_jabatan] </option>";
                            	}
                            	?>
                            </select>
                      		</td>
                           </tr>

                           <tr>
                      		<td>Golongan</td>
                      		<td>
                            <select name="golongan" class="form-control">
                            	<option value="">- Pilih -</option>
                            	<?php
                            	$sqlGolongan=mysqli_query($konek,"SELECT * FROM golongan ORDER BY kode_golongan ASC");
                            	while ($g=mysqli_fetch_array($sqlGolongan)) {
                            		echo "<option value ='$g[kode_golongan] '>$g[kode_golongan] - $g[nama_golongan] </option>";
                            	}
                            	?>
                            </select>
                      		</td>
                           </tr>

                           	<tr>
                      		<td>Status</td>
                      		<td>
                            <select name="status" id="status" class="form-control" onChange="autoAnak()">
                            	<option value="">- Pilih -</option>
                            	<option value="Menikah">Menikah</option>
                            	<option value="Belum Menikah">Belum Menikah</option>
                            </select>
                      		</td>
                           </tr>

                            <tr>
                      		<td>Jumlah Anak</td>
                      		<td>
                             <input class="form-control" id="jumlahanak" type="number" name="jumlahanak">
                      		</td>
                           </tr>


                          
                           	<tr>
                      		<td></td>
                      		<td>
                             <input type="submit" class="btn btn-info active" value="Simpan">
                             <a class="btn btn-danger active" href="data_pegawai.php">Kembali</a>
                      		</td>
                           </tr>

                      </table>
                  </form>

                  <script type="text/javascript">
                  	function autoAnak(){
                  		var status = $('#status').val();
                  		if(status=='Belum Menikah'){
                  			$('#jumlahanak').val('0');
                  			$('#jumlahanak').prop('readonly',true);
                  		}else{
                  			$('#jumlahanak').val('');
                  			$('#jumlahanak').prop('readonly',false);
                  		}
                  	}
                  </script>

					</div>

     </div>
 </div>

		<?php
			break;

			case"edit":
			$sqlEdit = mysqli_query($konek,"SELECT * FROM pegawai WHERE nip='$_GET[id]'");
			$e = mysqli_fetch_array($sqlEdit);
			?>

			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Edit Data Pegawai</h3>
					</div>
					<div class="panel-body">
						<form method="post" action="aksi_pegawai.php?act=update">
							<table class="table">
									<tr>
									<td width="160">NIP</td>
									<td>
                      			<input type="text" name="nip" class="form-control" value="<?php echo $e['nip']; ?>" readonly>
                      		</td>
                      	</tr>

                      	<tr>
                      		<td>Nama Pegawai</td>
                      		<td>
                             <input class="form-control" type="text" name="namapegawai" value="<?php echo $e['nama_pegawai']; ?>" required>
                      		</td>
                           </tr>

                           	<tr>
                      		<td>Jabatan</td>
                      		<td>
                            <select name="jabatan" class="form-control">
                            	<option value="">- Pilih -</option>
                            	<?php
                            	$sqlJabatan=mysqli_query($konek,"SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                            	while ($j=mysqli_fetch_array($sqlJabatan)) {

                                   $selected =($j['kode_jabatan']==$e['kode_jabatan']) ? ' selected="selected"':"";

                            		echo "<option value ='$j[kode_jabatan] ' $selected>$j[kode_jabatan] - $j[nama_jabatan] </option>";
                            	}
                            	?>
                            </select>
                      		</td>
                           </tr>

                           <tr>
                      		<td>Golongan</td>
                      		<td>
                            <select name="golongan" class="form-control">
                            	<option value="">- Pilih -</option>
                            	<?php
                            	$sqlGolongan=mysqli_query($konek,"SELECT * FROM golongan ORDER BY kode_golongan ASC");
                            	while ($g=mysqli_fetch_array($sqlGolongan)) {

                                     $selected =($g['kode_golongan']==$e['kode_golongan']) ? ' selected="selected"':"";

                            		echo "<option value ='$g[kode_golongan] ' $selected>$g[kode_golongan] - $g[nama_golongan] </option>";
                            	}
                            	?>
                            </select>
                      		</td>
                           </tr>

                           	<tr>
                      		<td>Status</td>
                      		<td>
                            <select name="status" id="status" class="form-control" onChange="autoAnak()">
                            	<option value="<?php echo $e['status'];?> "selected><?php echo $e['status'];?> </option>
                            	<option value="Menikah">Menikah</option>
                            	<option value="Belum Menikah">Belum Menikah</option>
                            </select>
                      		</td>
                           </tr>

                            <tr>
                      		<td>Jumlah Anak</td>
                      		<td>
                             <input class="form-control" id="jumlahanak" type="number" name="jumlahanak" value="<?php echo $e['jumlah_anak'];?>"required>
                      		</td>
                           </tr>

									<tr>
									<td></td>
									<td>
										<input type="submit" value="Update Data" class="btn btn-info active" />
										<a href="data_pegawai.php" class="btn btn-danger active">Kembali</a>
									</td>
								</tr>
							</table>
						</form>

                         <script type="text/javascript">
                  	function autoAnak(){
                  		var status = $('#status').val();
                  		if(status=='Belum Menikah'){
                  			$('#jumlahanak').val('0');
                  			$('#jumlahanak').prop('readonly',true);
                  		}else{
                  			$('#jumlahanak').val('');
                  			$('#jumlahanak').prop('readonly',false);
                  		}
                  	}
                  </script>

					</div>
				</div>
			</div>
			<?php
			break;
			
	}
	?>

</div>
<?php include "footer.php"; ?>