<? include "../config/core_edu.php";

	// sign in phone
	if(isset($_GET['phone'])) {
		$phone = strip_tags($_POST['phone']);
		$password = strip_tags($_POST['password']);
		$user = db::query("SELECT * FROM user WHERE phone = '$phone'");
		if (mysqli_num_rows($user)) {
			$user_d = mysqli_fetch_assoc($user);
			if ($password == $user_d['password']) {
				$_SESSION['uph'] = $phone;
				setcookie('uph', $phone, time() + 3600*24*30, '/');
				$_SESSION['ups'] = $password;
				setcookie('ups', $password, time() + 3600*24*30, '/');
				echo 'yes';
			} else if ($user_d['password'] == null) echo 'code';
			else echo 'password';
		} else echo 'phone';
		exit();
	}

	// sign in mail
	if(isset($_GET['smail'])) {
		$mail = strip_tags($_POST['smail']);
		$password = strip_tags($_POST['password']);
		$user = db::query("SELECT * FROM user WHERE mail = '$mail'");
		if (mysqli_num_rows($user)) {
			$user_d = mysqli_fetch_assoc($user);
			if ($password == $user_d['password']) {
				$_SESSION['upm'] = $mail;
				setcookie('upm', $mail, time() + 3600*24*30, '/');
				$_SESSION['ups'] = $password;
				setcookie('ups', $password, time() + 3600*24*30, '/');
				echo 'yes';
			} else if ($user_d['password'] == null) echo 'code';
			else echo 'password';
		} else echo 'mail';
		exit();
	}




	// sign in
	// if(isset($_GET['password'])) {
	// 	$login = strip_tags($_POST['login']);
	// 	$user = db::query("SELECT * FROM user WHERE phone = '$login' and phone is not null");

	// 	if (mysqli_num_rows($user)) {
	// 		$user_d = mysqli_fetch_assoc($user);
			
	// 	} elseif (mysqli_num_rows($user2)) {
	// 		$user_d2 = mysqli_fetch_assoc($user2);
	// 		if ($password == $user_d2['password']) {
	// 			$_SESSION['upm'] = $login;
	// 			$_SESSION['ups'] = $password;
	// 			setcookie('upm', $login, time() + 3600*24*30);
	// 			setcookie('ups', $password, time() + 3600*24*30);
	// 			echo 'yes';
	// 		} else echo 'none';
	// 	} else echo 'none';

	// 	exit();
	// }


	// login 2
	// if(isset($_GET['login2'])) {
	// 	$login = strip_tags($_POST['login']);
	// 	$user = db::query("SELECT * FROM user WHERE phone = '$login' and phone is not null");
	// 	$user2 = db::query("SELECT * FROM user WHERE mail = '$login' and mail is not null");

	// 	if (mysqli_num_rows($user)) {
	// 		$user_d = mysqli_fetch_assoc($user);
	// 		if ($user_d['password'] == null) {
	// 			if ($user_d['code'] != null) {
	// 				$code = $user_d['code'];
	// 				$mess = "Aru Academy | Тексеру коды: $code";
	// 				list($sms_id, $sms_cnt, $cost, $balance) = send_sms($login, $mess, 0, 0, 0, 0, false);
	// 			} else {
	// 				$ins = db::query("UPDATE `user` SET `code`='$code' WHERE phone = '$login'");
	// 				$mess = "Aru Academy | Тексеру коды: $code";
	// 				list($sms_id, $sms_cnt, $cost, $balance) = send_sms($login, $mess, 0, 0, 0, 0, false);
	// 			}
	// 			echo 'code';
	// 		} else echo 'yes';
	// 	} elseif (mysqli_num_rows($user2)) {
	// 		$user_d = mysqli_fetch_assoc($user2);
	// 		if ($user_d['password'] == null) {
	// 			if ($user_d['code'] != null) {
	// 				$code = $user_d['code'];
	// 				$mess = "Aru Academy | Тексеру коды: $code";
	// 				fun::send_mail($mail, $mess);
	// 			} else {
	// 				$ins = db::query("UPDATE `user` SET `code`='$code' WHERE mail = '$login'");
	// 				$mess = "Aru Academy | Тексеру коды: $code";
	// 				fun::send_mail($mail, $mess);
	// 			}
	// 			echo 'code';
	// 		} else echo 'yes';
	// 	} else echo 'none';

	// 	exit();
	// }





	// sign up
	// sign_up_phone
	if(isset($_GET['sign_up_phone'])) {
		$phone = strip_tags($_POST['phone']);
		$phone_sms = substr_replace($phone, 7, 0, 1);

		$user = db::query("SELECT * FROM user WHERE phone = '$phone'");
		if (mysqli_num_rows($user)) {
			$user_d = mysqli_fetch_assoc($user);
			if ($user_d['password'] == null) {
				if ($user_d['code'] != null) {
					$code = $user_d['code'];
					$mess = "Aru Academy | Тексеру коды: $code";
					// list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
					// $send_sms = $sms_api->send_sms($phone_sms, $mess);
					
				} else {
					$ins = db::query("UPDATE `user` SET code = '$code' WHERE phone = '$phone'");
					$mess = "Aru Academy | Тексеру коды: $code";
					// list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
					// $send_sms = $sms_api->send_sms($phone_sms, $mess);
					
				}
				echo 'code';
			} else echo 'password';
		} else echo 'phone';
		exit();
	}
	// code
	if(isset($_GET['sign_up_code'])) {
		$phone = strip_tags($_POST['phone']);
		$code = strip_tags($_POST['code']);
		$user = db::query("SELECT * FROM user WHERE phone = '$phone' and code = '$code'");
		if (mysqli_num_rows($user)) {
			$_SESSION['phone'] = $phone;
			$_SESSION['code'] = $code;
			echo 'yes';
		} else echo 'none';
		exit();
	}
	// sign_up final
	if(isset($_GET['sign_up_final'])) {
		$name = strip_tags($_POST['name']);
		$password = strip_tags($_POST['password']);
		if (isset($_SESSION['phone']) && isset($_SESSION['code'])) {
			$phone = $_SESSION['phone'];
			$code = $_SESSION['code'];
			$upd = db::query("UPDATE `user` SET `name`='$name', `password`='$password' WHERE phone = '$phone' and code = '$code'");
			$_SESSION['uph'] = $phone;
			setcookie('uph', $phone, time() + 3600*24*30, '/');
			$_SESSION['ups'] = $password;
			setcookie('ups', $password, time() + 3600*24*30, '/');
		}
		echo "yes";
		exit();
	}


	// sign_up_mail
	if(isset($_GET['sign_up_mail'])) {
		$mail = strip_tags($_POST['smail']);
		$user = db::query("SELECT * FROM user WHERE mail = '$mail'");
		if (mysqli_num_rows($user)) {
			$user_d = mysqli_fetch_assoc($user);
			if ($user_d['password'] == null) {
				if ($user_d['code'] != null) {
					$code = $user_d['code'];
					$mess = "Aru Academy | Тексеру коды: $code";
					fun::send_mail($mail, $mess);
				} else {
					$ins = db::query("UPDATE `user` SET `code`='$code' WHERE mail = '$mail'");
					$mess = "Aru Academy | Тексеру коды: $code";
					fun::send_mail($mail, $mess);
				}
				echo 'code';
			} else echo 'password';
		} else echo 'mail';
		exit();
	}
	// code
	if(isset($_GET['sign_up_mail_code'])) {
		$mail = strip_tags($_POST['smail']);
		$code = strip_tags($_POST['code']);
		$user = db::query("SELECT * FROM user WHERE mail = '$mail' and code = '$code'");
		if (mysqli_num_rows($user)) {
			$_SESSION['mail'] = $mail;
			$_SESSION['code'] = $code;
			echo 'yes';
		} else echo 'none';
		exit();
	}
	// sign_up final
	if(isset($_GET['sign_up_mail_final'])) {
		$name = strip_tags($_POST['name']);
		$password = strip_tags($_POST['password']);
		if (isset($_SESSION['mail']) && isset($_SESSION['code'])) {
			$mail = $_SESSION['mail'];
			$code = $_SESSION['code'];
			$upd = db::query("UPDATE `user` SET `name`='$name', `password`='$password' WHERE mail = '$mail' and code = '$code'");
			$_SESSION['upm'] = $mail;
			setcookie('upm', $mail, time() + 3600*24*30, '/');
			$_SESSION['ups'] = $password;
			setcookie('ups', $password, time() + 3600*24*30, '/');
		}
		echo "yes";
		exit();
	}





	// pass_reset
	// sign_up_phone
	if(isset($_GET['reset_phone'])) {
		$phone = strip_tags($_POST['phone']);
		$phone_sms = substr_replace($phone, 7, 0, 1);

		$user = db::query("SELECT * FROM user WHERE phone = '$phone'");
		if (mysqli_num_rows($user)) {
			$user_d = mysqli_fetch_assoc($user);
			if ($user_d['code'] != null) {
				$code = $user_d['code'];
				$mess = "Aru Academy | Тексеру коды: $code";
				// list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
				$send_sms = $sms_api->send_sms($phone_sms, $mess);
			} else {
				$ins = db::query("UPDATE `user` SET `code`='$code' WHERE phone = '$phone'");
				$mess = "Aru Academy | Тексеру коды: $code";
				// list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
				$send_sms = $sms_api->send_sms($phone_sms, $mess);
			}
			echo 'code';
		} else echo 'phone';
		exit();
	}
	// code
	if(isset($_GET['reset_code'])) {
		$phone = strip_tags($_POST['phone']);
		$code = strip_tags($_POST['code']);
		$user = db::query("SELECT * FROM user WHERE phone = '$phone' and code = '$code'");
		if (mysqli_num_rows($user)) {
			$_SESSION['phone'] = $phone;
			$_SESSION['code'] = $code;
			echo 'yes';
		} else echo 'none';
		exit();
	}
	// sign_up final
	if(isset($_GET['reset_final'])) {
		$password = strip_tags($_POST['password']);
		if (isset($_SESSION['phone']) && isset($_SESSION['code'])) {
			$phone = $_SESSION['phone'];
			$code = $_SESSION['code'];
			$upd = db::query("UPDATE `user` SET `password`='$password' WHERE phone = '$phone' and code = '$code'");
			$_SESSION['uph'] = $phone;
			setcookie('uph', $phone, time() + 3600*24*30, '/');
			$_SESSION['ups'] = $password;
			setcookie('ups', $password, time() + 3600*24*30, '/');
		}
		echo "yes";
		exit();
	}





	// pass_reset
	// if(isset($_GET['pass_reset'])) {
	// 	$login = strip_tags($_POST['login']);
	// 	$user = db::query("SELECT * FROM user WHERE phone = '$login'");
	// 	$user2 = db::query("SELECT * FROM user WHERE mail = '$login'");

	// 	if (mysqli_num_rows($user)) {
	// 		$sql = db::query("UPDATE `user` SET `code`='$code' WHERE phone = '$login'");
	// 		$mess = "Aru Academy | Тексеру коды: $code";
	// 		list($sms_id, $sms_cnt, $cost, $balance) = send_sms($login, $mess, 0, 0, 0, 0, false);
	// 		echo "yes";
	// 	} elseif (mysqli_num_rows($user2)) {
	// 		$sql = db::query("UPDATE `user` SET `code`='$code' WHERE mail = '$login'");
	// 		$mess = "Aru Academy | Тексеру коды: $code";
	// 		fun::send_mail($mail, $mess);
	// 		echo "yes";
	// 	} else echo 'none';

	// 	exit();
	// }

	// // sign reset
	// if(isset($_GET['sign_reset'])) {
	// 	$phone = $_SESSION['phone'];
	// 	$mail = $_SESSION['mail'];
	// 	$code = $_SESSION['code'];
	// 	$password = strip_tags($_POST['password']);
		
	// 	if ($phone != null) {
	// 		$upd = db::query("UPDATE `user` SET `password`='$password' WHERE phone = '$phone' and code = '$code'");
	// 		$_SESSION['uph'] = $phone;
	// 		setcookie('uph', $phone, time() + 3600*24*30);
	// 	} else {
	// 		$upd = db::query("UPDATE `user` SET `password`='$password' WHERE mail = '$mail' and code = '$code'");
	// 		$_SESSION['upm'] = $mail;
	// 		setcookie('upm', $mail, time() + 3600*24*30);
	// 	}
		
	// 	$_SESSION['ups'] = $password;
	// 	setcookie('ups', $password, time() + 3600*24*30);
	// 	echo "yes";
	// 	exit();
	// }




	// ubd user
	if(isset($_GET['ubd_acc'])) {
		$n_name = strip_tags($_POST['n_name']);
		$surname = strip_tags($_POST['surname']);
		$sex = strip_tags($_POST['sex']);
		$age = strip_tags($_POST['age']);
		$mail = strip_tags($_POST['mail']);
		$phone = strip_tags($_POST['phone']);
		$password = strip_tags($_POST['password']);
		
		$upd = db::query("UPDATE `user` SET `name`='$n_name', `surname`='$surname', `sex`='$sex', `age`='$age', `mail`='$mail', `phone`='$phone', `password`='$password', `upd_dt`='$datetime' WHERE id = '$user_id'");

		$_SESSION['uph'] = $phone;
		$_SESSION['upm'] = $mail;
		$_SESSION['ups'] = $password;
		setcookie('uph', $phone, time() + 3600*24*30, '/');
		setcookie('upm', $mail, time() + 3600*24*30, '/');
		setcookie('ups', $password, time() + 3600*24*30, '/');

		echo "yes";
		exit();
	}


















	// 
	if(isset($_GET['test_answer'])) {

		$answer = strip_tags($_POST['answer']);
		$v = strip_tags($_POST['v']);
		$test_id = strip_tags($_POST['test_id']);
		$lesson_id = strip_tags($_POST['lesson_id']);

		$sql = db::query("INSERT INTO `test_answer`(`test_id`, `user_id`, `lesson_id`, `answer`, `v`, `ins_dt`) VALUES ('$test_id', '$user_id', '$lesson_id', '$answer', '$v', '$datetime')");
		if ($sql) echo 'yes';
		exit();
	}


	// 
	if(isset($_GET['sub_info_upd'])) {
		$nm = strip_tags($_POST['nm']);
		$lesson_id = strip_tags($_POST['lesson_id']);

		$sql = db::query("UPDATE `c_buy_lesson` SET `lesson_stage`='$nm' WHERE lesson_id = '$lesson_id' and user_id = '$user_id'");
		if ($sql) echo 'yes';
		exit();
	}
	
	
	
	// 
	if(isset($_GET['home_work'])) {
		$cours_id = strip_tags($_POST['cours_id']);
		$pack_id = strip_tags($_POST['pack_id']);
		$lesson_id = strip_tags($_POST['lesson_id']);
		$txt = strip_tags($_POST['inp_hm']);

		$id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `home_work`")))['max(id)'] + 1;
		$ins = db::query("INSERT INTO `home_work`(`id`, `user_id`, `cours_id`, `pack_id`, `lesson_id`) VALUES ('$id', '$user_id', '$cours_id', '$pack_id', '$lesson_id')");
		$ins_item = db::query("INSERT INTO `home_work_item`(`work_id`, `txt`) VALUES ('$id', '$txt')");
		if ($ins_item) echo 'yes';
		exit();
	}




	// 
	if(isset($_GET['rev_add'])) {

		$cours_id = strip_tags($_POST['cours_id']);
		$inp_rev = strip_tags($_POST['inp_rev']);

		$sql = db::query("INSERT INTO `review`(`user_id`, `cours_id`, `txt`, `ins_dt`) VALUES ('$user_id', '$cours_id', '$inp_rev', '$datetime')");
		if ($sql) echo 'yes';
		exit();
	}


	
	// 
	if(isset($_GET['add_ques'])) {

		$cours_id = strip_tags($_POST['cours_id']);
		$pack_id = strip_tags($_POST['pack_id']);
		$lesson_id = strip_tags($_POST['lesson_id']);
		$txt = strip_tags($_POST['txt']);

		$sql = db::query("INSERT INTO `ques`(`user_id`, `cours_id`, `pack_id`, `lesson_id`, `txt`, `ins_dt`) VALUES ('$user_id', '$cours_id', '$pack_id', '$lesson_id', '$txt', '$datetime')");
		if ($sql) echo 'yes';
		exit();
	}



















	// 
	if(isset($_GET['add_user_img'])) {
		$path = '../assets/uploads/users/';
		$allow = array();
		$deny = array(
			'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
			'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
			'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
		);
		$error = $success = '';
		$datetime = date('Ymd-His', time());

		if (!isset($_FILES['file'])) $error = 'Файлды жүктей алмады';
		else {
			$file = $_FILES['file'];
			if (!empty($file['error']) || empty($file['tmp_name'])) $error = 'Файлды жүктей алмады';
			elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) $error = 'Файлды жүктей алмады';
			else {
				$pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
				$name = mb_eregi_replace($pattern, '-', $file['name']);
				$name = mb_ereg_replace('[-]+', '-', $name);
				$parts = pathinfo($name);
				$name = $datetime.'-'.$name;

				if (empty($name) || empty($parts['extension'])) $error = 'Файлды жүктей алмады';
				elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) $error = 'Файлды жүктей алмады';
				elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) $error = 'Файлды жүктей алмады';
				else {
					if (move_uploaded_file($file['tmp_name'], $path . $name)) $success = '<p style="color: green">Файл «' . $name . '» успешно загружен.</p>';
					else $error = 'Файлды жүктей алмады';
				}
			}
		}
		
		if (!empty($error)) $error = '<p style="color:red">'.$error.'</p>';  
		
		$data = array(
			'error'   => $error,
			'success' => $success,
			'file' => $name,
		);
		
		header('Content-Type: application/json');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);

		exit();
	}

	// user edit
	if(isset($_GET['user_edit'])) {
		$name = strip_tags($_POST['name']);
		$surname = strip_tags($_POST['surname']);
		$age = strip_tags($_POST['age']);
		$img = strip_tags($_POST['img']);
		// $code = strip_tags($_POST['code']);
		
		if ($name) $upd = db::query("UPDATE `user` SET `name`='$name' WHERE id = '$user_id'");
		if ($surname) $upd = db::query("UPDATE `user` SET `surname`='$surname' WHERE id = '$user_id'");
		if ($age) $upd = db::query("UPDATE `user` SET `age`='$age' WHERE id = '$user_id'");
		if ($img) $upd = db::query("UPDATE `user` SET `img`='$img' WHERE id = '$user_id'");
		// if ($code) $upd = db::query("UPDATE `user` SET `code`='$code' WHERE id = '$user_id'");

		echo "yes";
		exit();
	}


	// user edit
	if(isset($_GET['user_name_edit'])) {
		$name = strip_tags($_POST['name']);
		$upd = db::query("UPDATE `user` SET `name`='$name' WHERE id = '$user_id'");
		echo "yes";
		exit();
	}


	// // user edit
	// if(isset($_GET['user_edit'])) {
	// 	$name = strip_tags($_POST['name']);
	// 	$surname = strip_tags($_POST['surname']);
	// 	$age = strip_tags($_POST['age']);
	// 	$code = strip_tags($_POST['code']);
		
	// 	$upd = db::query("UPDATE `user` SET `name`='$n_name', `surname`='$surname', `sex`='$sex', `age`='$age', `mail`='$mail', `phone`='$phone', `password`='$password', `upd_date`='$date' WHERE id = '$user_id'");

	// 	$_SESSION['uph'] = $phone;
	// 	$_SESSION['upm'] = $mail;
	// 	$_SESSION['ups'] = $password;
	// 	setcookie('uph', $phone, time() + 3600*24*30);
	// 	setcookie('upm', $mail, time() + 3600*24*30);
	// 	setcookie('ups', $password, time() + 3600*24*30);

	// 	echo "yes";
	// 	exit();
	// }