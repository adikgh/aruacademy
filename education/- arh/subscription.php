<?php include "../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/');

	$cours = db::query("select * from cours where category_id = 4 ORDER BY ins_dt DESC");

	
	// Сайттың баптаулары
	$menu_name = 'cours';
	$pod_menu_name = 'subscription';
	$site_set = [
		'utop_nm' => 'Курстар (жазылым)',
      'um_menu' => 'true',
	];
	$css = ['user','ucours'];
	$js = ['user'];
?>
<?php include "../../block/header.php"; ?>

	<div class="ucours">

		<?php include "c_header.php"; ?>
		
		<div class="uc_d">
			<?php while($cours_date = mysqli_fetch_array($cours)): ?>
				<?php	$cours_id = $cours_date['id']; ?>
				<?php $category = fun::category($cours_date['category_id']); ?>
				<?php	$sub = db::query("select * from c_sub where cours_id = '$cours_id' and user_id = '$user_id'"); ?>
				<?php if (mysqli_num_rows($sub) || $user_right) : ?>
					<a class="uc_di" href="/user/item/?id=<?=$cours_date['id']?>">
						<div class="bq_ci_img"><div class="lazy_img" data-src="/assets/img/cours/<?=$cours_date['img']?>"></div></div>
						<div class="bq_ci_info">
							<div class="bq_cit"><?=$category['name']?></div>
							<div class="bq_cih"><?=$cours_date['name']?></div>
						</div>
						<div class="bq_ci_btn"><div class="btn btn_cm btn_dd"><i class="fal fa-long-arrow-right"></i></div></div>
					</a>
				<?php endif ?>
			<?php endwhile ?>
		</div>
		
	</div>


<?php include "../../block/footer.php"; ?>