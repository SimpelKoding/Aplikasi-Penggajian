<?php
session_start();
if (isset($_SESSION['login'])) {
	include "koneksi.php";
	include "fungsi.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Golongan</title>
	<style type="text/css">
		body{
			font-family: Arial;
		}
		@media print{
			.no-print{
				display: none;
			}
		}

       table{
       	border-collapse: collapse;
       }
	</style>
</head>
<body>
<h3 align="center">PT. GAS NEGARA</h3>
<hr>
<p align="center">LAPORAN DATA GOLONGAN</p>
<table border="1" cellpadding="4" cellspacing="0" width="100%">
	<tr>
	<th>No</th>
	<th>Kode</th>
	<th>Nama Golongan</th>
	<th>Tunj. Suami/Istri</th>
	<th>Tunj. Anak</th>
	<th>Uang Makan</th>
	<th>Uang Lembur</th>
	<th>Askes</th>
</tr>

<?php
$sql=mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");

	                       $no = 1;
                           while ($d=mysqli_fetch_array($sql)) {
                           	echo "<tr>
                           	<td align='center' width='40px'>$no</td>
                           	<td align='center'>$d[kode_golongan]</td>
                           	<td align='center'>$d[nama_golongan]</td>
                           	<td align='center'>".buatRp($d['tunjangan_suami_istri'])."</td>
                           	<td align='center'>".buatRp($d['tunjangan_anak'])."</td>
                           	<td align='center'>".buatRp($d['uang_makan'])."</td>
                           	<td align='center'>".buatRp($d['uang_lembur'])."</td>
                           	<td align='center'>".buatRp($d['askes'])."</td>
                           	</tr>";
                           	$no++;
                           }

                           if (mysqli_num_rows($sql) < 1) {
                           	echo "<tr><td colspan='8'>Belum ada data...</td></tr>";
                           }

                         ?>
                      </table>


<table width="100%">
	<tr>
		<td></td>
		<td width="200px">
			<p>
				Bogor, <?php echo tglIndonesia(date('Y-m-d')); ?>
				<br>
				Administrator,
			</p>
			<br>
			<br>
			<br>
			<p>______________________________</p>
		</td>
	</tr>
</table>

<a href="#" class="no-print" onclick="window.print();">Cetak/Print</a>

</body>
</html>
<?php
}else{
	header('Location:login.php');
}
?>