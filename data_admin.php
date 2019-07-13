<?php include"header.php";?>

      <div class="container">
   <?php
   $view = isset($_GET['view']) ? $_GET['view'] :null;
   switch ($view) {
    default:

    //untuk pesan berhasil atau gagal proses
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
          <h3 class="panel-title">Data Administrator</h3>
        </div>
        <div class="panel-body">
          <a href="data_admin.php?view=tambah" class="btn btn-primary" style="margin-bottom: 10px">Tambah Data</a>
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="text-align: center;">No</th>
              <th style="text-align: center;">Username</th>
              <th style="text-align: center;">Nama Lengkap</th>
              <th style="text-align: center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no =1;
            $sqlAdmin = mysqli_query($konek,"SELECT * FROM admin ORDER BY username ASC");
            while ($data = mysqli_fetch_array($sqlAdmin)){
              echo "<tr>
              <td class='text-center'>$no</td>
              <td align='center'>$data[username]</td>
              <td align='center'>$data[namalengkap]</td>
              <td class='text-center'>
              <a href='data_admin.php?view=edit&id=$data[idadmin]' class='btn btn-warning active btn-sm'>Edit</a>
                <a href='aksi_admin.php?act=delete&id=$data[idadmin]' class='btn btn-danger active btn-sm'>Hapus</a>
              </td>
              </tr>";
              $no++;
            }
            ?>
          </tbody>
        </table>
        </div>
      </div>
      </div>
    <?php
    break;
    case 'tambah':
    ?>
  <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Tambah Data Administrator</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal"  method="POST" action="aksi_admin.php?act=insert">
            <div class="form-group">
              <label class="col-md-2">Username</label>
              <div class="col-md-4">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
              </div>
            </div>
          
           <div class="form-group">
              <label class="col-md-2">Password</label>
              <div class="col-md-4">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
              </div>
            </div>

   <div class="form-group">
              <label class="col-md-2">Nama Lengkap</label>
              <div class="col-md-6">
                <input type="text" name="namalengkap" class="form-control" placeholder="Nama Lengkap" required>
              </div>
            </div>

             <div class="form-group">
              <label class="col-md-2"></label>
              <div class="col-md-4">
                <input type="submit"  class="btn btn-info active" value="Simpan">
                <a href="data_admin.php" class="btn btn-danger active">Batal</a>
              </div>
            </div>
          </form>


        </div>
      </div>
     <?php
    break;
    case 'edit':
    $sqlEdit = mysqli_query($konek,"SELECT * FROM admin WHERE idadmin='$_GET[id]'");
    $e = mysqli_fetch_array($sqlEdit);
    ?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Data Administrator</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="aksi_admin.php?act=update">
              <input type="hidden" name="idadmin" value="<?php echo $e['idadmin']; ?>">
            <div class="form-group">
              <label class="col-md-2">Username</label>
              <div class="col-md-4">
                <input type="text" name="username" class="form-control" value="<?php echo $e['username']; ?>" required>
              </div>
            </div>
          
           <div class="form-group">
              <label class="col-md-2">Password</label>
              <div class="col-md-4">
                <input type="password" name="password" class="form-control" placeholder="Kosongkan Jika Tidak Diganti">
              </div>
            </div>

   <div class="form-group">
              <label class="col-md-2">Nama Lengkap</label>
              <div class="col-md-6">
                <input type="text" name="namalengkap" class="form-control" value="<?php echo $e['namalengkap']; ?>" required>
              </div>
            </div>

             <div class="form-group">
              <label class="col-md-2"></label>
              <div class="col-md-4">
                <input type="submit"  class="btn btn-info active" value="Update Data">
                <a href="data_admin.php" class="btn btn-danger active">Batal</a>
              </div>
            </div>
          </form>


        </div>
      </div>
    <?php
    break;
     }
     ?>

    
  </div>
<?php include"footer.php";?>


