<?php 
    include('inc/header.php');
?>
<?php 
    $login_check = Session::get('customer_login');
    if($login_check==false){
        header('Location: login.php');
    }
?>
<?php 
    $id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])){
        $UpdateCustomers = $cs->update_customers($_POST,$id);
    }
?>
<div class="main">
    <div class="container">
        <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>CẬP NHẬT THÔNG TIN CÁ NHÂN</span></h2>
                    </div>
                </div>
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="table table-borderless">
                <tr>
                    <td colspan="3" style="text-align: center;">                       
                        <?php 
                            if(isset($UpdateCustomers)){
                                echo $UpdateCustomers;     
                            }
                        ?>                
                    </td>
                </tr>
                <?php
                    $id = Session::get('customer_id'); 
                    $get_customers = $cs->show_customers($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){

                ?>
                <tr>
                    <td rowspan="8">
                        <img src="admin/uploads/<?php echo $result['image']; ?>" width="200px" style="border-radius: 50%;"><br>
                        <input type="file" name="image">
                    </td>
                    <td>Tên :</td>
                    <td><input type="text" name="name" value="<?php echo $result['name']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Số điện thoại :</td>
                    <td><input type="number" name="phone" value="<?php echo '0'.$result['phone']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td><input type="text" name="email" value="<?php echo $result['email']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Địa chỉ :</td>
                    <td><input type="text" name="address" value="<?php echo $result['address']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Thành phố :</td>
                    <td><input type="text" name="city" value="<?php echo $result['city']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Quốc tịch :</td>
                    <td><input type="text" name="country" value="<?php echo $result['country']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Zipcode :</td>
                    <td><input type="text" name="zipcode" value="<?php echo $result['zipcode']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td colspan="3"><button class="btn btn-success" type="submit" name="save">Cập nhật</button></td>
                </tr>
            <?php 
                    }
                }
            ?>
            </table>
            </form>
        </div>
    </div>
</div>   
<?php 
    include('inc/footer.php');
?>