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


include 'conf/app.php';

// menerima email yang dipilih pengguna
$email =$_GET['email'];

if (delete_customers($email) > 0) {
    echo "<script>
        alert('Data Customers Berhasil Dihapus');
        document.location.href = 'tables_customers.php';
        </script>";
} else {
    echo "<script>
        alert('Data Customers Gagal Dihapus');
        document.location.href = 'tables_customers.php';
        </script>";   
}

?>