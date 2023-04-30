<?php include "../../../config/core.php";



   // add_chat_item
	if(isset($_GET['add_chat_item'])) {
		$id = strip_tags($_POST['id']);
		$txt = $_POST['txt'];
		$u_id = strip_tags($_POST['u_id']);
		$chat_d = fun::chat($u_id);
		
		if ($chat_d == 0) {
			$chat_ins = db::query("INSERT INTO `h_chat`(`user_id`, `ins_dt`, `ubd_dt`) VALUES ('$u_id', '$datetime', '$datetime')");
			$chat = db::query("select * from h_chat where user_id = '$u_id'");
			$chat_d = mysqli_fetch_assoc($chat);
			$id = $chat_d['id'];
			$sql = db::query("INSERT INTO `h_chat_item`(`chat_id`, `user_id`, `txt`, `ins_dt`) VALUES ('$id', '$user_id', '$txt', '$datetime')");
		} else {
			$sql = db::query("INSERT INTO `h_chat_item`(`chat_id`, `user_id`, `txt`, `ins_dt`) VALUES ('$id', '$user_id', '$txt', '$datetime')");
			$ubd = db::query("UPDATE `h_chat` SET `ubd_dt`='$datetime' WHERE id = '$id'");
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



	// 
	if(isset($_GET['add_chat_all'])) {
		$type = strip_tags($_POST['type']);
		$txt = $_POST['txt'];

		if ($type == 'club') $users = db::query("select * from c_sub_buy");
		else $users = db::query("select * from user");

		while ($user_d = mysqli_fetch_assoc($users)) {
			if ($type == 'club') $user_d = fun::user($user_d['user_id']);
			$chat_d = fun::chat($user_d['id']);
			$id = $chat_d['id'];
			if ($chat_d == 0) {
				$u_id = $user_d['id'];
				$chat_ins = db::query("INSERT INTO `h_chat`(`user_id`, `ins_dt`, `ubd_dt`) VALUES ('$u_id', '$datetime', '$datetime')");
				$chat = db::query("select * from h_chat where user_id = '$u_id'");
				$chat_d = mysqli_fetch_assoc($chat);
				$id = $chat_d['id'];
				$sql = db::query("INSERT INTO `h_chat_item`(`chat_id`, `user_id`, `txt`, `ins_dt`) VALUES ('$id', '$user_id', '$txt', '$datetime')");
			} else $sql = db::query("INSERT INTO `h_chat_item`(`chat_id`, `user_id`, `txt`, `ins_dt`) VALUES ('$id', '$user_id', '$txt', '$datetime')");
		}

		if ($sql) echo 'yes';		
		exit();
	}