<?php include dirname(__FILE__)."/../../config/core_edu.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /education/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
			$category = fun::category($cours_d['category_id']);
			$autor = fun::autor($cours_d['autor_id']);
			
			$buy = fun::user_buy($cours_id, $user_id);
			if ($buy == 1) $buy_d = fun::buy($cours_id, $user_id);
			else if ($buy == 2) $buy_d = fun::sub_buy2(1, $user_id);

			$home_work = fun::cours_work($cours_id);

		} else header('location: /education/my/');
	} else header('location: /education/my/');

   // Сайттың баптаулары
	$menu_name = 'item';
	$site_set['utop_nm'] = $cours_d['name_'.$lang];
	$site_set['utop_bk'] = 'my';
	if (isset($_GET['back'])) $site_set['utop_bk'] = $_GET['back'];
	$css = ['education/main', 'education/cours', 'education/item'];
	$js = ['education/main'];