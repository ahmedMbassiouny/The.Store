<?php

// requires
require_once 'user.php';
require_once 'DBManager.php';


class AuthManager
{
  protected $db;      //use as object of database (DBManager)

  //1. Open connection.
  //2. Run query & logic.
  //3. Close connection


  function login(user $user)
  {
    $this->db = DBManager::getInstance();
    if ($this->db) {
      $query = "select * from Users where email='{$user->get_email()}' and password='{$user->get_password()}'";
      $result = $this->db->select($query);
      if ($result === false) {
        //echo "Error in Query";
        return false;
      } else {
        if (count($result) == 0) {
          // session_start();
          // $_SESSION["errMsg"] = "You have entered wrong email or password";
          $this->db->close();
          return false;
        } else {
          /*print_r($result);*/  //Array ( [0] => Array ( [id] => 1 [name] => ahmed [email] => ahmed123@gmail.com [password] => 12345 [roleid] => 1 ) )
          session_start();
          $_SESSION["userId"] = $result[0]["userID"];
          $_SESSION["userRole"] = $result[0]["role"];
          $this->db->close();
          return true;
        }
      }
    } else {
      //echo "Error in Database Connection";
      return false;
    }
  }


  function register(user $user)
  {
    $this->db = DBManager::getInstance();
    if ($this->db) {
      $query = "insert into Users (username, password, email, phone, role) values ('{$user->get_name()}','{$user->get_password()}','{$user->get_email()}','{$user->get_phone()}','customer')";
      $result = $this->db->DBinsert($query);
      if ($result === false) {
        $this->db->close();
        return false;
      } else {
        $this->db->close();
        return true;
      }
    } else {
      //echo "Error in Database Connection";
      return false;
    }
  }


  function check_email($email)
  {
    $this->db = DBManager::getInstance();
    if ($this->db) {
      $query = "select email from Users;";
      $results = $this->db->select($query);
      // $this->db->close();
      foreach ($results as $result) {
        if ($result['email'] == $email) {
          return false;
        }
      }
      return true;
    } else {
      //echo "Error in Database Connection";
      return false;
    }
  }

  public function viewUserInfo($id)
  {
    $this->db = DBManager::getInstance();

    if ($this->db) {
      $stmt = "SELECT * FROM Users where userID = $id";
      $result = $this->db->select($stmt);

      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }
}
