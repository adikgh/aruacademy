<?php include "../../config/core.php";
	
	// 
	if ($user_id) {
		if (isset($_GET['id']) || $_GET['id'] != '') {
			$cours_id = $_GET['id'];
			$cours = db::query("select * from cours where id = '$cours_id'");
			if (mysqli_num_rows($cours)) {
				
				$cours = mysqli_fetch_assoc($cours);
				$category = fun::category($cours['category_id']);
				$date = date("Y-m-d", strtotime("-3 day"));
				$pack = db::query("select * from cours_pack where cours_id = '$cours_id'");
				
				$sub = db::query("select * from cours_sub where cours_id = '$cours_id' and user_id = '$user_id'");
				if (mysqli_num_rows($sub) == 0 && $user_right != 1) header('location: /cours/item/?id='.$cours_id);
				
			} else { header('location: /user/cours/'); }
		} else { header('location: /user/cours/'); }
	} else { header('location: /user/sign_in.php'); }
	
	// site setting
	$menu_name = 'item';
	$pod_menu_name = 'info';
	$site_set = [
		'header' => 'full',
		'footer' => 'false',
		'ublock' => 'true',
		'utop_nm' => $cours['name'],
		'utop_bk' => 'cours'
	];
   $css = ['user','uitem'];
	$js = ['user'];


?>
<?php include "../../block/header.php"; ?>

	<div class="uitem">
		<div class="uitem_c">
			
			<!-- item header -->
			<?php include "../item_header.php"; ?>


		</div>
	</div>

<?php include "../../block/footer.php"; ?>