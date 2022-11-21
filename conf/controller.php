<?php

// fungsi menampilkkan data_user
function select($query) {
  
  //panggil koneksi database
  global $conn;

  $result = mysqli_query($conn, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


// fungsi menghapus data user
function delete_user($id_user) {
  global $conn;

  //query delete data
  $query = "DELETE FROM user WHERE id_user = $id_user";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}



// fungsi ubah user
function update_user($post) {

  global $conn;

  $id_user       = strip_tags($post['id_user']);
  $name          = strip_tags($post['name']);
  $password      = strip_tags($post['password']);
  $role          = strip_tags($post['role']);
  $date_modified = date("Y-m-d");
  
  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);



 // query ubah
 $query = "UPDATE user SET  name = '$name',  password = '$password', role = '$role', date_modified = '$date_modified' WHERE id_user = '$id_user'";

 mysqli_query($conn, $query);

 return mysqli_affected_rows($conn);
}




// fungsi menghapus data mahasiswa
function delete_mahasiswa($id_mahasiswa) {
  global $conn;

  //query delete data
  $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}


// fungsi update data mahasiswa
function update_mahasiswa($post) {
  global $conn;

  $id_mahasiswa      = strip_tags($post['id_mahasiswa']);
  $nama              = strip_tags($post['nama']);
  $kelas             = strip_tags($post['kelas']);


 // query ubah
 $query = "UPDATE mahasiswa SET  nama = '$nama', kelas = '$kelas' WHERE id_mahasiswa = '$id_mahasiswa'";

 mysqli_query($conn, $query);

 return mysqli_affected_rows($conn);
}



// fungsi tambah presensi
// function create_presensi($post) {

//   global $conn;


//   $makul           = $_POST['makul'];
//   $kelas           = $_POST['kelas'];
//   $nim             = $_POST['nim'];
//   $nama            = $_POST['nama'];
//   $status_presensi = $_POST['status_presensi'];
  


//   // query tambah
//   $query = "INSERT INTO presensi VALUES( CURRENT_TIMESTAMP() , '$makul', '$kelas',  '$nim', '$nama', '$status_presensi' )";

//   mysqli_query($conn, $query);

//   return mysqli_affected_rows($conn);
// }







