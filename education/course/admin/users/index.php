<? include "../../../../config/core_edu.php";
	
	// Қолданушыны тексеру
	if (!$user_right) header('location: /education/');


	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
			$category = fun::category($cours_d['category_id']);
			// $autor = fun::autor($cours_d['autor_id']);
			
			$home_work = fun::cours_work($cours_id);

			// if ($course_d['info']) $course_d = array_merge($course_d, fun::course_info($course_d['id']));
		} else header('location: /education/');
	} else header('location: /education/');


	// filter user all
	if (isset($_GET['on']) && $_GET['on'] == 1) $cours_buy_all = db::query("select * from c_buy where cours_id = '$cours_id' and off is null");
	elseif (isset($_GET['off']) && $_GET['off'] == 1) $cours_buy_all = db::query("select * from c_buy where cours_id = '$cours_id' and off is not null");
	else $cours_buy_all = db::query("select * from c_buy where cours_id = '$cours_id'");
	$page_result = mysqli_num_rows($cours_buy_all);

	// page number
	$page = 1; if (isset($_GET['page']) && $_GET['page'] && is_int(intval($_GET['page']))) $page = $_GET['page'];
	$page_age = 50;
	$page_all = ceil($page_result / $page_age);
	if ($page > $page_all && $page_all != 0) $page = $page_all;
	$page_start = ($page - 1) * $page_age;
	$number = $page_start;

	// filter cours
	if (isset($_GET['on']) &&  $_GET['on'] == 1) $cours_buy = db::query("select * from c_buy where cours_id = '$cours_id' and off is null order by ins_dt desc limit $page_start, $page_age");
	elseif (isset($_GET['off']) &&  $_GET['off'] == 1) $cours_buy = db::query("select * from c_buy where cours_id = '$cours_id' and off is not null order by ins_dt desc limit $page_start, $page_age");
	else $cours_buy = db::query("select * from c_buy where cours_id = '$cours_id' order by ins_dt desc limit $page_start, $page_age");

	// Сайттың баптаулары
	$menu_name = 'item';
	$pod_menu_name = 'users';

	$site_set['menu_mb'] = false;
	$site_set['utop_nm'] = 'Оқушылар';
	$site_set['utop_bk'] = 'course/admin/?id='.$cours_id;
	$css = ['education/item', 'education/user2'];
	$js = ['education/admin'];

?>
<? include "../../../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<? include "../iheader.php"; ?>

			<div class="ucours_t">
				<div class="ucours_tl">
					<div class="ucours_tm ucours_tm_btn">
						<button class="btn btn_cm add_user_btn">
							<i class="fal fa-user-plus"></i>
							<span>Оқушыны қосу</span>
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
					<input type="text" placeholder="Іздеуді қолданыңыз" class="form_im_txt cours_user_search_in" data-cours-id="<?=$cours_id?>" />
					<i class="fal fa-search form_icon"></i>
				</div>
				<div class="uc_uh">
					<div class="uc_uhn">
						<div class="uc_uh_number">#</div>
						<div class="uc_uh_right">Күйі</div>
						<div class="uc_uh_name">Аты-жөні</div>
						<div class="uc_uh_other">Жазылым аяқталуына</div>
						<? if (fun::pack_sum($cours_id) > 1): ?><div class="uc_uh_other">Пакет</div><? endif ?>
						<!-- <div class="uc_uh_other">Процесс</div> -->
					</div>
					<div class="uc_uh_cn"></div>
				</div>

				<div class="uc_uc">
					<? if (mysqli_num_rows($cours_buy)): ?>
						<? while ($buy_d = mysqli_fetch_assoc($cours_buy)): ?>
							<? $user_d = fun::user($buy_d['user_id']); ?>
							<? $pack_d = fun::pack($buy_d['pack_id']); ?>
							<? $number++; ?>

							<div class="uc_ui">
								<div class="uc_uil">
									<div class="uc_ui_number"><?=$number?></div>
									<div class="uc_ui_right">
										<div class="form_im form_im_toggle">
											<input type="checkbox" class="homework" data-val="" />
											<div class="form_im_toggle_btn <?=($buy_d['off']?'':'form_im_toggle_act')?> sub_buy_off" data-id="<?=$buy_d['id']?>"></div>
										</div>
									</div>
									<a class="uc_uiln" href="/user/admin/users/item/?id=<?=$user_d['id']?>">
										<div class="uc_ui_icon lazy_img" data-src="/assets/uploads/users/<?=$user_d['img']?>"><?=($user_d['img']!=null?'':'<i class="fal fa-user"></i>')?></div>
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

									<? if (fun::pack_sum($cours_id) > 1): ?> <div class="uc_uin_other" data-name="Пакет"><?=@$pack_d['name_kz']?></div> <? endif ?>
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
										<div class="menu_ci uc_uib_del user_del">
											<div class="menu_cin"><i class="fal fa-trash-alt"></i></div>
											<div class="menu_cih">Оқушыны өшіру</div>
										</div>
									</div>
								</div>
							</div>
						<? endwhile ?>
					
					<? else: ?>
						<div class="ds_nr">
							<i class="fal fa-ghost"></i>
							<p>Ешкім жоқ</p>
						</div>
					<? endif ?>

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
			<? endif ?>

		</div>
	</div>

	<div class="ucours_tm ucours_tm_btn dsp_n">
		<button class="btn btn_cm add_user_btn">
			<i class="fal fa-user-plus"></i>
			<span>Оқушыны қосу</span>
		</button>
	</div>

<? include "../../../block/footer.php"; ?>


	<!--  -->
	<div class="pop_bl sel_id set_user">
		<div class="pop_bl_a set_user_back"></div>
		<div class="pop_bl_c">
			<!-- <div class="btn btn_dd2 set_user_back"><i class="fal fa-times"></i></div> -->
			<div class="">
				<div class="menu_ci cursor_none" data-title="Доступ уақытын ауыстыру">
					<div class="menu_cin"><i class="fal fa-calendar-alt"></i></div>
					<div class="menu_cih">Доступ уақыты</div>
				</div>
				<div class="menu_ci sms_send" data-title="Смс қайта жіберу" data-id="<?=$buy_d['id']?>">
					<div class="menu_cin"><i class="fal fa-paper-plane"></i></div>
					<div class="menu_cih">СМС қайта жіберу</div>
				</div>
				<div class="menu_ci uc_uib_del user_del" data-title="Оқушыны өшіру" data-id="<?=$buy_d['id']?>">
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
							<div class="form_span">Пакет:</div>
							<div class="form_txt sel_clc pack" data-val="">Таңдау:</div>
							<i class="fal fa-ballot-check form_icon"></i>
							<i class="fal fa-caret-down form_icon_sel"></i>
							<div class="form_im_sel sel_clc_i">
								<? while ($pack_d = mysqli_fetch_assoc($pack)): ?>
									<div class="form_im_seli pack_each" data-val="<?=$pack_d['id']?>"><?=$pack_d['name_'.$lang]?></div>
								<? endwhile ?>
							</div>
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
							<div class="form_span">Телефон номері:</div>
							<input type="tel" class="form_txt phone fr_phone" placeholder="8 (000) 000-00-00" data-lenght="11">
							<i class="far fa-mobile form_icon"></i>
						</div>
						<!-- <div class="form_im form_im_toggle">
							<div class="form_span">СМС-ті жіберу:</div>
							<input type="checkbox" class="cours_sms_send" data-val="1">
							<div class="form_im_toggle_btn form_im_toggle_act"></div>
						</div> -->
					</div>
					<div class="cn_mail dsp_n">
						<div class="form_im ">
							<div class="form_span">Почтасы:</div>
							<input type="text" class="form_txt mail" placeholder="Почта" data-lenght="6">
							<i class="far fa-at form_icon"></i>
						</div>
					</div>
				</div>

				<div class="form_c">
					<div class="form_im form_im_bn">
						<div class="btn btn_cm add_user_send" data-cours-id="<?=$cours_id?>">
							<span>Қосу</span>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>



	<!-- <div class="coursls_i coursls_i_rg sms_send_all" data-cours-id="<?=$cours_id?>">
		<div class="bq_ci_s">
			<i class="far fa-paper-plane"></i>
			<span>СМС кайта жіберу</span>
		</div>
	</div> -->