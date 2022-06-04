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
    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div class="banner_content d-md-flex justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
            <?php 
                if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['search_product'])){
                    $tukhoa = $_POST['tukhoa'];
                    $search_product = $product->search_product($tukhoa);
            ?>
              <h2>Từ khóa tìm kiếm: <?php echo $tukhoa ?></h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
            <div class="page_link">
              <a href="index.php">Trang chủ</a>
              <a href="productall.php?trang=1">Tìm kiếm</a>
              <a style="color: #71cd14;"><?php echo $tukhoa ?></a>
            </div>
            <?php
                }elseif($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['product_price'])){
                    $price = $_POST['vol'];
                    if(isset($_POST['brand'])){
                      $brand_pd = $_POST['brand'];
                      $price_product = $product->product_by_price_brand($price,$brand_pd);                    
                    }elseif(isset($_POST['cat'])){
                      $cat_pd = $_POST['cat'];
                      $price_product = $product->product_by_price_cat($price,$cat_pd);
                    }
                    else{            
                      $price_product = $product->product_by_price($price);
                    }
            ?>
            <h2>Lọc sản phẩm theo giá dưới: <?php echo $fm->format_currency($price); ?>₫</h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
            <div class="page_link">
              <a href="index.php">Trang chủ</a>
              <a style="color: #71cd14;">Lọc sản phẩm theo giá</a>
            </div>
            <?php
                }
            ?>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
      <div class="container">
        <form action="search.php" method="POST" style="display: flex;margin-bottom: 10px;">
          <input type="text" name="tukhoa" placeholder="Tìm kiếm sản phẩm" class="form-control">
          <button type="submit" name="search_product" class="btn btn-success"><i class="ti-search"></i></button>
        </form>
        <div class="row flex-row-reverse">
          <div class="col-lg-9">
            <div class="product_top_bar">
              <div class="left_dorp">
                <select class="sorting">
                  <option value="1">Default sorting</option>
                  <option value="2">Default sorting 01</option>
                  <option value="4">Default sorting 02</option>
                </select>
                <select class="sorting">
                  <option value="1">Sản phẩm 6</option>
                  <option value="2">Sản phẩm 9</option>
                  <option value="4">Sản phẩm 12</option>
                </select>
              </div>
            </div>
            
            <div class="latest_product_inner">
              <div class="row">
                <?php 
                  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['search_product'])){
                    if($search_product){
                      while($result = $search_product->fetch_assoc()){
                ?>
                <div class="col-lg-4 col-md-6">
                  <div class="single-product">
                    <div class="product-img">
                      <img
                        class="card-img"
                        src="./admin/uploads/<?php   echo $result['image'];?>"
                        alt=""
                      />
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
                    }else{
                ?>
                <p style="margin-left: 38%;">Không tìm thấy sản phẩm</p>
                <?php
                    }
                    }elseif($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['product_price'])){
                      if($price_product){
                        while($result = $price_product->fetch_assoc()){
                ?>
                <div class="col-lg-4 col-md-6">
                  <div class="single-product">
                    <div class="product-img">
                      <img
                        class="card-img"
                        src="./admin/uploads/<?php   echo $result['image'];?>"
                        alt=""
                      />
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
                      }else{
                ?>
                <p style="margin-left: 38%;">Không tìm thấy sản phẩm</p>
                <?php       
                      }
                    }
                ?>                   
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="left_sidebar_area">
              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Danh mục sản phẩm</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                    <?php 
                      $get_all_cat = $cat->show_category_fontend();
                      if($get_all_cat){
                        while($result_allcat=$get_all_cat->fetch_assoc()){                      
                    ?>
                    <li>
                      <a href="productbycat.php?catid=<?php echo $result_allcat['catId']; ?>">
                        <?php echo $result_allcat['catName']; ?>
                      </a>
                    </li>
                    <?php 
                       }
                      }
                    ?>
                  </ul>
                </div>
              </aside>

              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Thương hiệu sản phẩm</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                  <?php 
                    $get_all_brand = $brand->show_brand();
                    if($get_all_brand){
                      while($result_all_brand = $get_all_brand->fetch_assoc()){
                  ?>
                    <li>
                      <a href="productbybrand.php?brandid=<?php echo $result_all_brand['brandId']; ?>">
                        <?php echo $result_all_brand['brandName']; ?>
                      </a>
                    </li>
                  <?php 
                     }
                    }
                  ?>
                  </ul>
                </div>
              </aside>

              <!-- <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Color Filter</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                    <li>
                      <a href="#">Black</a>
                    </li>
                    <li>
                      <a href="#">Black Leather</a>
                    </li>
                    <li class="active">
                      <a href="#">Black with red</a>
                    </li>
                    <li>
                      <a href="#">Gold</a>
                    </li>
                    <li>
                      <a href="#">Spacegrey</a>
                    </li>
                  </ul>
                </div>
              </aside> -->

              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Lọc theo giá tiền</h3>
                </div>
                <div class="widgets_inner">
                  <div class="range_item">
                    <div id="slider-range"></div>
                      <form action="search.php" method="POST">
                      <div style="display: flex;">
                        <p>1.000.000</p>
                        <input type="range" name="vol" min="1000000" max="100000000">
                        <p>100.000.000</p>
                      </div>
                      <button type="submit" name="product_price" class="btn btn-success" style="margin-left: 40%;">Lọc</button>
                      </form>
                    </div>
                  </div>
                </div>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Category Product Area =================-->
<?php 
    include('inc/footer.php');
?>