<?php
// required headers
header("Access-Control-Allow-Origin: *"); 
// include database and object files
include_once '../config/database.php';
include_once '../object/product.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$productClass = new Product($db);
$product = $_POST['product'];
$catId = $_POST['catId'];
// query products
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $productClass->create($product,$catId);
    if($result){
        echo json_encode(
            array("message" => "Product inserted.")
        );
    }
    else{
        echo json_encode(
            array("message" => "Something went wrong.")
        );
    }
}else{
    echo json_encode(
            array("message" => "This is a post request.")
        );
}

?>