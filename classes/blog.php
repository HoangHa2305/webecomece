<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
class blog
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_blog($data,$files)
    {
        $title = mysqli_real_escape_string($this->db->link,$data['title']); 
        $category = mysqli_real_escape_string($this->db->link,$data['category_post']);       //2 biến 1 là dữ liệu, 2 là kết nối csdl
        $desc = mysqli_real_escape_string($this->db->link,$data['desc']);
        $content = mysqli_real_escape_string($this->db->link,$data['content']);
        $type = mysqli_real_escape_string($this->db->link,$data['type']);
        $date = date('d');
        $year = date('m-Y');

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($title =="" || $category == "" ||  $desc =="" || $content=="" || $type=="" || $file_name=="" ){
            $alert = "<span  class='success' style='color: #68228B;'>Dữ liệu không được để trống </span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_blog (title,description,content,category_post,image,status,date,year) VALUES('$title','$desc','$content',
            '$category','$unique_image','$type','$date','$year') ";
            $result = $this->db->insert($query);

            if($result){
                $alert = "<span  class='success' style='color: #00EE00;'>Thêm tin tức thành công </span>";
                return $alert;
            }else{
                $alert = "<span  class='success' style='color: #EE0000;'>Thêm tin tức không thành công </span>";
                return $alert;
            }
        }
    }

    public function show_blog()
    {
        $query = 
        " SELECT tbl_blog.*,tbl_category_post.title as title_category
        FROM tbl_blog INNER JOIN tbl_category_post ON tbl_category_post.id_cate_post = tbl_blog.category_post
        ORDER BY tbl_blog.id DESC";

        $result = $this->db->select($query);

        return $result;
    }
    public function update_blog($data,$files,$id)
    {
        $title = mysqli_real_escape_string($this->db->link,$data['title']); 
        $category = mysqli_real_escape_string($this->db->link,$data['category_post']);       //2 biến 1 là dữ liệu, 2 là kết nối csdl
        $desc = mysqli_real_escape_string($this->db->link,$data['desc']);
        $content = mysqli_real_escape_string($this->db->link,$data['content']);
        $type = mysqli_real_escape_string($this->db->link,$data['type']);

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($title =="" || $category == "" ||  $desc =="" || $content=="" || $type==""){
            $alert = "<span  class='success' style='color: #68228B;'>Dữ liệu không được để trống </span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "UPDATE tbl_blog SET 
                            title='$title',
                            description='$desc',
                            content='$content',
                            category_post='$category',
                            image='$unique_image',
                            status='$type' 
                            WHERE id = '$id'";               
            }else{
                $query = "UPDATE tbl_blog SET 
                            title='$title',
                            description='$desc',
                            content='$content',
                            category_post='$category',
                            status='$type' 
                            WHERE id = '$id'"; 
            }
            $result = $this->db->update($query);

            if($result){
                $alert = "<span  class='success' style='color: #00EE00;'>Cập nhật tin tức thành công </span>";
                return $alert;
            }else{
                $alert = "<span  class='success' style='color: #EE0000;'>Cập nhật tin tức không thành công </span>";
                return $alert;
            }
        }
    }
    public function del_blog($id)
    {
        $query = "DELETE FROM tbl_blog WHERE id='$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span  class='success' style='color: #00EE00;'>Xóa tin tức thành công </span>";
            return $alert;
        }else{
            $alert = "<span  class='success' style='color: #EE0000;'>Xóa tin tức không thành công </span>";
            return $alert;
        }
    }
    public function getblogbyId($id)
    {
        $query = "SELECT * FROM tbl_blog WHERE id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    //FONTEND
    public function get_blog()
    {
        $query = "SELECT * FROM tbl_blog ORDER BY id DESC LIMIT 3 ";
        $result = $this->db->select($query);
        return $result;
    }

}