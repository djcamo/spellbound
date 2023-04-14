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
    try {

        $sql = 'SELECT * FROM products WHERE slug = :slug';
        $ref = $pdo->prepare($sql);
        $ref->bindParam(':slug', $slug, PDO::PARAM_STR);
        $ref->execute();
        $result = $ref->fetchAll();
        
        echo json_encode($result);
    }catch(PDOException $e){
        $errorMessage = $e->getMessage();
        die($errorMessage);
    }