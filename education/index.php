<? include "../config/core_edu.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /education/sign.php');
	else if ($user_right) header('location: /education/my/list.php');
	else header('location: /education/my/');