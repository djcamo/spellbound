<?php
	include("config/template.class.php");
	$data = new Template("views/pages/_about.html");
	$layout = new Template("views/layouts/_layout.html");
	$header = new Template("views/partials/_header.html");
	$footer = new Template("views/partials/_footer.html");
    $layout->set("title", "About Spellbound Magical Gifts");
    $layout->set("desc", "");
	$layout->set("content", $data->output());
	$layout->set("header", $header->output());
	$layout->set("footer", $footer->output());
	echo $layout->output();
?>