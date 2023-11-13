<? include "../../config/core_edu.php";

	// Қолданушыны тексеру
	if (!$user_right) header('location: /education/');


	// $cours_id = 5;

	// filter user all
	if (@$_GET['on'] == 1) $cours_buy_all = db::query("select * from user where `right` is null and locked is null");
	elseif (@$_GET['off'] == 1) $cours_buy_all = db::query("select * from user where `right` is null and locked is not null");
	else $cours_buy_all = db::query("select * from user where `right` is null");
	$page_result = mysqli_num_rows($cours_buy_all);

	// page number
	$page = 1; if (@$_GET['page'] && is_int(intval($_GET['page']))) $page = $_GET['page'];
	$page_age = 50;
	$page_all = ceil($page_result / $page_age);
	if ($page > $page_all) $page = $page_all;
	$page_start = ($page - 1) * $page_age;
	$number = $page_start;

	// filter cours
	if (@$_GET['on'] == 1) $users = db::query("select * from user where `right` is null and locked is null order by id desc limit $page_start, $page_age");
	elseif (@$_GET['off'] == 1) $users = db::query("select * from user where `right` is null and locked is not null order by id desc limit $page_start, $page_age");
	else $users = db::query("select * from user where `right` is null order by id desc limit $page_start, $page_age");

	

	// site setting
	$menu_name = 'users';
	$site_set['um_menu'] = true;
	$site_set['utop'] = false;

	$site_set['utop_nm'] = 'Қолданушылар';
	$site_set['utop_bk'] = 'acc/';
	if (isset($_GET['back'])) $site_set['utop_bk'] = $_GET['back'];

	// $css = ['education/admin'];
	$css = ['admin/user'];
	$js = ['education/admin'];
?>
<? include "../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="head_c">
				<h4>Қолданушылар тізімі</h4>
			</div>

			<? // include "iheader.php"; ?>

			<div class="ucours_t">
				<div class="ucours_tl">
					<div class="ucours_tm ucours_tm_btn">
						<button class="btn btn_cm add_user_btn">
							<i class="fal fa-user-plus"></i>
							<span>Оқушы қосу</span>
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
					<div class="ucours_trn">Барлығы: <?=$page_result?></div>
					<? if ($page_all > 1): ?>
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
					<input type="text" placeholder="Іздеуді қолданыңыз" class="form_im_txt user_search_in" />
					<i class="fal fa-search form_icon"></i>
				</div>
				<div class="uc_uh">
					<div class="uc_uhn">
						<div class="uc_uh_number">#</div>
						<div class="uc_uh_right">Күйі</div>
						<div class="uc_uh_name">Аты-жөні</div>
						<div class="uc_uh_other">Телефон / Почта</div>
						<div class="uc_uh_other">Тіркелген уақыты</div>
						<div class="uc_uh_other">Курстары</div>
					</div>
					<div class="uc_uh_cn"></div>
				</div>
				<div class="uc_uc">
					<? if (mysqli_num_rows($users) != 0): ?>
						<? while ($user_d = mysqli_fetch_assoc($users)): ?>
							<? $number++; ?>

							<div class="uc_ui">
								<div class="uc_uil">
									<div class="uc_ui_number"><?=$number?></div>
									<div class="uc_ui_right">
										<div class="form_im form_im_toggle">
											<input type="checkbox" class="homework" data-val="" />
											<div class="form_im_toggle_btn <?=($user_d['locked']?'':'form_im_toggle_act')?> sub_buy_off" data-id="<?=$user_d['id']?>"></div>
										</div>
									</div>
									<a class="uc_uiln" href="/user/admin/users/item/?id=<?=$user_d['id']?>">
										<div class="uc_ui_icon lazy_img" data-src="/assets/img/users/<?=$user_d['img']?>"><?=($user_d['img']!=null?'':'<i class="fal fa-user"></i>')?></div>
										<div class="uc_ui_name"><?=$user_d['name']?> <?=$user_d['surname']?></div>
									</a>
									<div class="uc_uin_other">
										<? if ($user_d['phone']): ?> <div class="uc_ui_phone fr_phone" data-name="Телефон:"><?=$user_d['phone']?></div> <? endif ?>
										<? if ($user_d['mail']): ?> <div class="uc_ui_phone" data-name="Почта:"><?=$user_d['mail']?></div> <? endif ?>
									</div>
									<div class="uc_uin_other" data-name="Тіркелген уақыты:">
										<? if ($user_d['ins_dt']): ?> <?=date("d.m.Y", strtotime($user_d['ins_dt']))?> <?=date("H:i", strtotime($user_d['ins_dt']))?> 
										<? else: ?> Белгісіз <? endif ?>
									</div>
								</div>
								<div class="uc_uib sel_id" data-id="<?=$user_d['id']?>" data-pass="<?=$user_d['password']?>">
									<div class="uc_uibo" ><i class="fal fa-ellipsis-v"></i></div>
									<div class="menu_c uc_uibs">
										<div class="menu_ci ">
											<div class="menu_cin"><i class="fal fa-paper-plane"></i></div>
											<div class="menu_cih">Қабарлама жіберу</div>
										</div>
										<div class="menu_ci ">
											<div class="menu_cin"><i class="fal fa-pen"></i></div>
											<div class="menu_cih">Өзгерту</div>
										</div>
										<div class="menu_ci copy_pass">
											<div class="menu_cin"><i class="fal fa-key"></i></div>
											<div class="menu_cih">Кілт сөзді көшіріп алу</div>
										</div>
										<div class="menu_ci ">
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

			<? if ($page_all > 1): ?>
				<div class="uc_p">
					<? if ($page > 1): ?> <a class="uc_pi" href="<?=$url?>?id=<?=$cours_id?>&page=<?=$page-1?>"><i class="fal fa-long-arrow-left"></i></a> <? endif ?>
					<a class="uc_pi <?=($page==1?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&page=1">1</a>
					<? for ($pg = 2; $pg < $page_all; $pg++): ?>
						<? if ($pg == $page - 1): ?>
							<? if ($page - 1 != 2): ?> <div class="uc_pi uc_pi_disp">...</div> <? endif ?>
							<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&page=<?=$pg?>"><?=$pg?></a>
						<? endif ?>
						<? if ($pg == $page): ?> <a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&page=<?=$pg?>"><?=$pg?></a> <? endif ?>
						<? if ($pg == $page + 1): ?>
							<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&page=<?=$pg?>"><?=$pg?></a>
							<? if ($page + 1 != $page_all - 1): ?> <div class="uc_pi uc_pi_disp">...</div> <? endif ?>
						<? endif ?>
					<? endfor ?>
					<a class="uc_pi <?=($page==$page_all?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&page=<?=$page_all?>"><?=$page_all?></a>
					<? if ($page < $page_all): ?> <a class="uc_pi" href="<?=$url?>?id=<?=$cours_id?>&page=<?=$page+1?>"><i class="fal fa-long-arrow-right"></i></a> <? endif ?>
				</div>
				<div class="ucours_tr uc_pb">
					<div class="ucours_trn">Бет: <?=$page?>/<?=$page_all?></div>
					<div class="ucours_trnc">
						<a class="ucours_trnci <?=($page>1?'':'ucours_trnci_ds')?>" href="<?=$url?>?id=<?=$cours_id?>&page=<?=$page-1?>"><i class="fal fa-angle-left"></i></a>
						<a class="ucours_trnci <?=($page<$page_all?'':'ucours_trnci_ds')?>" href="<?=$url?>?id=<?=$cours_id?>&page=<?=$page+1?>"><i class="fal fa-angle-right"></i></a>
					</div>
				</div>
			<? endif ?>

		</div>
	</div>

<? include "../block/footer.php"; ?>


	<!--  -->
	<div class="pop_bl sel_id set_user">
		<div class="pop_bl_a set_user_back"></div>
		<div class="pop_bl_c">
			<!-- <div class="btn btn_dd2 set_user_back"><i class="fal fa-times"></i></div> -->

			<div class="">
				<div class="menu_ci ">
					<div class="menu_cin"><i class="fal fa-paper-plane"></i></div>
					<div class="menu_cih">Қабарлама жіберу</div>
				</div>
				<div class="menu_ci ">
					<div class="menu_cin"><i class="fal fa-pen"></i></div>
					<div class="menu_cih">Өзгерту</div>
				</div>
				<div class="menu_ci copy_pass">
					<div class="menu_cin"><i class="fal fa-key"></i></div>
					<div class="menu_cih">Кілт сөзді көшіріп алу</div>
				</div>
				<div class="menu_ci ">
					<div class="menu_cin"><i class="fal fa-trash-alt"></i></div>
					<div class="menu_cih">Оқушыны өшіру</div>
				</div>
			</div>

		</div>
	</div>


	<!-- user plus -->
	<div class="pop_bl pop_bl2 add_user">
		<div class="pop_bl_a add_user_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h4>Оқушыны қосу</h4>
				<div class="btn btn_dd2 add_user_back"><i class="fal fa-times"></i></div>
				<!-- <p>Номерін немесе почтасын жазыңыз<br>доступ ашылады</p> -->
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<? $pack = db::query("select * from c_pack where cours_id = '$cours_id'"); ?>
					<? if (mysqli_num_rows($pack) > 1): ?>
						<div class="form_im form_sel">
							<div class="form_im_txt sel_clc pack" data-val="">Пакет:</div>
							<i class="fal fa-caret-down form_icon_sel"></i>
							<div class="form_im_sel sel_clc_i">
								<? while ($pack_d = mysqli_fetch_assoc($pack)): ?>
									<div class="form_im_seli pack_each" data-val="<?=$pack_d['id']?>"><?=$pack_d['name_'.$lang]?></div>
								<? endwhile ?>
							</div>
						</div>
					<? else: $pack_d = mysqli_fetch_assoc($pack); ?>
						<div class="form_im form_sel dsp_n">
							<div class="form_im_txt sel_clc pack" data-val="<?=$pack_d['id']?>"><?=$pack_d['name_'.$lang]?></div>
						</div>
					<? endif ?>
				</div>

				<div class="form_c">
					<div class="form_im form_im_btn">
						<div class="form_im_btn_t">Доступ түрі:</div>
						<div class="form_im_btn_i form_im_btn_act"><i class="fal fa-mobile"></i><span>Телефон</span></div>
						<div class="form_im_btn_i"><i class="fal fa-at"></i><span>Почта</span></div>
					</div>
					<div class="cn_phone">
						<div class="form_im ">
							<i class="far fa-mobile form_icon"></i>
							<input type="tel" class="form_im_txt phone fr_phone" placeholder="8 (000) 000-00-00" data-lenght="11">
						</div>
						<div class="form_im form_im_toggle">
							<div class="form_span">СМС-ті жіберу:</div>
							<input type="checkbox" class="cours_sms_send" data-val="1">
							<div class="form_im_toggle_btn form_im_toggle_act"></div>
						</div>
					</div>
					<div class="cn_mail dsp_n">
						<div class="form_im ">
							<i class="far fa-at form_icon"></i>
							<input type="text" class="form_im_txt mail" placeholder="Почта" data-lenght="6">
						</div>
					</div>
				</div>

				<div class="form_c">
					<div class="form_im form_im_bn">
						<div class="btn add_user_send" data-cours-id="<?=$cours_id?>">
							<span>Қосу</span>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>