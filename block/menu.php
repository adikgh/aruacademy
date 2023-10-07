<? if ($site_set['header']): ?>
	<div class="header <?=($site_set['mheader']?'mheader_none':'')?>">
		<div class="header_c">

			<a class="logo" href="/"><?=$site['name']?></a>
			<div class="menu">
				<div class="menu_bars menu_bars_clc">
					<span>Мәзір</span>
					<div class="menu_bars_i"></div>
				</div>
				<div class="menu_c">
					<a class="menu_ci" href="/education/my/">
						<div class="menu_cin"><i class="fal fa-user"></i></div>
						<div class="menu_cih">Менің аккаунтым</div>
					</a>
					<a class="menu_ci" href="/club/">
						<div class="menu_cin"><i class="fal fa-users-class"></i></div>
						<div class="menu_cih">Даму клубы</div>
					</a>
					<a class="menu_ci" href="/cours/">
						<div class="menu_cin"><i class="fal fa-graduation-cap"></i></div>
						<div class="menu_cih">Курстар</div>
					</a>
					<a class="menu_ci" href="/link/" target="_blank">
						<div class="menu_cin"><i class="fab fa-instagram"></i></div>
						<div class="menu_cih">Ару Сағи (жеке блог)</div>
					</a>
				</div>
			</div>

		</div>
	</div>
<? endif ?>

<!-- app start -->
<div class="app">