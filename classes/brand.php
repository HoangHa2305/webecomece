<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
class brand
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_brand($brandName,$files)
    {
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this->db->link,$brandName);         //2 biến 1 là dữ liệu, 2 là kết nối csdl
      
        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if(empty($brandName)){
            $alert = "<span  class='success' style='color: #68228B;'>Thương hiệu sản phẩm không được để trống </span>";
            return $alert;
            header("location: ./catlist.php");
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_brand (brandName,image) VALUES('$brandName','$unique_image') ";
            $result = $this->db->insert ($query);

            if($result){
                $alert = "<span  class='success' style='color: #00EE00;'>Thêm thương hiệu sản phẩm thành công </span>";
                return $alert;
            }else{
                $alert = "<span  class='success' style='color: #EE0000;'>Thêm thương hiệu sản phẩm không thành công </span>";
                return $alert;
            }
        }
    }

    public function show_brand()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $result = $this->db->select ($query);
        return $result;

    }
    public function getbrandbyId($id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id' ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function update_brand($brandName,$id)
    {
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this->db->link,$brandName);         //2 biến 1 là dữ liệu, 2 là kết nối csdl
        $id = mysqli_real_escape_string($this->db->link,$id);                   //2 biến 1 là dữ liệu, 2 là kết nối csdl

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');        //Cho phép những file này được lưu vào
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);                     //Chia thành 2  ngăn  cách bởi dấu .
        $file_ext = strtolower(end($div));                  //Tất cả chữ hoa thành chữ thường
        // $file_current = strtolower(current($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;     //random số từ không tới 10, kết hợp file_ext tạo thành 1 tên mới
        $uploaded_image = "uploads/".$unique_image;

        if(empty($brandName)){
            $alert = "<span  class='success' style='color: #68228B;'>Thương hiệu sản phẩm không được để trống </span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                //Nếu người dùng chọn ảnh
                if($file_size>204800){
                    $alert = "<span  class='success' style='color: #EE0000;'>Kích thước file nên ít hơn 2MB! </span>";
                    return $alert;
                }elseif(in_array($file_ext,$permited)==false){          //Kiểm tra xem người dùng đã up đúng file định dạng chưa
                    // echo "<span class='success' style='color: #EE0000;'>Bạn có thể upload mỗi: - ".implode(',',$permited)."</span>";
                    $alert = "<span class='success' style='color: #EE0000;'>Bạn có thể upload mỗi: - ".implode(',',$permited)."</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "UPDATE tbl_brand SET brandName = '$brandName',image = '$unique_image' WHERE brandId = '$id' ";
            }else{
                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id' ";
            }
            $result = $this->db->update($query);

            if($result){
                $alert = "<span  class='success' style='color: #00EE00;'>Cập nhật thương hiệu sản phẩm thành công </span>";
                return $alert;
            }else{
                $alert = "<span  class='success' style='color: #EE0000;'>Cập nhật thương hiệu sản phẩm không thành công </span>";
                return $alert;
            }
        }
    }
    public function del_brand($id)
    {
        $query = "DELETE FROM tbl_brand WHERE brandId = '$id' ";
        $result = $this->db->delete($query);
               
        if($result){
            $alert = "<span  class='success' style='color: #00EE00;'>Xóa thương hiệu sản phẩm thành công </span>";
            return $alert;
        }else{
            $alert = "<span  class='success' style='color: #EE0000;'>Xóa thương hiệu sản phẩm không thành công </span>";
            return $alert;
        }
    }

    //END BACKEND ADMIN
    //START FONTEND USER
    public function get_brand()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC LIMIT 8";
        $result = $this->db->select ($query);
        return $result;
    }
    public function get_name_by_brand($id)
    {
        $query = "SELECT tbl_product.*,tbl_brand.brandName,tbl_brand.brandId FROM tbl_product,tbl_brand 
        WHERE tbl_product.brandId = tbl_brand.brandId AND tbl_product.brandId = '$id' LIMIT 1 ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function get_product_by_brand($id)
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '$id' ORDER BY productId DESC ";
        $result = $this->db->select ($query);
        return $result;
    }
}
?>
