<?php include "../../config/core.php";

	// 
	if (!$user_id) header('location: /user/');
	
	// 
	$bookmark = db::query("select * from c_bookmark where user_id = '$user_id' ORDER BY ins_dt DESC");

	// site setting
	$menu_name = 'cours';
	$pod_menu_name = 'bookmark';
	$site_set = [
		'utop_nm' => 'Курстар (сақтаулы)',
		'utop_bk' => 'c',
	];
	$css = ['user','ucours'];
	$js = ['user'];

?>
<?php include "../../block/header.php"; ?>

	<div class="ucours">

		<?php include "c_header.php"; ?>
		
		<?php if (mysqli_num_rows($bookmark)): ?>
			<div class="bq3_c ucours_c">
				<?php while($bookmark_date = mysqli_fetch_array($bookmark)): ?>
					<?php	$cours_id = $bookmark_date['cours_id']; ?>
					<?php $cours = db::query("select * from cours where id = '$cours_id'"); ?>
					<?php $cours_date = mysqli_fetch_array($cours) ?>
					<?php $category = fun::category($cours_date['category_id']); ?>

					<div class="bq3_ci">
						<a href="/u/i/?id=<?=$cours_date['id']?>">
							<div class="bq_ci_img"><div class="lazy_img" data-src="/assets/img/cours/<?=$cours_date['img']?>"></div></div>
							<div class="bq_ci_info">
								<div class="bq_cit"><?=$category['name']?></div>
								<div class="bq_cih"><?=$cours_date['name']?></div>
							</div>
							<div class="bq_ci_btn"><div class="btn btn_cm btn_dd"><i class="fal fa-long-arrow-right"></i></div></div>
						</a>
						<div class="bq3_ci_book bq3_ci_book_act bq3_ci_book_act2" data-id="<?=$cours_date['id']?>">
							<div class="btn btn_red_cl btn_dd"><i class="fas fa-bookmark"></i></div>
						</div>
					</div>
				<?php endwhile ?>
			</div>
		<?php endif ?>
			
		<!-- <div class="bookmark_nn <?=(mysqli_num_rows($bookmark)?'dsp_n':'')?>">
			<div class="bl_c">
				<div class="">
					НЕТУ
				</div>
			</div>
		</div> -->

	</div>

<?php include "../../block/footer.php"; ?>