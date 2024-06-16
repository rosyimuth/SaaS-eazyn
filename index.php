<?php
session_start();

//proses pengecekan session
if(!isset($_SESSION['id'])){
  header('Location: login.php');
}
?>

<?php 
//1. koneksi ke MySQL
require_once("config/connect.php");
//2. Membuat query sesuai kebutuhan
$query = "select izin.*, guru.nama as nama_guru, bk.nama as nama_bk 
          from izin
          inner join guru on guru.id = izin.guru_id
          left join bk on bk.id = izin.bk_id
          where siswa_id = " .$_SESSION['id'];
          //tips: jalankan query di phpmyadmin untuk uji coba sql
//3. Menjalankan query
$run_sql = mysqli_query($is_connect, $query);
//var_dump($run_sql); //tips: cek isi variabel menggunakan var_dump()
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EAZYN : Aplikasi untuk memudahkan izin</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/logo.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="assets/images/logos/logo.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./buat-izin.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Buat Izin</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./riwayat.php" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">Riwayat</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-9 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Riwayat Izin</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Id</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Validasi Oleh</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Alasan</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Status</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Tanggal</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0"><i class="ti ti-dots-vertical"></i></h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //4. Menampilkan menggunakan mysqli_fetch_all
                      $fetch_data = mysqli_fetch_all($run_sql, MYSQLI_BOTH); //mengambil data dari variabel, lalu menyimpannya pada array fetch_data
                        foreach($fetch_data as $data){ //mengulang elemen fetch_data
                      ?>
                      <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $data[0]?></h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data[10]?></h6>
                            <?php echo $data[11]?>                          
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"><?php echo $data[4]?></p>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <?php 
                            if($data[8] == 0){
                            ?>
                            <span class="badge bg-info rounded-3 fw-semibold">Ajukan</span>
                            <?php
                            }elseif($data["is_approved"] == 1){
                            ?>
                            <span class="badge bg-warning rounded-3 fw-semibold">Disetujui Guru</span>
                            <?php
                            }elseif($data["is_approved"] == 2){
                            ?>
                            <span class="badge bg-success rounded-3 fw-semibold">Disetujui BK</span>
                            <?php
                            }elseif($data["is_approved"] == 3){
                            ?>
                            <span class="badge bg-danger rounded-3 fw-semibold">Ditolak</span>
                            <?php
                            }
                            ?>
                            
                          </div>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4"><?php echo $data[7];?></h6>
                        </td>
                      </tr> 
                      <?php 
                      }
                      ?>                       
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="row">
              <div class="col-lg-10">
                <!-- Izin Tersedia -->
                <div class="card overflow-hidden">
                  <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Izin Tersedia</h5>
                    <div class="row align-items-center">
                      <div class="col-4">
                      <?php
                        $query = "select value from setting where nama_setting='pembatasan'";
                        $query1 = "select count(id) as jumlah_izin from izin where siswa_id=2 and is_approved= 2";
                        $sql = mysqli_query($is_connect, $query);
                        $sql1 = mysqli_query($is_connect, $query1);
                        $fetch_data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
                        $fetch_data1 = mysqli_fetch_all($sql1, MYSQLI_ASSOC);
                        ?>
                        <h4 class="fw-semibold mb-3"><?php echo $fetch_data[0]['value']-$fetch_data1[0]['jumlah_izin']; ?></h4>
                      </div>
                      <div class="col-7">
                        <div class="d-flex justify-content-center">
                          <div id="breakup"></div>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="d-flex align-items-center">
                          <div class="me-4">
                            <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">Tersedia</span>
                          </div>
                          <div>
                            <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">Sudah digunakan</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">Rosyimuth</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
</body>

</html>