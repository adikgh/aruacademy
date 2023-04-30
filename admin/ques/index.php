<?php include "../../config/core_admin.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /admin/');

	// Сайттың баптаулары
	$menu_name = 'ques';
	// $site_set = [
	// 	'header' => 'user',
	// 	'footer' => 'false',
	// 	'ublock' => 'true',
	// 	'utop_nm' => 'Сұрақ-жауап (aнкета)',
   //    'um_menu' => 'true',
	// ];
	$css = ['admin/acc'];
	// $js = [];
?>
<? include "../block/header.php"; ?>

	

<? include "../block/footer.php"; ?>