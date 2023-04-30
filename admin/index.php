<? include "../config/core_admin.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /admin/sign.php');
	else header('location: /admin/list');