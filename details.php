<style>
  .card_area{
    margin-top: 20px;
  }
  .love-product{
    padding: 10px;
    color: #DD0000;
  }
  .compare-product{
    color: #008080;
  }
  #wishlist{
    margin-left: 5px;
  }
  .card_area{
    display: flex;
  }
</style>
<?php 
    include('inc/header.php');
?>
<?php 
    if(!isset($_GET['proid']) || $_GET['proid']==NULL){
      echo "<script>window.location='404.php' </script>";    //script trả về lại trang 
    }else{
       $id = $_GET['proid'];
    } 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
       $quantity = $_POST['quantity'];
       $AddtoCart = $ct->add_to_cart($quantity,$id);
    }
?>
<?php
    $customer_id = Session::get('customer_id');
    //Thêm vào danh sách so sánh
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
      $productid = $_POST['productid'];
      $insertCompare = $product->insertCompare($productid,$customer_id);
    }
    //Thêm vào danh sách yêu thích
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])){
      $productid = $_POST['productid'];
      $insertWishlist = $product->insertWishlist($productid,$customer_id);
    }
    //Bình luận
    if(isset($_POST['binhluan_submit'])){
      $binhluan_insert = $cs->insert_binhluan();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['xoabinhluan'])){
      $id = $_POST['binhluan_id'];
      $proid = $_GET['proid'];
      $xoa_binhluan = $cs->xoa_binhluan($id,$proid);
   }
?>
    <!--================Home Banner Area =================-->
<?php 
    $get_product_details = $product->get_details($id);
    if($get_product_details){
        while($result_details = $get_product_details->fetch_assoc()){

      
?>
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Chi tiết sản phẩm</h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
            <div class="page_link">
              <a href="index.php">Trang chủ</a>
              <a href="productbycat.php?catid=<?php echo $result_details['catId']; ?>"><?php echo $result_details['catName']; ?></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->
    <!--================Single Product Area =================-->
    <div class="product_image_area">
      <div class="container">
        <div class="row s_product_inner">
          <div class="col-lg-5">
            <div class="s_product_img">
              <div
                id="carouselExampleIndicators"
                class="carousel slide"
                data-ride="carousel"              >
                <ol class="carousel-indicators">
                  <li
                    data-target="#carouselExampleIndicators"
                    data-slide-to="0"
                    class="active"
                  >
                    <img
                      src="./admin/uploads/<?php   echo $result_details['image'];?>"
                      alt=""
                      width="60"
                    />
                  </li>
                  <li
                    data-target="#carouselExampleIndicators"
                    data-slide-to="1"
                  >
                    <img
                      src="./admin/uploads/<?php   echo $result_details['image1'];?>"
                      alt=""
                      width="60"
                    />
                  </li>
                  <li
                    data-target="#carouselExampleIndicators"
                    data-slide-to="2"
                  >
                    <img
                      src="./admin/uploads/<?php   echo $result_details['image2'];?>"
                      alt=""
                      width="60"
                    />
                  </li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img
                      class="d-block w-100"
                      src="./admin/uploads/<?php   echo $result_details['image'];?>"
                      alt="First slide"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      class="d-block w-100"
                      src="./admin/uploads/<?php   echo $result_details['image1'];?>"
                      alt="Second slide"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      class="d-block w-100"
                      src="./admin/uploads/<?php   echo $result_details['image2'];?>"
                      alt="Third slide"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 offset-lg-1">
            <div class="s_product_text">
              <h3><?php echo $result_details['productName']; ?></h3>
              <?php
                  if($result_details['priceSale']==0 && $result_details['price']!=0){
                    ?>
                    <h2><?php echo $fm->format_currency($result_details['price']); ?>₫</h2>  
              <?php 
                  }elseif($result_details['price']==0){
              ?>
                  <del style="color: #FF3030;"><h2 style="color: #FF3030;">Hết hàng</h2></del>
              <?php    
                  }else{
              ?>
              <div style="display: flex;">
                  <h2><?php echo $fm->format_currency($result_details['priceSale']); ?>₫</h2>
                  <del style="padding-left: 30px;"><?php echo $fm->format_currency($result_details['price']); ?>₫</del>
              </div>
              <?php
                  }
              ?>
              <ul class="list">
                <li>
                  <a class="active" href="productbycat.php?catid=<?php echo $result_details['catId']; ?>">
                    <span>Danh mục</span> : <?php echo $result_details['catName']; ?></a
                  >
                </li>
                <li>
                  <a href="productbybrand.php?brandid=<?php echo $result_details['brandId']; ?>"> 
                    <span>Thương hiệu</span> : <?php echo $result_details['brandName']; ?>
                  </a>
                </li>
              </ul>
              <p>
                <?php echo $result_details['short_desc']; ?>
              </p>
              <form action="" method="POST">
                <div class="product_count">
                  <label for="qty">Số lượng:</label>
                  <input
                    type="number"
                    name="quantity"
                    id="sst"
                    min="1"
                    value="1"
                    title="Quantity:"
                    class="input-text qty"
                  />
                </div>
                <?php 
                  if($result_details['price']!=0){
                   
                ?>
                <div class="card_area">
                  <button class="main_btn" type="submit" name="submit">Thêm vào giỏ hàng</button>                 
                </div>
              </form>
              <?php 
                $login_check = Session::get('customer_login');
                  if($login_check){
              ?>
              <div class="card_area">
                  <!-- So sánh sản phẩm -->
                  <form action="" method="POST">
                    <input type="hidden" name="productid" value="<?php echo $result_details['productId']; ?>"> 
                    <button type="submit" name="compare" class="btn btn-dark"><i class="ti-view-list"></i> So sánh sản phẩm</button>
                  </form>
                  <!-- Yêu thích sản phẩm -->
                  <form action="" method="POST">
                    <input type="hidden" name="productid" value="<?php echo $result_details['productId']; ?>"> 
                    <button type="submit" name="wishlist" id="wishlist" class="btn btn-danger"><i class="ti-heart"></i> Yêu thích</button>  
                  </form>                     
              </div>
              <?php 
                  }  
                }
              ?>
              <?php 
                  if(isset($AddtoCart)){
                    echo '<span style="color: red;">Sản phẩm đã có trong giỏ hàng</span>';
                  }
                  if(isset($insertCompare)){
                    echo $insertCompare;
                  }
                  if(isset($insertWishlist)){
                    echo $insertWishlist;
                  }
              ?>
            </div>
          </div>
          <div class="col-lg-2 md-4">
            <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Danh mục</h3>
                </div>
                <div class="widgets_inner">
                  <ul>
                  <?php
                    $getall_category = $cat->show_category_fontend();
                    if($getall_category){
                      while($result_allcat = $getall_category->fetch_assoc()){
                  ?>
                    <li>
                        <a href="productbycat.php?catid=<?php echo $result_allcat['catId']; ?>" class="active"><?php echo $result_allcat['catName']; ?></a>
                    </li>
                  <?php 
                      }
                    }                  
                  ?>
                  </ul>
                </div>
              </aside>
            </div>
        </div>
      </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a
              class="nav-link"
              id="home-tab"
              data-toggle="tab"
              href="#home"
              role="tab"
              aria-controls="home"
              aria-selected="true"
              >Mô tả chi tiết</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              id="profile-tab"
              data-toggle="tab"
              href="#profile"
              role="tab"
              aria-controls="profile"
              aria-selected="false"
              >Thông số kĩ thuật</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link active"
              id="contact-tab"
              data-toggle="tab"
              href="#contact"
              role="tab"
              aria-controls="contact"
              aria-selected="false"
              >Bình luận</a
            >
          </li>
          <!-- <li class="nav-item">
            <a
              class="nav-link active"
              id="review-tab"
              data-toggle="tab"
              href="#review"
              role="tab"
              aria-controls="review"
              aria-selected="false"
              >Reviews</a
            >
          </li> -->
        </ul>
        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
            <p>
              <?php echo $result_details['product_desc']; ?>
            </p>
          </div>
          <div
            class="tab-pane fade"
            id="profile"
            role="tabpanel"
            aria-labelledby="profile-tab"
          >
            <div class="table-responsive">
              <p>
                  <?php echo $result_details['parameter']; ?>
              </p>
            </div>
          </div>
          <div
            class="tab-pane fade show active"
            id="contact"
            role="tabpanel"
            aria-labelledby="contact-tab"
          >
            <div class="row">
              <div class="col-lg-6">
                <div class="comment_list">
                  <?php 
                    $get_binhluan_by_proid = $cs->get_binhluan_by_proid($id);
                    if($get_binhluan_by_proid){
                      while($result_binhluan = $get_binhluan_by_proid->fetch_assoc()){

                  ?>
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="./admin/uploads/<?php echo $result_binhluan['image'];?>"
                          alt=""
                          width="70"
                          style="border-radius: 50%;"
                        />
                      </div>
                      <div class="media-body">
                        <h4><?php echo $result_binhluan['tenbinhluan']; ?></h4>
                        <h5><?php echo $result_binhluan['time']; ?> - <?php echo $result_binhluan['date']; ?></h5>
                        <?php
                          if($result_binhluan['customer_id']==Session::get('customer_id')){
                        ?>
                        <form action="" method="POST">
                          <input type="hidden" name="binhluan_id" value="<?php echo $result_binhluan['binhluan_id']; ?>">
                          <button class="reply_btn" name="xoabinhluan" type="submit">Xóa</button>
                        </form>
                        <?php 
                          }
                        ?>
                      </div>
                    </div>
                    <p>
                      <?php echo $result_binhluan['binhluan']; ?>
                    </p>
                  </div>
                  <?php 
                     }
                    }
                  ?>
                  <!-- <div class="review_item reply">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="img/product/single-product/review-2.png"
                          alt=""
                        />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz</h4>
                        <h5>12th Feb, 2017 at 05:56 pm</h5>
                        <a class="reply_btn" href="#">Reply</a>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div> -->
                </div>
              </div>
              <?php 
                $login_check = Session::get('customer_login');
                if($login_check){
              ?>
              <div class="col-lg-6">
                <div class="review_box">
                  <h4>Bình luận sản phẩm</h4>
                  <?php 
                    if(isset($binhluan_insert)){
                      echo $binhluan_insert;
                    }
                  ?>
                  <form
                    class="row contact_form"
                    action=""
                    method="POST"
                    id="contactForm"                    
                  >
                    <input
                      type="hidden"
                      name="product_id_binhluan"
                      value="<?php echo $id; ?>"
                    />
                    <input
                      type="hidden"
                      name="tenguoibinhluan"
                      value="<?php echo Session::get('customer_name'); ?>"
                    />
                    <input
                      type="hidden"
                      name="customer_id"
                      value="<?php echo Session::get('customer_id'); ?>"
                    />
                    <input
                      type="hidden"
                      name="image"
                      value="<?php echo Session::get('customer_image'); ?>"
                    />
                    <input
                      type="hidden"
                      name="date"
                      value="<?php echo date("d/m/Y"); ?>"
                    />
                    <input
                      type="hidden"
                      name="time"
                      value="<?php echo date("h:i:s"); ?>"
                    />                   
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea
                          class="form-control"
                          name="binhluan"
                          id="message"
                          rows="4"
                          style="resize: none;"
                          placeholder="Nội dung"
                        ></textarea>
                      </div>
                    </div>
                    <div class="col-md-12 text-right">
                      <button
                        type="submit"
                        name="binhluan_submit"
                        class="btn submit_btn"
                      >
                        Bình luận
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <?php 
                }
              ?>
            </div>
          </div>
          <!-- <div
            class="tab-pane fade show active"
            id="review"
            role="tabpanel"
            aria-labelledby="review-tab"
          >
            <div class="row">
              <div class="col-lg-6">
                <div class="row total_rate">
                  <div class="col-6">
                    <div class="box_total">
                      <h5>Overall</h5>
                      <h4>4.0</h4>
                      <h6>(03 Reviews)</h6>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="rating_list">
                      <h3>Based on 3 Reviews</h3>
                      <ul class="list">
                        <li>
                          <a href="#"
                            >5 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >4 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >3 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >2 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >1 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="review_list">
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="img/product/single-product/review-1.png"
                          alt=""
                        />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz</h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="img/product/single-product/review-2.png"
                          alt=""
                        />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz</h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="img/product/single-product/review-3.png"
                          alt=""
                        />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz</h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="review_box">
                  <h4>Add a Review</h4>
                  <p>Your Rating:</p>
                  <ul class="list">
                    <li>
                      <a href="#">
                        <i class="fa fa-star"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star"></i>
                      </a>
                    </li>
                  </ul>
                  <p>Outstanding</p>
                  <form
                    class="row contact_form"
                    action="contact_process.php"
                    method="post"
                    id="contactForm"
                    novalidate="novalidate"
                  >
                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          name="name"
                          placeholder="Your Full name"
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="email"
                          class="form-control"
                          id="email"
                          name="email"
                          placeholder="Email Address"
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          id="number"
                          name="number"
                          placeholder="Phone Number"
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea
                          class="form-control"
                          name="message"
                          id="message"
                          rows="1"
                          placeholder="Review"
                        ></textarea>
                      </div>
                    </div>
                    <div class="col-md-12 text-right">
                      <button
                        type="submit"
                        value="submit"
                        class="btn submit_btn"
                      >
                        Submit Now
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </section>
    <?php 
        }
      }
    ?>
  <?php 
      include('inc/footer.php');
  ?>