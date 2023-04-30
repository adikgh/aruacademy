<?php include "i_core.php";

	$id = $_GET['id'];
	$cat_id = $_GET['cat'];
	if ($cat_id == 1) header('location: /user/cours/item/?id='.$id.'&back=sub');
	elseif ($cat_id == 3) header('location: /user/cours/item/?id='.$id.'&back=sub');
	elseif ($cat_id == 2) header('location: /user/cours/masterclass/?id='.$id.'&back=sub');