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
							Data Golongan
						</h3>
					</div>

					<div class="panel-body">
						<a href="data_golongan.php?view=tambah" style="margin-bottom: 10px;" class="btn btn-primary">Tambah Data</a>
						<table class="table table-bordered table-striped">
							<tr>
								<th style="text-align: center;">No</th>
								<th style="text-align: center;">Kode Golongan</th>
								<th style="text-align: center;">Nama Golongan</th>
								<th style="text-align: center;">Tunjangan S/I</th>
								<th style="text-align: center;">Tunjangan Anak</th>
								<th style="text-align: center;">Uang Makan</th>
								<th style="text-align: center;">Uang Lembur</th>
								<th style="text-align: center;">Askes</th>
								<th style="text-align: center;">Aksi</th>
							</tr>
                          <?php
                          $sql = mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                          $no=1;

                          while($d=mysqli_fetch_array($sql)){
                          	echo "<tr>
                              <td width='40px' align='center'>$no</td>
                              <td align='center'>$d[kode_golongan]</td>
                              <td align='center'>$d[nama_golongan]</td>
                              <td align='center'>".buatRp($d['tunjangan_suami_istri'])."</td>
                              <td align='center'>".buatRp($d['tunjangan_anak'])."</td>
                                <td align='center'>".buatRp($d['uang_makan'])."</td>
                                  <td align='center'>".buatRp($d['uang_lembur'])."</td>
                                    <td align='center'>".buatRp($d['askes'])."</td>

                                 <td width='160px' align='center'>
                                 <a class='btn btn-warning active btn-sm'
                                 href='data_golongan.php?view=edit&id=$d[kode_golongan]'>Edit</a>
                                  
                                   <a class='btn btn-danger active btn-sm'
                                 href='aksi_golongan.php?act=del&id=$d[kode_golongan]'>Hapus</a>

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
			// membuat kode golongan otomatis
		$simbol="G";
		$query = mysqli_query($konek, "SELECT max(kode_golongan) AS last FROM golongan WHERE kode_golongan LIKE '$simbol%'");
		$data = mysqli_fetch_array($query);

		$kodeterakhir = $data['last'];
		$nomorterakhir = substr($kodeterakhir,1,2);
		$nextnomor = $nomorterakhir + 1;
		$nextkode = $simbol.sprintf('%02s',$nextnomor);

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
							Tambah Data Golongan
						</h3>
					</div>

					<div class="panel-body">

                      <form method="post" action="aksi_golongan.php?act=insert">
                      <table class="table">
                      		<tr>
									<td width="160">Kode Golongan</td>
									<td>
                      			<input type="text" name="kodegolongan" class="form-control" value="<?php echo $nextkode; ?>" readonly>
                      		</td>
                      	</tr>

                      	<tr>
                      		<td>Nama Golongan</td>
                      		<td>
                             <input class="form-control" type="text" name="namagolongan" required>
                      		</td>
                           </tr>

                           	<tr>
                      		<td>Tunjangan S/I</td>
                      		<td>
                             <input class="form-control" type="number" name="tunjangansi" required>
                      		</td>
                           </tr>

                           	<tr>
                      		<td>Tunjangan Anak</td>
                      		<td>
                             <input class="form-control" type="number" name="tunjangananak">
                      		</td>
                           </tr>


                           	<tr>
                      		<td>Uang Makan</td>
                      		<td>
                             <input class="form-control" type="number" name="uangmakan">
                      		</td>
                           </tr>


                           	<tr>
                      		<td>Uang Lembur</td>
                      		<td>
                             <input class="form-control" type="number" name="uanglembur">
                      		</td>
                           </tr>


                           	<tr>
                      		<td>Askes</td>
                      		<td>
                             <input class="form-control" type="number" name="askes">
                      		</td>
                           </tr>

                           	<tr>
                      		<td></td>
                      		<td>
                             <input type="submit" class="btn btn-info active" value="Simpan">
                             <a class="btn btn-danger active" href="data_golongan.php">Kembali</a>
                      		</td>
                           </tr>

                      </table>
                  </form>

					</div>

     </div>
 </div>

		<?php
			break;

			case"edit":
			$sqlEdit = mysqli_query($konek,"SELECT * FROM golongan WHERE kode_golongan='$_GET[id]'");
			$e = mysqli_fetch_array($sqlEdit);
			?>

			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Edit Data Golongan</h3>
					</div>
					<div class="panel-body">
						<form method="post" action="aksi_golongan.php?act=update">
							<table class="table">
								<tr>
									<td width="160">Kode Golongan</td>
									<td>
										<input type="text" name="kodegolongan" class="form-control" value="<?php echo $e['kode_golongan']; ?>" readonly />
									</td>
								</tr>
								<tr>
									<td>Nama Golongan</td>
									<td>
										<input type="text" name="namagolongan" class="form-control" value="<?php echo $e['nama_golongan']; ?>" required />
									</td>
								</tr>
									<tr>
									<td>Tunjangan S/I</td>
									<td>
										<input type="number" name="tunjangansi" class="form-control" value="<?php echo $e['tunjangan_suami_istri']; ?>" required />
									</td>
								</tr>
									<tr>
									<td>Tunjangan Anak</td>
									<td>
										<input type="number" name="tunjangananak" class="form-control" value="<?php echo $e['tunjangan_anak']; ?>" required />
									</td>
								</tr>

								<tr>
									<td>Uang Makan</td>
									<td>
										<input type="number" name="uangmakan" class="form-control" value="<?php echo $e['uang_makan']; ?>" required />
									</td>
								</tr>

								<tr>
									<td>Uang Lembur</td>
									<td>
										<input type="number" name="uanglembur" class="form-control" value="<?php echo $e['uang_lembur']; ?>" required />
									</td>
								</tr>
								<tr>
									<td>Askes</td>
									<td>
										<input type="number" name="askes" class="form-control" value="<?php echo $e['askes']; ?>" required />
									</td>
								</tr>
									<tr>
									<td></td>
									<td>
										<input type="submit" value="Update Data" class="btn btn-info active" />
										<a href="data_golongan.php" class="btn btn-danger active">Kembali</a>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
			<?php
			break;
			
	}
	?>

</div>
<?php include "footer.php"; ?>