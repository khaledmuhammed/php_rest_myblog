<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog category object
$category = new Category($db);

// Blog post query 
$result = $category->read();
// Get row count
$num = $result->rowCount();

// Check if posts
if($num > 0){
// post array
$category_arr = array();
$categories_arr['data'] = array();

while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $category_item = array(
        'id' => $id,
        'name' => $name
    );
    // Push to "data"
    array_push($categories_arr['data'], $category_item);
}
// Turn to json
echo json_encode($categories_arr);

} else{
// No Posts
echo json_encode(
    array('message' => 'No Categories Found')
);
}
