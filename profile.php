<?php 
    include('inc/header.php');
?>
<?php 
    $login_check = Session::get('customer_login');
    if($login_check==false){
        header('Location: login.php');
    }
?>
<div class="main">
    <div class="container">
        <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>THÔNG TIN CÁ NHÂN</span></h2>
                    </div>
                </div>
                <table class="table table-borderless">
                    <?php
                        $id = Session::get('customer_id'); 
                        $get_customers = $cs->show_customers($id);
                        if($get_customers){
                            while($result = $get_customers->fetch_assoc()){

                    ?>
                    <tr>
                        <td rowspan="8" style="text-align: center;">
                            <img src="admin/uploads/<?php echo $result['image']; ?>" width="200px" style="border-radius: 50%;">
                        </td>
                        <td>Tên :</td>
                        <td><?php echo $result['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại :</td>
                        <td><?php echo '0'.$result['phone']; ?></td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td><?php echo $result['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ :</td>
                        <td><?php echo $result['address']; ?></td>
                    </tr>
                    <tr>
                        <td>Thành phố :</td>
                        <td><?php echo $result['city']; ?></td>
                    </tr>
                    <tr>
                        <td>Quốc tịch :</td>
                        <td><?php echo $result['country']; ?></td>
                    </tr>
                    <tr>
                        <td>Zipcode :</td>
                        <td><?php echo $result['zipcode']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><a href="editprofile.php" style="color: #71cd14;">Cập nhật thông tin cá nhân</a></td>
                    </tr>
                <?php 
                        }
                    }
                ?>
                </table>
        </div>
    </div>
</div>   
<?php 
    include('inc/footer.php');
?>