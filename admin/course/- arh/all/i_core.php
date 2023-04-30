<?php include dirname(__FILE__)."/../../../config/core.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
			$category = fun::category($cours_d['category_id']);
			$autor = fun::autor($cours_d['autor_id']);
			// $bookmark = fun::bookmark($cours_d['id'], $user_id);
			
		} else header('location: /user/cours/');
	} else header('location: /user/cours/');

	// Жазылымды тексеру
	if (!$user_right) {
		$buy = db::query("select * from c_buy where cours_id = '$cours_id' and user_id = '$user_id'");
		$sub_buy = db::query("select * from c_sub_buy where sub_id = 1 and user_id = '$user_id'");
		$cours_sub = db::query("select * from c_sub_item where cours_id = '$cours_id'");
		if (!mysqli_num_rows($buy) && (!mysqli_num_rows($sub_buy) || !mysqli_num_rows($cours_sub))) header('location: /user/cours/item/info/?id='.$cours_id);
	}

   // Сайттың баптаулары
	$menu_name = 'item';
	$site_set = [
		'utop_nm' => $cours_d['name_'.$lang],
		'utop_bk' => 'cours',
	];
	if (isset($_GET['back'])) $site_set['utop_bk'] = $_GET['back'];
	$css = ['user', 'ucours', 'uitem'];
	$js = ['user'];