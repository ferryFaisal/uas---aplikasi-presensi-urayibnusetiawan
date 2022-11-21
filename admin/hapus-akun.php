<?php

// session_start();

// //  membatasi halaman sebelum login
// if (!isset($_SESSION['login'])) {
//     echo "<script>
//             alert('Login dulu yaaa!');
//             document.location.href = 'login.php';
//           </script>"; 
//     exit;      
// }


include '../conf/app.php';

// menerima id akun yang dipilih pengguna
$id_user = (int)$_GET['id_user'];

if (delete_user($id_user) > 0) {
    echo "<script>
        alert('Data User Berhasil Dihapus');
        document.location.href = 'tables_user.php';
        </script>";
} else {
    echo "<script>
        alert('Data User Gagal Dihapus');
        document.location.href = 'tables_user.php';
        </script>";   
}

?>