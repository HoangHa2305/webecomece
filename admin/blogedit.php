<?php 
  include('inc/header.php');
  include('../classes/post.php');
  include('../classes/blog.php');
?>
<?php 
    $post = new post();
    $blog = new blog();
    if(!isset($_GET['id']) || $_GET['id']==NULL){
        echo "<script>window.location='bloglist.php' </script>";    //script trả về lại trang 
     }else{
         $id = $_GET['id'];
     } 
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){

      $updateBlog = $blog->update_blog($_POST,$_FILES,$id);
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
              <h4 class="card-title">Cập nhật tin tức</h4>
                <?php
                    if(isset($updateBlog)){
                        echo $updateBlog;
                    }
                ?>
                <?php 
                    $get_blog_by_id = $blog->getblogbyId($id);
                    if($get_blog_by_id){
                        while($result_blog = $get_blog_by_id->fetch_assoc()){
                      
                ?>
                <form action="" method="POST" enctype="multipart/form-data">            
                  <table class="table">
                        <tr>
                            <td>
                                <label>Tiêu đề</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $result_blog['title']; ?>" class="form-control">
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
                                        <option
                                        <?php if($result_blog['category_post']==$result['id_cate_post']){ echo 'selected'; } ?>
                                        value="<?php echo $result['id_cate_post'] ?>"><?php echo $result['title'] ?></option>
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
                              <textarea class="form-control" rows="5" name="desc"><?php echo $result_blog['description']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nội dung</label>
                            </td>
                            <td>
                                <textarea id="editor1" name="content">
                                    <?php echo $result_blog['content']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                          <td>
                            <label>Trạng thái</label>
                          </td>
                          <td>
                             <select id="select" name="type" class="form-control">
                                <?php 
                                    if($result_blog['status']==0){
                                ?>
                                <option selected value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>  
                                <?php
                                    }else{
                                ?>
                                <option value="0">Hiển thị</option>
                                <option selected value="1">Ẩn</option>
                                <?php 
                                    }
                                ?>                                                                  
                              </select>
                          </td>
                        </tr>
                        <tr>
                            <td>
                              <label>Hình ảnh</label>
                            </td>
                            <td>
                              <img src="uploads/<?php   echo $result_blog['image'];?>" width="150"><br><br>
                              <input type="file" name="image">
                            </td>
                        </tr>                                              
                  </table>
                  <div style="text-align: center;">
                      <button type="submit" name="submit" class="btn btn-primary">Cập nhật tin tức</button>
                  </div>                    
              </form>
               <?php
                     }
                    }
               ?>  
            </div>
          </div>
        </div>
      </div>
    </div>   
<?php include('inc/footer.php'); ?>