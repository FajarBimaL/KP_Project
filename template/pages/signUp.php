<?php

require ".././koneksi.php";

$ListQuery = new listQuery();

$regis = new register();

if(isset($_POST["register"])){
    
    $hashPass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    echo $hashPass;
    $result = $regis->registrasi(
        $_POST["id_divisi"],
        $_POST["nama_user"],
        $hashPass,
        // $_POST["confirmpass"],
        $_POST["lvl"]
        
    );
    
    if($result == 1){
        
        echo "<script> alert('Registrasi berhasil'); </script>";
        // echo password_hash($pass, PASSWORD_DEFAULT);
    } elseif($result == 10){
        echo "<script> alert('username telah digunakan'); </script>";
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
              <h4 class="text-center">Sign Up</h4>
              <!-- <h6 class="font-weight-light">Sign in to continue.</h6> -->
              <form class="pt-3" method="post" autocomplete="off">
              <!-- <div class="form-group">
                  <input type="text" name="id_divisi" class="form-control form-control-lg" required value="" placeholder="Divisi">
              </div> -->
              <div class="form-group">
                <label for="">Pilih divisi</label><br>
                <!-- <input type="text" name="pengirim" class="form-control" placeholder="Pengirim"> -->
                <select class="col-sm-12" name="id_divisi" style="color: black;">
                    <?php
                        $listDiv = $ListQuery->divisi();
                        if ($listDiv){
                            foreach($listDiv as $hasil){
                                echo "<option value='$hasil[id_divisi]'>$hasil[deskripsi]</option>";
                            }
                        }
                    ?>
                </select>
            </div>
              <div class="form-group">
                  <input type="text" name="nama_user" class="form-control form-control-lg" required value="" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="pass" class="form-control form-control-lg" required value="" placeholder="Password">
                </div>
                <!-- <div class="form-group">
                  <input type="text" name="confirmpass" class="form-control form-control-lg" required value="" placeholder="Confirm Password">
                </div> -->
                <!-- <div class="form-group">
                  <input type="text" name="lvl" class="form-control form-control-lg" required value="" placeholder="Level">
                </div> -->
                <div class="form-group">
                  <label for="">Level</label>
                  <select name="lvl" class="col-sm-12" style="color: black;">
                    <option value="Approval">Approval</option>
                    <option value="Petugas">Petugas</option>
                  </select>
                </div>
                <div class="mt-3">
                  <button type="register" name="register" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Register</button>
                  <!-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</a> -->
                </div>
              </form>
              <a href="login.php">Login</a>
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