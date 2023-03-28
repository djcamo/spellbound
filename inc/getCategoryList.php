<?php
include("conn_pdo.php");
try {
    $sql = 'SELECT category_id,category_name FROM categories ORDER BY category_name';
    $ref = $pdo->prepare($sql);
    $ref->execute();
    $result = $ref->fetchAll();
    echo json_encode($result);
}catch(PDOException $e){
    $errorMessage = $e->getMessage();
    die($errorMessage);
}