<? include "../config/core_edu.php";

	if (isset($_GET['right']) && $_GET['right'] == 1) $right = 1;

	if (isset($_GET['id'])) {
		$id = strip_tags($_GET['id']);
		if ($right) $user = db::query("SELECT * FROM user WHERE id = '$id'");
		else $user = db::query("SELECT * FROM user WHERE id = '$id' and `right` is null");
		if (mysqli_num_rows($user)) {
			$user_d = mysqli_fetch_assoc($user);
         $_SESSION['uph'] = $user_d['phone'];
         $_SESSION['ups'] = $user_d['password'];
			header('location: /education/');
		} else echo 'Қолданушы табылмады';
		exit();
	}
	
	if (isset($_GET['phone'])) {
		$phone = strip_tags($_GET['phone']);
		if ($right) $user = db::query("SELECT * FROM user WHERE phone = '$phone'");
		else $user = db::query("SELECT * FROM user WHERE phone = '$phone' and `right` is null");
		if (mysqli_num_rows($user)) {
			$user_d = mysqli_fetch_assoc($user);
         $_SESSION['uph'] = $user_d['phone'];
         $_SESSION['ups'] = $user_d['password'];
			header('location: /education/');
		} else echo 'Қолданушы табылмады';
		exit();
	}