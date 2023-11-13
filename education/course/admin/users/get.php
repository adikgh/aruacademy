<? include "../../../../config/core_edu.php";

   // time
	$ins_dt = $datetime;
	$end_dt = date('Y-m-d H:i:s', strtotime("$datetime +2 month"));

	// add user
	if(isset($_GET['add_user'])) {
		$phone = strip_tags($_POST['phone']);
		$phone_sms = substr_replace($phone, 7, 0, 1);

		$cours_id = strip_tags($_POST['cours_id']);
		$pack_id = strip_tags($_POST['pack_id']);
		$cours_sms_send = @strip_tags($_POST['cours_sms_send']);
		$cours_sms_send = 1;

		$cours = fun::cours($cours_id);
		$cours_name = $cours['name_kz'];
		$pack = fun::pack($pack_id);
		$days = $cours['access']; if ($pack['access']) $days = $pack['access'];
		$end_dt = date('Y-m-d H:i:s', strtotime("$datetime +$days day"));

		$mess = "Cізге «$cours_name.» курсына доступ ашылды. \nСілтеме: https://aruacademy.kz/?c=$cours_id.";
      	$mess2 = "Cізге «$cours_name.» курсына доступ ашылды. \nСайтқа $phone нөміріңіз арқылы кіріңіз. \nСілтеме: https://aruacademy.kz/?cl=$cours_id. \nҚайырлы білім болсын!";

		$user = db::query("SELECT * FROM `user` WHERE phone = '$phone'");
		if (mysqli_num_rows($user) != 0) {
			$user_d = mysqli_fetch_assoc($user);
			$user_id = $user_d['id'];
			$sub = db::query("SELECT * FROM `c_buy` WHERE user_id = '$user_id' and cours_id = '$cours_id'");
			if (mysqli_num_rows($sub) == 0) {

				// if ($pack_id) $ins = db::query("INSERT INTO `course_pay`(`course_id`, `pack_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$pack_id', '$user_id', '$end_dt')"); 
				// else $ins = db::query("INSERT INTO `course_pay`(`course_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$user_id', '$end_dt')");
				// if ($ins) echo 'add'; else echo 'error';
				
				if ($pack_id) $buy_ins = db::query("INSERT INTO `c_buy`(`cours_id`, `pack_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$pack_id', '$user_id', '$end_dt')");
				else $buy_ins = db::query("INSERT INTO `c_buy`(`cours_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$user_id', '$end_dt')");
				
				if ($cours_sms_send) {
					$sms_send = @list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
					$sms_save = @fun::sms_save($sms_send, $user_id);

					// $send_sms = $sms_api->send_sms($phone_sms, $mess);
					// if (get_balance() > 50) $sms_send = list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
				}
				echo 'add';
			} else echo 'yes';
		} else {
			// if ($cours_sms_send) $user_ins = db::query("INSERT INTO `user`(`phone`) VALUES ('$phone')");
			// else 
			$user_ins = db::query("INSERT INTO `user`(`phone`, `password`) VALUES ('$phone', '123456')");
			if ($user_ins) {
				$user_d = mysqli_fetch_assoc(db::query("SELECT * FROM `user` WHERE phone = '$phone'"));
				$user_id = $user_d['id'];
            
				if ($pack_id) $buy_ins = db::query("INSERT INTO `c_buy`(`cours_id`, `pack_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$pack_id', '$user_id', '$end_dt')");
				else $buy_ins = db::query("INSERT INTO `c_buy`(`cours_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$user_id', '$end_dt')");

				if ($cours_sms_send) {
					$sms_send = list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess2, 0, 0, 0, 0, false);
					$sms_save = fun::sms_save($sms_send, $user_id);
				}
            echo 'add';
			}
		}

		// print_r($sms_send);
		// echo $sms_save;
		// echo $sms_send[0];

		exit();
	}

	// add user mail
	if(isset($_GET['add_umail'])) {
		$mail = strip_tags($_POST['mail']);
		$cours_id = strip_tags($_POST['cours_id']);
		$pack_id = strip_tags($_POST['pack_id']);

		$cours = fun::cours($cours_id);
		$cours_name = $cours['name_kz'];
		$pack = fun::pack($pack_id);
		$days = $cours['access']; if ($pack['access']) $days = $pack['access'];
		$end_dt = date('Y-m-d H:i:s', strtotime("$datetime +$days day"));

		$mess = "Cізге «$cours_name.» курсына доступ ашылды. \nСілтеме: https://aruacademy.kz/?cm=$cours_id&mail. \nҚайырлы білім болсын!";
      	$mess2 = "Cізге «$cours_name.» курсына доступ ашылды. \nСайтқа $mail почтаңыз арқылы кіріңіз. \nСілтеме: https://aruacademy.kz/?cml=$cours_id&mail. \nҚайырлы білім болсын!";

		$user = db::query("SELECT * FROM `user` WHERE mail = '$mail'");
		if (mysqli_num_rows($user) != 0) {
			$user_d = mysqli_fetch_assoc($user);
			$user_id = $user_d['id'];
			$sub = db::query("SELECT * FROM `c_buy` WHERE user_id = '$user_id' and pack_id = '$pack_id'");
			if (mysqli_num_rows($sub) == 0) {
				db::query("INSERT INTO `c_buy`(`cours_id`, `pack_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$pack_id', '$user_id', '$end_dt')");
				fun::send_mail($mail, $mess);
				echo 'add';
			} else echo 'yes';
		} else {
			$sql = db::query("INSERT INTO `user`(`mail`) VALUES ('$mail')");
			if ($sql) {
				$user_date = mysqli_fetch_assoc(db::query("SELECT * FROM `user` WHERE mail = '$mail'"));
				$user_id = $user_date['id'];
				db::query("INSERT INTO `c_buy`(`cours_id`, `pack_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$pack_id', '$user_id', '$end_dt')");
				fun::send_mail($mail, $mess2);
				echo 'add';
			}
		}
		exit();
	}


   // user delete
	if(isset($_GET['user_del'])) {
		$id = strip_tags($_POST['id']);
		$buy = db::query("delete FROM `c_buy` WHERE id = '$id'");
		echo 'yes';
		exit();
	}

	// sms_send
	if(isset($_GET['sms_send'])) {

		$cours_id = strip_tags($_POST['cours_id']);
		$user_id = strip_tags($_POST['user_id']);

		$sub = db::query("SELECT * FROM `c_sub` WHERE cours_id = '$cours_id' and user_id = '$user_id");
		$user = db::query("SELECT * FROM `user` WHERE id = '$user_id'");
		$user_date = mysqli_fetch_assoc($user);
		$phone = $user_date['phone'];
		$code = $user_date['code'];

		$mess = "Иммунити курсы.\nТексеру коды: $code\nСілтеме: https://aruacademy.kz/l/?c=$cours_id";
		list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);

		echo 'yes';
		exit();
	}



	// sms_send_all
	// if(isset($_GET['sms_send_all'])) {

	// 	$cours_id = strip_tags($_POST['cours_id']);
	// 	$sub = db::query("SELECT * FROM `cours_sub` WHERE cours_id = '$cours_id'");
	// 	while ($sub_date = mysqli_fetch_assoc($sub)) {

	// 		$user_id = $sub_date['user_id'];
	// 		$user = db::query("SELECT * FROM `user` WHERE id = '$user_id'");
	// 		$user_date = mysqli_fetch_assoc($user);
	// 		$phone = $user_date['phone'];
	// 		$code = $user_date['code'];
	
	// 		$mess = "Иммунити курсы.\nТексеру коды: $code\nСілтеме: https://aruacademy.kz/?c=$cours_id";
	// 		list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);

	// 	}
	// 	echo 'yes';

	// 	exit();
	// }