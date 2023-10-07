<? if ($site_set['um_menu'] == 'true'): ?>
   <div class="pmenu">
      <div class="pmenu_c">
			<a class="pmenu_i <?=($menu_name=='cours'?'pmenu_i_act':'')?>" href="/user/cours/">
				<i class="fal fa-graduation-cap"></i>
				<span>Курстарым</span>
			</a>
			<a class="pmenu_i <?=($menu_name=='sub'?'pmenu_i_act':'')?>" href="/user/sub/">
				<i class="fal fa-users-class"></i>
				<span>Даму клубым</span>
			</a>
         <a class="pmenu_i <?=($menu_name=='user'?'pmenu_i_act':'')?>" href="/user/">
            <i class="fal fa-user"></i>
            <span>Аккаунтым</span>
         </a>
      </div>
   </div>
<? endif ?>

<!-- body start -->
<div class="app">

	<div class="ub1">
		<div class="ub1_l">

			<div class="ub1_lm">
				<div class="ub1_ly" href="#">
					<div>AS</div>
					<span><?=$site['name']?></span>
				</div>
				<div class="umenu_c">
					<div class="umenu_co">Меню</div>

					<? if (!$user_right): ?>
						<!-- <a class="umenu_ci <?=($menu_name=='dashboard'?'menu_ci_act':'')?>" href="/u/dashboard.php">
							<div class="umenu_cin"><i class="fal fa-chalkboard-teacher"></i></div>
							<div class="umenu_cih">Оқу үстелі</div>
						</a> -->
						<a class="umenu_ci <?=($menu_name=='cours'?'menu_ci_act':'')?>" href="/user/cours/">
							<div class="umenu_cin"><i class="fal fa-graduation-cap"></i></div>
							<div class="umenu_cih">Курстар</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='sub'?'menu_ci_act':'')?>" href="/user/sub/">
							<div class="umenu_cin"><i class="fal fa-users-class"></i></div>
							<div class="umenu_cih">Даму клубым</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='chat'?'menu_ci_act':'')?>" href="/user/chat/">
							<div class="umenu_cin"><i class="fal fa-comments-alt"></i></div>
							<div class="umenu_cih">Куратормен чат 
								<? if (fun::chat_view_sum2($user_id) != 0): ?>
									<span><?=fun::chat_view_sum2($user_id)?></span>
								<? endif ?>
							</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='homework'?'menu_ci_act':'')?>" href="/user/homework/">
							<div class="umenu_cin"><i class="fal fa-pennant"></i></div>
							<div class="umenu_cih">Үй жұмыстарым</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='reviews'?'menu_ci_act':'')?>" href="/user/reviews/">
							<div class="umenu_cin"><i class="fal fa-comment-alt-lines"></i></div>
							<div class="umenu_cih">Пікірлерім</div>
						</a>
					<? else: ?>
						<a class="umenu_ci <?=($menu_name=='cours'?'menu_ci_act':'')?>" href="/user/cours/all.php">
							<div class="umenu_cin"><i class="fal fa-graduation-cap"></i></div>
							<div class="umenu_cih">Курстар</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='sub'?'menu_ci_act':'')?>" href="/user/sub/">
							<div class="umenu_cin"><i class="fal fa-users-class"></i></div>
							<div class="umenu_cih">Даму клубы</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='users'?'menu_ci_act':'')?>" href="/user/admin/users/">
							<div class="umenu_cin"><i class="fal fa-users"></i></div>
							<div class="umenu_cih">Қолданушылар</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='chat'?'menu_ci_act':'')?>" href="/user/chat/admin">
							<div class="umenu_cin"><i class="fal fa-comments-alt"></i></div>
							<div class="umenu_cih">Чат
								<? if (fun::chat_view_sum() != 0): ?>
									<span><?=fun::chat_view_sum()?></span>
								<? endif ?>
							</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='homework'?'menu_ci_act':'')?>" href="/user/homework/admin">
							<div class="umenu_cin"><i class="fal fa-pennant"></i></div>
							<div class="umenu_cih">Үй жұмыстары</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='reviews'?'menu_ci_act':'')?>" href="/user/reviews/admin">
							<div class="umenu_cin"><i class="fal fa-comment-alt-lines"></i></div>
							<div class="umenu_cih">Пікірлер</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='ques'?'menu_ci_act':'')?>" href="/user/admin/ques/">
							<div class="umenu_cin"><i class="fal fa-comment-dots"></i></div>
							<div class="umenu_cih">Сұрақ-жауап</div>
						</a>
						<a class="umenu_ci <?=($menu_name=='test'?'menu_ci_act':'')?>" href="/user/admin/test/">
							<div class="umenu_cin"><i class="fal fa-clipboard-list-check"></i></div>
							<div class="umenu_cih">Тесттер</div>
						</a>
						<!-- <div class="umenu_ci">
							<div class="umenu_cin"><i class="fal fa-wallet"></i></div>
							<div class="umenu_cih">
								<?// if (get_balance()): ?> <?//=get_balance();?> тг
								<?// else: ?> Белгісіз <?// endif ?>
							</div>
						</div> -->
					<? endif ?>
					<!-- <a class="umenu_ci" href="#">
						<div class="umenu_cin"><i class="fal fa-award"></i></div>
						<div class="umenu_cih">Академия жайлы</div>
					</a> -->
					<!-- <a class="umenu_ci" href="/user/exit.php">
						<div class="umenu_cin"><i class="fal fa-sign-out"></i></div>
						<div class="umenu_cih">Шығу</div>
					</a> -->
				</div>
				<!-- <div class="umenu_c">
					<div class="umenu_co">Баптаулар</div>
					<a class="umenu_ci <?=($menu_name=='setting'?'menu_ci_act':'')?>" href="/u/setting.php">
						<div class="umenu_cin"><i class="fal fa-cog"></i></div>
						<div class="umenu_cih">Баптаулар</div>
					</a>
				</div> -->
			</div>
			<div class="ub1_lx">
				<div class="ub1_lt" href="/user/">
					<div class="ub1_lti lazy_img" data-src="/assets/img/users/<?=$user['logo']?>"><? if (!$user['logo']): ?><i class="fal fa-user"></i><? endif ?></div>
					<div class="ub1_ltf"><?=$user['name']?> <?=($user['surname']?substr($user['surname'],0,1).'.':'')?></div>
					<div class="ub1_ltic"><i class="fal fa-ellipsis-v"></i></div>
				</div>
				<div class="menu_c">
					<a class="menu_ci" href="/user/">
						<div class="menu_cin"><i class="fal fa-user"></i></div>
						<div class="menu_cih">Жеке деректер</div>
					</a>
					<a class="menu_ci" href="/user/exit.php">
						<div class="menu_cin"><i class="fal fa-sign-out"></i></div>
						<div class="menu_cih">Шығу</div>
					</a>
				</div>
			</div>
		</div>
		<div class="ub1_c">

			<!--  -->
			<? if ($site_set['utop'] != 'false'): ?>
				<div class="uhead">
					<? if ($site_set['utop_bk']): ?>
						<a class="uhead_lb" href="/user/<?=$site_set['utop_bk']?>"><i class="fal fa-long-arrow-left"></i></a>
					<? endif ?>
					<h4 class="uhead_c"><?=$site_set['utop_nm']?></h4>
				</div>
			<? endif ?>