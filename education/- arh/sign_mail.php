<?php include "../config/core_edu.php";

	// 
	if ($user_id) header('location: /education/my/');
	
	// site setting
	$menu_name = 'sign_mail';
	$site_set['cl_wh'] = 1;
	$site_set['header'] = false;
	$site_set['footer'] = false;
	// $site_set['menu'] = 2;
	$css = ['education/sign'];
	// $js = [''];
?>
<? include "block/header.php"; ?>

	<div class="u_sign">
		<div class="bl_c">
			<div class="usign_c">

				<div class="usign_img">
					<script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
					<lord-icon src="https://cdn.lordicon.com/gzmgulpl.json" trigger="loop" colors="outline:#002728,primary:#055052,secondary:#dadada" style="width:120px;height:120px"></lord-icon>
				</div>

				<div class="usign_head"><h3 class="usign_h">Көргеніме қуаныштымын</h3></div>

				<div class="usign_cn">
					
					<div class="form_im form_im_ph">
						<i class="far fa-envelope form_icon"></i>
						<input type="text" class="form_txt smail" placeholder="Почтаңыз" data-lenght="6" data-sel="0" maxlength="50" />
					</div>

					<div class="form_im form_im_ps">
						<i class="far fa-lock form_icon"></i>
						<input type="password" class="form_txt password" placeholder="Құпия сөзіңіз" data-lenght="6" data-sel="0" data-eye="0" />
						<i class="far fa-eye-slash form_icon_pass"></i>
					</div>
					
					<div class="form_im">
						<button class="btn btn_sign_in_mail">
							<span>Кіру</span>
							<i class="far fa-long-arrow-right"></i>
						</button>
					</div>
					
					<div class="form_im si_blc_bn">
						<a class="btn btn_back3" href="sign.php">Номер арқылы кіру</a>
						<a class="btn btn_back3" href="sign_reset_mail.php">Құпия сөзімді ұмыттым?</a>
					</div>

				</div>

			</div>
		</div>
	</div>

<? include "block/footer.php"; ?>