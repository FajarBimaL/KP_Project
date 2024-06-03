<?php
require ".././koneksi.php";
$lsQuery = new listQuery();
// if(isset($_POST['submit'])){
//   $hasil = $ListQuery->logIn(
//     $_POST["nama_user"],
//     $_POST["pass"]
//   );

//   if($hasil == 1){
//     $_SESSION["logIn"] = true;
//     $_SESSION["id_user"] = $ListQuery->userID();
//     header("Location: index.php");
//     echo "<script> alert('Login Success'); </script>";
//   }
//   elseif($_hasil == 10){
//     echo "<script> alert('Username salah'); </script>";
    
//   }
//   elseif($_hasil == 100){
//     echo "<script> alert('Password salah'); </script>";
    
//   }
// }

// require "koneksi.php";

$user_log = new masuk();


if(isset($_POST['submit'])){
  $result = $user_log->userMasuk(
    $_POST["nama_user"],
    $_POST["pass"]
  );

  if($result == 1){
    $_SESSION["login"] = true;
    $_SESSION["id_user"] = $user_log->userID();
    $_SESSION["nama_user"] = $user_log->nmUser();
    $_SESSION["lvl"] = $user_log->lvlUsr();
    header("Location: .././index.php");
    echo "<script> alert('Login berhasil'); </script>";
  }
  elseif($result == 10){
    echo "<script> alert('pass salah '); </script>";
  }
  elseif($result == 100){
      echo "<script> alert('user belum terdaftar'); </script>";
  }
}

?>


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PolluxUI Admin</title>
  <!-- base:css -->
  
  <link rel="stylesheet" href="../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>
<!-- <body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0"></div>
        </div>
    </div>
</body> -->
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <!-- <div class="brand-logo">
                <img src="../../images/logo-dark.svg" alt="logo">
              </div> -->
              <h4 class="text-center">Tracking Document</h4>
              <br>
              <h4 class="text-center">Login</h4>
              <!-- <h6 class="font-weight-light">Sign in to continue.</h6> -->
              <form class="pt-3" method="post" autocomplete="off">
                <div class="form-group">
                  <input type="text" name="nama_user" class="form-control form-control-lg" required value="" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="pass" class="form-control form-control-lg" required value="" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Login</button>
                  <!-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</a> -->
                </div>
              </form>
              <a href="signUp.php">Registrasi</a>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
</body>