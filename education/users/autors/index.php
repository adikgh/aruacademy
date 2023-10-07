<?php include "../../../config/core.php";

	// 
	if (!$user_id || !$user_right) header('location: /u/sign_in.php');

	$autor = db::query("select * from u_autor");

	// site setting
	$menu_name = 'autors';
	$site_set = [
		'header' => 'user',
		'footer' => 'false',
		'ublock' => 'true',
		'form' => 'false',
		'utop_nm' => 'Ұстаздар',
		'utop_bk' => 'cours/',
	];
	$css = ['user', 'ucours', 'uitem', 'uc_user'];
	$js = ['user', 'admin'];

	$date = new DateTime();
	
?>
<?php include "../../../block/header.php"; ?>


	<div class="">

		<!-- <div class="ucours_t ucours_t2">
			<div class="ucours_tm swiper swiper_catalog2">
				<div class="swiper-wrapper">
					<a class="swiper-slide ucours_tm_i ucours_tm_act" href="/u/admin/users">Барлығы (<?=mysqli_num_rows($user)?>)</a>
				</div>
				<div class="swiper-button-prev2 swiper-button-prev"><i class="fal fa-chevron-left"></i></div>
				<div class="swiper-button-next2 swiper-button-next"><i class="fal fa-chevron-right"></i></div>
			</div>
		</div> -->

		<br>

		<!-- list -->
		<div class="uc_u">
			<div class="uc_us">
				<div class="uc_usi"><i class="fal fa-search"></i></div>
				<div class="uc_usn">
					<input type="text" placeholder="Іздеуді қолданыңыз" class="user_search_in">
				</div>
			</div>
			<div class="uc_uh">
				<div class="uc_uh_right">Күйі</div>
				<div class="uc_uh_name">Аты-жөні</div>
				<div>Телефон / Почта</div>
				<div>Тіркелген күні</div>
			</div>
			<div class="uc_uc">
				<?php if (mysqli_num_rows($autor) != 0): ?>
					<?php while ($autor_d = mysqli_fetch_assoc($autor)): ?>
						<?php // $sub_rows = fun::sub_rows($user_d['id']); ?>
						<div class="uc_ui">
							<div class="uc_uil">
								<div class="uc_ui_right">
									<div class="form_im form_im_toggle <?=($autor_d['locked']?'':'form_im_toggle_act')?>">
										<input type="checkbox" class="homework" data-val="" />
										<div class="form_im_toggle_btn cursor_none"></div>
									</div>
								</div>
								<div class="uc_ui_icon lazy_img" data-src="/assets/img/users/<?=$autor_d['logo']?>">
									<?=($autor_d['logo']!=null?'':'<i class="fal fa-user"></i>')?>
								</div>
								<div class="uc_ui_name"><?=$autor_d['name']?> <?=$autor_d['surname']?></div>
								<div class="uc_ui_phone"><?=($autor_d['phone'] != null?$autor_d['phone']:$autor_d['mail'])?></div>
								<div class="uc_ui_ins_date"><?=$autor_d['ins_date']?></div>
							</div>
						</div>

					<?php endwhile ?>
				<?php else: ?>
					Ешкім жоқ
				<?php endif ?>
			</div>
		</div>

	</div>


<?php include "../../../block/footer.php"; ?>