<?php

session_start();

include 'conf/app.php';

// check apakah tombol login ditekan
if (isset($_POST['login'])) {
    // ambil input username dan password
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // check username
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    // jika ada username 
    if (mysqli_num_rows($result) == 1) {
        // check password
        $hasil = mysqli_fetch_assoc($result);

        if (password_verify($password, $hasil['password'])) {
            // set session
            $_SESSION['login']   = true;
            $_SESSION['id_user'] = $hasil['id_user'];
            $_SESSION['name']    = $hasil['name'];
            $_SESSION['role']   = $hasil['role'];

            // jika login benar akan diarahkan ke index.php
            header("Location: index.php");
            exit;
        }

    }
    // jika tidak ada usernya/login salah
    $error = true;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title >Admin Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="icon" href="assets/img/person-circle.svg">
    <meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="admin/assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center bg-dark">

  

<main class="form-signin">
  <form action="" method="post">
    <img class="mb-4 "  src="assets/img/person-circle.svg"  alt="" width="102" height="87">
    <h1 class="h3 mb-3 fw-normal" style="color:white;">Dosen Login</h1>
    
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger text-center">
            <b>Username/Password SALAH!!!</b>
        </div>
    <?php endif;?>    

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email" required>
      <label for="floatingInput">Email</label>
    </div>

    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>
    

    <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>

    
    <p class="mt-5 mb-3 text-muted">Copyright &copy; Uray Ibnu Setiawan <?= date('Y') ?></p>
  </form>
 

</main>


    
  </body>
</html>