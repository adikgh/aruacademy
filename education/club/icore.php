<?php include dirname(__FILE__)."/../../config/core_edu.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/');

	// Курс деректері
	$sub_id = 1;
	$sub = db::query("select * from c_sub where id = '$sub_id'");
	$sub = mysqli_fetch_assoc($sub);

	// Жазылымды тексеру
	$buy = fun::sub_buy2($sub_id, $user_id);

   // Сайттың баптаулары
	$menu_name = 'club';
	$site_set['utop_nm'] = $sub['name_'.$lang];
	$site_set['utop_bk'] = 'sub/';
	$site_set['um_menu'] = true;
	$css = ['education/main', 'education/cours', 'education/uitem', 'education/club/main'];
	$js = ['education/main'];