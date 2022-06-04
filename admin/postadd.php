<?php 
  include('inc/header.php');
  include('../classes/post.php');
?>
<?php 
   $post = new post();
   if($_SERVER["REQUEST_METHOD"] == "POST"){
       $catName = $_POST['catName'];
       $catDesc = $_POST['catDesc'];
       $catStatus = $_POST['catStatus'];

       $insertCat = $post->insert_category_post($catName,$catDesc,$catStatus);
   }

?>
   <div class="panel-header">
      <div class="header text-center">
        <h2 class="title">Danh mục tin tức</h2>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Thêm danh mục tin tức</h4>
              <?php
                if(isset($insertCat)){
                   echo $insertCat;
                  // header("Location: http://www.example.com/");
                }
              ?>
            <form autocomplete="off" action="" method="POST">
              <table class="table">
                  <tr>
                      <td>
                        <input type="text" name="catName" placeholder="Vui lòng thêm danh mục tin tức"  class="form-control">
                      </td>
                  </tr>
                  <tr>
                      <td>
                        <input type="text" name="catDesc" placeholder="Vui lòng thêm mô tả tin tức"  class="form-control">
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <select id="select" name="catStatus" class="form-control">
                            <option value="0">Hiển thị</option>
                            <option value="1">Ẩn</option>
                          </select>
                      </td>
                  </tr>
                  <tr>
                      <td>
                        <button type="submit" name="submit" class="btn btn-primary">Thêm danh mục tin tức</button>
                      </td>
                  </tr>
              </table>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include('inc/footer.php'); ?>