<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "product";
 
    // object properties
    public $id;
    public $name;
    public $status =1;
    public $category_id;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // used for paging products
    public function getProducts(){
        $query = "SELECT *  FROM  product where `status`=1";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    // create product
    public function create($productName,$catID){
     
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    product_name=:name, status=:status, cat_id=:category_id ";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->name=htmlspecialchars(strip_tags($productName));
        $this->category_id=htmlspecialchars(strip_tags($catID));
     
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":category_id", $this->category_id);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }
}