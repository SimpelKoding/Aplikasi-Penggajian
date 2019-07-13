<?php include "header.php"; ?>
<div class="container">
	

	<?php
	$view = isset($_GET['view']) ? $_GET['view'] :null;

	switch ($view) {
		default:
		?>

		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Data Kehadiran Pegawai</h3>
			</div>
			<div class="panel-body">
				<form class="form-inline" method="get" action="">
					<div class="form-group">
						<label>Bulan</label>
						<select name="bulan" class="form-control">
					<option value="">- Pilih -</option>
					<option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
</select>
</div>
<div class="form-group">
	<label>Tahun</label>
	<select name="tahun" class="form-control">
		<option value="">- Pilih -</option>
		<?php
		$y = date('Y');
		for ($i=2019; $i <= $y+2; $i++) { 
			echo "<option value='$i'>$i</option>";
		}
		?>
	</select>
</div>
<button type="submit" class="btn btn-primary">Tampilkan Data</button>
<a href="data_kehadiran.php?view=tambah" class="btn btn-primary"> Input Kehadiran Pegawai</a>
</form>
<br>
<?php
if ((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET ['tahun']!='')){
	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];
    $bulantahun = $bulan.$tahun;
}else{
	$bulan = date('m');
	$tahun = date('Y');
	$bulantahun = $bulan.$tahun;
}
?>
<div class="alert alert-info">
	<strong>Bulan : <?php echo $bulan; ?>, Tahun : <?php echo $tahun; ?></strong>
</div>
<table class="table table-bordered table-striped">
	<tr>
		<th style="text-align: center;">No</th>
		<th style="text-align: center;">NIP</th>
		<th style="text-align: center;">Nama Pegawai</th>
		<th style="text-align: center;">Jabatan</th>
		<th style="text-align: center;">Masuk</th>
		<th style="text-align: center;">Sakit</th>
		<th style="text-align: center;">Izin</th>
		<th style="text-align: center;">Alpha</th>
		<th style="text-align: center;">Lembur</th>
		<th style="text-align: center;">Potongan</th>
	</tr>
	<?php
	$sql =mysqli_query($konek, "SELECT master_gaji.*,pegawai.nama_pegawai, pegawai.kode_jabatan, jabatan.nama_jabatan
		FROM master_gaji
		INNER JOIN pegawai ON master_gaji.nip=pegawai.nip
		INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
		WHERE master_gaji.bulan=$bulantahun
		ORDER BY pegawai.nip ASC");
     $no=1;

	while ($d=mysqli_fetch_array($sql)){
		echo "<tr>
		<td width='40px' align='center'>$no</td>
		<td align='center'>$d[nip]</td>
		<td align='center'>$d[nama_pegawai]</td>
		<td align='center'>$d[nama_jabatan]</td>
		<td align='center'>$d[masuk]</td>
		<td align='center'>$d[sakit]</td>
		<td align='center'>$d[izin]</td>
		<td align='center'>$d[alpha]</td>
		<td align='center'>$d[lembur]</td>
		<td align='center'>".buatRp($d['potongan'])."</td>
		</tr>";
		$no++;
	}

	if(mysqli_num_rows($sql) > 0) {
		echo"<tr>
		<td colspan='10' text-align='center'>
		<a class='btn btn-warning active' href='data_kehadiran.php?view=edit&bulan=$bulan&tahun=$tahun'>Edit Data Kehadiran</a>
		</td>
		</tr>";

	}else{
		echo"<tr>
		<td colspan='10' text-align='center'>
		Belum ada data pada bulan dan tahun yang anda pilih...!!!
		</td>
		</tr>";
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

		<div class="rows">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Tambah Data Kehadiran Pegawai</h3>
				</div>
				<div class="panel-body">
						<form class="form-inline" method="get" action="">
							<input type="hidden" name="view" value="tambah">
					<div class="form-group">
						<label>Bulan</label>
						<select name="bulan" class="form-control">
					<option value="">- Pilih -</option>
					<option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
</select>
</div>
<div class="form-group">
	<label>Tahun</label>
	<select name="tahun" class="form-control">
		<option value="">- Pilih -</option>
		<?php
		$y = date('Y');
		for ($i=2019; $i <= $y+2; $i++) { 
			echo "<option value='$i'>$i</option>";
		}
		?>
	</select>
</div>
<button type="submit" class="btn btn-primary">Generate Form</button>
</form>
<br>

<?php
if((isset($_GET['tahun']) && $_GET['tahun']!='') && (isset($_GET['bulan']) && $_GET['bulan']!='')){
	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];
	$bulantahun = $bulan.$tahun;
}else{
	$bulan = date('m');
	$tahun = date('Y');
	$bulantahun = $bulan.$tahun;
}
?>

<div class="alert alert-info">
	<strong>Bulan : <?php echo $bulan; ?>, Tahun : <?php echo $tahun; ?></strong>
</div>
<form method="post" action="aksi_kehadiran.php?act=insert">
	<table class="table">
		<tr>
		<th style="text-align: center;">No</th>
		<th style="text-align: center;">NIP</th>
		<th style="text-align: center;">Nama Pegawai</th>
		<th style="text-align: center;">Jabatan</th>
		<th style="text-align: center;">Masuk</th>
		<th style="text-align: center;">Sakit</th>
		<th style="text-align: center;">Izin</th>
		<th style="text-align: center;">Alpha</th>
		<th style="text-align: center;">Lembur</th>
		<th style="text-align: center;">Potongan</th>
	</tr>

	<?php
	$no=1;
	$query=mysqli_query($konek, "SELECT pegawai.*, jabatan.nama_jabatan FROM pegawai
		                         INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
		                         WHERE NOT EXISTS (SELECT * FROM master_gaji WHERE bulan='$bulantahun' AND 
		                         pegawai.nip=master_gaji.nip)
		                         ORDER BY pegawai.nip ASC");
	                             $jmlPegawai=mysqli_num_rows($query);
	                             while ($d=mysqli_fetch_array($query)) {
	                             	?>
	                             	    <input type="hidden" name="bulan[]" value="<?php echo $bulantahun; ?>" />
	                             		<input type="hidden" name="nip[]" value="<?php echo $d['nip']; ?>" />
	                             		<tr>
	                             			<td style="text-align: center;"><?php echo $no; ?></td>
	                             			<td style="text-align: center;"><?php echo $d['nip']; ?></td>
	                             		    <td style="text-align: center;"><?php echo $d['nama_pegawai']; ?></td>
	                             		    <td style="text-align: center;"><?php echo $d['nama_jabatan']; ?></td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="masuk[]" class="form-control" value="0" required />
	                             					</td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="sakit[]" class="form-control" value="0" required />
	                             					</td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="izin[]" class="form-control" value="0" required />
	                             					</td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="alpha[]" class="form-control" value="0" required />
	                             					</td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="lembur[]" class="form-control" value="0" required />
	                             					</td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="potongan[]" class="form-control" value="0" required />
	                             					</td>
	                             				</tr>
	                             				<?php

	                             				$no++;
	                             			}
	                             								
	                             			if($jmlPegawai > 0){
	                             				?>
	                             				<tr>
	                             					<td colspan="4"></td>
	                             					<td colspan="6">
	                             					<input class="btn btn-info active" type="submit" value="Simpan"> 
	                             					<a href="data_kehadiran.php" class="btn btn-danger active">Kembali</a>
	                             				</td>
	                             			</tr>
	                             			<?php 
	                             			}else{
	                             				?>
	                             				<tr>
	                             					<td colspan="10">
	                             						<label class="label label-warning">Maaf..., Bulan dan Tahun yang dipilih sudah diproses, silahkan lakukan edit data...</label>
	                             					</td>
	                             				</tr>
	                             				<?php
	                             			}
	                             			?>
	                               </table>
                                </form>
				          </div>
			          </div>
	              	</div>

		<?php

			break;

			case"edit":

			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan.$tahun;
			?>

				<div class="rows">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Data Kehadiran Pegawai</h3>
				</div>
				<div class="panel-body">
				<div class="alert alert-info">
	           <strong>Bulan : <?php echo $bulan; ?>, Tahun : <?php echo $tahun; ?></strong>
	       </div>

	       <form method="post" action="aksi_kehadiran.php?act=update">
	<table class="table">
		<tr>
		<th style="text-align: center;">No</th>
		<th style="text-align: center;">NIP</th>
		<th style="text-align: center;">Nama Pegawai</th>
		<th style="text-align: center;">Jabatan</th>
		<th style="text-align: center;">Masuk</th>
		<th style="text-align: center;">Sakit</th>
		<th style="text-align: center;">Izin</th>
		<th style="text-align: center;">Alpha</th>
		<th style="text-align: center;">Lembur</th>
		<th style="text-align: center;">Potongan</th>
	</tr>

	<?php
	$no=1;
	$query=mysqli_query($konek, "SELECT master_gaji.*, pegawai.nama_pegawai,jabatan.nama_jabatan
		                         FROM master_gaji
		                         INNER JOIN pegawai ON master_gaji.nip=pegawai.nip
		                         INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
		                         WHERE master_gaji.bulan='$bulantahun'
		                         ORDER BY master_gaji.nip ASC");
	                             $jmlPegawai=mysqli_num_rows($query);
	                             while ($d=mysqli_fetch_array($query)) {
	                             	
	                             	?>
	                             	    <input type="hidden" name="bulan[]" value="<?php echo $bulantahun; ?>" />
	                             		<input type="hidden" name="nip[]" value="<?php echo $d['nip']; ?>" />
	                             		<tr>
	                             			<td style="text-align: center;"><?php echo $no; ?></td>
	                             			<td style="text-align: center;"><?php echo $d['nip']; ?></td>
	                             		    <td style="text-align: center;"><?php echo $d['nama_pegawai']; ?></td>
	                             		    <td style="text-align: center;"><?php echo $d['nama_jabatan']; ?></td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="masuk[]" class="form-control" value="<?php echo $d['masuk']; ?>" required />
	                             					</td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="sakit[]" class="form-control" value="<?php echo $d['sakit']; ?>" required />
	                             					</td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="izin[]" class="form-control" value="<?php echo $d['izin']; ?>" required />
	                             					</td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="alpha[]" class="form-control" value="<?php echo $d['alpha']; ?>" required />
	                             					</td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="lembur[]" class="form-control" value="<?php echo $d['lembur']; ?>" required />
	                             					</td>
	                             					<td>
	                             						<input type="number" style="text-align: center;" name="potongan[]" class="form-control" value="<?php echo $d['potongan']; ?>" required />
	                             					</td>
	                             				</tr>
	                             				<?php

	                             				$no++;
	                             			}
	                             		   ?>
	                             				<tr>
	                             					<td colspan="4"></td>
	                             					<td colspan="6">
	                             					<input class="btn btn-info active" type="submit" value="Update"> 
	                             					<a href="data_kehadiran.php" class="btn btn-danger active">Kembali</a>
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