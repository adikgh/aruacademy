<?php include "../../../config/core_edu.php";

	// 
	if(isset($_GET['test_answer_tk1'])) {

		$v = strip_tags($_POST['v']);
		$n = strip_tags($_POST['n']);
		$ball = strip_tags($_POST['ball']);
		$test_item_id = strip_tags($_POST['test_item_id']);
		$test_answer_id = strip_tags($_POST['test_answer_id']);

		$test_answer_i = db::query("select * from test_answer_item where test_answer_id = '$test_answer_id' and test_item_id = '$test_item_id'");
		if (mysqli_num_rows($test_answer_i)) {
			$test_answer_i_d = mysqli_fetch_array($test_answer_i);
			$test_answer_i_id = $test_answer_i_d['id'];
			$sql = db::query("UPDATE `test_answer_item` SET `ubd_dt`='$datetime', `v`='$v' WHERE id = '$test_answer_i_id'");
		} else {
			$sql = db::query("INSERT INTO `test_answer_item`(`test_item_id`, `test_answer_id`, `v`, `ins_dt`) VALUES ('$test_item_id', '$test_answer_id', '$v', '$datetime')");
		}

		$sql = db::query("UPDATE `test_answer` SET `n`='$n', `ball`='$ball' WHERE id = '$test_answer_id'");
		if ($sql) echo 'yes';

		exit();
	}


	// 
	if(isset($_GET['test_answer_tk3'])) {
		$v = strip_tags($_POST['v']);
		$n = strip_tags($_POST['n']);
		$ball = strip_tags($_POST['ball']);
		$test_item_id = strip_tags($_POST['test_item_id']);
		$test_answer_id = strip_tags($_POST['test_answer_id']);

		$test_answer_i = db::query("select * from test_answer_item where test_answer_id = '$test_answer_id' and test_item_id = '$test_item_id'");
		if (mysqli_num_rows($test_answer_i)) {
			$test_answer_i_d = mysqli_fetch_array($test_answer_i);
			$test_answer_i_id = $test_answer_i_d['id'];
			$sql = db::query("UPDATE `test_answer_item` SET `ubd_dt`='$datetime', `v`='$v' WHERE id = '$test_answer_i_id'");
		} else {
			$sql = db::query("INSERT INTO `test_answer_item`(`test_item_id`, `test_answer_id`, `v`, `ins_dt`) VALUES ('$test_item_id', '$test_answer_id', '$v', '$datetime')");
		}

		$sql = db::query("UPDATE `test_answer` SET `n`='$n', `ball`='$ball' WHERE id = '$test_answer_id'");
		if ($sql) echo 'yes';

		exit();
	}



	// 
	if(isset($_GET['tk_test_start'])) {
		$name = strip_tags($_POST['name']);
		$child_name = strip_tags($_POST['child_name']);
		$child_age = strip_tags($_POST['child_age']);

		$sql = db::query("INSERT INTO `tk_test_b`(`user_id`, `name`, `child_name`, `child_age`, `ins_dt`) VALUES ('$user_id', '$name', '$child_name', '$child_age', '$datetime')");
		if ($sql) echo 'yes';

		exit();
	}


	// 
	if(isset($_GET['tk3_test_end'])) {

		$n = strip_tags($_POST['n']);
		$n = $n + 1;

		$test = db::query("select * from test where number = '$n' and name = 'tk3'");
		$test_d = mysqli_fetch_array($test);
		$test_id = $test_d['id'];

		// 
		$tk_test = db::query("select * from tk_test_b where user_id = '$user_id'");
		if (mysqli_num_rows($tk_test)) {
			$tk_test_b = mysqli_fetch_array($tk_test);
			$tk_test_id = $tk_test_b['id'];
		}

		$test_answer = db::query("select * from test_answer where test_id = '$test_id'");
		if (!mysqli_num_rows($test_answer)) {
			$sql = db::query("INSERT INTO `test_answer`(`test_id`, `user_id`, `tk_test_id`, `ins_dt`) VALUES ('$test_id', '$user_id', '$tk_test_id', '$datetime')");
		}
		echo $test_id;

		exit();
	}


	// 
	if(isset($_GET['tk4_test_end'])) {

		$n = strip_tags($_POST['n']);
		$n = $n + 1;

		$test = db::query("select * from test where number = '$n' and name = 'tk4'");
		$test_d = mysqli_fetch_array($test);
		$test_id = $test_d['id'];

		// 
		$tk_test = db::query("select * from tk_test_b where user_id = '$user_id'");
		if (mysqli_num_rows($tk_test)) {
			$tk_test_b = mysqli_fetch_array($tk_test);
			$tk_test_id = $tk_test_b['id'];
		}

		$test_answer = db::query("select * from test_answer where test_id = '$test_id'");
		if (!mysqli_num_rows($test_answer)) {
			$sql = db::query("INSERT INTO `test_answer`(`test_id`, `user_id`, `tk_test_id`, `ins_dt`) VALUES ('$test_id', '$user_id', '$tk_test_id', '$datetime')");
		}
		echo $test_id;

		exit();
	}