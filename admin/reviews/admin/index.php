<?php include "../../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/sign_in.php');

	// Сайттың баптаулары
	$menu_name = 'reviews';
	$site_set = [
		'header' => 'user',
		'footer' => 'false',
		'ublock' => 'true',
		'utop_nm' => 'Пікірлер',
      'um_menu' => 'true',
	];
	$css = ['user', 'uacc'];
	$js = ['user'];
?>
<?php include "../../../block/header.php"; ?>



<?php include "../../../block/footer.php"; ?>