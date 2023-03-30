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

switch ($params[0]["name"]) {
    case 'productId':
        updateProduct($params,$pdo);
        break;
    case 'categoryId':
        updateCategory($params,$pdo);
    default:
        # code...
        break;
}

function updateProduct($params,$pdo){

    if ($params[0]["value"] == '') {
        //new product
    } else {
        //update product
        if ($params[4]['value'] == 'on') {
            $active = 1;
        } else {
            $active = 0;
        }
        $sql = 'UPDATE products SET product_name = ?, product_description = ?, product_price = ?, active = ? WHERE product_id = ?';
        $ref = $pdo->prepare($sql);
        try {
            $ref->execute([$params[1]['value'],$params[5]['value'],$params[2]['value'],$active,$params[0]['value']]);
            echo json_encode(0);
        } catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
}

function updateCategory($params,$pdo){
    if ($params[0]["value"] == '') {
        //new category
    } else {
        //update category
        if ($params[4]['value'] == 'on') {
            $active = 1;
        } else {
            $active = 0;
        }
        $sql = 'UPDATE categories SET category_name = ?, category_description = ?, active = ? WHERE category_id = ?';
        $ref = $pdo->prepare($sql);
        try {
            $ref->execute([$params[1]['value'],$params[5]['value'],$params[2]['value'],$active,$params[0]['value']]);
            echo json_encode(0);
        } catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
}
