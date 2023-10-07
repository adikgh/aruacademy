<? include dirname(__FILE__)."/../../config/core_edu.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /education/');


	// Курс деректері
	// if (isset($_GET['id']) || $_GET['id'] != '') {
	// 	$cours_id = $_GET['id'];
	// 	$cours = db::query("select * from cours where id = '$cours_id'");
	// 	if (mysqli_num_rows($cours)) {
	// 		$cours_d = mysqli_fetch_assoc($cours);
	// 		$category = fun::category($cours_d['category_id']);
	// 		$autor = fun::autor($cours_d['autor_id']);
			
	// 		$buy = fun::user_buy($cours_id, $user_id);
	// 		if ($buy == 1) $buy_d = fun::buy($cours_id, $user_id);
	// 		else if ($buy == 2) $buy_d = fun::sub_buy2(1, $user_id);

	// 		$home_work = fun::cours_work($cours_id);

	// 	} else header('location: /education/my/');
	// } else header('location: /education/my/');


	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
			// if ($course_d['info']) $course_d = array_merge($course_d, fun::course_info($course_d['id']));
		} else header('location: /education/my/');
	} else header('location: /education/my/');

	// Тариф деректері
	$pack_all = db::query("select * from c_pack where cours_id = '$cours_id' order by number asc");
	
	// Жазылымды тексеру
	// $buy = db::query("select * from c_buy where cours_id = '$cours_id' and user_id = '$user_id' limit 1");
	$buy = fun::user_buy($cours_id, $user_id);
	if ($buy == 1) {
		$buy_d = fun::buy($cours_id, $user_id);
		if ($buy_d['pack_id']) $pack_id = $buy_d['pack_id'];
	} else if ($buy == 2) {
		$buy_d = fun::sub_buy2(1, $user_id);
		if ($buy_d['pack_id']) $pack_id = $buy_d['pack_id'];
	} else $buy = 0;
			
	// Тариф деректері
	if (!$buy || !$pack_id) {
		if (mysqli_num_rows($pack_all)) {
			if (isset($_GET['pack_id']) || $_GET['pack_id'] != '') {
				$pack_id = $_GET['pack_id'];
				$pack = db::query("select * from c_pack where id = '$pack_id'");
				if (mysqli_num_rows($pack)) $pack_dd = mysqli_fetch_assoc($pack);
			} else {
				$pack_dd = mysqli_fetch_assoc(db::query("select * from c_pack where cours_id = '$cours_id' order by number asc limit 1"));
				$pack_id = $pack_dd['id'];
			}
		}
	}
	
	// Блок деректері
	if ($pack_id) $block = db::query("select * from c_block where pack_id = '$pack_id' order by number asc");
	else $block = db::query("select * from c_block where cours_id = '$cours_id' order by number asc");








   // Сайттың баптаулары
	$menu_name = 'item';
	$site_set['utop_nm'] = $cours_d['name_'.$lang];
	$site_set['utop_bk'] = 'my';
	if (isset($_GET['back'])) $site_set['utop_bk'] = $_GET['back'];
	$css = ['education/main', 'education/cours', 'education/item'];
	$js = ['education/main'];