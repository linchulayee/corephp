<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../object/category.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$category = new category($db);
 
// query products
$stmt = $category->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $cat_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $cat_item=array(
            "category_id" => $id,
            "category_name" => html_entity_decode($name)
        );
 
        array_push($cat_arr, $cat_item);
    }
 
   # echo json_encode($cat_arr);
    echo json_encode(
        array("message" => "No category found.")
    );
}
 
else{
    echo json_encode(
        array("message" => "No category found.")
    );
}
?>