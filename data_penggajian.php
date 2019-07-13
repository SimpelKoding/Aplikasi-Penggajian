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
						<h3 class="panel-title">Gaji Pegawai</h3>
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
<div class="table-responsive">
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th style="text-align: center;"><div class="col-md-8">No</div></th>
			<th style="text-align: center;">NIP</th>
			<th style="text-align: center;"><div class="col-md-8">Nama&nbsp;Pegawai</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Jabatan&nbsp;&nbsp;&nbsp;</div></th>
			<th style="text-align: center;"><div class="col-md-8">Golongan</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;</div></th>
			<th style="text-align: center;"><div class="col-md-8">Jumlah&nbsp;Anak</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Gapok&nbsp;&nbsp;&nbsp;</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Tj.&nbsp;Jabatan&nbsp;&nbsp;&nbsp;</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Tj.&nbsp;S/I&nbsp;&nbsp;&nbsp;</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Tj.&nbsp;Anak&nbsp;&nbsp;&nbsp;</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Uang&nbsp;Makan&nbsp;&nbsp;&nbsp;</th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Uang&nbsp;Lembur&nbsp;&nbsp;&nbsp;</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Askes&nbsp;&nbsp;&nbsp;</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Pendapatan&nbsp;&nbsp;&nbsp;</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Potongan&nbsp;&nbsp;&nbsp;</div></th>
			<th style="text-align: center;"><div class="col-md-8">&nbsp;&nbsp;&nbsp;Total&nbsp;gaji&nbsp;&nbsp;&nbsp;</div></th>
</tr>
	</thead>
	<tbody>
		<?php 
		$sql = mysqli_query($konek, "SELECT pegawai.nip,pegawai.nama_pegawai,
			                         jabatan.nama_jabatan,golongan.nama_golongan,pegawai.status,pegawai.jumlah_anak,
			                         jabatan.gapok,jabatan.tunjangan_jabatan,
			                         IF(pegawai.status='Menikah',tunjangan_suami_istri,0) AS tjsi, 
			                         IF(pegawai.status='Menikah',tunjangan_anak,0) AS tjanak,
			                         uang_makan AS uangmakan,
			                         master_gaji.lembur*uang_lembur AS uanglembur,
			                         askes,
			                         (gapok+tunjangan_jabatan+(SELECT tjsi)+(SELECT tjanak)+(SELECT uangmakan)+(SELECT uanglembur)+askes) AS pendapatan, potongan, 
			                        (SELECT pendapatan) - potongan AS totalgaji
			                         FROM pegawai
			                         INNER JOIN master_gaji ON master_gaji.nip=pegawai.nip
			                         INNER JOIN golongan ON golongan.kode_golongan=pegawai.kode_golongan
			                         INNER JOIN jabatan ON jabatan.kode_jabatan=pegawai.kode_jabatan
			                         WHERE master_gaji.bulan='$bulantahun'
			                         ORDER BY pegawai.nip ASC");

		                             $no=1;

		                             while ($d= mysqli_fetch_array($sql)) {
		                             	echo "<tr>
		                             	      <td width='40px' align='center'>$no</td>
		                             	      <td align='center'>$d[nip]</td>
		                             	      <td align='center'>$d[nama_pegawai]</td>
		                             	      <td align='center'>$d[nama_jabatan]</td>
		                             	      <td align='center'>$d[nama_golongan]</td>
		                             	      <td align='center'>$d[status]</td>
		                             	      <td align='center'>$d[jumlah_anak]</td>
		                             	      <td align='center'>".buatRp($d['gapok'])."</td>
		                             	      <td align='center'>".buatRp($d['tunjangan_jabatan'])."</td>
		                             	      <td align='center'>".buatRp($d['tjsi'])."</td>
		                             	      <td align='center'>".buatRp($d['tjanak'])."</td>
		                             	      <td align='center'>".buatRp($d['uangmakan'])."</td>
		                             	      <td align='center'>".buatRp($d['uanglembur'])."</td>
		                             	      <td align='center'>".buatRp($d['askes'])."</td>
		                             	      <td align='center'>".buatRp($d['pendapatan'])."</td>
		                             	      <td align='center'>".buatRp($d['potongan'])."</td>
		                             	      <td align='center'>".buatRp($d['totalgaji'])."</td>
		                             	      </tr>";
		                             	      $no++;
		                             }
		?>
	</tbody>
</table>
</div>
						
					</div>
					<div class="panel-footer">
						<?php
						if(mysqli_num_rows($sql) > 0){
							echo"
							<center>
							<a class='btn btn-success active' href='cetak_daftar_gaji_pegawai.php?bulan=$bulan
							&tahun=$tahun' target='_blank'><span class='glypiconn glypicon-print'></span> Cetak Daftar Gaji Pegawai</a>

							<a class='btn btn-warning active' href='excel_daftar_gaji_pegawai.php?bulan=$bulan
							&tahun=$tahun' target='_blank'> Export Ke Excel</a>
							</center>
							";
						}
						?>
						
					</div>
				</div>
			</div>


			<?php
			break;
			case "tambah" :
			break;

			case "edit":
			break;
	}
	?>
	 
	</div>
<?php include "footer.php"; ?>