<?php include "../config/core.php";

	// site setting
	$menu_name = 'link';
	$site_set['header'] = false;
	$site_set['footer'] = false;
	$site_set['plyr'] = true;
	$css = ['link'];
?>
<? include "../block/header.php"; ?>

	<div class="a1">
		<div class="bl_c">
			<div class="a1_c">

				<div class="a1_t">
					<h1>Ару Сағи</h1>
					<h6>Халықаралық дәрежедегі<br>сертификатталған коуч ана мен бала<br>қарым-қатынасының маманы</h6>
				</div>
				
				<div class="a1_i">
					<div class="a1_ia"></div>
					<div class="a1_ic"></div>
				</div>

				<div class="a1_b">
					<div class="a1_bt">Менің әлеуметтік желіме<br>жазылып қойыңыз</div>
					<div class="a1_bc">
						<? if ($site['instagram']): ?>
							<a class="a1_bci" href="https://www.instagram.com/aru_sagi">
								<i class="fab fa-instagram"></i>
								<span>Instagram</span>
							</a>
						<? endif ?>
						<? if ($site['youtube']): ?>
							<a class="a1_bci" href="https://www.youtube.com/arusagi87">
								<i class="fab fa-youtube"></i>
								<span>Youtube</span>
							</a>
						<? endif ?>
						<? if ($site['telegram']): ?>
							<a class="a1_bci" href="https://t.me/arusagi">
								<i class="fab fa-telegram-plane"></i>
								<span>Telegram</span>
							</a>
						<? endif ?>
						<? if ($site['tik-tok']): ?>
							<a class="a1_bci" href="https://vm.tiktok.com/ZSe5QwFTr/">
								<div class="a1_bcii lazy_img" data-src="/assets/img/icons/tiktok_w.png"></div>
								<span>Tik-Tok</span>
							</a>
						<? endif ?>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="a2">
		<div class="bl_c">
			<div class="a2_c">
				<div class="a2_t">Ана мен бала қарым-қатынасы<br>жөнінде пайдалы білімдер</div>
				<div class="a2_tm">
					<div class="a2_tmc">
						<div class="container">
							<div class="player_1" data-plyr-provider="youtube" data-plyr-embed-id="g7R4Lkt5bX0"></div>
						</div>
						<script> const player_1 = new Plyr(".player_1", { fullscreen: {iosNative: true} }); </script>
					</div>
				</div>
				<div class="a2_tm_b">
					<a class="btn btn_cl" href="/a/video.php">
						<span>Барлығын қарау</span>
						<i class="fal fa-long-arrow-right"></i>
					</a>
					<a class="btn btn_red" href="https://www.youtube.com/arusagi87">
						<i class="fab fa-youtube"></i>
						<span>YouTube арнама өту</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="a3">
		<div class="bl_c">
			<div class="a3_c">
				<div class="a3_t">
					<div>Курс | Мастер-класс | Вебинар</div>
					<p>Барлық авторлық курстар, мастер-класстар<br>арнайы сайтта, толық ақпарат ала аласыз</p>
				</div>
				<div class="a3_i">
					<img class="lazy_img" data-src="/assets/img/bag/chrome_.png" />
				</div>
				<div class="a3_b">
					<a class="btn" href="/">
						<i class="fal fa-globe"></i>
						<span>Сайтқа өту</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="a4">
		<div class="bl_c">
			<div class="a4_c">
				<div class="a4_t">
					<div>Жарнама, курс бойынша</div>
					<p>Жәнеде басқада сұрақтар бойынша менің<br>менеджеріммен байланыса аласыз</p>
				</div>
				<div class="a4_b">
					<a class="btn btn_whatsapp" href="https://wa.me/<?=$site['whatsapp']?>?text=Сәлеметсіз%20бе%21%20Сұрағым%20бар%20еді.">
						<i class="fab fa-whatsapp"></i>
						<span>Whatsapp жазу</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="a5">
		<div class="bl_c">
			<div class="a5_c">
				<div class="a5_i">
					<img class="lazy_img" data-src="/assets/img/bag/24484968.png" />
				</div>
				<div class="a5_b">
					<a class="btn" href="https://aruacademy.online/bala-uiqysy-diagnostika/">
						<span>Тесттен өтемін</span>
						<i class="fal fa-long-arrow-right"></i>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="a6">
		<div class="bl_c">
			<div class="a6_c">
				<div class="a6_t">
					<div>Менің телеграм каналыма жазылыңыз</div>
				</div>
				<div class="a6_b">
					<a class="btn btn_telegram" href="https://t.me/arusagi">
						<i class="fab fa-telegram-plane"></i>
						<span>Телеграмға өту</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<? include "afoot.php"; ?>

<? include "../block/footer.php"; ?>