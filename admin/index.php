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


$title = 'Dashboard';


include 'layout/header.php';

// count data user
$data_user = mysqli_query($conn, "SELECT * FROM user");
$jumlah_user = mysqli_num_rows($data_user);

// count data user
$data_mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa");
$jumlah_mahasiswa = mysqli_num_rows($data_mahasiswa);

// count data presensi
$data_presensi = mysqli_query($conn, "SELECT * FROM presensi");
$jumlah_presensi = mysqli_num_rows($data_presensi);


?>

<!-- Navbar -->
<ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
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
       
        <li class="nav-item active">
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


        

        <li class="nav-item">
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
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Overview</li>
            </ol>
            <h4 style="font-style:italic; font-family: oleoScript-regular; text-alig">Selamat Datang... <b><?= $_SESSION['name'];?></b> </h4>
            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas far fa-user-circle"></i>
                            </div>
                            <div class="mr-5 font-italic font-weight-bold"> Tables User: <?= $jumlah_user; ?> </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="tables_user.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-shopping-cart"></i>
                            </div>
                            <div class="mr-5 font-italic font-weight-bold">Tables Mahasiswa: <?= $jumlah_mahasiswa; ?> </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="tables_mahasiswa.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas far fa-user-circle"></i>
                            </div>
                            <div class="mr-5 font-italic font-weight-bold">Tables Presensi: </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="tables_presensi.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <!-- <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-life-ring"></i>
                            </div>
                            <div class="mr-5">13 New Tickets!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div> -->
            </div>

            <!-- Area Chart Example-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i> Area Chart Example</div>
                <div class="card-body">
                    <canvas id="myAreaChart" width="100%" height="30"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>

            <!-- DataTables Example -->
            <!-- <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i> Data Table Example</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div> -->
                <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
            </div>

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
            <span aria-hidden="true"></span>
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