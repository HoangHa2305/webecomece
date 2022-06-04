<?php 
    include('inc/header.php');
?>
<?php 
  if(!isset($_GET['blogid']) || $_GET['blogid']==NULL){
    echo "<script>window.location='404.php'</script>";
  }else{
      $id = $_GET['blogid'];
  }
  
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
      $binhluan = $_POST['binhluan'];
      $inset_binhluan = $cs->insert_binhluan_post($id,$binhluan);
  }
  if(isset($_POST['del_binhluan'])){
      $id = $_POST['binhluan_id'];
      $blogid = $_GET['blogid'];
      $del_binhluan = $cs->del_binhluan($id,$blogid);
  }
?>
    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Chi tiết tin tức</h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
            <div class="page_link">
              <a href="index.html">Trang chủ</a>
              <a href="categorypost.php?idpost=all">Tin tức </a>
              <a style="color: #71cd14;">Chi tiết</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Blog Area =================-->
	<section class="blog_area single-post-area section_gap">
			<div class="container">
					<div class="row">
							<div class="col-lg-8 posts-list">
                <?php 
                  $blog_detail = $pos->getpostbyid($id);
                  if($blog_detail){
                    while($result_name = $blog_detail->fetch_assoc()){
                  
                ?>
									<div class="single-post">
											<div class="blog_details">
													<h2><?php echo $result_name['title']; ?></h2>
                          <ul class="blog-info-link mt-3 mb-4">
                              <li><a href="#"><i class="ti-user"></i> Quản trị viên</a></li>
                              <li><a href="#"><i class="ti-comments"></i> <?php echo $result_name['title_categorypost']; ?></a></li>
                            </ul>
                          <img class="card-img rounded-0" src="./admin/uploads/<?php   echo $result_name['image'];?>">
                          <div class="quote-wrapper">
                            <div class="quotes">
                                <?php echo $result_name['description']; ?>
                            </div>
                          </div>                        
                          <p>
                              <?php echo $result_name['content']; ?>
                          </p>
											</div>
                  </div>
                  <div class="navigation-top">
                    <div class="d-sm-flex justify-content-between text-center">
                      <p class="like-info">
                        <span class="align-middle">
                          <i class="ti-timer"></i>
                        </span> 
                        <?php echo $result_name['date']; ?> - <?php echo $result_name['year']; ?>
                      </p>
                      <div class="col-sm-4 text-center my-2 my-sm-0">
                        <p class="comment-count"><span class="align-middle"><i class="ti-comment"></i></span> 
                        <?php
                          $count = 0; 
                          $id = $_GET['blogid'];
                          $get_soluong_binhluan = $cs->get_binhluan_by_blogid($id);
                          if($get_soluong_binhluan){
                            while($result = $get_soluong_binhluan->fetch_assoc()){
                              $count++;
                            }
                            echo $count.' bình luận';
                          }else{
                            echo 'Hiện tại chưa có bình luận';
                          }
                        ?>
                      </p>
                      </div>
                      <ul class="social-icons">
                        <li><a href="https://www.facebook.com/HA58.PROTT/"><i class="ti-facebook"></i></a></li>
                        <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                        <li><a href="https://www.instagram.com/hoangha.2305/"><i class="ti-instagram"></i></a></li>
                        <li><a href="#"><i class="ti-wordpress"></i></a></li>
                      </ul>
                    </div>

                    <!-- <div class="navigation-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                <div class="thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="img/blog/prev.jpg" alt="">
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a href="#">
                                        <span class="ti-arrow-left text-white"></span>
                                    </a>
                                </div>
                                <div class="detials">
                                    <p>Prev Post</p>
                                    <a href="#">
                                        <h4>Space The Final Frontier</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                <div class="detials">
                                    <p>Next Post</p>
                                    <a href="#">
                                        <h4>Telescopes 101</h4>
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a href="#">
                                        <span class="ti-arrow-right text-white"></span>
                                    </a>
                                </div>
                                <div class="thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="img/blog/next.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                  </div>
                  <?php 
                     }
                  }
                  ?>
      
									<div class="comments-area">
											<h4>Bình luận</h4>
                      <?php
                        $id = $_GET['blogid']; 
                        $get_binhluan_by_blogid = $cs->get_binhluan_by_blogid($id);
                        if($get_binhluan_by_blogid){
                          while($result= $get_binhluan_by_blogid->fetch_assoc()){                       
                      ?>
											<div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                          <div class="user justify-content-between d-flex">
                              <div class="thumb">
                                  <img src="./admin/uploads/<?php echo $result['image'];?>" alt="">
                              </div>
                              <div class="desc">
                                  <p class="comment">
                                    <?php echo $result['binhluan']; ?>
                                  </p>

                                  <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                      <h5>
                                        <a href="#"><?php echo $result['tenbinhluan']; ?></a>
                                      </h5>
                                      <p class="date"><?php echo $result['date']; ?> lúc <?php echo $result['time']; ?> </p> 
                                    </div>
                                    <?php
                                      $user = Session::get('customer_id'); 
                                      if($user==$result['customer_id']){
                                    ?>
                                    <div class="reply-btn" style="margin-left: 10px;">
                                      <form action="" method="POST">
                                        <input type="hidden" name="binhluan_id" value="<?php echo $result['binhluan_id']; ?>">
                                        <button type="submit" class="btn btn-light" name="del_binhluan">
                                          <i class="ti-pin-alt" style="color: red;"></i>
                                        </button>
                                      </form>
                                    </div>
                                    <?php 
                                      }
                                    ?>
                                  </div>
                                  
                              </div>
                          </div>
                      </div>
											</div>
                      <?php 
                         }
                        }
                      ?>
									</div>
                  <?php 
                    $login_check = Session::get('customer_login');
                    if($login_check){                 
                  ?>
									<div class="comment-form">
											<h4>Bình luận tin tức</h4>
                      <?php 
                        if(isset($inset_binhluan)){
                          echo $inset_binhluan;
                        }
                      ?>
											<form class="form-contact comment_form" action="" method="POST" id="commentForm">
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="binhluan" cols="30" rows="4" placeholder="Write Comment"></textarea>
                            </div>
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <button type="submit" name="submit" class="main_btn">Gửi bình luận</button>
                        </div>
                      </form>
									</div>
                  <?php 
                     }
                  ?>
							</div>
							<div class="col-lg-4">
                <div class="blog_right_sidebar">
                      <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Danh mục tin tức</h4>
                        <ul class="list cat-list">
                        <?php 
                          $get_all_cate = $pos->show_category_fontend();
                          if($get_all_cate){
                            while($result_all_cat = $get_all_cate->fetch_assoc()){                                  
                        ?>
                            <li>
                                <a href="categorypost.php?idpost=<?php echo $result_all_cat['id_cate_post']; ?>" class="d-flex">
                                    <p><?php echo $result_all_cat['title']; ?></p>
                                </a>
                            </li>
                        <?php 
                            }
                          }
                        ?>    
                        </ul>
                      </aside>

                      <aside class="single_sidebar_widget tag_cloud_widget">
                          <h4 class="widget_title">Tag Clouds</h4>
                          <ul class="list">
                              <li>
                                  <a href="#">project</a>
                              </li>
                              <li>
                                  <a href="#">love</a>
                              </li>
                              <li>
                                  <a href="#">technology</a>
                              </li>
                              <li>
                                  <a href="#">travel</a>
                              </li>
                              <li>
                                  <a href="#">restaurant</a>
                              </li>
                              <li>
                                  <a href="#">life style</a>
                              </li>
                              <li>
                                  <a href="#">design</a>
                              </li>
                              <li>
                                  <a href="#">illustration</a>
                              </li>
                          </ul>
                      </aside>                   
                  </div>
							</div>
					</div>
			</div>
	</section>
	<!--================Blog Area =================-->
<?php 
    include('inc/footer.php');
?>