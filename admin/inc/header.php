<?php 
   include_once('../lib/session.php');
   Session::checkSession();
?>
<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Quản trị viên
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          QTV
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Quản trị viên
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="index.php">
              <i class="now-ui-icons design_app"></i>
              <p>Trang chủ</p>
            </a>
          </li>
          <li>
            <a href="./sliderlist.php">
              <i class="fas fa-images"></i>
              <p>Slider</p>
            </a>
          </li>
          <li>
            <a href="./customerlist.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>Người dùng</p>
            </a>
          </li>
          <li>
            <a href="./binhluanlist.php?binhluan=0">
              <i class="fas fa-comments"></i>
              <p>Bình luận</p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./catlist.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Danh mục sản phẩm</p>
            </a>
          </li>
          <li>
            <a href="./brandlist.php">
              <i class="now-ui-icons text_caps-small"></i>
              <p>Thương hiệu sản phẩm</p>
            </a>
          </li>
          <li>
            <a href="./productlist.php">
              <i class="fas fa-box-open"></i>
              <p>Sản phẩm</p>
            </a>
          </li>
          <li>
            <a href="./inbox.php">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Đơn đặt hàng</p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./postlist.php">
              <i class="fas fa-bars"></i>
              <p>Danh mục tin tức</p>
            </a>
          </li>
          <li>
            <a href="./bloglist.php">
              <i class="fas fa-newspaper"></i>
              <p>Tin tức</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">HoangHa.Co</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#"><?php echo Session::get('name') ?></a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <?php
                    if(isset($_GET['action']) && $_GET['action']=='logout'){
                      Session::destroy();
                      echo "<script>window.location='login.php' </script>";
                    }
                  ?>
                  <a class="dropdown-item" href="?action=logout">Đăng xuất</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <script src="../ckeditor/ckeditor.js"></script>