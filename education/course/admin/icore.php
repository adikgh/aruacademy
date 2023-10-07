<? include dirname(__FILE__)."/../../config/core_admin.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /admin/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
			$category = fun::category($cours_d['category_id']);
			$autor = fun::autor($cours_d['autor_id']);
			
			$home_work = fun::cours_work($cours_id);

		} else header('location: /admin/list/');
	} else header('location: /admin/list/');

   // Сайттың баптаулары
	$menu_name = 'item';
	$site_set['utop_nm'] = $cours_d['name_'.$lang];
	$site_set['utop_bk'] = 'list';
	if (isset($_GET['back'])) $site_set['utop_bk'] = $_GET['back'];
	$css = ['admin/cours', 'admin/item'];
	$js = ['admin/cours'];