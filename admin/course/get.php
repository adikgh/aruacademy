<? include "../config/core_admin.php";

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