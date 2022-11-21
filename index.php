<?php

include'conf/app.php';

session_start();

//  membatasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "<script>
            alert('Login dulu yaaa!');
            document.location.href = 'login.php';
          </script>"; 
    exit;      
}


// if (isset($_POST['tambah'])) {
//   $makul            = $_POST['makul'];
//   $kelas            = $_POST['kelas'];
//   $nim              = $_POST['nim'];
//   $nama             = $_POST['nama'];
//   $status_presensi  = $_POST['status_presensi'];



//   $query = "INSERT INTO presensi (id_presensi, tgl_presensi, makul, kelas, nim, nama, status_presensi) 
// VALUES (NULL, CURRENT_TIMESTAMP(), '$makul', '$kelas', '$nim', '$nama', '$status_presensi')";

// if (mysqli_query($conn, $query)) {
//     echo "New record created successfully";
// }  else {
//     echo "Error: " . $query . "<br>" . mysqli_error($conn);
// }

// mysqli_close($conn);
// // me-redirect ke file: read_data.php untuk menampilkan hasilnya
// header('Location: index.php');


// }


?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input | Presensi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="jquery.min.js" type="text/javascript"></script>

  </head>
<body class="bg-dark">
    <h1></h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header text-center"><h4>Pengisian Kehadiran Mahasiswa </h4> </div>
      <div class="card-header text-right"><a class="btn btn-danger" href="logout.php" onclick="return confirm('Yakin ingin keluar <?= $_SESSION['name']; ?>?')">Logout</a></div>
     
      <div class="card-body">
        <form method="POST" action="">
          <!-- <div class="form-group"> -->
            <div class="row form-row mb-1">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="date" id="tgl_presensi" name="tgl_presensi" class="form-control" placeholder="Tgl" autofocus="autofocus" value="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <select name="makul" id="makul" class="form-control" autofocus="autofocus">
                    <option value=""> -- Pilih Mata Kuliah  -- </option>
                    <option <?php if($_POST['makul'] == 'WebProg'){echo 'selected';} ?> value="WebProg"> Pemrograman Web </option>
                    <option <?php if($_POST['makul'] == 'WebProgLab'){echo 'selected';} ?> value="WebProgLab"> Praktik Pemrograman Web </option>
                    <option <?php if($_POST['makul'] == 'SoftDev'){echo 'selected';} ?> value="SoftDev"> Rekayasa Perangkat Lunak </option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <select name="kelas" id="kelas" class="form-control" autofocus="autofocus" onchange="this.form.submit()">
                    <option value=""> -- Pilih Kelas -- </option>
                    <option value="5A"> 5A </option>
                    <option value="5B"> 5B </option>
                  </select>
                </div>
              </div>
            </div>
        </form>
        <form method="post" action="">
            <hr><div class="row text-center">
                <div class="col-md-4"><strong>Nomor Induk Mahasiswa</strong></div>
                <div class="col-md-4"><strong>Nama Lengkap</strong></div>
                <div class="col-md-4"><strong>Status Presensi</strong></div>
            </div><hr>
            <?php
              if(isset($_POST['kelas'])){
                $tanggal = $_POST['tgl_presensi'];
                $makul = $_POST['makul'];
                $kelas = $_POST['kelas'];
                $sql = "SELECT * FROM mahasiswa WHERE kelas = '$_POST[kelas]'";
                $q_tampil = mysqli_query($conn, $sql);
                while ($r_tampil = mysqli_fetch_array($q_tampil)){
              

            ?>

            <div class="row form-row mb-1">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" id="nim" name="nim" class="form-control" placeholder="NIM" autofocus="autofocus" value="<?php echo $r_tampil['nim']; ?>" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" autofocus="autofocus" value="<?php echo $r_tampil['nama']; ?>" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <select name="status_presensi" id="status_presensi" class="form-control" autofocus="autofocus">
                      <option value="Hadir"> Hadir </option>
                      <option value="Sakit"> Sakit </option>
                      <option value="Izin"> Izin </option>
                      <option value="Alpa"> Alpa </option>
                  </select>
                </div>
              </div>
            </div>
            <?php } }?>


          <!-- </div> -->
          <br>
          <p class="text-center">
          <!-- <input type="submit" name="tambah" value="Simpan Presensi" class="btn btn-primary btn-block"></p> -->
          <button type="submit" name="tambah" class="btn btn-primary">Add Presensi</button>
          <!-- <a class="btn btn-secondary btn-block" href="users.php">Cancel</a> -->

        

        </form>

       



        <div class="text-center">
          <br>Copyright © Program Studi Teknik Informatika - <?= date('Y');?><br>
        </div>
      </div>
    </div>
                
</body>
</html>