<?php include "../config/core.php";

	// 
	if(isset($_GET['bookmark_plus'])) {
		$cours_id = strip_tags($_POST['cours_id']);
		$sql = db::query("INSERT INTO `bookmark`(`cours_id`, `user_id`, `date`) VALUES ('$cours_id','$user_id','$date')");
		if ($sql) echo 'yes';
		exit();
	}
	
	// 
	if(isset($_GET['bookmark_del'])) {
		$cours_id = strip_tags($_POST['cours_id']);
		$sql = db::query("delete from bookmark where cours_id = '$cours_id' and user_id = '$user_id'");
		$bookmark = db::query("select * from bookmark where user_id = '$user_id'");
      if (mysqli_num_rows($bookmark)) echo 'yes';
      else echo 'none';

		exit();
	}