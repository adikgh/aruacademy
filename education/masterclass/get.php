<? include "../../config/core_edu.php";



	// 
	if(isset($_GET['add_review'])) {
		$mc_id = strip_tags($_POST['mc_id']);
		$type = strip_tags($_POST['type']);
		$txt = strip_tags($_POST['txt']);

      if ($type == 'cours') $sql = db::query("INSERT INTO `review`(`user_id`, `cours_id`, `txt`, `ins_dt`) VALUES ('$user_id', '$mc_id', '$txt', '$datetime')");
      else if ($type == 'sub') $sql = db::query("INSERT INTO `review`(`user_id`, `c_sub_item_id`, `txt`, `ins_dt`) VALUES ('$user_id', '$mc_id', '$txt', '$datetime')");
		if ($sql) echo 'yes';
      exit();
	}

   // 
	if(isset($_GET['del_review'])) {
		$id = strip_tags($_POST['id']);
      $sql = db::query("DELETE FROM `review` where id = '$id'");
		if ($sql) echo 'yes';
      exit();
	}

   // 
	if(isset($_GET['add_review_answer'])) {
		$id = strip_tags($_POST['id']);
		$txt = strip_tags($_POST['txt']);

      $sql = db::query("INSERT INTO `review`(`user_id`, `review_id`, `txt`, `ins_dt`) VALUES ('$user_id', '$id', '$txt', '$datetime')");
		if ($sql) echo 'yes';
      exit();
	}