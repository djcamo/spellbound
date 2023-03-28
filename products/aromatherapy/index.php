<?php
	include("../../config/template.class.php");
	include("../../inc/conn_pdo.php");

	$slug = $_GET['p'];

	$sql = 'SELECT * FROM products WHERE slug = :slug';
	$ref = $pdo->prepare($sql);
	$ref->bindParam(':slug', $slug, PDO::PARAM_STR);
	$ref->execute();
	$result = $ref->fetchAll();
	

	$data = new Template("../../views/pages/_product.html");
	$layout = new Template("../../views/layouts/_layout.html");
	$header = new Template("../../views/partials/_header.html");
	$footer = new Template("../../views/partials/_footer.html");
    $layout->set("title", $result[0]['product_name']);
    $layout->set("desc", "A unique metaphysical gift shop in Gawler, SA, specialising in gemstones, books, jewellery, incense, salt lamps, essential oils, tarot & oracle cards.");
	$layout->set("content", $data->output());
	$layout->set("header", $header->output());
	$layout->set("footer", $footer->output());
	echo $layout->output();