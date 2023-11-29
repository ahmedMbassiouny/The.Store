<?php
require_once "DBManager.php";



class CartManager{

    protected $conn;


    public function viewProducts($user_id){
        $this->conn=DBManager::getInstance();

        if($this->conn){
            $stmt="SELECT Cart.Quantity as proQuantity,Products.numSales as pronumSales,Cart.CartID as cid,Products.productID as prod_id,Products.productName as prod_name,Products.imgURL as img,Products.price as prodPrice,Products.stockQuantity as stockQ from Cart inner join Products on Cart.productID=Products.productID where Cart.userID= ".$user_id;

            $result=$this->conn->select($stmt);

            if($result){
                return $result;
            }else{
                return false;
            }
        }
    }


    public function promoCode($promo_code){
        $this->conn=DBManager::getInstance();

        if($this->conn){
            $stmt="select * from Promocode where Promocode.promocode= '".$promo_code."'";

            $result=$this->conn->select($stmt);

            if($result){
                return $result;
            }else{
                return false;
            }
        }
    }



    public function deleteFromCart($userId,$prod_id){
        $this->conn=DBManager::getInstance();

        if($this->conn){
            $stmt="delete from Cart where Cart.UserID=$userId and Cart.ProductID=$prod_id";

            $result=$this->conn->query($stmt);

            if($result){
                return true;
            }else{
                return false;
            }
        }
    }

}





?>