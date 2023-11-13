<?php 

class fun {
	
	function __construct() {}

	// cours
	public static function cours($id) {
	  	$sql = db::query("select * from cours where id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
	}
	public static function cours_name($id, $l) {
		$sql = db::query("select * from cours where id = '$id'");
		$sql = mysqli_fetch_array($sql);
		return $sql['name_'.$l];
	}
	public static function cours_sum() {
	  $sql = db::query("select * from cours");
	  return mysqli_num_rows($sql);
	}
	public static function cours_info($id) {
	  $sql = db::query("select * from cours_info where cours_id = '$id'");
	  return mysqli_fetch_array($sql);
	}
	public static function cours_pack($id) {
		$sql = db::query("select * from c_pack where id = '$id'");
		$sql = mysqli_fetch_array($sql);
		return $sql['cours_id'];
	}
	public static function cours_price_min($id) {
		$sql = db::query("select min(price), min(price_sole) from c_pack where cours_id = '$id'");
		return mysqli_fetch_array($sql);
		// return ($sql[1]==null?$sql[0]:$sql[1]);
	}
	public static function cours_work($id) {
		$sql = db::query("select * from c_pack where cours_id = '$id' and home_work = 1");
		if (mysqli_num_rows($sql)) return 1; else return 0;
 	}



	// category
	public static function category($id) {
		$sql = db::query("select * from category where id = '$id'");
		$sql = mysqli_fetch_array($sql);
		return $sql;
	}
	public static function category_name($id, $l) {
		$sql = db::query("select * from category where id = '$id'");
		$sql = mysqli_fetch_array($sql);
		return @$sql['name_'.$l];
	}
	public static function category_cours($id) {
		$sql = db::query("select * from cours where id = '$id'");
		$sql = mysqli_fetch_array($sql);
		return $sql['category_id'];
	}
	
	// 
	public static function bookmark($id, $u_id) {
		$sql = db::query("select * from c_bookmark where cours_id = '$id' and user_id = '$u_id'");
		if (mysqli_num_rows($sql)) return 1; else return 0;
	}
 


	// pack
	public static function pack($id) {
	  $sql = db::query("select * from c_pack where id = '$id'");
	  if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
	}
	public static function pack_one($id) {
		$sql = db::query("select * from c_pack where cours_id = '$id' order by number asc limit 1");
		return mysqli_fetch_array($sql);
	}
	public static function pack_one_work($id) {
		$sql = db::query("select * from c_pack where cours_id = '$id' and home_work = 1 order by number asc limit 1");
		return mysqli_fetch_array($sql);
	}
	public static function pack2($id) {
	  $sql = db::query("select * from c_pack where cours_id = '$id'");
	  if (mysqli_num_rows($sql) == 1) return mysqli_fetch_array($sql); else return 0;
	}
	public static function pack_sum($id) {
	  $sql = db::query("select * from c_pack where cours_id = '$id'");
	  return mysqli_num_rows($sql);
	}
	public static function pack_price_min($id) {
		$sql = db::query("select min(price) from c_pack where cours_id = '$id'");
		$sql = mysqli_fetch_array($sql);
		return $sql;
	}
	public static function pack_word($id) {
		$sql = db::query("select * from c_pack_word where pack_id = '$id'");
		$sql = mysqli_fetch_array($sql);
		return $sql;
	}


	// block
	public static function sblock($id) {
		$sql = db::query("select * from c_block where id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return null;
	}
	public static function block($id) {
		$sql = db::query("select * from c_block where id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
	}
	public static function block_one($id) {
		$sql = db::query("select * from c_block where pack_id = '$id' order by number asc limit 1");
		return mysqli_fetch_array($sql);
	}
	public static function pack_block($id) {
		$sql = db::query("select * from c_block where id = '$id'");
		$sql = mysqli_fetch_array($sql);
		return $sql['pack_id'];
	}


	// lesson
	public static function lesson($id) {
		$sql = db::query("select * from c_lesson where id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
	}
	public static function lesson_one($id) {
		$sql = db::query("select * from c_lesson where block_id = '$id' order by number asc limit 1");
		return mysqli_fetch_array($sql);
	}
	public static function lesson_info($id) {
		$sql = db::query("select * from c_lesson_info where id = '$id'");
		$sql = mysqli_fetch_array($sql);
		return $sql;
	}
	public static function lesson_name($id, $lang) {
		$sql = db::query("select number, name_kz from c_lesson where id = '$id'");
		if (mysqli_num_rows($sql)) {
			$sql_d = mysqli_fetch_array($sql);
			return $sql_d['number'].'. '.$sql_d['name_'.$lang];
		} else return 0;
	}
	public static function lesson_next_number($id) {
		$sql = db::query("select * from c_lesson where block_id = '$id' order by number desc limit 1");
		if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['number'] + 1; else return 1;
	}






	// Курс жазылу
	public static function buy($id, $user_id) {
		$sql = db::query("select * from c_buy where cours_id = '$id' and user_id = '$user_id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
 	}
	public static function buy_n($id, $user_id) {
	  	$sql = db::query("select * from c_buy where cours_id = '$id' and user_id = '$user_id'");
	  	if (mysqli_num_rows($sql)) return 1; else return 0;
	}
	public static function buy_i($id, $user_id) {
	  	$sql = db::query("select * from c_buy where cours_id = '$id' and user_id = '$user_id'");
	  	if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
	}
	public static function buy_rows($id) {
		$sql = db::query("select * from c_buy where user_id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_num_rows($sql); else return 0;
	}
	public static function buy_cours_sum($id) {
		$sql = db::query("select * from c_buy where cours_id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_num_rows($sql); else return 0;
 	}
	public static function buy_end_off($id) {
		$buy = db::query("select * from c_buy where user_id = '$id' ORDER BY ins_dt DESC");
		while($buy_d = mysqli_fetch_array($buy)) {
			$buy_id = $buy_d['id'];
			if ($buy_d['end_dt']) {
				$result = intval((strtotime($buy_d['end_dt']) - strtotime(date("d.m.Y"))) / (60*60*24));
				if ($result <= 0) db::query("UPDATE `c_buy` SET `off` = 1 where id = '$buy_id'");
			}
		}
 	}




	// 
	public static function cours_pack_item_info($id) {
		$user_id = core::$user_data['id'];
		$sql = db::query("select * from c_buy_lesson where pack_item_id = '$id' and user_id = '$user_id'");
		$sql = mysqli_fetch_array($sql);
		return $sql;
	}



	// sub
	public static function sub($id) {
		$sql = db::query("select * from c_sub where id = '$id'");
		$sql = mysqli_fetch_array($sql);
		return $sql;
	}
	public static function club_yes($id) {
		$sql = db::query("select * from c_sub_item where cours_id = '$id'");
		if (mysqli_num_rows($sql)) return 1; else return 0;
 	}

	// sub buy
	public static function sub_buy($id) {
		$sql = db::query("select * from c_sub_buy where id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
 	}
	public static function sub_buy2($id, $user_id) {
		$sql = db::query("select * from c_sub_buy where sub_id = '$id' and user_id = '$user_id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
	}
	public static function sub_buy_true($id) {
		$sql = db::query("select * from c_sub_buy where user_id = '$id'");
		if (mysqli_num_rows($sql)) return 1; else return 0;
 	}
	public static function sub_buy_sum($id) {
		$sql = db::query("select * from c_sub_buy where sub_id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_num_rows($sql); else return 0;
 	}











	public static function work($id, $u_id) {
		$sql = db::query("select * from home_work where lesson_id = '$id' and user_id = '$u_id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
 	}
	public static function work_ls($id, $uid) {
		$sql = db::query("select *, COUNT(`lesson_id`) AS `count` from home_work where cours_id = '$id' and user_id = '$uid' GROUP BY `lesson_id` HAVING `count` > 0");
	 	return mysqli_num_rows($sql);
 	}
	public static function home_work_sum($id) {
		$sql = db::query("select * from home_work where cours_id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_num_rows($sql); else return 0;
 	}

	public static function work_d($id) {
		$sql = db::query("select * from home_work where id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
 	}
	public static function work_item_desc($id) {
		$sql = db::query("select * from home_work_item where work_id = '$id' order by ins_dt desc limit 1");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
 	}










	//  chat
	public static function chat($id) {
		$sql = db::query("select * from h_chat where user_id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
 	}
	public static function chat2($id) {
		$sql = db::query("select * from h_chat where id = '$id'");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
 	}
	public static function chat_txt_end($id) {
		$sql = db::query("select * from h_chat_item where chat_id = '$id' order by ins_dt desc limit 1");
		if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
 	}
	public static function chat_view_sum() {
		$sql = db::query("select * from h_chat where view is null");
		return mysqli_num_rows($sql);
 	}
	public static function chat_item_view_sum($id) {
		$sql = db::query("select * from h_chat_item where chat_id = '$id' and user_id is null and view is null");
		return mysqli_num_rows($sql);
 	}
	public static function chat_view_sum2($id) {
		$sql = db::query("select * from h_chat where user_id = '$id'");
		if (mysqli_num_rows($sql)) {
			$chat_d = mysqli_fetch_array($sql); 
			$chat_id = $chat_d['id'];
			$chad_i = db::query("select * from h_chat_item where chat_id = '$chat_id' and user_id is not null and view is null");
			return mysqli_num_rows($chad_i);
		} else return 0;
 	}




	






	// user
	public static function user($id) {
		$sql = db::query("select * from user where id = '$id'");
		return mysqli_fetch_array($sql);
	}
	public static function user_buy($id, $user_id) {
		$buy = db::query("select * from c_buy where cours_id = '$id' and user_id = '$user_id'");
		$sub_buy = db::query("select * from c_sub_buy where sub_id = 1 and user_id = '$user_id'");
		$cours_sub = db::query("select * from c_sub_item where cours_id = '$id'");
		if (mysqli_num_rows($buy)) return 1;
		else if (mysqli_num_rows($sub_buy) && mysqli_num_rows($cours_sub)) return 2;
		else return 0;
	}



	// autor
	public static function autor($id) {
		$sql = db::query("select * from user_autor where id = '$id'");
		return mysqli_fetch_array($sql);
	}
	









	// sms
	public static function sms_save($arr, $user_id) {
		$id_sms = $arr['0'];
		$status = $arr['1'];
		$price = $arr['2'];

		if ($price) $sql = db::query("INSERT INTO `user_sms`(`id_sms`, `user_id`, `price`, `status`) VALUES ('$id_sms', '$user_id', '$price', '$status')");
		else $sql = db::query("INSERT INTO `user_sms`(`id_sms`, `user_id`, `status`) VALUES ('$id_sms', '$user_id', '$status')");
		if ($sql) return 'yes'; else return 'none';
		// return $id_sms;
	}
	







	// send mall 
	public static function send_mail($mail, $txt) {
		$from = "info@aruacademy.kz";
		$subject = "Aru Academy";
		$headers = "From:" . $from. "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8";
      $mess = "<html>
						<head><title>$subject</title></head>
						<body>
							<div><b>$txt<b></div>
						</body>
					</html>";
	  	return mail($mail, $subject, $mess, $headers);
	}






}