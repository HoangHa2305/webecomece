<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
class post
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_category_post($catName,$catDesc,$catStatus)
    {
        $catName = $this->fm->validation($catName);
        $catDesc = $this->fm->validation($catDesc);
        $catStatus = $this->fm->validation($catStatus);
        $catName = mysqli_real_escape_string($this->db->link,$catName);         //2 biến 1 là dữ liệu, 2 là kết nối csdl
        $catDesc = mysqli_real_escape_string($this->db->link,$catDesc);
        $catStatus = mysqli_real_escape_string($this->db->link,$catStatus);

        if(empty($catName) || empty($catDesc)){
            $alert = "<span  class='success' style='color: #68228B;'>Danh mục tin tức không được để trống </span>";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_category_post (title,description,status) VALUES('$catName','$catDesc','$catStatus') ";
            $result = $this->db->insert ($query);

            if($result){
                $alert = "<span  class='success' style='color: #00EE00;'>Thêm danh mục tin tức thành công </span>";
                return $alert;
            }else{
                $alert = "<span  class='success' style='color: #EE0000;'>Thêm danh mục tin tức không thành công </span>";
                return $alert;
            }
        }
    }

    public function show_category_post()
    {
        $query = "SELECT * FROM tbl_category_post ORDER BY id_cate_post DESC";
        $result = $this->db->select ($query);
        return $result;

    }
    public function getcatbyId($id)
    {
        $query = "SELECT * FROM tbl_category_post WHERE id_cate_post = '$id' ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function update_category_post($catName,$catDesc,$catStatus,$id)
    {
        $catName = $this->fm->validation($catName);
        $catDesc = $this->fm->validation($catDesc);
        $catStatus = $this->fm->validation($catStatus);

        $catName = mysqli_real_escape_string($this->db->link,$catName);         //2 biến 1 là dữ liệu, 2 là kết nối csdl
        $catDesc = mysqli_real_escape_string($this->db->link,$catDesc);
        $catStatus = mysqli_real_escape_string($this->db->link,$catStatus);
        $id = mysqli_real_escape_string($this->db->link,$id);                   //2 biến 1 là dữ liệu, 2 là kết nối csdl

        if(empty($catName) || empty($catDesc)){
            $alert = "<span  class='success' style='color: #68228B;'>Dữ liệu không được để trống </span>";
            return $alert;
        }else{
            $query = "UPDATE tbl_category_post SET title = '$catName',description = '$catDesc',status = '$catStatus' WHERE id_cate_post = '$id' ";
            $result = $this->db->update($query);

            if($result){
                $alert = "<span  class='success' style='color: #00EE00;'>Cập nhật danh mục tin tức thành công </span>";
                return $alert;
            }else{
                $alert = "<span  class='success' style='color: #EE0000;'>Cập nhật danh mục tin tức không thành công </span>";
                return $alert;
            }
        }
    }
    public function del_category_post($id)
    {
        $query = "DELETE FROM tbl_category_post WHERE id_cate_post = '$id' ";
        $result = $this->db->delete($query);
               
        if($result){
            $alert = "<span  class='success' style='color: #00EE00;'>Xóa danh mục tin tức thành công </span>";
            return $alert;
        }else{
            $alert = "<span  class='success' style='color: #EE0000;'>Xóa danh mục tin tức không thành công </span>";
            return $alert;
        }
    }

    //END BACKEND ADMIN
    //START FONTEND USER

    public function show_category_fontend()
    {
        $query = "SELECT * FROM tbl_category_post ORDER BY id_cate_post DESC";
        $result = $this->db->select ($query);
        return $result;
    }
    public function getpostbycateid($id)
    {
        $query = "SELECT * FROM tbl_category_post WHERE id_cate_post = '$id' ";
        $result = $this->db->select ($query);
        return $result;
    }
    public function get_post_by_cat($id)
    {
        $query = "SELECT tbl_blog.*,tbl_category_post.title as title_categorypost FROM tbl_blog,tbl_category_post 
            WHERE tbl_blog.category_post=tbl_category_post.id_cate_post AND tbl_blog.category_post = '$id' ORDER BY tbl_blog.id DESC";
        $result = $this->db->select ($query);
        return $result;
    }
    public function get_all_post()
    {
        $query = "SELECT tbl_blog.*,tbl_category_post.title as title_categorypost FROM tbl_blog,tbl_category_post 
        WHERE tbl_blog.category_post=tbl_category_post.id_cate_post ORDER BY tbl_blog.id DESC";
        $result = $this->db->select ($query);
        return $result;
    }
    public function getpostbyid($id)
    {
        $query = "SELECT tbl_blog.*,tbl_category_post.title as title_categorypost FROM tbl_blog,tbl_category_post 
            WHERE tbl_blog.category_post=tbl_category_post.id_cate_post AND tbl_blog.id = '$id' ";
        $result = $this->db->select ($query);
        return $result;
    }
}
?>
