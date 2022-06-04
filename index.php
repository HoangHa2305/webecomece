<?php 
    include('inc/header.php');
?>
<?php 
  if(isset($_GET['proid'])){
    $id = $_GET['proid'];
    $quantity = $_GET['qty'];
    $insert_cart = $ct->insert_to_cart($quantity,$id); 
  }
  if(isset($_GET['productid'])){
    $productid = $_GET['productid'];
    $customer_id = Session::get('customer_id');
    $insert_wishlist = $product->insert_to_wishlist($productid,$customer_id);
  }
?>
<!--================ Offer Area =================-->
  <!-- Slider -->
  <section class="slider-section">
	<div id="carousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		
		<!-- Carousel Content -->
		<div class="carousel-inner" role="listbox">
      <?php 
        $get_first_slider = $product->show_first_slider();
        if($get_first_slider){
          while($result_first_slider = $get_first_slider->fetch_assoc()){        
      ?>
			<div class="carousel-item active" style="background-image: url('./admin/uploads/<?php echo $result_first_slider['slider_image'];?>');">
				<div class="carousel-caption d-none d-md-block">
					<h3 style="color: white;">HoangHa.Co</h3>
					<p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
				</div>
			</div> <!-- End of Carousel Item -->
      <?php
          $id = $result_first_slider['sliderId']; 
         }
        }
      ?>
      <?php 
        $get_slider = $product->show_slider($id);
        if($get_slider){
          while($result_slider = $get_slider->fetch_assoc()){        
      ?>
			<div class="carousel-item" style="background-image: url('./admin/uploads/<?php echo $result_slider['slider_image'];?>');">
				<div class="carousel-caption d-none d-md-block">
					<h3 style="color: white;">HoangHa.Co</h3>
					<p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
				</div>
			</div> <!-- End of Carousel Item -->
      <?php 
         }
        }
      ?>
		</div> <!-- End of Carousel Content -->
    <ol class="carousel-indicators">
			<li data-target="#carousel" data-slide-to="0" class="active"></li>
      <?php 
        $show_slider = $product->show_slider($id);
        if($show_slider){
          while($result_show_slider = $show_slider->fetch_assoc()){  
          
      ?>
			<li data-target="#carousel" data-slide-to="1"></li>
      <?php 
          }
        }
      ?>
		</ol> <!-- End of Indicators -->
		<!-- Previous & Next -->
		<a href="#carousel" class="carousel-control-prev" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only"></span>
		</a>
		<a href="#carousel" class="carousel-control-next" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only"></span>
		</a>
    
	</div> <!-- End of Carousel -->
</section> <!-- End of Slider -->
  <!--================ End Offer Area =================-->

  <!-- Start feature Area -->
  <section class="feature-area section_gap_bottom_custom">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="#" class="title">
              <i class="flaticon-money"></i>
              <h3>Giá rẻ và chất lượng tốt nhất</h3>
            </a>
            <p>Shall open divide a one</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="#" class="title">
              <i class="flaticon-truck"></i>
              <h3>Giao hàng nhanh chóng trên toàn quốc</h3>
            </a>
            <p>Shall open divide a one</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="#" class="title">
              <i class="flaticon-support"></i>
              <h3>Hỗ trợ 24/7</h3>
            </a>
            <p>Shall open divide a one</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="#" class="title">
              <i class="flaticon-blockchain"></i>
              <h3>Bảo mật thanh toán</h3>
            </a>
            <p>Shall open divide a one</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End feature Area -->

  <!--================ Inspired Product Area =================-->
  <section class="inspired_product_area section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Thương hiệu sản phẩm</span></h2>
            <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
          </div>
        </div>
      </div>

      <div class="row">
        <?php  
          $getLastestbrand = $brand->get_brand();
          if($getLastestbrand){
            while($resultbrand = $getLastestbrand->fetch_assoc()){
        ?>
        <div class="col-lg-3 col-md-6">
          <a class="d-block" href="productbybrand.php?brandid=<?php echo $resultbrand['brandId']; ?>">
            <div class="single-blog">
              <div class="thumb">
                <img class="img-fluid" src="./admin/uploads/<?php echo $resultbrand['image'];?>" style="height: 110px;" alt="">
              </div> 
              <div class="short_details">                
                  <h4 style="text-align: center;"><?php echo $resultbrand['brandName']; ?></h4>             
              </div>
            </div>
          </a>
        </div>
        <?php 
            }
          }       
        ?>
      
      </div>
    </div>
  </section>
  <!--================ End Inspired Product Area =================-->
  
  <!--================Home Banner Area =================-->
  <!-- <section class="home_banner_area mb-40">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content row">
          <div class="col-lg-12">
            <p class="sub text-uppercase">men Collection</p>
            <h3><span>Show</span> Your <br />Personal <span>Style</span></h3>
            <h4>Fowl saw dry which a above together place.</h4>
            <a class="main_btn mt-40" href="#">View Collection</a>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!--================End Home Banner Area =================-->
  
  <!--================ Feature Product Area =================-->
  <section class="feature_product_area section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Sản phẩm nổi bật</span></h2>
            <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
          </div>
        </div>
      </div>

      <div class="row">
        <?php
            $product_feathered = $product->getproduct_feathered();
            if($product_feathered){
                while($result = $product_feathered->fetch_assoc()){
        ?>
        <div class="col-lg-4 col-md-6">
          <div class="single-product">
            <div class="product-img">
              <img class="img-fluid w-100" src="./admin/uploads/<?php   echo $result['image'];?>" alt="" />
              <div class="p_icon">
                <a href="details.php?proid=<?php echo $result['productId']; ?>">
                  <i class="ti-eye"></i>
                </a>
                <?php 
                  $login_check = Session::get('customer_login');
                  if($login_check){
                ?>
                <a href="?productid=<?php echo $result['productId']; ?>">
                  <i class="ti-heart"></i>
                </a>
                <?php 
                  }
                ?>
                <a href="?proid=<?php echo $result['productId']; ?>&qty=1">
                  <i class="ti-shopping-cart"></i>
                </a>
              </div>
            </div>
            <div class="product-btm">
              <a href="details.php?proid=<?php echo $result['productId']; ?>" class="d-block">
                <h4><?php echo $result['productName']; ?></h4>
              </a>
              <div class="mt-3">
                <?php
                    if($result['priceSale']==0 && $result['price']!=0){
                                          
                ?>
                <span class="mr-4"><?php echo $fm->format_currency($result['price']); ?>₫</span>
                <?php
                    }elseif($result['price']==0){
                ?>
                <del style="color: #FF3030;"><span style="color: #FF3030;">Hết hàng</span></del>
                <?php
                    }else{
                ?>
                <span class="mr-4"><?php echo $fm->format_currency($result['priceSale']); ?>₫</span>
                <del><?php echo $fm->format_currency($result['price']); ?>₫</del>
                <?php 
                    }
                ?>
              </div>
            </div>
          </div>
        </div>
        <?php
                }
            }
        ?>
      </div>
    </div>
  </section>
  <!--================ End Feature Product Area =================-->

  <!--================ New Product Area =================-->
  <section class="new_product_area section_gap_top section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>SẢN PHẨM MỚI</span></h2>
            <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
          </div>
        </div>
      </div>

      <div class="row">
      <?php
            $product_new_high = $product->getproduct_new_high();
            if($product_new_high){
                while($result_new_high = $product_new_high->fetch_assoc()){
        ?>
        <div class="col-lg-6">
          <div class="new_product">
            <h5 class="text-uppercase">Sản phẩm mới nhất</h5>
            <h3 class="text-uppercase"><?php echo $result_new_high['productName']; ?></h3>
            <div class="product-img">
              <img class="img-fluid" src="./admin/uploads/<?php   echo $result_new_high['image'];?>" alt="" />
            </div>
            <h4>
              <?php
              $id = $result_new_high['productId']; 
                  if($result_new_high['priceSale']==0 && $result_new_high['price']!=0){
                    echo $fm->format_currency($result_new_high['price']).'₫';
                  }elseif($result_new_high['price']==0 && $result_new_high['priceSale']==0){
                    echo '<del style="color: #FF3030;"><span style="color: #FF3030;font-size: 20px;">Hết hàng</span></del>';
                  }
                  else{
                    echo $fm->format_currency($result_new_high['priceSale']).'₫';
                  }
              ?>
            </h4>
            <a href="details.php?proid=<?php echo $result_new_high['productId']; ?>" class="main_btn">Xem chi tiết</a>
          </div>
        </div>
        <?php
                }
            }
        ?>
        <div class="col-lg-6 mt-5 mt-lg-0">
          <div class="row">
            <?php
              $product_new = $product->getproduct_new($id);
              if($product_new){
                  while($result_new = $product_new->fetch_assoc()){
            ?>
            <div class="col-lg-6 col-md-6">
              <div class="single-product">
                <div class="product-img">
                  <img class="img-fluid w-100" src="./admin/uploads/<?php   echo $result_new['image'];?>" alt="" />
                  <div class="p_icon">
                    <a href="details.php?proid=<?php echo $result_new['productId']; ?>">
                      <i class="ti-eye"></i>
                    </a>
                    <?php 
                      $login_check = Session::get('customer_login');
                      if($login_check){
                    ?>
                    <a href="?productid=<?php echo $result_new['productId']; ?>">
                      <i class="ti-heart"></i>
                    </a>
                    <?php
                      } 
                    ?>
                    <a href="?proid=<?php echo $result_new['productId']; ?>&qty=1">
                      <i class="ti-shopping-cart"></i>
                    </a>
                  </div>
                </div>
                <div class="product-btm">
                  <a href="details.php?proid=<?php echo $result_new['productId']; ?>" class="d-block">
                    <h4><?php echo $result_new['productName']; ?></h4>
                  </a>
                  <div class="mt-3">
                    <?php 
                        if($result_new['priceSale']==0 && $result_new['price']!=0){
                    ?>
                    <span class="mr-4"><?php echo $fm->format_currency($result_new['price']); ?>₫</span>
                    <?php 
                        }elseif($result_new['priceSale']==0 && $result_new['price']==0){
                    ?>
                    <del style="color: #FF3030;"><span style="color: #FF3030;">Hết hàng</span></del>
                    <?php
                        }else{
                    ?>
                    <span class="mr-4"><?php echo $fm->format_currency($result_new['priceSale']); ?>₫</span>
                    <del><?php echo $fm->format_currency($result_new['price']); ?>₫</del>
                    <?php 
                        }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <?php
                }
              }
            ?>       
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ End New Product Area =================-->

  <!--================ Start Blog Area =================-->
  <section class="blog-area section-gap">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Tin tức</span></h2>
            <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
          </div>
        </div>
      </div>

      <div class="row">
      <?php 
        $get_blog = $blog->get_blog();
        if($get_blog){
          while($result_blog = $get_blog->fetch_assoc()){       
      ?>
        <div class="col-lg-4 col-md-6">
          <div class="single-blog">
            <div class="thumb">
              <img class="img-fluid" src="./admin/uploads/<?php   echo $result_blog['image'];?>" alt="" style="height: 175px;"> 
            </div>
            <div class="short_details">
              <div class="meta-top d-flex">
                <a>Quản trị viên</a>
                <a>
                  <i class="ti-timer"></i>
                  <?php echo $result_blog['date']; ?> - <?php echo $result_blog['year']; ?>
                </a>
              </div>
              <a class="d-block" href="details_blog.php?blogid=<?php echo $result_blog['id']; ?>">
                <h4><?php echo $result_blog['title']; ?></h4>
              </a>
              <div class="text-wrap">
                <p><?php echo substr($result_blog['description'],0,200); ?>...</p>
              </div>
              <a href="details_blog.php?blogid=<?php echo $result_blog['id']; ?>" class="blog_btn">Xem thêm <span class="ml-2 ti-arrow-right"></span></a>
            </div>
          </div>
        </div>
      <?php 
          }
        }
      ?>
      </div>
    </div>
  </section>
  <!--================ End Blog Area =================-->
  <?php 
      include('inc/footer.php');
  ?>

  