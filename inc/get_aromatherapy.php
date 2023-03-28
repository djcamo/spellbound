<?php
    include("conn_pdo.php");
    try {
        $sql = 'SELECT * FROM products INNER JOIN product_categories ON products.product_id = product_categories.product_id WHERE categoryId = 2 ORDER BY product_name';
        $ref = $pdo->prepare($sql);
        $ref->execute();
        $result = $ref->fetchAll();
        echo json_encode($result);
    }catch(PDOException $e){
        $errorMessage = $e->getMessage();
        die($errorMessage);
    }