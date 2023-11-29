<?php
require_once 'DBinfo.php';

class DBManager {
    private static $instance = null;
    private $servername = db_host;     # Endpoint of AWS RDS database we use in our case
    private $username = db_username;
    private $password = db_pass;
    private $dbname = db_name;
    public $conn;



    private function __construct() {
        # private constructor, only be called within the class itself
        $this->connect($this->servername, $this->username, $this->password, $this->dbname);
    }

    # use this anywhere to access the Instance of the DBManager to apply the singleton
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new DBManager();
        }
        return self::$instance;
    }

    private function connect($servername, $username, $password, $dbname) {
        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

    }

    public function query($sql) {
        // Execute query
        $result = $this->conn->query($sql);

        // Check for errors
        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        // Return result
        return $result;
    }
    # tested select ✅
    public function select($stmt){
        $result=$this->conn->query($stmt);
        if($result->num_rows>0){
            while($row=$result->fetch_all(MYSQLI_ASSOC)){
                return $row;
            }
        }else{
            return false;
        }
    }


    public function close() {
        // Close connection
        $this->conn->close();
    }
    # method that return the column names of a table in array
    # helper functions
    # function to get the PK of a table
    public function getPrimaryKey($tableName) {
        // Get the table metadata
        $stmt = $this->conn->prepare("DESCRIBE $tableName");
        $stmt->execute();
        /*
         MYSQLI_ASSOC is used as a parameter to the fetch_all method within the PHP code block. 
         This parameter specifies that the result should be fetched as an associative array.
         */
        $tableMetadata = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        // Find the primary key column
        foreach ($tableMetadata as $column) {
            if ($column['Key'] === 'PRI') {
                return $column['Field'];
            }
        }

        // If no primary key found, return null
        return null;
    }
 
    private function getType($value){
        switch(gettype($value)){
            case 'boolean':
                return 'i';
            case 'integer':
                return 'i';
            case 'double' :
                return 'd';
            case 'string' :
                return 's';
            default :
                 return 's';

        }
    }
    # update ✅ 
    public function update($tableName, $id, $colsValues){
        $idColName = $this->getPrimaryKey($tableName);
        $sql = "update $tableName set ";
        $params = [];
        foreach($colsValues as $colName => $colsValue){
            $params[] = "$colName = ? ";
        }
        /*implode(",", ['lastname', 'email', 'phone']); ====>"lastname,email,phone" */
        $sql .= implode(", ", $params)." where $idColName = ? ";
        // prepare the statments 
        $statement = $this->conn->prepare($sql);
        // bind the params
        /*
        preparing a SQL statement with placeholders for parameters and then associating specific values with those placeholders before executing the statement.
        helps to prevent SQL injection attacks by separating the SQL code from the data values.
        fast in performance
        */
        $types = ''; 
        $values = [];
        foreach($colsValues as $colsValue){
            $types .= $this->getType($colsValue);
            $values[] = $colsValue;
        }
        $types .= $this->getType($id);
        $values[] = $id;
        // ... unpack like * in pyhton
        $statement->bind_param($types, ...$values);
        $statement->execute();
        if($statement->error){
            die("Error : ". $statement->error);
        }
        $statement->close();

    }

    
    # insert ✅ tested
    public function insert($tableName, $columnValues) {
        // Build the SQL query
        $sql = "INSERT INTO $tableName (";
        $params = [];
        # params names (keys)
        foreach ($columnValues as $columnName => $columnValue) {
            $params[] = "$columnName";
        }
        $sql .= implode(", ", $params) . ") VALUES (";
        $params = [];
        # params values 
        foreach ($columnValues as $columnName => $columnValue) {
            $params[] = "?";
        }
        $sql .= implode(", ", $params) . ")";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
    
        // Bind the parameters
        // make sure every thing is the right type
        $types = str_repeat('s', count($columnValues));
        $values = array_values($columnValues);
        $stmt->bind_param($types, ...$values);
    
        // Execute the statement
        $stmt->execute();
    
        // Check for errors
        if ($stmt->error) {
            die("Error: " . $stmt->error);
        }
    
        // Close the statement
        $stmt->close();
    }
    # delete ✅ tested
    public function delete($tableName, $id) {
        // Determine the type of the identifier
        $idType = $this->getType($id);
        $idColName = $this->getPrimaryKey($tableName);
    
        // Build the SQL query
        $sql = "DELETE FROM $tableName WHERE $idColName = ?";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
    
        // Bind the parameters
        $stmt->bind_param($idType, $id);
    
        // Execute the statement
        $stmt->execute();
    
        // Check for errors
        if ($stmt->error) {
            die("Error: " . $stmt->error);
        }
    
        // Close the statement
        $stmt->close();
    }
   
    # checks if the value occure n times n = 1 default you can change it 
    public function isUnique(string $tableName, string $col, $value,int $how_many = 1) : bool{
        $statement = $this->conn->prepare("select count(*) from $tableName where $col = ?");
        $statement->bind_param('s', $value);
        $statement->execute();
        $count = null;
        $statement->bind_result($count);
        $statement->fetch();
        return $count == $how_many;
        /*
        When you execute a prepared statement using execute() in mysqli, 
        the result of the query is returned to the mysqli_stmt object.
         To access this result, you can use bind_result() 
         to bind the columns in the result to variables.
        */
        /**
         * check by default if the value is unique in the column 
         * @param string $tableName The name of the table
         * @param string $col is the column name
         * @param $value the value you want to know if it's unique or not
         * @param int $how_many by default it's 1 which meant it would check that it appear only once if set to 0 check if it hasn't been used in the column yet
         * @return bool if the $count == $how_many
         */
    }

    # tested ✅
      public function apply_function_to_column($function, $table_name, $column_name, $condition_column = null, $condition_value = null) {
        if ($condition_column && $condition_value) {
            $sql = "SELECT $function($column_name) AS result FROM $table_name WHERE $condition_column = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $condition_value);
        } else {
            $sql = "SELECT $function($column_name) AS result FROM $table_name";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['result'];
    }
    public function DBinsert($stmt)
    {
      $result = $this->conn->query($stmt);
      if ($result === true) {
        return true;
      } else {
        return false;
      }
    }

    public function getLastId(){
        return $this->conn->insert_id;
    }

    

}
?>