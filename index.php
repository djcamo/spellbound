<?php
	include("config/template.class.php");
	$data = new Template("views/pages/_home.html");
	$layout = new Template("views/layouts/_layout.html");
	$header = new Template("views/partials/_header.html");
	$footer = new Template("views/partials/_footer.html");
    $layout->set("title", "Spellbound Magical Gifts - the crystal shop in Gawler");
    $layout->set("desc", "A unique metaphysical gift shop in Gawler, SA, specialising in gemstones, books, jewellery, incense, salt lamps, essential oils, tarot & oracle cards.");
	$layout->set("content", $data->output());
	$layout->set("header", $header->output());
	$layout->set("footer", $footer->output());
	echo $layout->output();
?>