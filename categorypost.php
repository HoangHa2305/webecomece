<?php 
    include('inc/header.php');
?>
<?php 
    if(!isset($_GET['idpost']) || $_GET['idpost']==NULL){
        echo "<script>window.location='404.php'</script>";
    }else{
        if($_GET['idpost']=='all'){
            $postbycat = $pos->get_all_post();
        }else{
            $id = $_GET['idpost'];
            $postbycat = $pos->get_post_by_cat($id);
        }
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
              <h2>Danh mục tin tức: 
              <?php
                if($_GET['idpost']=='all'){
                    echo "Tất cả";
                }else{
                    $name_cat = $pos->getpostbycateid($id);
                    if($name_cat){
                        while($result_by_cat = $name_cat->fetch_assoc()){
                            echo $result_by_cat['title'];
                        }
                    }
                }                
              ?>
              </h2>
              <p>Best Service, Right Time, Right People – Dịch vụ tốt nhất, Đúng lúc, Đúng người</p>
            </div>
            <div class="page_link">
              <a href="index.php">Trang chủ</a>
              <a style="color: #71cd14;">Tin tức</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

  <!--================Blog Area =================-->
  <section class="blog_area section_gap">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 mb-5 mb-lg-0">
                  <div class="blog_left_sidebar">
                      <?php 
                        if($postbycat){
                            while($result = $postbycat->fetch_assoc()){
                         
                      ?>
                      <article class="blog_item">
                        <div class="blog_item_img">
                          <img class="card-img rounded-0" src="./admin/uploads/<?php   echo $result['image'];?>" alt="">
                          <a href="details_blog.php?blogid=<?php echo $result['id']; ?>" class="blog_item_date">
                            <h3><?php echo $result['date']; ?></h3>
                            <p><?php echo $result['year']; ?></p>
                          </a>
                        </div>
                        
                        <div class="blog_details">
                            <a class="d-inline-block" href="details_blog.php?blogid=<?php echo $result['id']; ?>">
                                <h2><?php echo $result['title']; ?></h2>
                            </a>
                            <p><?php echo $result['description']; ?></p>
                            <ul class="blog-info-link">
                              <li><a href="#"><i class="ti-user"></i>Quản trị viên</a></li>
                              <li><a href="categorypost.php?idpost=<?php echo $result['category_post']; ?>"><i class="ti-comments"></i> <?php echo $result['title_categorypost']; ?></a></li>
                            </ul>
                        </div>
                      </article>
                      <?php 
                          }
                        }
                      ?>
                      <nav class="blog-pagination justify-content-center d-flex">
                          <ul class="pagination">
                              <li class="page-item">
                                  <a href="#" class="page-link" aria-label="Previous">
                                      <span aria-hidden="true">
                                          <span class="ti-arrow-left"></span>
                                      </span>
                                  </a>
                              </li>
                              <li class="page-item">
                                  <a href="#" class="page-link">1</a>
                              </li>
                              <li class="page-item active">
                                  <a href="#" class="page-link">2</a>
                              </li>
                              <li class="page-item">
                                  <a href="#" class="page-link" aria-label="Next">
                                      <span aria-hidden="true">
                                          <span class="ti-arrow-right"></span>
                                      </span>
                                  </a>
                              </li>
                          </ul>
                      </nav>
                  </div>
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