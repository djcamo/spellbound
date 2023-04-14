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
    if ($params[4]['value'] == 'on') {
        $active = 1;
    } else {
        $active = 0;
    }
    if ($params[0]["value"] == '') {
        $temp = explode(" ",$params[1]['value']);
        if($temp[1]){
            $temp1 = implode("-",$temp);
            $slug = strtolower($temp1) . ".php";
        }else{
            $slug = strtolower($temp[0]) . ".php";
        }
        //add new product
        $sql = "INSERT INTO products(product_name,slug,product_description,product_price,active,created) VALUES (?,?,?,?,?,UTC_TIMESTAMP())";
        $ref = $pdo->prepare($sql);
        try {
            $ref->execute([$params[1]['value'],$slug,$params[5]['value'],$params[2]['value'],$active]);
            $lastId = $pdo->lastInsertId();
            //add entry into product_categories table
            $sql = "INSERT INTO product_categories(product_id,categoryId) VALUES (?,?)";
            $ref = $pdo->prepare($sql);
            try {
                $ref->execute([$lastId,$params[3]["value"]]);
                echo json_encode('0');
            } catch (PDOException $ex){
                echo $ex->getMessage();
            }
        } catch (PDOException $ex){
            echo $ex->getMessage();
        }
    } else {
        //update product
        $sql = 'UPDATE products SET product_name = ?, product_description = ?, product_price = ?, active = ?, modified = UTC_TIMESTAMP() WHERE product_id = ?';
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
    if ($params[2]['value'] == 'on') {
        $active = 1;
    } else {
        $active = 0;
    }
    if ($params[0]["value"] == '') {
        $temp = explode(" ",$params[1]['value']);
        if($temp[1]){
            $temp1 = implode("-",$temp);
            $url = strtolower($temp1) . ".php";
        }else{
            $url = strtolower($temp[0]) . ".php";
        }
        //new category
        $sql = "INSERT INTO categories(category_name,category_description,`url`,active,created) VALUES (?,?,?,?,UTC_TIMESTAMP())";
        $ref = $pdo->prepare($sql);
        try {
            $ref->execute([$params[1]['value'],$params[3]['value'],$url,$active]);
            echo json_encode('0');
        } catch (PDOException $ex){
            echo $ex->getMessage();
        }
    } else {
        //update category
        $sql = 'UPDATE categories SET category_name = ?, category_description = ?, active = ?, modified = UTC_TIMESTAMP() WHERE category_id = ?';
        $ref = $pdo->prepare($sql);
        try {
            $ref->execute([$params[1]['value'],$params[3]['value'],$active,$params[0]['value']]);
            echo json_encode(0);
        } catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
}
