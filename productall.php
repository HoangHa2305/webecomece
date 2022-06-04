<?php 
    include('inc/header.php');
?>
<?php 
  if(!isset($_GET['trang']) || $_GET['trang']==NULL){
    echo "<script>window.location='404.php'</script>";
  }
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
<style>
  .pages_center{
    margin-top: 30px;
    margin-left: 30%;
  }
  .page-link{
    color: #71cd14;
  }
  .page-item.active .page-link{
    background-color: #71cd14;
    border-color: #71cd14;
  }
</style>
    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div class="banner_content d-md-flex justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
              <h2>Danh mục: Tất cả sản phẩm</h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
            <div class="page_link">
              <a href="index.php">Trang chủ</a>
              <a>Danh mục</a>
              <a style="color: #71cd14;">Tất cả sản phẩm</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->
    
    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
      <div class="container">
        <form action="search.php" method="POST" class="input_search" style="display: flex;margin-bottom: 10px;">
          <input type="text" name="tukhoa" placeholder="Tìm kiếm sản phẩm" class="form-control">
          <button type="submit" name="search_product" class="btn btn-success"><i class="ti-search"></i></button>
        </form>
        <div class="row flex-row-reverse">
          <div class="col-lg-9">
            <div class="product_top_bar">
              <div class="left_dorp">
                <select class="sorting">
                  <option value="1">Sắp xếp</option>
                  <option value="2">Sắp xếp theo giá tăng</option>
                  <option value="4">Sắp xếp theo giá giảm</option>
                </select>
                <!-- <select class="show">
                  <option value="1">Show 12</option>
                  <option value="2">Show 14</option>
                  <option value="4">Show 16</option>
                </select> -->
              </div>
            </div>
            
            <div class="latest_product_inner">
              <div class="row">
                <?php 
                  $productall = $product->get_product_all();
                  if($productall){
                    while($result = $productall->fetch_assoc()){
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
                    <p style="margin-left: 30%;">Hiện tại danh mục này không có sản phẩm</p>
                <?php
                  }
                ?>
              </div>
            </div>
            <div class="pages_center">
              <ul class="pagination">
                <!-- <li class="page-item"><a class="page-link" href="#"><i class="ti-arrow-circle-left"></i></a></li> -->
                <?php 
                  $productall = $product->get_all_product();
                  $product_count = mysqli_num_rows($productall);
                  $product_button = ceil($product_count/9);
                  for($i=1;$i<=$product_button;$i++){
                ?>
                <li class="page-item <?php if($_GET['trang']==$i){echo 'active';} ?>"><a class="page-link" href="?trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
                  }
                ?>
                <!-- <li class="page-item"><a class="page-link" href="#"><i class="ti-arrow-circle-right"></i></a></li> -->
              </ul>
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