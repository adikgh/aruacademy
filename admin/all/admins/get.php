<?php include "../../config/core.php";

   // time
	$ins_dt = $datetime;
	$end_dt = date('Y-m-d H:i:s', strtotime("$datetime +12 month"));

	// mail data
	$from = "info@aruacademy.kz";
	$subject = "Aru Academy";
	$headers = "From:" . $from. "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8";

	
	// 
	if(isset($_GET['work_yes'])) {
		$id = strip_tags($_POST['id']);
		$txt = strip_tags($_POST['txt']);
		$sql = db::query("UPDATE `home_work` SET `accept`=1 WHERE id = '$id'");
		$sql2 = db::query("INSERT INTO `home_work`(`homework_id`, `user_id`, `txt`, `ins_dt`) VALUES ('$id', '$user_id', '$txt', '$datetime')");
		echo 'yes';
		exit();
	}
	if(isset($_GET['work_none'])) {
		$id = strip_tags($_POST['id']);
		$txt = strip_tags($_POST['txt']);
		$sql = db::query("UPDATE `home_work` SET `refusal`=1 WHERE id = '$id'");
		$sql2 = db::query("INSERT INTO `home_work`(`homework_id`, `user_id`, `txt`, `ins_dt`) VALUES ('$id', '$user_id', '$txt', '$datetime')");
		echo 'yes';
		exit();
	}







	// 
	if(isset($_GET['block_plus'])) {
		$name = strip_tags($_POST['name']);
		$cours_id = strip_tags($_POST['cours_id']);
		$number = strip_tags($_POST['number']);
		$sql = db::query("INSERT INTO `c_block`(`number`, `cours_id`, `name`, `logo_txt`, `status_id`, `date`) VALUES ('$number','$cours_id','$name','',5,'$date')");
		if ($sql) echo 'yes';
		else echo 'none';

		exit();
	}





	// 
	// if(isset($_GET['student_plus2'])) {
	// 	$phone = strip_tags($_POST['phone']);
	// 	$phone = substr_replace($phone, '', 0, 1);
	// 	$phone = '7'.$phone;
	// 	$cours_id = strip_tags($_POST['cours_id']);

	// 	$code = rand(1000,9999);

	// 	$student = db::query("SELECT * FROM `user` WHERE phone = '$phone'");
	// 	if (mysqli_num_rows($student) != 0) {
	// 		$student = mysqli_fetch_assoc($student);
	// 		$student_id = $student['id'];
	// 		$code = $student['code'];

	// 		$sub = db::query("SELECT * FROM `cours_sub` WHERE user_id = '$student_id' and cours_id = '$cours_id'");
	// 		if (mysqli_num_rows($sub) == 0) {
	// 			db::query("INSERT INTO `cours_sub`(`cours_id`, `user_id`, `status_id`, `date`) VALUES ('$cours_id', '$student_id', 1, '$date')");

	// 			$mess = "Сізге сабақ ашылды.\nСіздің номеріңіз: +$phone\nТексеру коды: $code\nСабаққа сілтеме: https://sab1.kz/l/?c=$cours_id";
	// 			list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);

	// 			echo 'plus';
	// 		} else {
	// 			echo 'yes';
	// 		}
	// 	} else {
	// 		$sql = db::query("INSERT INTO `user`(`phone`, `code`, `ins_date`, `status_id`) VALUES ('$phone','$code','$date', 8)");
	// 		if ($sql) {
	// 			$student = mysqli_fetch_assoc(db::query("SELECT * FROM `user` WHERE phone = '$phone'"));
	// 			$student_id = $student['id'];

	// 			$sub = db::query("SELECT * FROM `cours_sub` WHERE user_id = '$student_id' and cours_id = '$cours_id'");
	// 			if (mysqli_num_rows($sub) == 0) {
	// 				db::query("INSERT INTO `cours_sub`(`cours_id`, `user_id`, `status_id`, `date`) VALUES ('$cours_id', '$student_id', 1, '$date')");

	// 				$mess = "Сізге сабақ ашылды.\nСіздің номеріңіз: +$phone\nТексеру коды: $code\nСабаққа сілтеме: https://sab1.kz/l/?c=$cours_id";
	// 				list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);

	// 				echo 'plus';
	// 			} else {
	// 				echo 'yes';
	// 			}
	// 		}
	// 	}

	// 	exit();
	// }

	// 
	// if(isset($_GET['video_plus'])) {
	// 	$video = strip_tags($_POST['video']);
	// 	$item_id = strip_tags($_POST['item_id']);

	// 	$sql = db::query("INSERT INTO `cours_item_info`(`item_id`, `type`, `type_name`, `txt`, `date`) VALUES ('$item_id','video','Видео сабақ','$video','$date')");
	// 	if ($sql) {
	// 		echo 'plus';
	// 	}

	// 	exit();
	// }




	// 
	if(isset($_GET['add_item_photo'])) {

		$path = '../../assets/img/cours/';
		$allow = array();
		$deny = array(
			'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
			'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
			'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
		);
		$error = $success = '';
		$datetime = date('Y-m-d-H-i-s', time());

		if (!isset($_FILES['file'])) { $error = 'Файлды жүктей алмады'; }
		else {
			$file = $_FILES['file'];
			if (!empty($file['error']) || empty($file['tmp_name'])) {
				$error = 'Файлды жүктей алмады';
			} elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
				$error = 'Файлды жүктей алмады';
			} else {
				$pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
				$name = mb_eregi_replace($pattern, '-', $file['name']);
				$name = mb_ereg_replace('[-]+', '-', $name);
				$parts = pathinfo($name);
				$name = $datetime.'-'.$name;

				if (empty($name) || empty($parts['extension'])) {
					$error = 'Файлды жүктей алмады';
				} elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
					$error = 'Файлды жүктей алмады';
				} elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
					$error = 'Файлды жүктей алмады';
				} else {
					if (move_uploaded_file($file['tmp_name'], $path . $name)) {
						$success = '<p style="color: green">Файл «' . $name . '» успешно загружен.</p>';
					} else {
						$error = 'Файлды жүктей алмады';
					}
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
	
	
	// 
	if(isset($_GET['item_add'])) {
		$n_name = strip_tags($_POST['n_name']);
		$price = strip_tags($_POST['price']);
		$price_sole = strip_tags($_POST['price_sole']);
		$category_id = strip_tags($_POST['category']);
		$autor_id = strip_tags($_POST['autor']);
		$homework = strip_tags($_POST['homework']);
		$img = strip_tags($_POST['n_img']);

		$sql = db::query("INSERT INTO `cours`(`category_id`, `autor_id`, `status_id`, `name`, `price`, `price_sole`, `img`, `home_work`, `ins_dt`) VALUES ('$category_id', '$autor_id', 5, '$n_name', '$price', '$price_sole', '$img', '$homework', '$datetime')");
		if ($sql) echo 'plus';

		exit();
	}





	// 
	if(isset($_GET['lesson_add'])) {
		$name = strip_tags($_POST['name']);
		$cours_id = strip_tags($_POST['cours_id']);
		$pack_id = strip_tags($_POST['pack_id']);
		$logo_txt = '<i class="far fa-play"></i>';
		
		if (!$pack_id) {
			$pack = db::query("select * from c_pack where cours_id = '$cours_id'");
			$pack_d = mysqli_fetch_array($pack);
			$pack_id = $pack_d['id'];
		}
		
		$block = db::query("select * from c_block where cours_id = '$cours_id' and pack_id = '$pack_id'");
		if (mysqli_num_rows($block)) {
			if (mysqli_num_rows($block) == 1) {
				$block_d = mysqli_fetch_array($block);
				$block_id = $block_d['id'];
			}
		} else {
			$sql = db::query("INSERT INTO `c_block`(`cours_id`, `pack_id`, `status_id`, `number`, `name`, `ins_dt`) VALUES ('$cours_id', '$pack_id', 5, 1, 'Жалпы', '$datatime')");
			if ($sql) {
				$block = db::query("select * from c_block where cours_id = '$cours_id' and pack_id = '$pack_id'");
				$block_d = mysqli_fetch_array($block);
				$block_id = $block_d['id'];
			}
		}
		
		$sql = db::query("INSERT INTO `c_lesson`(`cours_id`, `pack_id`, `block_id`, `name`, `logo_txt`, `status_id`, `ins_dt`) VALUES ('$cours_id', '$pack_id', '$block_id', '$name', '$logo_txt', 5, '$datatime')");
		if ($sql) echo 'yes';

		exit();
	}





	// // 
	// if(isset($_GET['filter_awork'])) {
	// 	$id = strip_tags($_POST['id']);
	// 	$pack = strip_tags($_POST['pack']);
	// 	$sts = strip_tags($_POST['sts']);
	// 	$answer = strip_tags($_POST['answer']);
		
		


	// 	exit();
	// }



	// 
	if(isset($_GET['user_search'])) {
		$result = strip_tags($_POST['result']);
		$s_result = '';

		$user = db::query("select * from user where (phone like '%$result%' and `right` is null) or (mail like '%$result%' and `right` is null) or (name like '%$result%' and `right` is null) or (surname like '%$result%' and `right` is null) order by ins_date desc limit 50");
		while ($user_d = mysqli_fetch_assoc($user)) {
			$s_result = $s_result.'
				<div class="uc_ui">
					<div class="uc_uil">
						<div class="uc_ui_right">
							<div class="form_im form_im_toggle '.($user_d['locked']?'':'form_im_toggle_act').'">
								<input type="checkbox" class="homework" data-val="" />
								<div class="form_im_toggle_btn cursor_none"></div>
							</div>
						</div>
						<div class="uc_ui_icon lazy_img" data-src="/assets/img/users/'.$user_d['logo'].'">
							'.($user_d['logo']!=null?'':'<i class="fal fa-user"></i>').'
						</div>
						<div class="uc_ui_name">'.$user_d['name'].' '.$user_d['surname'].'</div>
						<div class="uc_ui_phone">'.($user_d['phone'] != null?$user_d['phone']:$user_d['mail']).'</div>
						<div class="uc_ui_ins_date">'.$user_d['ins_date'].'</div>
						<div class="uc_ui_number">'.fun::sub_rows($user_d['id']).'</div>
					</div>
					<div class="uc_uib">
						<div class="uc_uibo"><i class="fal fa-ellipsis-v"></i></div>
						<div class="uc_uibs">
							<div class="uc_uib_i pass_ress" data-id="'.$user_d['id'].'" data-login="'.($user_d['phone'] != null?$user_d['phone']:$user_d['mail']).'">
								<div><i class="fal fa-user-lock"></i></div>
								<span>Кілт-сөзді қайта орнату</span>
							</div>
							<div class="uc_uib_i uc_uib_del cursor_none">
								<div><i class="fal fa-trash-alt"></i></div>
								<span>Оқушыны өшіру</span>
							</div>
						</div>
					</div>
				</div>';
		}

		echo $s_result;

		exit();
	}

	// 
	if(isset($_GET['pass_ress'])) {
		$id = strip_tags($_POST['id']);
		$sql = db::query("UPDATE `user` SET `password`='123456' WHERE id = '$id'");
		if ($sql) echo 'yes';
		exit();
	}
