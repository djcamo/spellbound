<?php

include("conn_pdo.php");

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if ($contentType === "application/json") {
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
    extract($decoded);
}else{
    extract($_POST);
}

switch ($type) {
    case 'p':
        $table = "products";
        $field = "product_id";
        break;
    case 'c':
        $table = "categories";
        $field = "category_id";
        break;
    default:
        # code...
        break;
}

$sql = "DELETE FROM $table WHERE $field = $id";
$db->query($sql);
echo json_encode('0');