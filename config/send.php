<?php include 'core.php';

	// $token = "1921836439:AAEdLQlmhwkwbuznS5E0xmAbfEzOhPJEANg";
	$token = "1921836439:AAHlW8tYIwG_5yqCVFI_zNcdZJGuERSA6Xo";
	$chat_id = "-569554715";
	
	if(isset($_GET['mess'])) {
		$name  = strip_tags($_POST['name']);
		$phone = strip_tags($_POST['phone']);
		$phone = substr_replace($phone, '', 0, 1);
		$phone = substr_replace($phone, '8', 0, 1);

		$arr = array(
			'Типі: '			=> 'Курсқа жазыламын',
			'Аты-жөні: '	=> $name,
			'Телефон: ' 	=> $phone
		);

		foreach($arr as $key => $value) {$txt .= "<b>".$key."</b> ".$value."%0A";};
		$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
		if ($sendToTelegram) echo "yes"; else echo "error";

		exit();
	}



	if(isset($_GET['mess2'])) {
		$name  = strip_tags($_POST['name']);
		$phone = strip_tags($_POST['phone']);

		$arr = array(
			'Аты-жөні: ' => $name,
			'Телефон: ' => $phone
		);

		$sql = db::query("INSERT INTO `lide`(`name`, `phone`, `ins_dt`) VALUES ('$name', '$phone', '$datetime')");

		foreach($arr as $key => $value) {$txt .= "<b>".$key."</b> ".$value."%0A";};
		$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
		if ($sendToTelegram) echo "yes"; else echo "error";

		exit();
	}