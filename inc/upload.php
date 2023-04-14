<?php

if(isset($_FILES['sample_image']))
{

	$new_name = $_FILES['sample_image']['name'];
	move_uploaded_file($_FILES['sample_image']['tmp_name'], '../assets/img/products/' . $new_name);
	$data = array(
		'image_source' => $new_name
	);
	echo json_encode($data);
}