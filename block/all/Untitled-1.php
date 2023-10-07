<?php if ($site_set['header'] != 'false'): ?>
	
	<!-- header_menu -->
	<div class="header header_acc <?=($site_set['m_header']!='item'?'':'header_acci')?> <?=($site_set['mheader']!='false'?'':'mheader_none')?>">
		<div class="header_c">

			<div class="header_n1">
				<a class="logo" href="/"><?=$site['name']?></a>
				<div class="menu">
					<div class="menu_bars menu_bars_clc">
						<div class="menu_bars_i"></div>
					</div>
					<div class="menu_c">
						<a class="menu_ci" href="/user/cours/">
							<div class="menu_cin"><i class="fal fa-user"></i></div>
							<div class="menu_cih">Менің аккаунтым</div>
						</a>
						<a class="menu_ci" href="/cours/">
							<div class="menu_cin"><i class="fal fa-graduation-cap"></i></div>
							<div class="menu_cih">Курстар</div>
						</a>
						<a class="menu_ci" href="/cours/?type=webinar">
							<div class="menu_cin"><i class="fal fa-chalkboard-teacher"></i></div>
							<div class="menu_cih">Вебинарлар</div>
						</a>
						<a class="menu_ci" href="/cours/?type=master-class">
							<div class="menu_cin"><i class="fal fa-user-graduate"></i></div>
							<div class="menu_cih">Мастер-класстар</div>
						</a>
						<a class="menu_ci" href="#">
							<div class="menu_cin"><i class="fal fa-info-circle"></i></div>
							<div class="menu_cih">Академия жайлы</div>
						</a>
						<!-- <a class="menu_ci" href="https://instagram.com/aru_sagi/" target="_blank">
							<div class="menu_cin"><i class="fab fa-instagram"></i></div>
							<div class="menu_cih">Insta Blog</div>
						</a> -->

					</div>
				</div>
			</div>

			<div class="utop <?=(!$site_set['utop_bk']?'utop1':'')?>">
				<?php if ($site_set['utop_bk']): ?>
					<div class="utop_l">
						<?php if ($site_set['utop_bk'] != 'home'): ?>
							<a class="utop_ic" href="/user/<?=$site_set['utop_bk']?>">
								<i class="fal fa-long-arrow-left"></i>
							</a>
						<?php else: ?>
							<a class="utop_ic" href="/"><span>AS</span></a>
						<?php endif ?>
					</div>
				<?php endif ?>
				<div class="utop_r">
					<div class="utop_nm"><?=$site_set['utop_nm']?></div>
					<?php if ($menu_name == 'cours' || $menu_name == 'bookmark'): ?>
						<!-- <div class="utop_ic"><i class="fal fa-sliders-h"></i></div> -->
					<?php elseif ($menu_name == 'item' || $menu_name == 'pack'): ?>
						<?php if ($pod_menu_name != 'work'): ?>
							<!-- <div class="utop_sh"><i class="fal fa-paper-plane"></i></div> -->
						<?php endif ?>
						<!-- <div class="utop_ic usmenu_bars_clc"><i class="fal fa-bars"></i></div> -->
					<?php elseif ($menu_name == 'dashboard'): ?>
						<div class="utop_ic"><i class="fal fa-comment-dots"></i></div>
					<?php elseif ($menu_name == 'user'): ?>
						<!-- <div class="utop_ic"><i class="fal fa-bell"></i></div> -->
					<?php endif ?>
				</div>
			</div>

		</div>
	</div>
<?php endif ?>



<!--  -->


			<!-- <div class="ub1_lb">
				<div class="ub1_lbt">
					<a class="menu_ci" href="/user/exit.php">
						<div class="umenu_cin"><i class="fal fa-sign-out"></i></div>
						<div class="umenu_cih">Шығу</div>
					</a>
				</div>
				<div class="ub1_lbb">
					<div class="ub1_lbb1">
						<a href="https://gprog.kz" target="_blank" class="gprog_bl">
							<span>#gprog-та</span>
							<div class="gprog_heart"><i class="fas fa-heart"></i></div>
							<span>жасалған</span>
							<div class="gprog_ab">
								<div class="gprog_lg"><div class="lazy_img" data-src="https://gprog.kz/assets/img/logo/logo_tr_1200.png"></div></div>
								<div class="gprog_h">G prog</div>
								<div class="gprog_p">digital cіздің<br>бизнесіңізге</div>
							</div>
						</a>
					</div>
				</div>
			</div> -->