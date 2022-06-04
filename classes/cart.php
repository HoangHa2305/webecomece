<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
class cart
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($quantity,$id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link,$quantity); 
        $id = mysqli_real_escape_string($this->db->link,$id); 
        $sId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result['image'];
        if($result['priceSale']>0){
            $price = $result['priceSale'];
        }else{
            $price = $result['price'];
        }       
        $productName = $result['productName'];

        $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId' ";
        $result_check = $this->db->select($check_cart); 
        if($result_check){
            $msg = "Sản phẩm đã được thêm vào ";
            return $msg;
        }else{
            $query_insert = "INSERT INTO tbl_cart (productId,quantity,sId,image,price,productName) VALUES('$id','$quantity','$sId',
            '$image','$price','$productName') ";
            $insert_cart = $this->db->insert ($query_insert);

            if($insert_cart){
                header("location:cart.php");
            }else{
                header("location:404.php");
            }
        }
    }
    //Chọn nhanh sản phẩm vào giỏ hàng
    public function insert_to_cart($quantity,$id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link,$quantity); 
        $id = mysqli_real_escape_string($this->db->link,$id); 
        $sId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result['image'];
        if($result['priceSale']>0){
            $price = $result['priceSale'];
        }else{
            $price = $result['price'];
        }       
        $productName = $result['productName'];

        $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId' ";
        $result_check = $this->db->select($check_cart); 
        if($result_check){
            $result_cart = mysqli_fetch_assoc($result_check);
            $quantity_cart = $result_cart['quantity']+1;
            $query = "UPDATE tbl_cart SET  quantity = '$quantity_cart' WHERE productId = '$id' AND sId = '$sId' ";
            $result = $this->db->update($query);
            if($result){
            header('Location:cart.php');
            }
        }else{
            $query_insert = "INSERT INTO tbl_cart (productId,quantity,sId,image,price,productName) VALUES('$id','1','$sId',
            '$image','$price','$productName') ";
            $insert_cart = $this->db->insert($query_insert);

            if($insert_cart){
                header("location:cart.php");
            }else{
                header("location:404.php");
            }
        }
    }
    public function get_product_cart()
    {
        $sId = session_id();

        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
        $result = $this->db->select($query);

        return $result;
    }

    public function update_quantity_cart($quantity,$cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link,$quantity); 
        $cartId = mysqli_real_escape_string($this->db->link,$cartId); 

        $query = "UPDATE tbl_cart SET  quantity = '$quantity' WHERE cartId = '$cartId' ";
        $result = $this->db->update($query);
        if($result){
            header('Location:cart.php');
        }else{
            $msg = "<span class='text-danger'>Số lượng sản phẩm cập nhật thất bại</span>";
            return $msg;
        }
    }

    public function del_product_cart($cartid)
    {
        $cartid = mysqli_real_escape_string($this->db->link,$cartid);
        $query = " DELETE FROM tbl_cart WHERE cartId = '$cartid' ";
        $result = $this->db->delete($query);
        if($result){
            header('Location:cart.php');
        }else{
            $msg = "<span class='text-danger'>Xóa sản phẩm thất bại</span>";
            return $msg;
        }
    }

    public function check_cart()
    {
        $sId = session_id();

        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
        $result = $this->db->select($query);

        return $result;
    }
    public function check_order($customer_id)
    {
        $sId = session_id();

        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id' ";
        $result = $this->db->select($query);

        return $result;
    }
    public function dell_all_data_cart()
    {
        $sId = session_id();

        $query = "DELETE FROM tbl_cart WHERE sId = '$sId' ";
        $result = $this->db->delete($query);

        return $result;
    }
    public function dell_compare($customer_id)
    {
        $query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id' ";
        $result = $this->db->delete($query);

        return $result;
    }
    public function insertOrder($customer_id)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
        $get_product = $this->db->select($query);

        if($get_product){
            while($result = $get_product->fetch_assoc()){
                $productid = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price']*$quantity;
                $image = $result['image'];
                $customer_id = $customer_id;

                $query_order = "INSERT INTO tbl_order(productId,productName,customer_id,quantity,price,image) 
                            VALUES('$productid','$productName','$customer_id','$quantity','$price','$image')";
                $insert_order = $this->db->insert($query_order);

            }
        }
    }
    public function getAmountPrice($customer_id)
    {
        $query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id' ";
        $get_price = $this->db->select($query);

        return $get_price;
    }
    public function get_cart_ordered($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id' ";
        $get_cart_ordered = $this->db->select($query);

        return $get_cart_ordered;
    }
    public function get_inbox_cart()
    {
        $query = "SELECT * FROM tbl_order ORDER BY date_order DESC";
        $get_inbox_cart = $this->db->select($query);

        return $get_inbox_cart;
    }
    public function get_status_order($id,$time,$price)
    {
        $query = "SELECT * FROM tbl_order WHERE id='$id' AND date_order='$time' AND price='$price' ";
        $get_inbox_cart = $this->db->select($query);

        return $get_inbox_cart;
    }
    public function shifted($id,$time,$price,$status)
    {
        $id = mysqli_real_escape_string($this->db->link,$id);
        $time = mysqli_real_escape_string($this->db->link,$time);
        $price = mysqli_real_escape_string($this->db->link,$price);
        $status = mysqli_real_escape_string($this->db->link,$status);

        $query = "UPDATE tbl_order SET status = '$status' WHERE  id='$id' AND date_order='$time' AND price='$price' ";
        $result = $this->db->update($query);
        if($result){
            $msg = "<span  class='success' style='color: #00EE00;'>Cập nhật trạng thái đơn hàng thành công</span>";
            return $msg;           
        }else{
            $msg = "Cập nhật trạng thái đơn hàng thất bại";
            return $msg;
        }
    }
    public function del_shifted($id,$time,$price)
    {
        $id = mysqli_real_escape_string($this->db->link,$id);
        $time = mysqli_real_escape_string($this->db->link,$time);
        $price = mysqli_real_escape_string($this->db->link,$price);

        $query = "DELETE FROM tbl_order WHERE id='$id' AND date_order='$time' AND price='$price' ";
        $result = $this->db->delete($query);
        if($result){
            $msg = "<span  class='success' style='color: #00EE00;'>Xóa đơn hàng thành công</span>";
            return $msg;
        }else{
            $msg = "Xóa đơn hàng thất bại";
            return $msg;
        }
    }
    public function shifted_confirm($id,$time,$price)
    {
        $id = mysqli_real_escape_string($this->db->link,$id);
        $time = mysqli_real_escape_string($this->db->link,$time);
        $price = mysqli_real_escape_string($this->db->link,$price);

        $query = "UPDATE tbl_order SET status = '4' WHERE  customer_id='$id' AND date_order='$time' AND price='$price' ";
        $result = $this->db->update($query);
        if($result){
            $msg = "<span  class='success' style='color: #00EE00;'>Bạn đã nhận được hàng thành công</span>";
            return $msg;
        }else{
            $msg = "Cập nhật trạng thái đơn hàng thất bại";
            return $msg;
        }
    }
    public function del_shifted_confirm($id)
    {
        $id = mysqli_real_escape_string($this->db->link,$id);
        $query = "DELETE FROM tbl_order WHERE id='$id' ";
        $result = $this->db->delete($query);
        if($result){
            $msg = "<span  class='success' style='color: #00EE00;'>Đã hoàn thành đơn hàng thành công</span>";
            return $msg;
        }else{
            $msg = "Xóa đơn hàng thất bại";
            return $msg;
        }
    }

}
?>
