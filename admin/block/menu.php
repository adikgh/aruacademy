<? if ($site_set['um_menu']): ?>
   <div class="pmenu">
      <div class="pmenu_c">
			<a class="pmenu_i <?=($menu_name=='list'?'pmenu_i_act':'')?>" href="/admin/list/"><i class="fal fa-graduation-cap"></i></a>
			<a class="pmenu_i <?=($menu_name=='club'?'pmenu_i_act':'')?>" href="/admin/club/"><i class="fal fa-users-class"></i></a>
			<div class="pmenu_i pmenu_is">
				<i class="fal fa-plus"></i>
			</div>
			<a class="pmenu_i <?=($menu_name=='users'?'pmenu_i_act':'')?>" href="/admin/users/"><i class="fal fa-users"></i></a>
         <a class="pmenu_i <?=($menu_name=='user'?'pmenu_i_act':'')?>" href="/admin/acc/"><i class="fal fa-user"></i></a>
      </div>
   </div>
<? endif ?>

<!-- body start -->
<div class="app">

	<div class="ub1_l">
		<div class="ub1_lc">
			<div class="ub1_lm">
				<div class="ub1_lmq">
					<div class="ub1_lmqc"><i class="fal fa-bars"></i></div>
				</div>
				<div class="umenu_c">
					<!-- <div class="umenu_co">Меню</div> -->
					<a class="umenu_ci <?=($menu_name=='list'?'menu_ci_act':'')?>" href="/admin/list/" data-title="Курстар">
						<div class="umenu_cin"><i class="fal fa-graduation-cap"></i></div>
						<div class="umenu_cih">Курстар</div>
					</a>
					<a class="umenu_ci <?=($menu_name=='club'?'menu_ci_act':'')?>" href="/admin/club/" data-title="Даму клубы">
						<div class="umenu_cin"><i class="fal fa-users-class"></i></div>
						<div class="umenu_cih">Даму клубы</div>
					</a>
					<a class="umenu_ci <?=($menu_name=='users'?'menu_ci_act':'')?>" href="/admin/users/" data-title="Қолданушылар">
						<div class="umenu_cin"><i class="fal fa-users"></i></div>
						<div class="umenu_cih">Қолданушылар</div>
					</a>
					<a class="umenu_ci <?=($menu_name=='chats'?'menu_ci_act':'')?>" href="/admin/chats/" data-title="Чат">
						<div class="umenu_cin"><i class="fal fa-comments-alt"></i></div>
						<div class="umenu_cih">Чат
							<? if (fun::chat_view_sum() != 0): ?>
								<span><?=fun::chat_view_sum()?></span>
							<? endif ?>
						</div>
					</a>
					<a class="umenu_ci <?=($menu_name=='works'?'menu_ci_act':'')?>" href="/admin/works/" data-title="Үй жұмысы">
						<div class="umenu_cin"><i class="fal fa-pennant"></i></div>
						<div class="umenu_cih">Үй жұмысы</div>
					</a>
					<!-- <a class="umenu_ci <?=($menu_name=='ques'?'menu_ci_act':'')?>" href="/admin/ques/">
						<div class="umenu_cin"><i class="fal fa-comment-dots"></i></div>
						<div class="umenu_cih">Сұрақ-жауап</div>
					</a> -->
					<!-- <a class="umenu_ci <?=($menu_name=='reviews'?'menu_ci_act':'')?>" href="/admin/reviews/">
						<div class="umenu_cin"><i class="fal fa-comment-alt-lines"></i></div>
						<div class="umenu_cih">Пікірлер</div>
					</a>
					<a class="umenu_ci <?=($menu_name=='test'?'menu_ci_act':'')?>" href="/admin/test/">
						<div class="umenu_cin"><i class="fal fa-clipboard-list-check"></i></div>
						<div class="umenu_cih">Тесттер</div>
					</a> -->
				</div>
				<div class="umenu_c">
					<a class="umenu_ci <?=($menu_name=='company'?'menu_ci_act':'')?>" href="/admin/company" data-title="Компания">
						<div class="umenu_cin"><i class="fal fa-award"></i></div>
						<div class="umenu_cih">Компания</div>
					</a>
					<a class="umenu_ci" href="#" data-title="Баланс">
						<div class="umenu_cin"><i class="fal fa-wallet"></i></div>
						<div class="umenu_cih">
							<?// if (get_balance()): ?> <?//=get_balance();?> тг
							<?// else: ?> Белгісіз <?// endif ?>
						</div>
					</a>
				</div>
			</div>
			<div class="ub1_lx">
				<div class="ub1_lt" href="/admin/" data-title="<?=$user['name']?> <?=($user['surname']?substr($user['surname'],0,1).'.':'')?>">
					<div class="ub1_lti lazy_img" data-src="/assets/uploads/users/<?=$user['img']?>"><? if (!$user['img']): ?><i class="fal fa-user"></i><? endif ?></div>
					<div class="ub1_ltf"><?=$user['name']?> <?=($user['surname']?substr($user['surname'],0,1).'.':'')?></div>
					<div class="ub1_ltic"><i class="fal fa-ellipsis-v"></i></div>
				</div>
				<div class="menu_c">
					<div class="menu_ci user_edit_pop">
						<div class="menu_cin"><i class="fal fa-user"></i></div>
						<div class="menu_cih">Менің аккаунтым</div>
					</div>
					<div class="menu_ci user_ph_pop">
						<div class="menu_cin"><i class="fal fa-mobile"></i></div>
						<div class="menu_cih">Телефон номерім</div>
					</div>
					<a class="menu_ci" href="https://wa.me/<?=$site['whatsapp']?>">
						<div class="menu_cin"><i class="fal fa-comment-dots"></i></div>
						<div class="menu_cih">Көмек (Whatsapp)</div>
					</a>
					<a class="menu_ci" href="/admin/exit.php">
						<div class="menu_cin"><i class="fal fa-sign-out"></i></div>
						<div class="menu_cih">Шығу</div>
					</a>
					<!-- <div class="umenu_c">
						<div class="umenu_co">Баптаулар</div>
						<a class="umenu_ci <?=($menu_name=='setting'?'menu_ci_act':'')?>" href="/u/setting.php">
							<div class="umenu_cin"><i class="fal fa-cog"></i></div>
							<div class="umenu_cih">Баптаулар</div>
						</a>
					</div> -->
				</div>
			</div>
		</div>

	</div>

	<? if ($site_set['utop']): ?>
		<div class="uhead">
			<? if ($site_set['utop_bk']): ?> <a class="uhead_lb" href="/admin/<?=$site_set['utop_bk']?>"><i class="fal fa-long-arrow-left"></i></a> <? endif ?>
			<h4 class="uhead_c"><?=$site_set['utop_nm']?></h4>
		</div>
	<? endif ?>