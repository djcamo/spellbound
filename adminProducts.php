<?php
	include("config/template.class.php");
	$data = new Template("views/pages/_adminProducts.html");
	$layout = new Template("views/layouts/_admin_layout.html");
	$header = new Template("views/partials/_admin_header.html");
    $menu = new Template("views/partials/_admin_menu.html");
    $layout->set("title", "");
    $layout->set("desc", "");
	$layout->set("content", $data->output());
	$layout->set("header", $header->output());
    $layout->set("menu", $menu->output());
	echo $layout->output();