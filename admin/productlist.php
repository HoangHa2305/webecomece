<?php
  include('inc/header.php');
  include('../classes/category.php');
  include('../classes/brand.php');
  include('../classes/product.php');
  include_once('../helpers/format.php');
?>
<?php
  $pd = new product();
  $fm = new Format();

  if(isset($_GET['productid'])){
    $id = $_GET['productid'];
    $delpro = $pd->del_product($id);
  }
?>
  <div class="panel-header">
    <div class="header text-center">
      <h2 class="title">Danh sách sản phẩm</h2>
    </div>
  </div>
  <div class="content">
        <div class="col-md-4">
            <a href="./productadd.php">
                <button class="btn btn-primary btn-block">Thêm sản phẩm</button>
            </a>
        </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Danh sách sản phẩm</h4>
                <?php 
                  if(isset($delpro)){
                    echo $delpro;
                  }
                ?>
              </div>              
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                        <thead class=" text-primary">
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Giá khuyến mãi</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Hình ảnh</th>
                            <th>Loại sản phẩm</th>  
                            <th></th>              
                        </thead>
                    <tbody>
                        <?php 
                            $pdlist = $pd->show_product();
                            if($pdlist){
                                $i = 0;
                                $count = 0;
                                while($result = $pdlist->fetch_assoc()){
                                    $i++;
                                    $count++;                                        
                        ?> 
                          <tr>
                            <td><?php   echo $i; ?></td>
                            <td><?php   echo $result['productName'];?></td>
                            <td><?php   echo $fm->format_currency($result['price']);?></td>
                            <td><?php   echo $fm->format_currency($result['priceSale']);?></td>
                            <td><?php   echo $result['catName'];?></td>
                            <td><?php   echo $result['brandName'];?></td>
                            <td>
                                <img src="uploads/<?php   echo $result['image'];?>" width="100">
                            </td>                            
                            <td>
                                <?php  
                                    if($result['type']==0){
                                        echo 'Không nổi bật';
                                    }elseif($result['type']==1){
                                        echo 'Nổi bật';
                                    }else{
                                        echo 'Sản phẩm mới';
                                    } 
                                ?>
                            </td>                            
                            <td>
                                <a href="productdetails.php?productid=<?php echo $result['productId']; ?>"><i class="fas fa-eye" style="color: #473C8B;"></i></a> 
                                ||                             
                                <a href="productedit.php?productid=<?php echo $result['productId']; ?>"><i class="fas fa-pencil-alt" style="color: #008C5E;"></i></a>
                                ||                                
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" 
                                    href="?productid=<?php echo $result['productId']; ?>"><i class="fas fa-trash" style="color: red;"></i>
                                </a>                               
                            </td>
                          </tr>
                        <?php 
                                }
                            }
                        ?> 
                    </tbody>
                  </table>
                  <?php echo "Tổng số sản phẩm là: $count"; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include('inc/footer.php'); ?>