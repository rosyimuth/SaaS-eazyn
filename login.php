<?php
session_start(); //memulai sesi

if(isset($_SESSION['id'])){ //memeriksa id apakah diatur=True, lalu mengeksekusi koding selanjutnya
  header('Location: index.php'); //mengarahkan pengguna ke index.php
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Eazyn</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/logo.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-6 col-lg-4 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="assets/images/logos/logo.png" width="180" alt="">
                </a>
                <p class="text-center">Waduh Eazyn Banget</p>
                <form action="proses_login.php" method="post">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" placeholder="Username" class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="text" name="password" placeholder="Password" class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    
                    <a class="text-primary fw-bold" href="./index.php">Lupa Password ?</a>
                  </div>
                  <input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Sign In" \>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-3 mb-0 fw-bold">Tidak punya akun ?</p>
                    <a class="text-primary fw-bold ms-2" href="./authentication-register.php">Buat akun baru</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>