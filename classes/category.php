<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
class category 
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_category($catName)
    {
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link,$catName);         //2 biến 1 là dữ liệu, 2 là kết nối csdl
      

        if(empty($catName)){
            $alert = "<span  class='success' style='color: #68228B;'>Danh mục sản phẩm không được để trống </span>";
            return $alert;
            header("location: ./catlist.php");
        }else{
            $query = "INSERT INTO tbl_category (catName) VALUES('$catName') ";
            $result = $this->db->insert ($query);

            if($result){
                $alert = "<span  class='success' style='color: #00EE00;'>Thêm danh mục  sản phẩm thành công </span>";
                return $alert;
            }else{
                $alert = "<span  class='success' style='color: #EE0000;'>Thêm danh mục  sản phẩm không thành công </span>";
                return $alert;
            }
        }
    }

    public function show_category()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select ($query);
        return $result;

    }
    public function getcatbyId($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catId = '$id' ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function update_category($catName,$id)
    {
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link,$catName);         //2 biến 1 là dữ liệu, 2 là kết nối csdl
        $id = mysqli_real_escape_string($this->db->link,$id);                   //2 biến 1 là dữ liệu, 2 là kết nối csdl

        if(empty($catName)){
            $alert = "<span  class='success' style='color: #68228B;'>Danh mục sản phẩm không được để trống </span>";
            return $alert;
            header("location: ./catlist.php");
        }else{
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id' ";
            $result = $this->db->update($query);

            if($result){
                $alert = "<span  class='success' style='color: #00EE00;'>Cập nhật danh mục sản phẩm thành công </span>";
                return $alert;
            }else{
                $alert = "<span  class='success' style='color: #EE0000;'>Cập nhật danh mục sản phẩm không thành công </span>";
                return $alert;
            }
        }
    }
    public function del_category($id)
    {
        $query = "DELETE FROM tbl_category WHERE catId = '$id' ";
        $result = $this->db->delete($query);
               
        if($result){
            $alert = "<span  class='success' style='color: #00EE00;'>Xóa danh mục sản phẩm thành công </span>";
            return $alert;
        }else{
            $alert = "<span  class='success' style='color: #EE0000;'>Xóa danh mục sản phẩm không thành công </span>";
            return $alert;
        }
    }

    //END BACKEND ADMIN
    //START FONTEND USER

    public function show_category_fontend()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select ($query);
        return $result;
    }
    public function get_name_by_cat($id)
    {
        $query = "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId FROM tbl_product,tbl_category 
        WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id' LIMIT 1 ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function get_product_by_cat($id)
    {
        $query = "SELECT * FROM tbl_product WHERE catId = '$id' ORDER BY productId DESC LIMIT 9";
        $result = $this->db->select ($query);
        return $result;
    }
}
?>
