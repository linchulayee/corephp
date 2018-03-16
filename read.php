<?php
// required headers
 header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../object/product.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new Product($db);
 
// query products
$stmt = $product->getProducts();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // products array
    $pro_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $pro_item=array(
            "product_id" => $pro_id,
            "cat_name" => html_entity_decode($cat_name),
            "prodcut_name" => html_entity_decode($product_name),
            "cat_id" => $cat_id
        );
 
        array_push($pro_arr, $pro_item);
    }
 
   echo json_encode($pro_arr);

    // echo json_encode(
    //     array("message" => "No category found.")
    // );
}
 
else{
    echo json_encode(
        array("message" => "No product found.")
    );
}
?>