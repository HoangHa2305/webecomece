<?php 
    include('inc/header.php');
    include('../classes/product.php');
?>
<?php
  $pd = new product();

  if(isset($_GET['productid'])){
    $id = $_GET['productid'];
    $get_product_by_id = $pd->getproductbyId($id);
  }
?>    
    <div class="panel-header">
      <div class="header text-center">
        <h2 class="title">Chi tiết sản phẩm</h2>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
            <?php 
                if($get_product_by_id){
                    $result = mysqli_fetch_assoc($get_product_by_id);
                }
            ?>
              <h4 class="card-title"><?php echo $result['productName']; ?></h4>            
               <table>
                   <tr>
                       <td>Hình ảnh sản phẩm:</td>
                        <td>
                            <img src="uploads/<?php   echo $result['image'];?>" width="200">
                            <img src="uploads/<?php   echo $result['image1'];?>" width="200">
                            <img src="uploads/<?php   echo $result['image2'];?>" width="200">
                        </td>
                   </tr>
                   <tr>
                       <td>Mô tả ngắn:</td>
                       <td><?php echo $result['short_desc']; ?></td>
                   </tr>
                   <tr>
                       <td>Mô tả:</td>
                       <td><?php echo $result['product_desc']; ?></td>
                   </tr>
                   <tr>
                       <td>Thông số kĩ thuật:</td>
                       <td><?php echo $result['parameter']; ?></td>
                   </tr>
               </table>
            </div>
          </div>
        </div>
      </div>
    </div>   