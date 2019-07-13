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
    $kode =$_POST['kodegolongan'];
 	  $nama =$_POST['namagolongan'];
 		$tunjsi =$_POST['tunjangansi'];
 		$tunjanak =$_POST['tunjangananak'];
    $uangmakan =$_POST['uangmakan'];
    $uanglembur =$_POST['uanglembur'];
    $askes =$_POST['askes'];




 		if($kode=='' || $nama=='' || $tunjsi=='' || $tunjanak=='' || $uangmakan=='' || $uanglembur=='' || $askes==''){
 			header('Location:data_golongan.php?view=tambah&e=bl');

 		}else{
 			//proses query simpan data
 			$simpan = mysqli_query($konek,"INSERT INTO golongan(kode_golongan,nama_golongan,tunjangan_suami_istri,tunjangan_anak,uang_makan,uang_lembur,askes) VALUES ('$kode','$nama','$tunjsi','$tunjanak','$uangmakan','$uanglembur','$askes')");

 			if($simpan){
 				header('Location:data_golongan.php?e=sukses');
 			}else{
 				header('Location:data_golongan.php?e=gagal');
 			}
 		}

 		}

          elseif($_GET['act']=='update'){ 
         //simpan inputan form ke variabel
        $kode =$_POST['kodegolongan'];
    $nama =$_POST['namagolongan'];
    $tunjsi =$_POST['tunjangansi'];
    $tunjanak =$_POST['tunjangananak'];
    $uangmakan =$_POST['uangmakan'];
    $uanglembur =$_POST['uanglembur'];
    $askes =$_POST['askes'];

 			if($kode=='' || $nama=='' || $tunjsi=='' || $tunjanak=='' || $uangmakan=='' || $uanglembur=='' || $askes==''){
 				header('Location:data_golongan.php?view=edit&e=bl');
           }else{
           //proses query update
           	$update = mysqli_query($konek, "UPDATE golongan SET nama_golongan='$nama',tunjangan_suami_istri='$tunjsi',tunjangan_anak='$tunjanak',uang_makan='$uangmakan',uang_lembur='$uanglembur',askes='$askes' WHERE kode_golongan='$kode'");

           		if($update){
 				header('Location:data_golongan.php?e=sukses');
 			}else{
 				header('Location:data_golongan.php?e=gagal');
 			}
 		}

       }
       
       //jika act = delete
       elseif ($_GET['act']=='del'){
 	$hapus = mysqli_query($konek, "DELETE FROM golongan WHERE kode_golongan='$_GET[id]'");
 
 	if($hapus){
 				header('Location:data_golongan.php?e=sukses');
 			}else{
 				header('Location:data_golongan.php?e=gagal');
 			}
	 			}


	 		}

?>