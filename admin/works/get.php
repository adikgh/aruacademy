<?php include "../../config/core_admin.php";


   // 
	if(isset($_GET['add_work'])) {
		$id = strip_tags($_POST['id']);
		$txt = strip_tags($_POST['txt']);
      $sql = db::query("INSERT INTO `home_work_item`(`work_id`, `user_id`, `txt`) VALUES ('$id', '$user_id', '$txt')");
      $ubd = db::query("UPDATE `home_work` SET `view` = 1 WHERE id = '$id'");
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






	$token = "1921836439:AAHlW8tYIwG_5yqCVFI_zNcdZJGuERSA6Xo";
	$chat_id = "-569554715";
	// $chat_id = "628893373";


	// send_statistic
	if(isset($_GET['send_statistic'])) {
		$id = strip_tags($_POST['id']);
		$work = db::query("select *, COUNT(`user_id`) AS `count` from home_work where cours_id = '$id' GROUP BY `user_id` HAVING `count` > 0 order by ins_dt desc limit 52, 60");

		$arrs = array();
		$arr = array();
		$txt = '';
		
		while ($work_d = mysqli_fetch_assoc($work)) {
			$user_d = fun::user($work_d['user_id']);
			$lesson_count = fun::work_ls($id, $user_d['id']);
			$phone = $user_d['phone'];
			$name = $user_d['name'].' '.$user_d['surname'];
			if ($name == ' ') $name = '';
			
			$arr = array(
				'id: ' 			=> $user_d['id'],
				// 'Аты-жөні: '	=> $name,
				'Телефон: ' 	=> $phone,
				'Сабақ саны: ' => $lesson_count,
				'Дата: '			=> date("d-m-Y / H:i", strtotime($work_d['ins_dt']))
			);
			foreach ($arr as $key => $value) { $txt .= "<b>".$key."</b> ".$value."%0A"; }
			$txt .= '%0A';
		}
		// array_push($arrs, $arr);
		// echo $txt;

		$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
		if ($sendToTelegram) echo "yes"; else echo "error";

		exit();
	}