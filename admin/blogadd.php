<?php 
  include('inc/header.php');
  include('../classes/post.php');
  include('../classes/blog.php');
?>
<?php 
    $post = new post();
    $blog = new blog();
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
      $insertBlog = $blog->insert_blog($_POST,$_FILES);
    }

?>
   <div class="panel-header">
      <div class="header text-center">
        <h2 class="title">Tin tức</h2>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Thêm tin tức</h4>
                <?php
                    if(isset($insertBlog)){
                        echo $insertBlog;
                    }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">            
                  <table class="table">
                        <tr>
                            <td>
                                <label>Tiêu đề</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Nhập tên tiêu đề" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Danh mục tin tức</label>
                            </td>
                            <td>
                                <select id="select" name="category_post" class="form-control">
                                        <option>-----Danh mục tin tức-----</option>
                                    <?php
                                      $catlist = $post->show_category_post();
                                      if($catlist){
                                        while($result = $catlist->fetch_assoc()){                                        
                                    ?>
                                        <option value="<?php echo $result['id_cate_post'] ?>"><?php echo $result['title'] ?></option>
                                    <?php 
                                        }
                                      }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Mô tả ngắn</label>
                            </td>
                            <td>
                              <textarea class="form-control" rows="5" name="desc"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nội dung</label>
                            </td>
                            <td>
                                <textarea id="editor1" name="content">

                                </textarea>
                            </td>
                        </tr>
                        <tr>
                          <td>
                            <label>Trạng thái</label>
                          </td>
                          <td>
                             <select id="select" name="type" class="form-control">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>                                                                  
                              </select>
                          </td>
                        </tr>
                        <tr>
                            <td>
                              <label>Hình ảnh</label>
                            </td>
                            <td>
                              <input type="file" name="image">
                            </td>
                        </tr>                                              
                  </table>
                  <div style="text-align: center;">
                      <button type="submit" name="submit" class="btn btn-primary">Thêm tin tức</button>
                  </div>                    
              </form>  
            </div>
          </div>
        </div>
      </div>
    </div>   
<?php include('inc/footer.php'); ?>