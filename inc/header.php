<?php

use function PHPSTORM_META\elementType;

   ob_start(); 
   include('lib/session.php');
   Session::init();
?>

<?php 
    include_once('lib/database.php');
    include_once('helpers/format.php');

    spl_autoload_register(function($className){
        include_once "classes/".$className.".php";
    });

    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $cs = new customer();
    $cat = new category();
    $product = new product();
    $brand = new brand();
    $pos = new post();
    $blog = new blog();
?>

<?php
    header("Cache-Control: no-cache,must-revalidate");
    header("Pragma: no-cache");
    header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/fevicon.png" type="image/png" />
  <title>HoangHa.Co</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="vendors/linericon/style.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="css/flaticon.css" />
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css" />
  <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
  <link rel="stylesheet" href="vendors/animate-css/animate.css" />
  <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css" />
  <!-- main css -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
</head>

<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light w-100">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.php">
            <img src="./admin/uploads/logo.png" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
            <div class="row w-100 mr-0">
              <div class="col-lg-7 pr-0">
                <ul class="nav navbar-nav center_nav pull-right">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php">Trang chủ</a>
                  </li>
                  <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Sản phẩm</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="productall.php?trang=1">Tất cả</a>
                      </li>
                      <?php
                        $get_category = $cat->show_category_fontend();
                        if($get_category){
                          while($result = $get_category->fetch_assoc()){
                      ?>
                            <li class="nav-item">
                              <a class="nav-link" href="productbycat.php?catid=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a>
                            </li>
                      <?php 
                         }
                        }
                      ?>
                    </ul>
                  </li>
                  <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Tin tức</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="categorypost.php?idpost=all">Tất cả</a>
                      </li>
                      <?php 
                        $post = $pos->show_category_fontend();
                        if($post){
                          while($result_new = $post->fetch_assoc()){                       
                      ?>
                      <li class="nav-item">
                        <a class="nav-link" href="categorypost.php?idpost=<?php echo $result_new['id_cate_post']; ?>"><?php echo $result_new['title']; ?></a>
                      </li>
                      <?php 
                         }
                        }
                      ?>
                    </ul>
                  </li>
                  <?php 
                    $login_check = Session::get('customer_login');
                    if($login_check){
                  ?>
                  <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Danh sách</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="compare.php">So sánh</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="wishlist.php">Yêu thích</a>
                      </li>
                    </ul>
                  </li>
                  <?php 
                    }                 
                  ?>
                  <li class="nav-item">
                    <a class="nav-link" href="contact.php">Liên hệ</a>
                  </li>
                </ul>
              </div>

              <div class="col-lg-5 pr-0">
                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                  <li class="nav-item">
                    <a href="cart.php" class="icons">
                      <i class="ti-shopping-cart"></i>
                      <sup>
                          <?php
                              $check_cart = $ct->check_cart();
                              if($check_cart){
                                $sum = Session::get("sum");
                                echo $fm->format_currency($sum).'₫';
                              }else{
                                echo 0;
                              }                             
                          ?>
                      </sup>
                    </a>
                  <?php 
                    if(isset($_GET['customer_id'])){
                      $customer_id = $_GET['customer_id'];
                      $delCart = $ct->dell_all_data_cart();
                      $delCompare = $ct->dell_compare($customer_id);
                      Session::destroy();
                    }
                  ?>
                  </li>
                  <?php 
                    $login_check = Session::get('customer_login');
                    if($login_check==false){
                  ?>
                    <li class="nav-item">
                      <a href="login.php" class="icons">
                        <i class="ti-user" aria-hidden="true"></i>
                          ĐĂNG NHẬP
                      </a>
                    </li>
                  <?php 
                    }else{
                  ?>
                  <?php
                      $id = Session::get('customer_id');
                      $get_customer_by_id = $cs->show_customers($id);
                      if($get_customer_by_id){
                        while($result_customer = $get_customer_by_id->fetch_assoc()){

                        
                  ?>
                     <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                          aria-expanded="false">
                          <img src="admin/uploads/<?php echo $result_customer['image']; ?>" style="width: 40px;height: 40px;margin-left: 10px;margin-right: 3px;border-radius: 50%;">
                          <?php echo $result_customer['name']; ?>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="nav-item">
                            <a class="nav-link" href="profile.php">THÔNG TIN CÁ NHÂN</a>
                          </li>
                          <?php
                            $customer_id = Session::get('customer_id'); 
                            $check_order = $ct->check_order($customer_id);
                            if($check_order==true){
                          ?>
                          <li class="nav-item">
                            <a class="nav-link" href="orderdetails.php">ĐƠN HÀNG</a>
                          </li>
                          <?php 
                            }
                          ?>
                          <li class="nav-item">
                            <a class="nav-link" href="?customer_id=<?php echo Session::get('customer_id'); ?>">ĐĂNG XUẤT</a>
                          </li>
                        </ul>
                      </li>
                  <?php
                        }
                      } 
                    }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>                                         
  </header>
  <!--================Header Menu Area =================-->