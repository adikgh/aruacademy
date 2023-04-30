<?php include "../../config/core.php";



   // 
	if(isset($_GET['add_work'])) {
		$id = strip_tags($_POST['id']);
		$txt = strip_tags($_POST['txt']);
      $sql = db::query("INSERT INTO `home_work`(`homework_id`, `user_id`, `txt`, `ins_dt`) VALUES ('$id', '$user_id', '$txt', '$datetime')");
		if ($sql) echo 'yes';
      exit();
	}

   // 
	// if(isset($_GET['del_review'])) {
	// 	$id = strip_tags($_POST['id']);
   //    $sql = db::query("DELETE FROM `home_work` where id = '$id'");
	// 	if ($sql) echo 'yes';
   //    exit();
	// }