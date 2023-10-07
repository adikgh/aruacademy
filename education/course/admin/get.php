<? include "../../../config/core_edu.php";

	// 
	if(isset($_GET['add_item_photo'])) {
		$path = '../../assets/uploads/course/';
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



	
	// 
	if(isset($_GET['item_add'])) {
		$name = strip_tags($_POST['name']);
		$access = strip_tags($_POST['access']);
		$autor = strip_tags($_POST['autor']);
		$img = strip_tags($_POST['img']);
		$price = strip_tags($_POST['price']);
		$price_sole = strip_tags($_POST['price_sole']);
		$item = strip_tags($_POST['item']);
		$assig = strip_tags($_POST['assig']);
		$id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `cours`")))['max(id)'] + 1;

		$ins = db::query("INSERT INTO `cours`(`name_kz`, `name_ru`) VALUES ('$name', '$name')");

		if ($access) $upd = db::query("UPDATE `cours` SET `access`='$access' WHERE `id`='$id'");
		if ($autor) $upd = db::query("UPDATE `cours` SET `autor`='$autor' WHERE `id`='$id'");
		if ($img) $upd = db::query("UPDATE `cours` SET `img`='$img' WHERE `id`='$id'");
		if ($price) $upd = db::query("UPDATE `cours` SET `price`='$price' WHERE `id`='$id'");
		if ($price_sole) $upd = db::query("UPDATE `cours` SET `price_sole`='$price_sole' WHERE `id`='$id'");
		if ($item || $assig) {
			$upd = db::query("UPDATE `cours` SET `info`=1 WHERE `id`='$id'");
			$ins_info = db::query("INSERT INTO `cours_info`(`cours_id`) VALUES ('$id')");
			if ($item) $upd = db::query("UPDATE `cours_info` SET `item`='$item' WHERE `cours_id`='$id'");
			if ($assig) $upd = db::query("UPDATE `cours_info` SET `assig`='$assig' WHERE `cours_id`='$id'");
		}

		if ($ins) echo 'plus';
		exit();
	}





	
	// 
	if(isset($_GET['item_edit'])) {
		$id = strip_tags($_POST['id']);
		$name = strip_tags($_POST['name']);
		$access = strip_tags($_POST['access']);
		$autor = strip_tags($_POST['autor']);
		$img = strip_tags($_POST['img']);
		$price = strip_tags($_POST['price']);
		$price_sole = strip_tags($_POST['price_sole']);
		$item = strip_tags($_POST['item']);
		$assig = strip_tags($_POST['assig']);

		if ($name) $upd = db::query("UPDATE `cours` SET `name_kz`='$name', `name_ru`='$name', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($access) $upd = db::query("UPDATE `cours` SET `access`='$access', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($autor) $upd = db::query("UPDATE `cours` SET `autor`='$autor', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($img) $upd = db::query("UPDATE `cours` SET `img`='$img', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($price) $upd = db::query("UPDATE `cours` SET `price`='$price', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($price_sole) $upd = db::query("UPDATE `cours` SET `price_sole`='$price_sole', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($item || $assig) {
			$upd = db::query("UPDATE `cours` SET `info` = 1 WHERE `id` = '$id'");
			if (mysqli_num_rows(db::query("SELECT * FROM `cours_info` where cours_id = '$id'")) == 0) $ins_info = db::query("INSERT INTO `cours_info`(`cours_id`) VALUES ('$id')");
			if ($item) $upd = db::query("UPDATE `cours_info` SET `item`='$item' WHERE `cours_id`='$id'");
			if ($assig) $upd = db::query("UPDATE `cours_info` SET `assig`='$assig' WHERE `cours_id`='$id'");
		}

		echo 'plus';
		exit();
	}











	// 
	if(isset($_GET['cours_copy'])) {
		$course_id = strip_tags($_POST['course']);
		$new_course_id = strip_tags($_POST['copy_course']);
		
		$course_d = fun::cours($course_id);
		$new_course_d = fun::cours($new_course_id);

		if ($course_d && $new_course_d) {

			$block = db::query("select * from c_block where cours_id = '$course_id' order by number asc");
			if (mysqli_num_rows($block)) {
				while ($block_d = mysqli_fetch_assoc($block)) {
					$block_id = $block_d['id'];

					$new_block_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `c_block`")))['max(id)'] + 1;
					$nblock_number = $block_d['number'];
					$nblock_name = $block_d['name_kz'];
					$nblock_open = $block_d['open'];

					$ins_block = db::query("INSERT INTO `c_block`(`id`, `cours_id`, `number`, `name_kz`) VALUES ('$new_block_id', '$new_course_id', '$nblock_number', '$nblock_name')");
					if ($nblock_open) $upd_block = db::query("UPDATE `c_block` SET `open` = '$nblock_open' WHERE id = '$new_block_id'");
					
					// 
					$lesson = db::query("select * from c_lesson where block_id = '$block_id' order by number asc");
					if (mysqli_num_rows($lesson)) {
						while ($lesson_d = mysqli_fetch_assoc($lesson)) {
							$lesson_id = $lesson_d['id'];
		
							$new_lesson_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `c_lesson`")))['max(id)'] + 1;
							$nlesson_number = $lesson_d['number'];
							$nlesson_name = $lesson_d['name_kz'];
							$nlesson_open = $lesson_d['open'];
							$nlesson_arh = $lesson_d['arh'];
		
							$ins_item = db::query("INSERT INTO `c_lesson`(`id`, `cours_id`, `block_id`, `number`, `name_kz`) VALUES ('$new_lesson_id', '$new_course_id', '$new_block_id', '$nlesson_number', '$nlesson_name')");
							if ($nlesson_open) $upd_item = db::query("UPDATE `c_lesson` SET `open` = '$nlesson_open' WHERE id = '$new_lesson_id'");
							if ($nlesson_arh) $upd_item = db::query("UPDATE `c_lesson` SET `arh` = '$nlesson_arh' WHERE id = '$new_lesson_id'");
		
							// 
							$item = db::query("select * from c_lesson_item where lesson_id = '$lesson_id' order by number asc");
							if (mysqli_num_rows($item)) {
								while ($item_d = mysqli_fetch_assoc($item)) {
		
									$new_item_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `c_lesson_item`")))['max(id)'] + 1;
									$nitem_number = $item_d['number'];
									$nitem_type = $item_d['type'];
									$nitem_type_name = $item_d['type_name'];
									$nitem_type_video = $item_d['type_video'];
									$nitem_txt = $item_d['txt'];
									$nitem_question_id = $item_d['question_id'];
									$nitem_question_item_id = $item_d['question_item_id'];
		
									$ins_item = db::query("INSERT INTO `c_lesson_item`(`id`, `lesson_id`, `number`, `type`) VALUES ('$new_item_id', '$new_lesson_id', '$nitem_number', '$nitem_type')");
									if ($nitem_type_name) $upd_item = db::query("UPDATE `c_lesson_item` SET `type_name` = '$nitem_type_name' WHERE id = '$new_item_id'");
									if ($nitem_type_video) $upd_item = db::query("UPDATE `c_lesson_item` SET `type_video` = '$nitem_type_video' WHERE id = '$new_item_id'");
									if ($nitem_txt) $upd_item = db::query("UPDATE `c_lesson_item` SET `txt` = '$nitem_txt' WHERE id = '$new_item_id'");
									if ($nitem_question_id) $upd_item = db::query("UPDATE `c_lesson_item` SET `question_id` = '$nitem_question_id' WHERE id = '$new_item_id'");
									if ($nitem_question_item_id) $upd_item = db::query("UPDATE `c_lesson_item` SET `question_item_id` = '$nitem_question_item_id' WHERE id = '$new_item_id'");
									
								}
							} else echo '4';
							
						}
					} else echo '3';
				

				}
			} else echo '2';

		} else echo '1';

		echo 'yes';

		exit();
	}












	// 
	if(isset($_GET['block_copy'])) {
		$block_id = strip_tags($_POST['block']);
		$new_block_id = strip_tags($_POST['copy_block']);
		
		$block_d = fun::sblock($block_id);
		$new_block_d = fun::sblock($new_block_id);
		
		if ($block_d && $new_block_d) {

			$new_course_id = $new_block_d['cours_id'];
			
			$lesson = db::query("select * from c_lesson where block_id = '$block_id' order by number asc");
			if (mysqli_num_rows($lesson)) {
				while ($lesson_d = mysqli_fetch_assoc($lesson)) {
					$lesson_id = $lesson_d['id'];

					$new_lesson_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `c_lesson`")))['max(id)'] + 1;
					$nlesson_number = $lesson_d['number'];
					$nlesson_name = $lesson_d['name_kz'];
					$nlesson_open = $lesson_d['open'];
					$nlesson_arh = $lesson_d['arh'];

					$ins_item = db::query("INSERT INTO `c_lesson`(`id`, `cours_id`, `block_id`, `number`, `name_kz`) VALUES ('$new_lesson_id', '$new_course_id', '$new_block_id', '$nlesson_number', '$nlesson_name')");
					if ($nlesson_open) $upd_item = db::query("UPDATE `c_lesson` SET `open` = '$nlesson_open' WHERE id = '$new_lesson_id'");
					if ($nlesson_arh) $upd_item = db::query("UPDATE `c_lesson` SET `arh` = '$nlesson_arh' WHERE id = '$new_lesson_id'");

					$item = db::query("select * from c_lesson_item where lesson_id = '$lesson_id' order by number asc");
					if (mysqli_num_rows($item)) {
						while ($item_d = mysqli_fetch_assoc($item)) {

							$new_item_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `c_lesson_item`")))['max(id)'] + 1;
							$nitem_number = $item_d['number'];
							$nitem_type = $item_d['type'];
							$nitem_type_name = $item_d['type_name'];
							$nitem_type_video = $item_d['type_video'];
							$nitem_txt = $item_d['txt'];
							$nitem_question_id = $item_d['question_id'];
							$nitem_question_item_id = $item_d['question_item_id'];

							$ins_item = db::query("INSERT INTO `c_lesson_item`(`id`, `lesson_id`, `number`, `type`) VALUES ('$new_item_id', '$new_lesson_id', '$nitem_number', '$nitem_type')");
							if ($nitem_type_name) $upd_item = db::query("UPDATE `c_lesson_item` SET `type_name` = '$nitem_type_name' WHERE id = '$new_item_id'");
							if ($nitem_type_video) $upd_item = db::query("UPDATE `c_lesson_item` SET `type_video` = '$nitem_type_video' WHERE id = '$new_item_id'");
							if ($nitem_txt) $upd_item = db::query("UPDATE `c_lesson_item` SET `txt` = '$nitem_txt' WHERE id = '$new_item_id'");
							if ($nitem_question_id) $upd_item = db::query("UPDATE `c_lesson_item` SET `question_id` = '$nitem_question_id' WHERE id = '$new_item_id'");
							if ($nitem_question_item_id) $upd_item = db::query("UPDATE `c_lesson_item` SET `question_item_id` = '$nitem_question_item_id' WHERE id = '$new_item_id'");
							
						}
					} else echo '2';
					
				}
			} else echo '3';
			
		} else echo '4';
		
		echo 'yes';
		// echo $new_lesson_id;

		exit();
	}
















	// 
	if(isset($_GET['lesson_add'])) {
		$name = strip_tags($_POST['name']);
		$course_id = strip_tags($_POST['course_id']);
		$block_id = strip_tags($_POST['block_id']);
		$open = strip_tags($_POST['open']);
		$youtube = strip_tags($_POST['youtube']);
		// $txt = strip_tags($_POST['txt']);
				
		// if (!$block_id) {
		// 	$course = fun::course($course_id);
		// 	$cours_name_kz = $course['name_kz'];
		// 	$cours_name_ru = $course['name_ru'];
		// 	$block_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `course_block`")))['max(id)'] + 1;
		// 	$ins_block = db::query("INSERT INTO `course_block`(`number`, `course_id`, `name_kz`, `name_ru`) VALUES (1, '$course_id', '$cours_name_kz', '$cours_name_ru')");
		// }
		
		$id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `c_lesson`")))['max(id)'] + 1;
		$number = fun::lesson_next_number($block_id);
		$ins = db::query("INSERT INTO `c_lesson`(`cours_id`, `block_id`, `number`, `name_kz`, `open`) VALUES ('$course_id', '$block_id', '$number', '$name', 1)");

		if ($youtube) $ins_li = db::query("INSERT INTO `c_lesson_item`(`lesson_id`, `number`, `type`, `type_name`, `type_video`, `txt`) VALUES ('$id', 1, 'video', 'Сабақ', 'youtube', '$youtube')");
		// if ($txt) $ins_li = db::query("INSERT INTO `c_lesson_item`(`lesson_id`, `number`, `type`, `txt`) VALUES ('$id', 2, 'txt', '$txt')");
		
		if ($ins) echo 'yes';

		exit();
	}