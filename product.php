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
        $query = "SELECT p.id as pro_id, p.cat_id,p.product_name,c.name as cat_name FROM `product` p inner join `catagory` c on c.id = p.cat_id";
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
     
        return $stmt;
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