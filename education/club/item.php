<?php

	$id = $_GET['id'];
	$cat_id = $_GET['cat'];
	if ($cat_id == 1) header('location: /education/course/?id='.$id.'&back=club');
	elseif ($cat_id == 3) header('location: /education/course/?id='.$id.'&back=club');
	elseif ($cat_id == 2) header('location: /education/masterclass/?id='.$id.'&back=club');