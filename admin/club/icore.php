<? include dirname(__FILE__)."/../../config/core_admin.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /admin/');

	// Курс деректері
	$sub_id = 1;
	$sub = db::query("select * from c_sub where id = '$sub_id'");
	$sub = mysqli_fetch_assoc($sub);

	// Жазылымды тексеру
	$buy = fun::sub_buy2($sub_id, $user_id);

   // Сайттың баптаулары
	$menu_name = 'club';
	// $site_set = [
	// 	'utop_nm' => $sub['name_'.$lang],
	// 	'utop_bk' => 'sub/',
	// 	'um_menu' => 'true',
	// ];

	$site_set['um_menu'] = true;
	$site_set['utop'] = false;
	$css = ['admin/cours', 'admin/item', 'admin/club/main'];
	$js = [];