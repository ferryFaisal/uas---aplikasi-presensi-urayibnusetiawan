<?php

session_start();

//  membatasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "<script>
            alert('Login dulu yaaa!');
            document.location.href = 'login.php';
          </script>"; 
    exit;      
}

// membatasi halaman sesuai email login
if ($_SESSION['role'] != 'Admin') {
  echo "<script>
  alert('Maaf, anda tidak mempunyai hak akses');
  document.location.href = 'login.php';
</script>"; 
exit;  
}

$title = 'Data Mahasiswa';

include 'layout/header.php';

$data_mahasiswa = select("SELECT * FROM mahasiswa ");

// jika tombol tambah di tekan jalankan script
if (isset($_POST['tambah'])) {
  $nim        = $_POST['nim'];
  $nama       = $_POST['nama'];
  $kelas      = $_POST['kelas'];


 
  $q = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
  $cek = mysqli_num_rows($q);

  if ($cek == 0) {

    mysqli_query($conn, "INSERT INTO mahasiswa VALUES(null, '$nim', '$nama', '$kelas' )");
    echo "<script>
    alert('Data Mahasiswa Berhasil ditambahkan');
    document.location.href = 'tables_mahasiswa.php';
    </script>";

  } else {
    echo "<script>
          alert('Maaf NIM sudah terdaftar');
          document.location.href = 'tables_mahasiswa.php';
      </script>";
  }
}






// jika tombol ubah di tekan jalankan script
if (isset($_POST['ubah'])) {
  if (update_mahasiswa($_POST) > 0) {
      echo "<script>
              alert('Data Mahasiswa Berhasil Diubah');
              document.location.href = 'tables_mahasiswa.php';
              </script>";
  } else {
      echo "<script>
              alert('Data Mahasiswa Berhasil Diubah');
              document.location.href = 'tables_mahasiswa.php';
              </script>";
  }
}



?>


    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php" onclick="return confirm('Yakin ingin keluar <?= $_SESSION['name']; ?>?')">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">

    <li class="nav-item ">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
    </li>


    <?php if ($_SESSION['role'] == 'Admin') : ?>
        <li class="nav-item ">
          <a class="nav-link" href="tables_user.php">
              <i class="fas fa-users"></i>
              <span>Tables User</span>
          </a>
        </li>
    <?php endif; ?>  

    

      <li class="nav-item active">
        <a class="nav-link" href="tables_mahasiswa.php">
          <i class="fas fa-users"></i>
          <span>Tables Mahasiswa</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="tables_presensi.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables Presensi</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Tables Mahasiswa</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Mahasiswa</div>
          <div class="card-body">
            <div class="table-responsive">
            <link rel="icon" href="assets/img/cart-plus.svg">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-cart-plus"> Add Mahasiswa</i></button>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php $no = 1;?>
                  <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                  <tr class="text-center">
                      <td><?= $no++; ?></td>
                      <td><?= $mahasiswa['nim']; ?></td>
                      <td> <?= $mahasiswa['nama']; ?></td>
                      <td> <?= $mahasiswa['kelas']; ?></td>
                      <td class="text-center">
                      <button type="button" class="btn btn-success mb-2"  data-toggle="modal" data-target="#modalUbah<?= $mahasiswa['id_mahasiswa'];?>">
                      <i class="fa fa-edit"></i> Edit</button>
                      <button type="button" class="btn btn-danger mb-2"  data-toggle="modal" data-target="#modalHapus<?= $mahasiswa['id_mahasiswa'];?>">
                      <i class="fa fa-trash-alt" ></i> Hapus</button>
                      </td>
                  </tr>
                  <?php endforeach; ?>    
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"><?php date_default_timezone_set('Asia/Jakarta');
            echo 'Indonesian : ' . date('d-m-Y H:i:s'); ?></div>
        </div>

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
        </p>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Uray Ibnu Setiawan <?= date('Y') ?></span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa"
                Required>
            </div>
            
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" 
                Required>
            </div>

            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <select name="kelas" id="kelas" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    <option value="5A">5A</option>
                    <option value="5B">5B</option>
                  </select>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="tambah" class="btn btn-primary">Add Mahasiswa</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Hapus -->
<?php foreach ($data_mahasiswa as $mahasiswa) : ?>
<div class="modal fade" id="modalHapus<?= $mahasiswa['id_mahasiswa'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">
                    <p>Yakin Ingin Menghapus Data Mahasiswa: <?= $mahasiswa['nama'];?> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa'];?>"  class="btn btn-danger" >Hapus</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


<!-- Modal Ubah -->
<?php foreach ($data_mahasiswa as $mahasiswa) : ?>
  <div class="modal fade" id="modalUbah<?= $mahasiswa['id_mahasiswa'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="exampleModalLabel">Update Data Mahasiswa: <?= $mahasiswa['nama']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
            

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $mahasiswa['nama']?>" placeholder="Nama Mahasiswa"
                Required>
            </div>
            
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?= $mahasiswa['nim']?>" placeholder="NIM" 
                Required>
            </div>

            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <select name="kelas" id="kelas" class="form-control" required>
                      <option value="5A" <?php if($mahasiswa['kelas'] == '5A'){ echo 'selected'; } ?>>5A</option>
                      <option value="5B" <?php if($mahasiswa['kelas'] == '5B'){ echo 'selected'; } ?>>5B</option>
                  </select>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubah" class="btn btn-primary" >Ubah</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>


  <!-- Logout Modal-->
  <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div> -->

   <!-- preview img-->
   <script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

  <?php include'layout/footer.php'; ?>