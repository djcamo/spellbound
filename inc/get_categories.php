<?php
    include("conn_pdo.php");
    try {
        $sql = 'SELECT * FROM categories WHERE active = 1 ORDER BY category_name';
        $ref = $pdo->prepare($sql);
        $ref->execute();
        $result = $ref->fetchAll();
        echo json_encode($result);
    }catch(PDOException $e){
        $errorMessage = $e->getMessage();
        die($errorMessage);
    }