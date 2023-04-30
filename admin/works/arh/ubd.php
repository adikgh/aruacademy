<? include "../../config/core_admin.php";
	
   $work_all = db::query("select * from home_work");
   while ($work_d = mysqli_fetch_assoc($work_all)) {
      $homework_id = $work_d['id']; 
      $txt = $work_d['txt'];
      if ($work_d['homework_id']) {
         $homework_id = $work_d['homework_id'];
         $user_id = $work_d['user_id'];
         $ubd = db::query("INSERT INTO `home_work_item`(`work_id`, `user_id`, `txt`) VALUES ('$homework_id', '$user_id', '$txt')");
      } else $ubd = db::query("INSERT INTO `home_work_item`(`work_id`, `txt`) VALUES ('$homework_id', '$txt')");
   }