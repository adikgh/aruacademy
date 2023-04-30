<? if ($site_set['header'] == true): ?>
	<div class="header <?=($site_set['mheader']!='false'?'':'mheader_none')?>">
		<div class="bl_c">
			<div class="header_c">
				<a class="logo" href="/education/"><?=$site['name']?></a>
				<div class="header_r">
					<div class="cmenu">
						<a class="cmenu_i <?=($menu_name=='my'?'cmenu_i_act':'')?>" href="/education/my/">Курстар</a>
						<a class="cmenu_i <?=($menu_name=='club'?'cmenu_i_act':'')?>" href="/education/club/">Клуб</a>
						<a class="cmenu_i <?=($menu_name=='chat'?'cmenu_i_act':'')?>" href="/education/chat/">Чат</a>
						<!-- <a class="cmenu_i <?=($menu_name==''?'cmenu_i_act':'')?>" href="/user/homework/">Үй жұмысы</a> -->
						<!-- <a class="cmenu_i <?=($menu_name==''?'cmenu_i_act':'')?>" href="#"></a> -->
					</div>
					<div class="menu cuser">
						<div class="menu_bars cuserc menu_bars_clc">
							<div class="cuser_c"><?=$user['name']?> <?=($user['surname']?substr($user['surname'],0,1).'.':'')?></div>
							<div class="cuser_i">
								<div class="lazy_img" data-src="/assets/uploads/users/<?=$user['img']?>"><?=($user['img']?'':'<i class="fal fa-user"></i>')?></div>
							</div>
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
							<a class="menu_ci" href="/education/reviews">
								<div class="menu_cin"><i class="fal fa-comment"></i></div>
								<div class="menu_cih">Менің пікірлерім</div>
							</a>
							<a class="menu_ci" href="https://wa.me/<?=$site['whatsapp']?>">
								<div class="menu_cin"><i class="fal fa-comment-dots"></i></div>
								<div class="menu_cih">Көмек (Whatsapp)</div>
							</a>
							<a class="menu_ci" href="/education/exit.php">
								<div class="menu_cin"><i class="fal fa-sign-out"></i></div>
								<div class="menu_cih">Шығу</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<? endif ?>

<? if ($site_set['um_menu'] == true): ?>
   <div class="pmenu">
      <div class="pmenu_c">
			<div class="pmenu_cm">
				<a class="pmenu_i <?=($menu_name=='my'?'pmenu_i_act':'')?>" href="/education/my">
					<i class="fal fa-graduation-cap"></i>
					<span>Курстар</span>
				</a>
				<a class="pmenu_i <?=($menu_name=='club'?'pmenu_i_act':'')?>" href="/education/club">
					<i class="fal fa-users-class"></i>
					<span>Клуб</span>
				</a>
				<a class="pmenu_i <?=($menu_name=='acc'?'pmenu_i_act':'')?>" href="/education/acc">
					<i class="fal fa-user"></i>
					<span><?=$user['name']?> <?=($user['surname']?substr($user['surname'],0,1).'.':'')?></span>
				</a>
			</div>
      </div>
   </div>
<? endif ?>

<div class="app">

	<? if ($site_set['header'] == true): ?>
		<div class="uhead">
			<? if ($site_set['utop_bk']): ?>
				<a class="uhead_lb clc_back" <?=($site_set['utop_bk']!=' '?'href="/education/'.$site_set['utop_bk'].'"':'')?>>
					<i class="fal fa-long-arrow-left"></i>
				</a>
			<? endif ?>
			<h4 class="uhead_c"><?=$site_set['utop_nm']?></h4>
		</div>
	<? endif ?>