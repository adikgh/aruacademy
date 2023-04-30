<?php include "../../config/core_edu.php";



   // add_chat_item
	if(isset($_GET['add_chat_item'])) {
		$id = strip_tags($_POST['id']);
		$txt = $_POST['txt'];
		$chat_d = fun::chat($user_id);
		
		if ($chat_d == 0) {
			$ins = db::query("INSERT INTO `h_chat`(`user_id`, `ins_dt`, `ubd_dt`) VALUES ('$user_id', '$datetime', '$datetime')");
			$sel = db::query("select * from h_chat where user_id = '$user_id'");
			if (mysqli_num_rows($sel)) {
				$chat_d = mysqli_fetch_assoc($sel);
				$id = $chat_d['id'];
				$sql = db::query("INSERT INTO `h_chat_item`(`chat_id`, `txt`, `ins_dt`) VALUES ('$id', '$txt', '$datetime')");
			}
		} else {
			$sql = db::query("INSERT INTO `h_chat_item`(`chat_id`, `txt`, `ins_dt`) VALUES ('$id', '$txt', '$datetime')");
			$ubd = db::query("UPDATE `h_chat` SET `ubd_dt`='$datetime', `view` = null WHERE id = '$id'");
		} 

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