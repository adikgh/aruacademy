<? include "../config/core_edu.php";

	// 
	if ($user_id) header('location: /education/my/');

	// cours
	if ($user_id && isset($_GET['c'])) header('location: /education/course/?id='.$_GET['c']);
	if ($user_id && isset($_GET['sub'])) header('location: /education/club/');

	// 
	if ($user_id && isset($_GET['subm'])) header('location: /education/masterclass/?id='.$_GET['subm'].'&back=sub');

	// site setting
	$menu_name = 'sign';
	$site_set['cl_wh'] = 1;
	$site_set['header'] = false;
	// $site_set['menu'] = 2;
	$site_set['footer'] = false;
	$css = ['education/sign'];
	$js = ['education/sign'];
?>
<? include "block/header.php"; ?>

	<div class="u_sign">
		<div class="bl_c">

			<div class="usign_c">

				<div class="usign_img">
					<div class="">
						<script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
						<lord-icon src="https://cdn.lordicon.com/xxdqfhbi.json" trigger="loop" colors="outline:#002728,primary:#055052,secondary:#ffc738,tertiary:#f28ba8,quaternary:#f9c9c0" style="width:120px;height:120px"></lord-icon>
					</div>
					<div class="dsp_n">
						<script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
						<lord-icon src="https://cdn.lordicon.com/dykrlspk.json" trigger="loop" colors="outline:#002728,primary:#055052,secondary:#ffffff" style="width:120px;height:120px"></lord-icon>
					</div>
				</div>

				<div class="usign_head"><h3 class="usign_h" data-reset="Кілт сөзді қайта жазу" data-main="Қайта келуіңізбен">Қайта келуіңізбен</h3></div>

				<div class="usign_cn">

					<div class="form_im_ii">
						<div class="form_im_ii_phone form_im_ii_act">Телефон</div>
						<div class="form_im_ii_mail ">Почта</div>
					</div>
					
					<div class="">
						<div class="form_im form_im_ph">
							<i class="far fa-mobile form_icon"></i>
							<input type="tel" class="form_txt fr_phone phone" placeholder="8 (700) 000-00-00" data-lenght="11" data-sel="0" />
						</div>
						<div class="form_im form_im_ml dsp_n">
							<i class="far fa-envelope form_icon"></i>
							<input type="text" class="form_txt smail" placeholder="Почтаңыз" data-lenght="6" data-sel="0" maxlength="50" />
						</div>
					</div>
					
					<div class="form_im form_im_ps">
						<i class="far fa-lock form_icon"></i>
						<input type="password" class="form_txt password" placeholder="Құпия сөзіңіз" data-lenght="6" data-sel="0" data-eye="0" />
						<i class="far fa-eye-slash form_icon_pass"></i>
					</div>
					
					<div class="form_im">
						<button class="btn btn_sign_in" data-type="phone" data-reset="0">
							<span>Кіру</span>
							<i class="fal fa-long-arrow-right"></i>
						</button>
					</div>
					
					<div class="form_im si_blc_bn">
						<div class="btn btn_back" data-reset="Кілт сөзді жазу" data-main="Құпия сөзімді ұмыттым?">Құпия сөзімді ұмыттым?</div>
					</div>
				
				</div>
			
			</div>

		</div>
	</div>

<? include "block/footer.php"; ?>