<?php
require_once "DBManager.php";

class selectedproductManager{

    protected $conn;


    public function addToCart($userId,$prod_id){
        $this->conn=DBManager::getInstance();

        if($this->conn){
            $stmt="insert into Cart(UserID,ProductID,Quantity) values ($userId,$prod_id,1)";

            $result=$this->conn->query($stmt);

            if($result){
                return true;
            }else{
                return false;
            }
        }
    }

    public function updateQuantity($Quantity,$prod_id,$userId){
        $this->conn=DBManager::getInstance();

        if($this->conn){
            $stmt="update Cart set Cart.Quantity=$Quantity+1 where ProductID=$prod_id and UserID=$userId";

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