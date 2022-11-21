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

$title = 'Data Presensi';


include'layout/header.php';

// tampilkan seluruh data
$data_presensi = select("SELECT * FROM presensi");




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



      <li class="nav-item ">
        <a class="nav-link" href="tables_mahasiswa.php">
          <i class="fas fa-users"></i>
          <span>Tables Mahasiswa</span></a>
      </li>

      <li class="nav-item active">
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
          <li class="breadcrumb-item active">Tabel Presensi</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Presensi</div>
          <div class="card-body">
            <div class="table-responsive">
              <link rel="icon" href="assets/img/person-plus.svg">
              <!-- <a href="register.php" class="btn btn-primary mb-2">Tambah</a> -->
            <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-user-plus"> Add User</i> </button> -->
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr class="text-center">
                    <th>Date Presensi</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Status Presensi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php foreach ($data_presensi as $presensi) : ?>
                  <tr class="text-center">
                      <td><?= $presensi['tgl_presensi'];?></td>
                      <td><?= $presensi['makul']?></td>
                      <td><?= $presensi['kelas'];?></td>
                      <td><?= $presensi['nim']?></td>
                      <td><?= $presensi['nama']?></td>
                      <td><?= $presensi['status_presensi']?></td>
                      <td class="text-center" >
                      <a href="#" class="btn btn-success ">
                      <i class="fa fa-edit" ></i> Edit</a>   
                      <a href="hapus-customers.php?nim=<?= $presensi['nim']; ?>" onclick="return confirm('Anda yakin ingin menghapus record ini?')"class="btn btn-danger ">
                      <i class="fa fa-trash-alt" ></i> Hapus</a> 
                      </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"> <?php date_default_timezone_set('Asia/Jakarta');
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

  

<?php include'layout/footer.php'; ?>