<?php
class category{
 
    // database connection and table name
    private $conn;
    private $table_name = "catagory";
 
    // object properties
    public $id;
    public $name;
    public $catName;
    public $status;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    public function read(){
     
        // select all query
        $query = "SELECT * FROM `catagory` WHERE `status`=1";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    public function create($catName){
     
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, status=:status ";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->name=htmlspecialchars(strip_tags($catName));
        $this->status =1;
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":status", $this->status);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }
}