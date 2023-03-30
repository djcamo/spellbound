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
    case 'cat':
        $sql = "SELECT * FROM categories WHERE category_id = :id";
        break;
    case 'prod':
        $sql = "SELECT * FROM products INNER JOIN product_categories ON product_categories.product_id = products.product_id WHERE products.product_id = :id";
        break;
    default:
        # code...
        break;
}

try {


    $ref = $pdo->prepare($sql);
    $ref->bindParam(':id', $id, PDO::PARAM_STR);
    $ref->execute();
    $result = $ref->fetchAll();

    echo json_encode($result);
}catch(PDOException $e){
    $errorMessage = $e->getMessage();
    die($errorMessage);
}