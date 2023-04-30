<? include "../config/core_admin.php";

	// sign in phone
	if(isset($_GET['phone'])) {
		$phone = strip_tags($_POST['phone']);
		$password = strip_tags($_POST['password']);
		$user = db::query("SELECT * FROM user WHERE phone = '$phone' and `right` = 1");
		if (mysqli_num_rows($user)) {
			$user_d = mysqli_fetch_assoc($user);
			if ($password == $user_d['password']) {
				$_SESSION['uph'] = $phone;
				$_SESSION['ups'] = $password;
				echo 'yes';
			} else echo 'password';
		} else echo 'none';
		exit();
	}





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
		$inp_hm = strip_tags($_POST['inp_hm']);

		$sql = db::query("INSERT INTO `home_work`(`user_id`, `cours_id`, `pack_id`, `lesson_id`, `txt`, `ins_dt`) VALUES ('$user_id', '$cours_id', '$pack_id', '$lesson_id', '$inp_hm', '$datetime')");
		if ($sql) echo 'yes';
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