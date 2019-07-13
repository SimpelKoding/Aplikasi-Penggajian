<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=daftar_gaji_pegawai.xls");
	include "koneksi.php";
	$bulantahun = $_GET['bulan'].$_GET['tahun'];
	?>
<h3 align="center">PT. GAS NEGARA<br>DAFTAR GAJI PEGAWAI</h3>
<p>Bulan : <?php echo $_GET['bulan'].", Tahun: ".$_GET['tahun']; ?></p>
<table border="1" cellpadding="4" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>No.</th>
			<th>NIP</th>
			<th>Nama Pegawai</th>
			<th>Jabatan</th>
			<th>Golongan</th>
			<th>Status</th>
			<th>Jumlah Anak</th>
			<th>Gapok</th>
			<th>Tj. Jabatan</th>
			<th>Tj. S/I</th>
			<th>Tj. Anak</th>
			<th>Uang Makan</th>
			<th>Uang Lembur</th>
			<th>Askes</th>
			<th>Pendapatan</th>
			<th>Potongan</th>
			<th>Total Gaji</th>
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
		                             	      <td align='center'>".$d['gapok']."</td>
		                             	      <td align='center'>".$d['tunjangan_jabatan']."</td>
		                             	      <td align='center'>".$d['tjsi']."</td>
		                             	      <td align='center'>".$d['tjanak']."</td>
		                             	      <td align='center'>".$d['uangmakan']."</td>
		                             	      <td align='center'>".$d['uanglembur']."</td>
		                             	      <td align='center'>".$d['askes']."</td>
		                             	      <td align='center'>".$d['pendapatan']."</td>
		                             	      <td align='center'>".$d['potongan']."</td>
		                             	      <td align='center'>".$d['totalgaji']."</td>
		                             	      </tr>";
		                             	      $no++;
		                             }
		?>
	</tbody>
</table>

