<? include "../config/core_admin.php";

	// 
	if ($user_id) header('location: /admin/');

	// site setting
	$menu_name = 'sign';
	// $site_set['cl_wh'] = 1;
	$site_set['header'] = false;
	$site_set['footer'] = false;
	// $css = [];
	// $js = [];
?>
<? include "block/header.php"; ?>

	<div class="usign">
		<div class="bl_c">
			<div class="usign_c">

				<!-- <div class="usign_img"><div class="lazy_img" data-src="/assets/img/icons/waving-hand_1f44b.png"></div></div> -->

				<div class="usign_head"><h3 class="usign_h">Админ панель</h3></div>

				<div class="usign_cn">
					<div class="form_im form_im_ph">
						<i class="far fa-mobile form_icon"></i>
						<input type="tel" class="form_txt fr_phone phone" placeholder="8 (700) 000-00-00" data-lenght="11" data-sel="0" />
					</div>
					<div class="form_im form_im_ps">
						<i class="far fa-lock form_icon"></i>
						<input type="password" class="form_txt password" placeholder="Құпия сөзіңіз" data-lenght="6" data-sel="0" data-eye="0" />
						<i class="far fa-eye-slash form_icon_pass"></i>
					</div>
					<!-- <div class="form_im si_blc_bn dsp_n">
						<a class="btn btn_back3 txt_c" href="sign_reset.php">Құпия сөзімді ұмыттым?</a>
					</div> -->
					<div class="form_im">
						<button class="btn btn_sign_in"><span>Кіру</span><i class="far fa-long-arrow-right"></i></button>
					</div>
					<!-- <div class="form_im txt_c">
						<a class="btn btn_back3" href="sign_in_mail.php">Почта арқылы кіру</a>
					</div> -->
				</div>

			</div>
		</div>
	</div>

<? include "block/footer.php"; ?>