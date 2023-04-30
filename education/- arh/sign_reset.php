<?php include "../config/core_edu.php";

	// 
	if ($user_id) header('location: /education/my/');

	// site setting
	$menu_name = 'sign_reset';
	$site_set['cl_wh'] = 1;
	$site_set['header'] = false;
	$site_set['footer'] = false;
	$css = ['education/sign'];
	// $js = ['education/main'];
?>
<? include "block/header.php"; ?>

	<div class="u_sign">
		<div class="bl_c">

			<div class="usign_c">

				<div class="usign_head"><h3 class="usign_h"></h3></div>

				<div class="usign_cn">
					<div class="usign_f">
						<div class="form_im form_im_ph">
							<i class="far fa-mobile form_icon"></i>
							<input type="tel" class="form_txt fr_phone phone" placeholder="8 (700) 000-00-00" data-lenght="11" data-sel="0" />
						</div>
						<div class="form_im form_im_cd dsp_n">
							<i class="far fa-lock-alt form_icon"></i>
							<input type="tel" class="form_txt code fr_code" placeholder="0000" data-lenght="4" data-sel="0" />
						</div>
						<div class="form_im form_im_ps dsp_n">
							<i class="far fa-lock form_icon"></i>
							<input type="password" class="form_txt password" placeholder="Құпия сөз ойлап табыңыз" data-lenght="6" data-sel="0" />
							<i class="far fa-eye-slash form_icon_pass"></i>
						</div>
					</div>
					<div class="si_blc_b">
						<div class="form_im si_blc_b">
							<button class="btn btn_sign_reset" data-type="phone">
								<span>Тексеру</span>
								<i class="far fa-long-arrow-right"></i>
							</button>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>

<?php include "block/footer.php"; ?>


