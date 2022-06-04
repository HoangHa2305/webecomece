<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
class product
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    //Slider
    public function insert_slider($data,$files)
    {
        $sliderName = mysqli_real_escape_string($this->db->link,$data['sliderName']); 
        $type = mysqli_real_escape_string($this->db->link,$data['type']);       //2 biến 1 là dữ liệu, 2 là kết nối csdl

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($sliderName =="" || $type == ""){
            $alert = "<span  class='success' style='color: #68228B;'>Dữ liệu không được để trống </span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                if($file_size>2048000){
                    $alert = "<span  class='success' style='color: #68228B;'>Kích thước ảnh không được quá 2MB! </span>";
                    return $alert;
                }
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tbl_slider(sliderName,slider_image,type) VALUES('$sliderName','$unique_image','$type')";
                $result = $this->db->insert ($query);
    
                if($result){
                    $alert = "<span  class='success' style='color: #00EE00;'>Thêm slider thành công </span>";
                    return $alert;
                }else{
                    $alert = "<span  class='success' style='color: #EE0000;'>Thêm slider không thành công </span>";
                    return $alert;
                }
            }
        }
    }
    public function update_type_slider($id,$type)
    {
        $type = mysqli_real_escape_string($this->db->link,$type); 
        $query = "UPDATE tbl_slider SET type ='$type' WHERE sliderId = '$id' ";
        $result = $this->db->update($query);
        return $result;
    }
    public function show_slider_list()
    {
        $query = "SELECT * FROM tbl_slider ORDER BY sliderId DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_first_slider()
    {
        $query = "SELECT * FROM tbl_slider WHERE type='1' ORDER BY sliderId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_slider($id)
    {
        $query = "SELECT * FROM tbl_slider WHERE type='1' EXCEPT SELECT * FROM tbl_slider WHERE sliderId='$id' ORDER BY sliderId DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_slider($id)
    {
        $query = "DELETE FROM tbl_slider WHERE sliderId = '$id' ";
        $result = $this->db->delete($query);
               
        if($result){
            $alert = "<span  class='success' style='color: #00EE00;'>Xóa slider thành công </span>";
            return $alert;
        }else{
            $alert = "<span  class='success' style='color: #EE0000;'>Xóa slider không thành công </span>";
            return $alert;
        }
    }
    

    //Product
    public function insert_product($data,$files)
    {
        $productName = mysqli_real_escape_string($this->db->link,$data['productName']); 
        $category = mysqli_real_escape_string($this->db->link,$data['category']);       //2 biến 1 là dữ liệu, 2 là kết nối csdl
        $brand = mysqli_real_escape_string($this->db->link,$data['brand']);
        $short_desc = mysqli_real_escape_string($this->db->link,$data['short_desc']);
        $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
        $parameter = mysqli_real_escape_string($this->db->link,$data['parameter']);
        $type = mysqli_real_escape_string($this->db->link,$data['type']);
        $price = mysqli_real_escape_string($this->db->link,$data['price']);
        $priceSale = mysqli_real_escape_string($this->db->link,$data['priceSale']);

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited1 = array('jpg','jpeg','png','gif');
        $file_name1 = $_FILES['image1']['name'];
        $file_size1 = $_FILES['image1']['size'];
        $file_temp1 = $_FILES['image1']['tmp_name'];

        $div1 = explode('.',$file_name1);
        $file_ext1 = strtolower(end($div1));
        $unique_image1 = substr(md5(time()),10,20).'.'.$file_ext1;
        $uploaded_image1 = "uploads/".$unique_image1;

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited2 = array('jpg','jpeg','png','gif');
        $file_name2 = $_FILES['image2']['name'];
        $file_size2 = $_FILES['image2']['size'];
        $file_temp2 = $_FILES['image2']['tmp_name'];

        $div2 = explode('.',$file_name2);
        $file_ext2 = strtolower(end($div2));
        $unique_image2 = substr(md5(time()),20,30).'.'.$file_ext2;
        $uploaded_image2 = "uploads/".$unique_image2;

        if($productName =="" || $category == "" ||  $brand =="" || $product_desc=="" || $parameter=="" || $type=="" || $price=="" || $priceSale=="" || $file_name=="" ){
            $alert = "<span  class='success' style='color: #68228B;'>Dữ liệu không được để trống </span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            move_uploaded_file($file_temp1,$uploaded_image1);
            move_uploaded_file($file_temp2,$uploaded_image2);
            $query = "INSERT INTO tbl_product (productName,catId,brandId,short_desc,product_desc,parameter,type,price,priceSale,image,image1,image2) VALUES('$productName','$category','$brand',
            '$short_desc','$product_desc','$parameter','$type','$price','$priceSale','$unique_image','$unique_image1','$unique_image2') ";
            $result = $this->db->insert($query);

            if($result){
                $alert = "<span  class='success' style='color: #00EE00;'>Thêm sản phẩm thành công </span>";
                return $alert;
            }else{
                $alert = "<span  class='success' style='color: #EE0000;'>Thêm sản phẩm không thành công </span>";
                return $alert;
            }
        }
    }

    public function show_product()
    {
        //Cách 1
        // $query = "SELECT p.*,c.catName,b.brandName
        // FROM tbl_product AS p,tbl_category AS c,tbl_brand AS b WHERE p.catId = c.catId AND p.brandId = b.brandId 
        // ORDER BY p.productId DESC";
        
        //Cách 2
        $query = 
        "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        ORDER BY tbl_product.productId DESC";
        // $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
        $result = $this->db->select ($query);
        return $result;

    }
    public function getproductbyId($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function update_product($data,$files,$id)
    {
        $productName = mysqli_real_escape_string($this->db->link,$data['productName']); 
        $category = mysqli_real_escape_string($this->db->link,$data['category']);       //2 biến 1 là dữ liệu, 2 là kết nối csdl
        $brand = mysqli_real_escape_string($this->db->link,$data['brand']);
        $short_desc = mysqli_real_escape_string($this->db->link,$data['short_desc']);
        $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
        $parameter = mysqli_real_escape_string($this->db->link,$data['parameter']);
        $type = mysqli_real_escape_string($this->db->link,$data['type']);
        $price = mysqli_real_escape_string($this->db->link,$data['price']);
        $priceSale = mysqli_real_escape_string($this->db->link,$data['priceSale']);

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

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited1 = array('jpg','jpeg','png','gif');
        $file_name1 = $_FILES['image1']['name'];
        $file_size1 = $_FILES['image1']['size'];
        $file_temp1 = $_FILES['image1']['tmp_name'];

        $div1 = explode('.',$file_name1);
        $file_ext1 = strtolower(end($div1));
        $unique_image1 = substr(md5(time()),10,20).'.'.$file_ext1;
        $uploaded_image1 = "uploads/".$unique_image1;

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited2 = array('jpg','jpeg','png','gif');
        $file_name2 = $_FILES['image2']['name'];
        $file_size2 = $_FILES['image2']['size'];
        $file_temp2 = $_FILES['image2']['tmp_name'];

        $div2 = explode('.',$file_name2);
        $file_ext2 = strtolower(end($div2));
        $unique_image2 = substr(md5(time()),20,30).'.'.$file_ext2;
        $uploaded_image2 = "uploads/".$unique_image2;

        if($productName =="" || $category == "" ||  $brand =="" || $short_desc=="" || $product_desc=="" || $parameter=="" || $type=="" || $price=="" || $priceSale==""){
            $alert = "<span  class='success' style='color: #68228B;'>Dữ liệu không được để trống </span>";
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
                move_uploaded_file($file_temp1,$uploaded_image1);
                move_uploaded_file($file_temp2,$uploaded_image2);
                $query = "UPDATE tbl_product SET 
                productName = '$productName',
                catId = '$category',
                brandId = '$brand',
                short_desc = '$short_desc',
                product_desc = '$product_desc',
                parameter = '$parameter',
                type = '$type',
                price = '$price',
                priceSale = '$priceSale',
                image = '$unique_image',
                image1 = '$unique_image1',
                image2 = '$unique_image2' 
                WHERE productId = '$id' ";
            }elseif(!empty($file_name1) && !empty($file_name2)){
                move_uploaded_file($file_temp1,$uploaded_image1);
                move_uploaded_file($file_temp2,$uploaded_image2);
                $query = "UPDATE tbl_product SET 
                productName = '$productName',
                catId = '$category',
                brandId = '$brand',
                short_desc = '$short_desc',
                product_desc = '$product_desc',
                parameter = '$parameter',
                type = '$type',
                price = '$price',
                priceSale = '$priceSale',
                image1 = '$unique_image1',
                image2 = '$unique_image2' 
                WHERE productId = '$id' ";
            }elseif(!empty($file_name2)){
                move_uploaded_file($file_temp2,$uploaded_image2);
                $query = "UPDATE tbl_product SET 
                productName = '$productName',
                catId = '$category',
                brandId = '$brand',
                short_desc = '$short_desc',
                product_desc = '$product_desc',
                parameter = '$parameter',
                type = '$type',
                price = '$price',
                priceSale = '$priceSale',
                image2 = '$unique_image2'
                WHERE productId = '$id' ";
            }else{
                //Nếu người dùng không chọn ảnh
                $query = "UPDATE tbl_product SET 
                productName = '$productName',
                catId = '$category',
                brandId = '$brand',
                short_desc = '$short_desc',
                product_desc = '$product_desc',
                parameter = '$parameter',
                type = '$type',
                price = '$price',
                priceSale = '$priceSale'
                WHERE productId = '$id' ";
            }
            $result = $this->db->update($query);

            if($result){
                $alert = "<span  class='success' style='color: #00EE00;'>Cập nhật sản phẩm thành công </span>";
                return $alert;
            }else{
                $alert = "<span  class='success' style='color: #EE0000;'>Cập nhật sản phẩm không thành công </span>";
                return $alert;
            }
        }
    }
    public function del_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->delete($query);
               
        if($result){
            $alert = "<span  class='success' style='color: #00EE00;'>Xóa sản phẩm thành công </span>";
            return $alert;
        }else{
            $alert = "<span  class='success' style='color: #EE0000;'>Xóa sản phẩm không thành công </span>";
            return $alert;
        }
    }
    //END BACKEND ADMIN
    //START FONTEND USER
    public function getproduct_feathered()
    {
        $query = "SELECT * FROM tbl_product WHERE type = '1' ORDER BY productId DESC LIMIT 3 ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function getproduct_new_high()
    {
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function getproduct_new($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId !='$id' ORDER BY productId DESC LIMIT 4 ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function get_product_all()
    {
        $sp_tungtrang = 9;
        if(!isset($_GET['trang'])){
            $trang = 1;
        }else{
            $trang = $_GET['trang'];
        }
        $tung_trang = ($trang-1)*$sp_tungtrang;
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang,$sp_tungtrang";
        $result = $this->db->select ($query);
        return $result;
    }
    //Lấy tất cả sản phẩm để phân trang
    public function get_all_product()
    {
        $query = "SELECT * FROM tbl_product ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function get_details($id)
    {
        $query = 
        "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId,tbl_brand.brandName,tbl_brand.brandId
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        WHERE tbl_product.productId = '$id'  ";
        
        $result = $this->db->select ($query);
        return $result;
    }
    public function get_compare($customer_id)
    {
        $query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' ORDER BY id DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_wishlist($customer_id)
    {
        $query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' ORDER BY id DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_wlist($proid,$customer_id)
    {
        $query = "DELETE FROM tbl_wishlist WHERE productId = '$proid' AND customer_id = '$customer_id' ";
        $result = $this->db->delete($query);

        return $result;
    }
    public function insertCompare($productid,$customer_id)
    {
        $productid = mysqli_real_escape_string($this->db->link,$productid);
        $customer_id = mysqli_real_escape_string($this->db->link,$customer_id); 
       
        $check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id = '$customer_id' ";
        $result_check_compare = $this->db->select($check_compare);

        if($result_check_compare){
            $msg = "<span style='color: #EE0000;'>Sản phẩm đã có trong danh sách so sánh</span>";
            return $msg;
        }else{
            $query = "SELECT * FROM tbl_product WHERE productId = '$productid' ";
            $result = $this->db->select($query)->fetch_assoc();

            $image = $result['image'];
            $productName = $result['productName'];
            if($result['priceSale']>0){
                $price = $result['priceSale'];
            }else{
                $price = $result['price'];
            } 
        
            $query_insert = "INSERT INTO tbl_compare (customer_id,productId,productName,price,image) VALUES('$customer_id',
                            '$productid','$productName','$price','$image') ";
            $insert_compare = $this->db->insert ($query_insert);

            if($insert_compare){
                $alert = "<span style='color: #00EE00;'>Thêm vào danh sách so sánh thành công </span>";
                return $alert;
            }else{
                $alert = "<span style='color: #EE0000;'>Thêm vào danh sách so sánh không thành công </span>";
                return $alert;
            }
        }
    }
    public function insertWishlist($productid,$customer_id)
    {
        $productid = mysqli_real_escape_string($this->db->link,$productid);
        $customer_id = mysqli_real_escape_string($this->db->link,$customer_id); 
           
        $check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id = '$customer_id' ";
        $result_check_wlist = $this->db->select($check_wlist);

        if($result_check_wlist){
            $msg = "<span style='color: #EE0000;'>Sản phẩm đã có trong danh sách yêu thích</span>";
            return $msg;
        }else{
            $query = "SELECT * FROM tbl_product WHERE productId = '$productid' ";
            $result = $this->db->select($query)->fetch_assoc();

            $image = $result['image'];
            $productName = $result['productName'];
            if($result['priceSale']>0){
                $price = $result['priceSale'];
            }else{
                $price = $result['price'];
            } 
        
            $query_insert = "INSERT INTO tbl_wishlist (customer_id,productId,productName,price,image) VALUES('$customer_id',
                            '$productid','$productName','$price','$image') ";
            $insert_wlist = $this->db->insert ($query_insert);

            if($insert_wlist){
                $alert = "<span style='color: #00EE00;'>Thêm vào danh sách yêu thích thành công </span>";
                return $alert;
            }else{
                $alert = "<span style='color: #EE0000;'>Thêm vào danh sách yêu thích không thành công </span>";
                return $alert;
            }
        }
    }
    //Thêm nhanh vào danh sách yêu thích
    public function insert_to_wishlist($productid,$customer_id)
    {
        $productid = mysqli_real_escape_string($this->db->link,$productid);
        $customer_id = mysqli_real_escape_string($this->db->link,$customer_id); 
           
        $check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id = '$customer_id' ";
        $result_check_wlist = $this->db->select($check_wlist);

        if($result_check_wlist){
            header("location:wishlist.php");
        }else{
            $query = "SELECT * FROM tbl_product WHERE productId = '$productid' ";
            $result = $this->db->select($query)->fetch_assoc();

            $image = $result['image'];
            $productName = $result['productName'];
            if($result['priceSale']>0){
                $price = $result['priceSale'];
            }else{
                $price = $result['price'];
            } 
        
            $query_insert = "INSERT INTO tbl_wishlist (customer_id,productId,productName,price,image) VALUES('$customer_id',
                            '$productid','$productName','$price','$image') ";
            $insert_wlist = $this->db->insert ($query_insert);

            if($insert_wlist){
                header("location:wishlist.php");
            }else{
                header("location:index.php");
            }
        }
    }
    //Tìm kiếm sản phẩm
    public function search_product($tukhoa)
    {
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%' ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function product_by_price($price)
    {
        $price = $this->fm->validation($price);
        $query = "SELECT * FROM tbl_product WHERE price<=$price ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function product_by_price_brand($price,$brand_pd)
    {
        $price = $this->fm->validation($price);
        $brand = $this->fm->validation($brand_pd);
        $query = "SELECT * FROM tbl_product WHERE price<=$price AND brandId = '$brand_pd' ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function product_by_price_cat($price,$cat_pd)
    {
        $price = $this->fm->validation($price);
        $cat_pd = $this->fm->validation($cat_pd);
        $query = "SELECT * FROM tbl_product WHERE price<=$price AND catId = '$cat_pd' ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    
}
?>
