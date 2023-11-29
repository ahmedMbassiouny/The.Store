<?php
require_once "DBManager.php";

class checkoutManager{
    protected $conn;



    public function makeOrder($user_id,$total_amount,$address1,$address2,$addetionalphone,$addetionalemail){
        $this->conn=DBManager::getInstance();

        if($this->conn){
            $stmt="insert into Orders(userID,totalAmount,address1,address2,additionalPhone,additionalEmail) values ($user_id,$total_amount,'$address1','$address2','$addetionalphone','$addetionalemail')";

            $result=$this->conn->DBinsert($stmt);
            
            if($result){
                $last_id = $this->conn->getLastId();
                return $last_id;
            }else{
                return false;
            }
            
        }
    }



    public function makeOrderDetails($orderID,$prod_id,$Quantity,$sub_total,$prod_sales,$old_stock){
        $this->conn=DBManager::getInstance();

        if($this->conn){
            $stmt="insert into OrderDetails(orderID,productID,quantity,subtotal) values ($orderID,$prod_id,$Quantity,$sub_total)";

            $stmt2="update Products set Products.numSales=$prod_sales where Products.productID=$prod_id";

            $stmt3="update Products set Products.stockQuantity=$old_stock-$Quantity where Products.productID=$prod_id";

            $result=$this->conn->DBinsert($stmt);
            
            $result2=$this->conn->query($stmt2);

            $result3=$this->conn->query($stmt3);


            if($result and $result2 and $result3){
                return true;
            }else{
                return false;
            }

            
            
    }
}

    public function deleteCart($user_id){
        $this->conn=DBManager::getInstance();

        if($this->conn){
            $stmt="delete from Cart where UserID = $user_id";

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