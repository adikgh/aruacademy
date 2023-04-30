<?php include "../../config/core.php";
	
	// 
	if ($user_id) {
		if (isset($_GET['id']) || $_GET['id'] != '') {
			$cours_id = $_GET['id'];
			$cours = db::query("select * from cours where id = '$cours_id'");
			if (mysqli_num_rows($cours)) {
				
				$cours = mysqli_fetch_assoc($cours);
				$category = fun::category($cours['category_id']);
				$autor = fun::autor($cours['autor_id']);
				$bookmark = fun::bookmark($cours['id'], $user_id);
				$pack = db::query("select * from c_pack where cours_id = '$cours_id'");
				$sub = db::query("select * from c_sub where cours_id = '$cours_id' and user_id = '$user_id'");
				$review = db::query("select * from review where cours_id = '$cours_id' order by ins_dt desc");
				
			} else { header('location: /u/c/'); }
		} else { header('location: /u/c/'); }
	} else { header('location: /u/sign_in.php'); }
	

	// site setting
	$menu_name = 'item';
	$pod_menu_name = 'reviews';
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
			
			<!-- item hedaer -->
			<?php include "../item_header.php"; ?>


			<div class="ubl6">
				<div class="bl_c">
					<div class="lsb_ic">
						<div class="form_im">
							<i class="fal fa-comment-lines form_icon"></i>
							<textarea class="form_im_txt inp_rev"></textarea>
						</div>
						<div class="form_im">
							<div class="btn btn_cl btn_rev" data-cours-id="<?=$cours_id?>">Жіберу</div>
						</div>
					</div>
				</div>
			</div>

			<div class="ubl5">
				<div class="bl_c">
					<div class="head_c head_c1">
						<h4>Пікірлер</h4>
					</div>
					<div class="ubl5_c">

						<?php while ($review_d = mysqli_fetch_assoc($review)): ?>
							<?php $user_d = fun::user($review_d['user_id']); ?>
							<div class="ubl5_i">
								<div class="ubl5_il">
									<div class="ubl5_im lazy_img" data-src="/assets/img/users/<?=$user_d['logo']?>"><?=($user_d['logo']!=null?'':'<i class="far fa-user"></i>')?></div>
									<div class="ubl5_ilc">
										<?php if ($review_d['user_id'] == null): ?>
											<div class="ubl5_in"><?=$review_d['name']?></div>
										<?php else: ?>
											<div class="ubl5_in"><?=$user_d['name']?> <?=$user_d['surname']?></div>
										<?php endif ?>
										<div class="ubl5_id"><?=date("m-d-Y", strtotime($review_d['ins_dt']))?></div>
									</div>
								</div>
								<div class="ubl5_ic"><?=$review_d['txt']?></div>
							</div>
						<?php endwhile ?>

					</div>
				</div>
			</div>

		</div>
	</div>


<?php include "../../block/footer.php"; ?>