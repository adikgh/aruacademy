<?php include "../../../../config/core.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
			$category = fun::category($cours_d['category_id']);
			$autor = fun::autor($cours_d['autor_id']);
		} else header('location: /user/cours/');
	} else header('location: /user/cours/');

	// Жазылымды тексеру
	if (!$user_right) {
		$buy = db::query("select * from c_buy where cours_id = '$cours_id' and user_id = '$user_id'");
		$sub_buy = db::query("select * from c_sub_buy where sub_id = 1 and user_id = '$user_id'");
		$cours_sub = db::query("select * from c_sub_item where cours_id = '$cours_id'");
		if (!mysqli_num_rows($buy) && (!mysqli_num_rows($sub_buy) || !mysqli_num_rows($cours_sub))) header('location: /user/cours/item/info/?id='.$cours_id);
	}

   // Сайттың баптаулары
	$menu_name = 'item';
	$site_set = [
		'utop_nm' => $cours_d['name_'.$lang],
		'utop_bk' => 'cours',
	];
	if (isset($_GET['back'])) $site_set['utop_bk'] = $_GET['back'];
	$css = ['user', 'ucours', 'uitem'];
	$js = ['user'];

	$pack = db::query("select * from c_pack where cours_id = '$cours_id'");

	$lesson_id = $_GET['lesson_id'];
	$lesson_d = fun::lesson($lesson_id);


	// filter user all
	if ($_GET['on'] == 1) $work_all = db::query("select * from user where `right` is null and locked is null");
	elseif ($_GET['off'] == 1) $work_all = db::query("select * from user where `right` is null and locked is not null");
	else $work_all = db::query("select * from home_work where lesson_id = '$lesson_id'");
	$page_result = mysqli_num_rows($work_all);

	// page number
	$page = 1; if ($_GET['page'] && is_int(intval($_GET['page']))) $page = $_GET['page'];
	$page_age = 50;
	$page_all = ceil($page_result / $page_age);
	if ($page > $page_all) $page = $page_all;
	$page_start = ($page - 1) * $page_age;
	$number = $page_start;

	// filter cours
	if ($_GET['on'] == 1) $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit $page_start, $page_age");
	elseif ($_GET['off'] == 1) $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit $page_start, $page_age");
	else $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit $page_start, $page_age");


	// site setting
	$pod_menu_name = 'works';
	$site_set = [
		'utop_nm' => $lesson_d['number'].'. '.$lesson_d['name_'.$lang].' ('.$cours_d['name_'.$lang].') - үй жұмысы',
		'utop_bk' => 'homework/admin/cours/?id='.$cours_id,
	];
	$css = ['user', 'uitem', 'uhomework'];
	$js = ['user', 'admin'];
?>
<? include "../../../../block/header.php"; ?>

	<div class="uitem">

		<!--  -->
		<div class="uhwa">
			<div class="uhwa_l">
				<div class="uhwa_c">
					<div class="uhwa_tn">Үй жұмыстардың тізімі:</div>

					<div class="uhwa_cb">
						<? if (mysqli_num_rows($work)): ?>
							<? while ($work_d = mysqli_fetch_assoc($work)): ?>
								<? $user_d = fun::user($work_d['user_id']); ?>
								<a class="uhwa_i" href="../item.php?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&work_id=<?=$work_d['id']?>">
									<div class="uhwa_itm"><i class="fal fa-user"></i></div>
									<div class="uhwa_ic">
										<div class="uhwa_it">
											<div class="uhwa_itcn">
												<? if ($user_d['name'] && $user_d['name'] != 'USER'): ?> <?=$user_d['name']?> <?=$user_d['surname']?> / <? endif ?>
												<?=$user_d['phone']?>
											</div>
											<div class="uhwa_itcp"><div><?=date("d-m-Y", strtotime($work_d['ins_dt']))?></div><div><?=date("H:i", strtotime($work_d['ins_dt']))?></div></div>
										</div>
										<div class="uhwa_iw">
											<div class="uhwa_iwc"><?=$work_d['txt']?></div>
										</div>
									</div>
								</a>
							<? endwhile ?>
						<? endif ?>
					</div>

					<? if ($page_all > 1): ?>
						<div class="uc_p">
							<? if ($page > 1): ?> <a class="uc_pi" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$page-1?>"><i class="fal fa-long-arrow-left"></i></a> <? endif ?>
							<a class="uc_pi <?=($page==1?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=1">1</a>
							<? for ($pg = 2; $pg < $page_all; $pg++): ?>
								<? if ($pg == $page - 1): ?>
									<? if ($page - 1 != 2): ?> <div class="uc_pi uc_pi_disp">...</div> <? endif ?>
									<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$pg?>"><?=$pg?></a>
								<? endif ?>
								<? if ($pg == $page): ?> <a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$pg?>"><?=$pg?></a> <? endif ?>
								<? if ($pg == $page + 1): ?>
									<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$pg?>"><?=$pg?></a>
									<? if ($page + 1 != $page_all - 1): ?> <div class="uc_pi uc_pi_disp">...</div> <? endif ?>
								<? endif ?>
							<? endfor ?>
							<a class="uc_pi <?=($page==$page_all?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$page_all?>"><?=$page_all?></a>
							<? if ($page < $page_all): ?> <a class="uc_pi" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$page+1?>"><i class="fal fa-long-arrow-right"></i></a> <? endif ?>
						</div>
						<div class="ucours_tr uc_pb">
							<div class="ucours_trn">Бет: <?=$page?>/<?=$page_all?></div>
							<div class="ucours_trnc">
								<a class="ucours_trnci <?=($page>1?'':'ucours_trnci_ds')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$page-1?>"><i class="fal fa-angle-left"></i></a>
								<a class="ucours_trnci <?=($page<$page_all?'':'ucours_trnci_ds')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$page+1?>"><i class="fal fa-angle-right"></i></a>
							</div>
						</div>
					<? endif ?>

				</div>

			</div>
		</div>
	</div>


<? include "../../../../block/footer.php"; ?>