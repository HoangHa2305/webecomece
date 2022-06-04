<?php 
  include('inc/header.php');
  include('../classes/post.php');
?>
<?php 
    $post = new post();
    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
       echo "<script>window.location='postlist.php' </script>";    //script trả về lại trang 
    }else{
        $id = $_GET['catid'];
    }  
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $catName = $_POST['catName'];
        $catDesc = $_POST['catDesc'];
        $catStatus = $_POST['catStatus'];

        $updateCat = $post->update_category_post($catName,$catDesc,$catStatus,$id);
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
              <h4 class="card-title">Cập nhật danh mục tin tức</h4>
              <?php
                if(isset($updateCat)){
                   echo $updateCat;
                }
              ?>
            <?php 
                $get_cate_name = $post->getcatbyId($id);
                if($get_cate_name){
                    while($result = $get_cate_name->fetch_assoc()){

            ?>
            <form autocomplete="off" action="" method="POST">
              <table class="table">
                  <tr>
                      <td>
                        <input type="text" name="catName" value="<?php echo $result['title']; ?>" class="form-control">
                      </td>
                  </tr>
                  <tr>
                      <td>
                        <input type="text" name="catDesc" value="<?php echo $result['description']; ?>" class="form-control">
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <select id="select" name="catStatus" class="form-control">
                            <?php 
                                if($result['status']==0){
                            ?>
                            <option value="0" selected>Hiển thị</option>
                            <option value="1">Ẩn</option>
                            <?php
                                }else{
                            ?>
                            <option value="0">Hiển thị</option>
                            <option value="1" selected>Ẩn</option>
                            <?php 
                                }
                            ?>
                          </select>
                      </td>
                  </tr>
                  <tr>
                      <td>
                        <button type="submit" name="submit" class="btn btn-primary">Cập nhật danh mục tin tức</button>
                      </td>
                  </tr>
              </table>
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