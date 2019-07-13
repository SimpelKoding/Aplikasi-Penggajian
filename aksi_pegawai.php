<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
header('Location:login.php');
 }

 //jika ada get act
 if(isset($_GET['act'])){

 	//jika act = insert
 	if($_GET['act']=='insert'){
 		//proses menyimpan data
 		//simpan inputan form ke variabel
    $nip =$_POST['nip'];
 	  $nama =$_POST['namapegawai'];
 		$jab =$_POST['jabatan'];
 		$gol =$_POST['golongan'];
    $status =$_POST['status'];
    $anak =$_POST['jumlahanak'];
    


     if($nip=='' || $nama=='' || $jab=='' || $gol=='' || $status=='' || $anak==''){
 			header('Location:data_pegawai.php?view=tambah&e=bl');

 		}else{
 			//proses query simpan data
 			$simpan = mysqli_query($konek,"INSERT INTO pegawai(nip,nama_pegawai,kode_jabatan,kode_golongan,status,jumlah_anak) VALUES ('$nip','$nama','$jab','$gol','$status','$anak')");

 			if($simpan){
 				header('Location:data_pegawai.php?e=sukses');
 			}else{
 				header('Location:data_pegawai.php?e=gagal');
 			}
 		}

 		}

          elseif($_GET['act']=='update'){ 
         //simpan inputan form ke variabel
    $nip =$_POST['nip'];
    $nama =$_POST['namapegawai'];
    $jab =$_POST['jabatan'];
    $gol =$_POST['golongan'];
    $status =$_POST['status'];
    $anak =$_POST['jumlahanak'];
    


     if($nip=='' || $nama=='' || $jab=='' || $gol=='' || $status=='' || $anak==''){
 				header('Location:data_pegawai.php?view=edit&e=bl');
           }else{
           //proses query update
           	$update = mysqli_query($konek, "UPDATE pegawai SET nama_pegawai='$nama',kode_jabatan='$jab',kode_golongan='$gol',status='$status',jumlah_anak='$anak' WHERE nip='$nip'");

           		if($update){
 				header('Location:data_pegawai.php?e=sukses');
 			}else{
 				header('Location:data_pegawai.php?e=gagal');
 			}
 		}

       }
       
       //jika act = delete
       elseif ($_GET['act']=='del'){
 	$hapus = mysqli_query($konek, "DELETE FROM pegawai WHERE nip='$_GET[id]'");
 
 	if($hapus){
 				header('Location:data_pegawai.php?e=sukses');
 			}else{
 				header('Location:data_pegawai.php?e=gagal');
 			}
	 			}


	 		}

?>