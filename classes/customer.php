<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php 
class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_customers($data,$files)
    {
        $name = mysqli_real_escape_string($this->db->link,$data['name']); 
        $city = mysqli_real_escape_string($this->db->link,$data['city']);
        $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
        $email = mysqli_real_escape_string($this->db->link,$data['email']);
        $address = mysqli_real_escape_string($this->db->link,$data['address']);
        $country = mysqli_real_escape_string($this->db->link,$data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);
        $password = mysqli_real_escape_string($this->db->link,md5($data['password']));

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "admin/uploads/".$unique_image;

        if($name =="" || $city == "" ||  $phone =="" || $email=="" || $address=="" || $country=="" || $zipcode=="" || $password=="" || $file_name=="" ){
            $alert = "Dữ liệu không được để trống";
            return $alert;
        }else{
            $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "Email đã tồn tại!";
                return $alert;
            }else{
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tbl_customer (name,city,phone,email,address,country,zipcode,password,image) VALUES ('$name','$city',
                        '$phone','$email','$address','$country','$zipcode','$password','$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "Đăng kí thành viên thành công";
                    return $alert;
                }else{
                    $alert = "Đăng kí thành viên không thành công";
                    return $alert;
                }
            }
        }
    }
    public function login_customers($data)
    {
        $email = mysqli_real_escape_string($this->db->link,$data['email']);
        $password = mysqli_real_escape_string($this->db->link,md5($data['password']));
        if($email=="" || $password==""){
            $alert = "Dữ liệu không được để trống";
            return $alert;
        }else{
            $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' ";
            $result_check = $this->db->select($check_login);
            if($result_check != false){
                $value = $result_check->fetch_assoc();
                Session::set('customer_login',true);
                Session::set('customer_id',$value['id']);
                Session::set('customer_name',$value['name']);
                Session::set('customer_image',$value['image']);
                header('Location: index.php');
            }else{
                $alert = "Email hoặc password không đúng";
                return $alert;
            }
        }
    }
    public function get_all_customer()
    {
        $query = "SELECT * FROM tbl_customer ";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_customers($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id='$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_customer($id)
    {
        $query = "DELETE FROM tbl_customer WHERE id = '$id' ";
        $result = $this->db->delete($query);
               
        if($result){
            $alert = "<span  class='success' style='color: #00EE00;'>Xóa người dùng thành công </span>";
            return $alert;
        }else{
            $alert = "<span  class='success' style='color: #EE0000;'>Xóa người dùng không thành công </span>";
            return $alert;
        }
    }
    public function update_customers($data,$id)
    {
        $name = mysqli_real_escape_string($this->db->link,$data['name']); 
        $city = mysqli_real_escape_string($this->db->link,$data['city']);
        $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
        $email = mysqli_real_escape_string($this->db->link,$data['email']);
        $address = mysqli_real_escape_string($this->db->link,$data['address']);
        $country = mysqli_real_escape_string($this->db->link,$data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "admin/uploads/".$unique_image;

        if($name =="" || $city == "" ||  $phone =="" || $email=="" || $address=="" || $country=="" || $zipcode==""  ){
            $alert = "<span style='color: #FFCC00;'>Dữ liệu không được để trống</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "UPDATE tbl_customer SET name='$name',city='$city',phone='$phone',email='$email',address='$address',country='$country',
                        zipcode='$zipcode',image='$unique_image' WHERE id='$id' ";
            }else{
                $query = "UPDATE tbl_customer SET name='$name',city='$city',phone='$phone',email='$email',address='$address',country='$country',
                        zipcode='$zipcode' WHERE id='$id' ";
            }
            $result = $this->db->update($query);

            if($result){
                $alert = "<span style='color: #00FF33;'>Cập nhật thông tin cá nhân thành công</span>";
                return $alert;
            }else{
                $alert = "<span style='color: #FF0000;'>Cập nhật thông tin cá nhân không thành công</span>";
                return $alert;
            }
        }
    }
    //BÌNH LUẬN
    //Bình luận sản phẩm
    public function insert_binhluan()
    {
        $product_id = $_POST['product_id_binhluan'];
        $tenbinhluan = $_POST['tenguoibinhluan'];
        $customer_id = $_POST['customer_id'];
        $binhluan = $_POST['binhluan'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $image = $_POST['image'];
        if($binhluan==""){
            $alert = "<span style='color: #FF4500;'>Dữ liệu không được để trống</span>";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_binhluan(tenbinhluan,customer_id,binhluan,product_id,image,date,time) 
                        VALUES ('$tenbinhluan','$customer_id','$binhluan','$product_id','$image','$date','$time')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span style='color: #00FF33;'>Bình luận sẽ được quản trị viên kiểm duyệt</span>";
                return $alert;
            }else{
                $alert = "<span style='color: #FF0000;'>Bình luận không thành công</span>";
                return $alert;
            }
        }
    }
    public function get_binhluan_by_proid($id)
    {
        $query = "SELECT * FROM tbl_binhluan WHERE product_id = '$id' AND type='1' ORDER BY binhluan_id DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function xoa_binhluan($id,$proid)
    {
        $query = "DELETE FROM tbl_binhluan WHERE binhluan_id = '$id' ";
        $result = $this->db->delete($query);
        
        if($result){
            header("Location: details.php?proid=$proid");
        }
    }
    //ADMIN bình luận
    public function show_binhluan()
    {
        $query = "SELECT * FROM tbl_binhluan ORDER BY binhluan_id DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_binhluan_blog()
    {
        $query = "SELECT * FROM tbl_binhluan_post ORDER BY binhluan_id DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_type_binhluan($id,$type)
    {
        $type = mysqli_real_escape_string($this->db->link,$type); 
        $query = "UPDATE tbl_binhluan SET type ='$type' WHERE binhluan_id = '$id' ";
        $result = $this->db->update($query);
        return $result;
    }
    public function update_type_binhluan_post($id,$type)
    {
        $type = mysqli_real_escape_string($this->db->link,$type); 
        $query = "UPDATE tbl_binhluan_post SET type ='$type' WHERE binhluan_id = '$id' ";
        $result = $this->db->update($query);
        return $result;
    }
    public function binhluan_del($id)
    {
        $query = "DELETE FROM tbl_binhluan WHERE binhluan_id = '$id' ";
        $result = $this->db->delete($query);
               
        if($result){
            $alert = "<span  class='success' style='color: #00EE00;'>Xóa bình luận thành công </span>";
            return $alert;
        }else{
            $alert = "<span  class='success' style='color: #EE0000;'>Xóa bình luận không thành công </span>";
            return $alert;
        }
    }
    public function binhluan_del_post($id)
    {
        $query = "DELETE FROM tbl_binhluan_post WHERE binhluan_id = '$id' ";
        $result = $this->db->delete($query);
               
        if($result){
            $alert = "<span  class='success' style='color: #00EE00;'>Xóa bình luận thành công </span>";
            return $alert;
        }else{
            $alert = "<span  class='success' style='color: #EE0000;'>Xóa bình luận không thành công </span>";
            return $alert;
        }
    }
    //Bình luận tin tức
    public function insert_binhluan_post($id,$binhluan)
    {
        $tenbinhluan = Session::get('customer_name');
        $customer_id = Session::get('customer_id');
        $image = Session::get('customer_image');
        // $binhluan = $_POST['binhluan'];
        $date = date("d/m/Y");
        $time = date("h:i:s");

        if($binhluan==""){
            $alert = "<span style='color: #FF4500;'>Dữ liệu không được để trống</span>";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_binhluan_post(tenbinhluan,customer_id,binhluan,blog_id,image,date,time) 
                        VALUES ('$tenbinhluan','$customer_id','$binhluan','$id','$image','$date','$time')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span style='color: #00FF33;'>Bình luận sẽ được quản trị viên kiểm duyệt</span>";
                return $alert;
            }else{
                $alert = "<span style='color: #FF0000;'>Bình luận không thành công</span>";
                return $alert;
            }
        }
    }
    public function get_binhluan_by_blogid($id)
    {
        $query = "SELECT * FROM tbl_binhluan_post WHERE blog_id = '$id' AND type='1' ORDER BY binhluan_id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_binhluan($id,$blogid)
    {
        $query = "DELETE FROM tbl_binhluan_post WHERE binhluan_id = '$id' ";
        $result = $this->db->delete($query);

        if($result){
            header("Location: details_blog.php?blogid=$blogid");
        }
    }

}
?>