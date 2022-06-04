<?php
    $filepath = realpath(dirname(__FILE__)); 
    include($filepath.'/../lib/session.php');
    Session::checkLogin();
    include($filepath.'/../lib/database.php');
    include($filepath.'/../helpers/format.php');

class adminlogin {

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function login_admin($adminUser,$adminPass)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link,$adminUser);         //2 biến 1 là dữ liệu, 2 là kết nối csdl
        $adminPass = mysqli_real_escape_string($this->db->link,$adminPass);

        if(empty($adminUser) || empty($adminPass)){
            $alert = "Tên người dùng hoặc mật khẩu không được để trống";
            return $alert;
        }else{
            $query = "SELECT * FROM  admin WHERE user = '$adminUser' AND pass = '$adminPass' LIMIT 1 ";
            $result = $this->db->select($query);

            if($result != false){
                $value = $result->fetch_assoc();
                Session::set('adminlogin',true);
                Session::set('id',$value['id']);
                Session::set('user',$value['user']);
                Session::set('name',$value['name']);

                header('location: index.php');
            }else{
                $alert = "Tên người dùng hoặc mật khẩu không đúng";
                return $alert;
            }
        }
    }
}
?>