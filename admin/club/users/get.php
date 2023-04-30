<? include "../icore.php";

   // time
	$ins_dt = $datetime;
	$end_dt = date('Y-m-d H:i:s', strtotime("$datetime +12 month"));


   // add user
	if(isset($_GET['add_user'])) {
		$phone = strip_tags($_POST['phone']);
      $mess = "Cізге «Даму» клубына доступ ашылды. \nСілтеме: https://aruacademy.kz/?sub. \nҚайырлы білім болсын!";
      $mess2 = "Cізге «Даму» клубына доступ ашылды. \nСайтқа $phone нөміріңіз арқылы кіріңіз. \nСілтеме: https://aruacademy.kz/?sub. \nҚайырлы білім болсын!";

		$user = db::query("SELECT * FROM `user` WHERE phone = '$phone'");
		if (mysqli_num_rows($user) != 0) {
			$user_d = mysqli_fetch_assoc($user);
			$user_id = $user_d['id'];
			$buy = db::query("SELECT * FROM `c_sub_buy` WHERE user_id = '$user_id'");
			if (mysqli_num_rows($buy) == 0) {
				db::query("INSERT INTO `c_sub_buy`(`sub_id`, `user_id`, `ins_dt`, `end_dt`) VALUES (1, '$user_id', '$ins_dt', '$end_dt')");
				list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
				echo 'add';
			} else echo 'yes';
		} else {
			$sql = db::query("INSERT INTO `user`(`phone`, `ins_dt`) VALUES ('$phone', '$ins_dt')");
			if ($sql) {
				$user_d = mysqli_fetch_assoc(db::query("SELECT * FROM `user` WHERE phone = '$phone'"));
				$user_id = $user_d['id'];
            db::query("INSERT INTO `c_sub_buy`(`sub_id`, `user_id`, `ins_dt`, `end_dt`) VALUES (1, '$user_id', '$ins_dt', '$end_dt')");
            list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess2, 0, 0, 0, 0, false);
            echo 'add';
			}
		}
		exit();
	}

	// add user mail
	if(isset($_GET['add_umail'])) {
		$mail = strip_tags($_POST['mail']);
      $txt = "Cізге «Даму» клубына доступ ашылды. \nСілтеме: https://aruacademy.kz/?sub&mail. \nҚайырлы білім болсын!";
      $txt2 = "Cізге «Даму» клубына доступ ашылды. \nСайтқа $mail почтаңыз арқылы кіріңіз. \nСілтеме: https://aruacademy.kz/?sub&mail. \nҚайырлы білім болсын!";

		$user = db::query("SELECT * FROM `user` WHERE mail = '$mail'");
		if (mysqli_num_rows($user) != 0) {
			$user_d = mysqli_fetch_assoc($user);
			$user_id = $user_d['id'];

			$buy = db::query("SELECT * FROM `c_sub_buy` WHERE user_id = '$user_id'");
			if (mysqli_num_rows($buy) == 0) {
            db::query("INSERT INTO `c_sub_buy`(`sub_id`, `user_id`, `ins_dt`, `end_dt`) VALUES (1, '$user_id', '$ins_dt', '$end_dt')");
				fun::send_mail($mail, $txt);
            echo 'add';
			} else echo 'yes';
		} else {
			$sql = db::query("INSERT INTO `user`(`mail`, `ins_dt`) VALUES ('$mail', '$ins_dt')");
			if ($sql) {
				$user_d = mysqli_fetch_assoc(db::query("SELECT * FROM `user` WHERE mail = '$mail'"));
				$user_id = $user_d['id'];
            db::query("INSERT INTO `c_sub_buy`(`sub_id`, `user_id`, `ins_dt`, `end_dt`) VALUES (1, '$user_id', '$ins_dt', '$end_dt')");
            fun::send_mail($mail, $txt2);
            echo 'add';
			}
		}
		exit();
	}


   // sms_send
	if(isset($_GET['sms_send'])) {

		$id = strip_tags($_POST['id']);
		$sub_buy_d = fun::sub_buy($id);
		$user_d = fun::user($sub_buy_d['user_id']);
		$phone = $user_d['phone'];
		$mail = $user_d['mail'];

      if ($phone) {
         $mess = "Cізге «Даму» клубына доступ ашылды. \nСайтқа $phone нөміріңіз арқылы кіріңіз. \nСілтеме: https://aruacademy.kz/?sub. \nҚайырлы білім болсын!";
         list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
      }
      if ($mail) {
         $txt2 = "Cізге «Даму» клубына доступ ашылды. \nСайтқа $mail почтаңыз арқылы кіріңіз. \nСілтеме: https://aruacademy.kz/?sub. \nҚайырлы білім болсын!";
         fun::send_mail($mail, $txt2);
      }

		echo 'yes';
		exit();
	}


   // user delete
	if(isset($_GET['user_del'])) {
		$id = strip_tags($_POST['id']);
		$buy = db::query("delete from `c_sub_buy` where id = '$id'");
		echo 'yes';
		exit();
	}

   // user buy_off
	if(isset($_GET['buy_off'])) {
		$id = strip_tags($_POST['id']);
		$off = strip_tags($_POST['off']);
      if ($off == 1) $buy = db::query("update `c_sub_buy` set off = '$off' where id = '$id'");
      else $buy = db::query("update `c_sub_buy` set off = null where id = '$id'");
		echo 'yes';
		exit();
	}



	// sms_send_all
	if(isset($_GET['sms_send_all'])) {
		$sub = db::query("SELECT * FROM `c_sub_buy`");
		while ($buy_d = mysqli_fetch_assoc($sub)) {
			$user_id = $buy_d['user_id'];
			$user_d = db::query("SELECT * FROM `user` WHERE id = '$user_id'");
			$user_d = mysqli_fetch_assoc($user_d);
			$user_name = $user_d['name'];
			$phone = $user_d['phone'];

			// if ($user_d['password']) $mess = "Қымбатты «Даму» клубының ханшайымы $user_name, біздің чатымызға қосылуыңызды сұраймын, cілтеме: https://t.me/+UY2bOVO-bM5jMTcy. \nКлуб сабақтары сайтта өтеді, қосымша ақпараттар сайтымызда, cілтеме: https://aruacademy.kz/?sub.";
			// else $mess = "Қымбатты «Даму» клубының ханшайымы, біздің чатымызға қосылуыңызды сұраймын, cілтеме: https://t.me/+UY2bOVO-bM5jMTcy. \nКлуб сабақтарына әлі кірмепсіз, қосымша ақпараттар біздің сайтымызда, cілтеме: https://aruacademy.kz/?sub.";
			// $mess = "Қымбатты $user_name ханымы! Клубымызда алғашқы экспертіміздің әйелдерге арналған тайм менеджмент сабағы шықты, cілтеме: https://aruacademy.kz/?subm=2";
			// $mess = "Қымбатты «Даму» клубының қатысушысы! Клубымызда екінші экспертіміздің «Дауыспен әсер ету құпиясы» сабағы шықты, cілтеме: https://aruacademy.kz/?subm=4";
			$mess = "Қымбатты «Даму» клубының қатысушысы! Клубымызда Ару Сағидың «Сепарация» вебинары шықты, cілтеме: https://aruacademy.kz/?c=14";
			$sn = list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
		}
		// echo $user_name;
		// var_dump($sn);
		echo 'yes';

		exit();
	}































