<?php include "../../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/sign_in.php');

	if ($_GET['type'] == 'club') $cours = db::query("select * from c_sub_item");
	else $cours = db::query("select * from cours where	home_work = 1");

	// Сайттың баптаулары
	$menu_name = 'test';
	$site_set = [
		'utop_bk' => '/',
		'utop_nm' => 'Тесттер',
	];
	$css = ['user', 'uhomework'];
	$js = ['user'];
?>
<?php include "../../../block/header.php"; ?>



<?php include "../../../block/footer.php"; ?>