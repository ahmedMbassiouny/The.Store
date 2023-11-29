<?php

// requires
require_once 'DBManager.php';


class ProductManager
{
  protected $db;      //use as object of database (DBManager)

  //1. Open connection.
  //2. Run query & logic.
  //3. Close connection


  public function viewProducts($sortType = 'productName', $sortOrder = 'ASC', $limit = null)
  {
    $this->db = DBManager::getInstance();

    if ($this->db) {
      $allowedSortTypes = ['productName', 'price', 'numSales']; // Add more as needed
      $sortType = in_array($sortType, $allowedSortTypes) ? $sortType : 'productName';

      $sortOrder = strtoupper($sortOrder) === 'DESC' ? 'DESC' : 'ASC';

      $limitClause = $limit ? "LIMIT $limit" : '';
      $stmt = "SELECT * FROM Products ORDER BY $sortType $sortOrder $limitClause";

      $result = $this->db->select($stmt);

      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function viewCategories()
  {
    $this->db = DBManager::getInstance();

    if ($this->db) {
      $stmt = "SELECT * FROM Categories";
      $result = $this->db->select($stmt);

      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function viewCategyInfo($id)
  {
    $this->db = DBManager::getInstance();

    if ($this->db) {
      $stmt = "SELECT * FROM Categories where categoryID = $id";
      $result = $this->db->select($stmt);

      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function viewCategyProducts($id, $limit = null)
  {
    $this->db = DBManager::getInstance();

    if ($this->db) {

      $limitClause = $limit ? "LIMIT $limit" : '';
      $stmt = "SELECT * FROM Products where categoryID = $id  $limitClause";
      $result = $this->db->select($stmt);

      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function viewProductInfo($id)
  {
    $this->db = DBManager::getInstance();

    if ($this->db) {
      $stmt = "SELECT * FROM Products where productID = $id";
      $result = $this->db->select($stmt);

      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function viewUserOrders($id)
  {
    $this->db = DBManager::getInstance();

    if ($this->db) {
      $stmt = "SELECT * FROM Orders where userID = $id";
      $result = $this->db->select($stmt);

      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


}
