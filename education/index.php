<?php include "../config/core_edu.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /education/sign.php');
	else header('location: /education/my');