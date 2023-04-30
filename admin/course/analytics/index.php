<?php include "../../../config/core.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours = mysqli_fetch_assoc($cours);
			$category = fun::category($cours['category_id']);
			$autor = fun::autor($cours['autor_id']);
			$bookmark = fun::bookmark($cours['id'], $user_id);
			$pack = db::query("select * from c_pack where cours_id = '$cours_id'");
			
			$sub = db::query("select * from c_sub where cours_id = '$cours_id' and user_id = '$user_id'");
			if (mysqli_num_rows($sub) == 1 && !$user_right) { 
				$sub_i = mysqli_fetch_array($sub);
				$pack_id = $sub_i['pack_id'];
				$pack = db::query("select * from c_pack where id = '$pack_id'");
			} else { $sub_i = 0; }
			
		} else { header('location: /user/cours/'); }
	} else { header('location: /user/cours/'); }
	
	
	// Сайттың баптаулары
	$menu_name = 'item';
   $pod_menu_name = 'analytics';
	$site_set = [
		'header' => 'user',
		'm_header' => 'item',
		'footer' => 'false',
		'ublock' => 'true',
		'utop_nm' => $cours['name'],
		'utop_bk' => 'cours',
	];
	$css = ['user', 'uitem'];
	$js = ['user', 'admin'];
	
?>
<?php include "../../../block/header.php"; ?>

	<div class="uitem">

		<!-- item header -->
		<?php include "../i_header.php"; ?>


	</div>


<?php include "../../../block/footer.php"; ?>