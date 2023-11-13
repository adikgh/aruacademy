<? include "../../../../config/core_edu.php";

	//
	if (!$user_right) header('location: /education/');


	// Курс деректері
	$sub_id = 1;
	$sub = db::query("select * from c_sub where id = '$sub_id'");
	$sub = mysqli_fetch_assoc($sub);


	// Оқушылар тізімі
	$filter = 1;
	if (@$_GET['on'] == 1) {
		$sub_buy = db::query("select * from c_sub_buy where sub_id = '$sub_id' and off is null order by ins_dt desc limit 50");
		$cours_sub_num = db::query("select * from c_sub_buy where sub_id = '$sub_id' and off is null order by ins_dt desc");
	} elseif (@$_GET['off'] == 1) {
		$sub_buy = db::query("select * from c_sub_buy where sub_id = '$sub_id' and off is not null order by ins_dt desc limit 50");
		$cours_sub_num = db::query("select * from c_sub_buy where sub_id = '$sub_id' and off is not null order by ins_dt desc");
	} else {
		$sub_buy = db::query("select * from c_sub_buy where sub_id = '$sub_id' order by ins_dt desc limit 50");
		$filter = 0;
	}



	// 
	$menu_name = 'club';
	$pod_menu_name = 'users';
	$site_set['utop_nm'] = $sub['name_'.$lang].' (оқушылар)';
	// $site_set['utop_bk'] = 'cours/item/?id='.$cours_id;
	// $site_set['um_menu'] = '';
	$css = ['admin/cours', 'admin/item', 'admin/club/main', 'admin/user'];
	$js = ['education/club/main', 'education/admin'];
	$date = new DateTime();
	$sum = 0;

?>
<? include "../../../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="head_c">
				<h3>Клуб</h3>
			</div>
			
			<div class="ucours_t">
				<div class="ucours_tl">
					<div class="ucours_tm ucours_tm_btn">
						<button class="btn btn_cm add_user_btn">
							<i class="fal fa-user-plus"></i>
							<span>Қосу</span>
						</button>
					</div>
					<div class="ucours_tm">
						<div class="ucours_tmi ucours_tm_act">
							<i class="fal fa-sort ucours_tmic"></i>
							<span>Сұрыптау</span>
						</div>
						<div class="menu_c ucours_tma">
							<a class="menu_ci" href="/admin/products/all/?sort=1">
								<div class="menu_cin"><i class="fal fa-circle"></i></div>
								<div class="menu_cih">по дата создание</div>
							</a>
							<a class="menu_ci" href="/admin/products/all/?sort=1">
								<div class="menu_cin"><i class="fal fa-circle"></i></div>
								<div class="menu_cih">по названием</div>
							</a>
							<a class="menu_ci" href="/admin/products/all/?sort=1">
								<div class="menu_cin"><i class="fal fa-circle"></i></div>
								<div class="menu_cih">по ценам</div>
							</a>
						</div>
					</div>
					<div class="ucours_tm">
						<div class="ucours_tmi ucours_tm_act">
							<i class="fal fa-filter ucours_tmic"></i>
							<span>Сұзгі</span>
						</div>
					</div>
				</div>
				<div class="ucours_to">
					<div class="ucours_tol">Барлығы: <?=$page_result?> адам</div>
					<div class="ucours_tor">Сүзгі және сұрыптау</div>
				</div>
				<div class="ucours_tr">
					<div class="ucours_trn">Барлығы: <?=@$page_result?></div>
					<? if (@$page_all > 1): ?>
						<div class="ucours_trn">Бет: <?=$page?>/<?=$page_all?></div>
						<div class="ucours_trnc">
							<a class="ucours_trnci <?=($page>1?'':'ucours_trnci_ds')?>" href="<?=$url?>?id=<?=$cours_id?>&page=<?=$page-1?>"><i class="fal fa-angle-left"></i></a>
							<a class="ucours_trnci <?=($page<$page_all?'':'ucours_trnci_ds')?>" href="<?=$url?>?id=<?=$cours_id?>&page=<?=$page+1?>"><i class="fal fa-angle-right"></i></a>
						</div>
					<? endif ?>
				</div>
			</div>
	
			<!-- list -->
			<div class="uc_u">

				<div class="form_im uc_us">
					<input type="text" placeholder="Іздеуді қолданыңыз" class="form_im_txt sub_user_search_in" data-cours-id="<?=$cours_id?>" />
					<i class="fal fa-search form_icon"></i>
				</div>

				<div class="uc_uh">
					<div class="uc_uhn">
						<div class="uc_uh_number">#</div>
						<div class="uc_uh_right">Күйі</div>
						<div class="uc_uh_name">Аты-жөні</div>
						<div class="uc_uh_other">Жазылым аяқталуына</div>
						<div class="uc_uh_other">Процесс</div>
					</div>
					<div class="uc_uh_cn"></div>
				</div>

				<div class="uc_uc">
					<? if (mysqli_num_rows($sub_buy) != 0): ?>
						<? while ($buy_d = mysqli_fetch_assoc($sub_buy)): ?>
							<? $user_d = fun::user($buy_d['user_id']); ?>
							<? $sum++; ?>
	
							<div class="uc_ui" data-id="<?=$buy_d['id']?>">
								<div class="uc_uil">
									<div class="uc_ui_number"><?=$sum?></div>
									<div class="uc_ui_right">
										<div class="form_im form_im_toggle">
											<input type="checkbox" class="homework" data-val="" />
											<div class="form_im_toggle_btn <?=($buy_d['off']?'':'form_im_toggle_act')?> sub_buy_off" data-id="<?=$buy_d['id']?>"></div>
										</div>
									</div>
									<a class="uc_uiln" href="/user/admin/users/item/?id=<?=$user_d['id']?>">
										<div class="uc_ui_icon lazy_img" data-src="/assets/img/users/<?=$user_d['img']?>"><?=($user_d['img']!=null?'':'<i class="fal fa-user"></i>')?></div>
										<div class="uc_uinu">
											<div class="uc_ui_name"><?=$user_d['name']?> <?=$user_d['surname']?></div>
											<div class="uc_ui_phone"><?=($user_d['phone'] != null?$user_d['phone']:$user_d['mail'])?></div>
										</div>
									</a>
	
									<? if ($buy_d['ins_dt'] != null && $buy_d['end_dt'] != null):?>
										<? $result = intval((strtotime($buy_d['end_dt']) - strtotime(date("d.m.Y"))) / (60*60*24)); ?>
										<? $access = intval((strtotime($buy_d['end_dt']) - strtotime($buy_d['ins_dt'])) / (60*60*24)); ?>
										<?	if (($access - $result) == 0) $precent = 0; elseif (($access - $result) < $access) $precent = round(100 / ($access / ($access - $result))); else $precent = 100; ?>
									<? endif ?>
									<div class="uc_uin_other uc_uin_date">
										<? if ($buy_d['end_dt'] != null): ?>
											<div class="uc_uin_date_u">
												<div class="">
													<? if ($result > 0): ?><?=$result?> күн қалды
													<? else: ?>Аяқталды<? endif ?>
												</div>
												<div class=""><?=$precent?>%</div>
											</div>
											<div class="uc_uin_date_i"><span style="width:<?=$precent?>%"></span></div>
										<? else: ?><div class="uc_uin_date_u">Шексіз</div><? endif ?>
									</div>

									<div class="uc_uin_other" data-name="Процесс">
										<div>
											<? if ($user_d['password']): ?>
												<? if ($buy_d['open']): ?>Сабақты бастаған
												<? else: ?>Сабаққа кірмеген<? endif ?>
											<? else: ?>Аккаунтқа кірмеген<? endif ?>
										</div>
									</div>
								</div>
								<div class="uc_uib sel_id" data-id="<?=$buy_d['id']?>">
									<div class="uc_uibo"><i class="fal fa-ellipsis-v"></i></div>
									<div class="menu_c uc_uibs">
										<div class="menu_ci cursor_none">
											<div class="menu_cin"><i class="fal fa-calendar-alt"></i></div>
											<div class="menu_cih">Доступ уақыты</div>
										</div>
										<div class="menu_ci sms_send">
											<div class="menu_cin"><i class="fal fa-paper-plane"></i></div>
											<div class="menu_cih">СМС қайта жіберу</div>
										</div>
										<div class="menu_ci uc_uib_del sub_user_del">
											<div class="menu_cin"><i class="fal fa-trash-alt"></i></div>
											<div class="menu_cih">Оқушыны өшіру</div>
										</div>
									</div>
								</div>
							</div>
						<? endwhile ?>
					
					<? else: ?> <div class="ds_nr"><i class="fal fa-ghost"></i><p>Ешкім жоқ</p></div> <? endif ?>
	
				</div>
			</div>

		</div>

	</div>


	<div class="ucours_tm ucours_tm_btn dsp_n" style="bottom:74px;">
		<button class="btn btn_cm add_user_btn">
			<i class="fal fa-user-plus"></i>
			<span>Оқушыны қосу</span>
		</button>
	</div>

<? include "../../../block/footer.php"; ?>

	
<!-- user plus -->
	<div class="pop_bl add_user">
		<div class="pop_bl_a add_user_back"></div>
		<div class="pop_bl_c">
			<div class="head_c txt_c">
				<h4>Оқушыны қосу</h4>
				<p>Нөмерін немесе почтасын жазыңыз<br>доступ ашылады</p>
			</div>
			<div class="form_c">
				<div class="form_im form_im_btn">
					<div class="form_im_btn_t">Доступ түрі:</div>
					<div class="form_im_btn_i form_im_btn_act"><i class="fal fa-mobile"></i><span>Телефон</span></div>
					<div class="form_im_btn_i"><i class="fal fa-at"></i><span>Почта</span></div>
				</div>
				<div class="form_im cn_phone">
					<i class="far fa-mobile form_icon"></i>
					<input type="tel" class="form_txt fr_phone phone " placeholder="8 (000) 000-00-00" data-lenght="11">
				</div>
				<div class="form_im cn_mail dsp_n">
					<i class="far fa-at form_icon"></i>
					<input type="text" class="form_txt mail" placeholder="Почта" data-lenght="6">
				</div>
				<div class="form_im form_im_bn">
					<div class="btn add_user_sub_send" data-sub-id="<?=$sub_id?>">Қосу</div>
				</div>
			</div>
		</div>
	</div>