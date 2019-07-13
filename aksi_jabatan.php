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
        $kode =$_POST['kodejabatan'];
 	    $nama =$_POST['namajabatan'];
 		$gapok =$_POST['gapok'];
 		$tunj =$_POST['tunjanganjabatan'];

 		if($kode=='' || $nama=='' || $gapok=='' || $tunj==''){
 			header('Location:data_jabatan.php?view=tambah&e=bl');

 		}else{
 			//proses query simpan data
 			$simpan = mysqli_query($konek,"INSERT INTO jabatan(kode_jabatan,nama_jabatan,gapok,tunjangan_jabatan) VALUES ('$kode','$nama','$gapok','$tunj')");

 			if($simpan){
 				header('Location:data_jabatan.php?e=sukses');
 			}else{
 				header('Location:data_jabatan.php?e=gagal');
 			}
 		}

 		}

          elseif($_GET['act']=='update'){ 
         //simpan inputan form ke variabel
        $kode =$_POST['kodejabatan'];
 	    $nama =$_POST['namajabatan'];
 		$gapok =$_POST['gapok'];
 		$tunj =$_POST['tunjanganjabatan'];

 			if($kode=='' || $nama=='' || $gapok=='' || $tunj==''){
 				header('Location:data_jabatan.php?view=edit&e=bl');
           }else{
           //proses query update
           	$update = mysqli_query($konek, "UPDATE jabatan SET nama_jabatan='$nama',gapok='$gapok',tunjangan_jabatan='$tunj' WHERE kode_jabatan='$kode'");

           		if($update){
 				header('Location:data_jabatan.php?e=sukses');
 			}else{
 				header('Location:data_jabatan.php?e=gagal');
 			}
 		}

       }
       
       //jika act = delete
       elseif ($_GET['act']=='del'){
 	$hapus = mysqli_query($konek, "DELETE FROM jabatan WHERE kode_jabatan='$_GET[id]'");
 
 	if($hapus){
 				header('Location:data_jabatan.php?e=sukses');
 			}else{
 				header('Location:data_jabatan.php?e=gagal');
 			}
	 			}


	 		}

?>