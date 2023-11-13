<? include "../../config/core_edu.php";


	// Қолданушыны тексеру
	if (!$user_id) header('location: /education/');


	// Курс деректері
	// if (isset($_GET['id']) || $_GET['id'] != '') {
	// 	$cours_id = $_GET['id'];
	// 	$cours = db::query("select * from cours where id = '$cours_id'");
	// 	if (mysqli_num_rows($cours)) {
	// 		$cours_d = mysqli_fetch_assoc($cours);
	// 		$category = fun::category($cours_d['category_id']);
	// 		$autor = fun::autor($cours_d['autor_id']);
			
	// 		$buy = fun::user_buy($cours_id, $user_id);
	// 		if ($buy == 1) $buy_d = fun::buy($cours_id, $user_id);
	// 		else if ($buy == 2) $buy_d = fun::sub_buy2(1, $user_id);

	// 		$home_work = fun::cours_work($cours_id);

	// 	} else header('location: /education/my/');
	// } else header('location: /education/my/');


	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
			// if ($course_d['info']) $course_d = array_merge($course_d, fun::course_info($course_d['id']));
		} else header('location: /education/my/');
	} else header('location: /education/my/');

	// Тариф деректері
	$pack_all = db::query("select * from c_pack where cours_id = '$cours_id' order by number asc");
	
	// Жазылымды тексеру
	// $buy = db::query("select * from c_buy where cours_id = '$cours_id' and user_id = '$user_id' limit 1");
	$buy = fun::user_buy($cours_id, $user_id);
	if ($buy == 1) {
		$buy_d = fun::buy($cours_id, $user_id);
		if ($buy_d['pack_id']) $pack_id = $buy_d['pack_id'];
	} else if ($buy == 2) {
		$buy_d = fun::sub_buy2(1, $user_id);
		if ($buy_d['pack_id']) $pack_id = $buy_d['pack_id'];
	} else {
		$buy = 0;
		header('location: /education/my/');
	}
			
	// Тариф деректері
	if (!$buy || !@$pack_id) {
		if (mysqli_num_rows($pack_all)) {
			if (isset($_GET['pack_id']) || $_GET['pack_id'] != '') {
				$pack_id = $_GET['pack_id'];
				$pack = db::query("select * from c_pack where id = '$pack_id'");
				if (mysqli_num_rows($pack)) $pack_dd = mysqli_fetch_assoc($pack);
			} else {
				$pack_dd = mysqli_fetch_assoc(db::query("select * from c_pack where cours_id = '$cours_id' order by number asc limit 1"));
				$pack_id = $pack_dd['id'];
			}
		}
	}

	// Курс ашылу типі
	if (@$pack_dd['open_type']) $open_type = $pack_dd['open_type'];
	else if ($cours_d['open_type']) $open_type = $cours_d['open_type'];
	if (@$pack_dd['open_start']) $open_start = $pack_dd['open_start'];
	else if ($cours_d['open_start']) $open_start = $cours_d['open_start'];
	if (@$pack_dd['open_days']) $open_days = $pack_dd['open_days'];
	else if ($cours_d['open_days']) $open_days = $cours_d['open_days'];


	
	// Блок деректері
	if (@$pack_id) $block = db::query("select * from c_block where pack_id = '$pack_id' order by number asc");
	else $block = db::query("select * from c_block where cours_id = '$cours_id' order by number asc");








   // Сайттың баптаулары
	$menu_name = 'item';
	$site_set['utop_nm'] = $cours_d['name_'.$lang];
	$site_set['utop_bk'] = 'my';
	if (isset($_GET['back'])) $site_set['utop_bk'] = $_GET['back'];
	$css = ['education/main', 'education/cours', 'education/item'];
	$js = ['education/main'];


?>
<? include "../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="uitem_c <?//=(mysqli_num_rows($cblock) == 0?'uitem_c2':'')?>">
				
				<? include "iheader.php"; ?>
	
				<div class="uitemc_l">
					<div class="uitemci_ck">
						<div class="uitemci_ckt">
							<div class="uitemci_cktl"><h1 class="uitemci_h"><?=$cours_d['name_'.$lang]?></h1></div>
							<div class="uitemci_cktr"><div class="lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div></div>
						</div>
	
						<div class="uitemci_ckb">
							<? if (@$sub_i['view']) $precent = round(100 / ($cours_d['item'] / $sub_i['view'])); ?>
							<div class="uitemci_ckb2">
								<div class="itemci_ls">
									<? if (@$cours_d['arh']): ?> <div class="itemci_lsi itemci_lsi_arh">Курс архивте</div> <? endif ?>
									<? if (@$cours_d['item']): ?> <div class="itemci_lsi"><?=($sub_i['view']?$sub_i['view'].'/':'')?><?=$cours_d['item']?> сабақ</div> <? endif ?>
									<? if (@$cours_d['test']): ?> <div class="itemci_lsi"><?=$cours_d['test']?> тест</div> <? endif ?>
									<? if (@$cours_d['assig']): ?> <div class="itemci_lsi"><?=$cours_d['assig']?> тапсырма</div> <? endif ?>
								</div>
								<? if (@$sub_i['view']): ?> <div class=""><?=$precent?>%</div> <? endif ?>
							</div>
							<? if (@$sub_i['view']): ?>
								<div class="uitemci_time_b">
									<div class="uitemci_time_b2" style="width:<?=$precent?>%"></div>
								</div>
							<? endif ?>
						</div>
	
						<div class="uitemci_tt">
							<span>Доступ:</span>
							<? if ($buy_d['ins_dt'] != null && $buy_d['end_dt'] != null):?>
								<? $result = intval((strtotime($buy_d['end_dt']) - strtotime(date("d.m.Y"))) / (60*60*24)); ?>
								<? $result2 = intval((strtotime($buy_d['end_dt']) - strtotime($buy_d['ins_dt'])) / (60*60*24)); ?>
								<?	if ($result > 0) $precent = round(100 / ($result2 / ($result2 - $result))); else $precent = 100; ?>
							<? endif ?>
							<div class="uitemci_time">
								<div class="uitemci_time_t">
									<div class="">Басталды: <?=date("d-m-Y", strtotime($buy_d['ins_dt']))?></div>
									<div class="">Соңы: <?=date("d-m-Y", strtotime($buy_d['end_dt']))?></div>
								</div>
								<div class="uitemci_time_t">
									<div class="">
										<? if ($result > 0): ?> Аяқталуына: <?=$result?> күн бар
										<? else: ?> Аяқталғанына: <?=abs($result)?> күн болды <? endif ?>
									</div>
									<div class=""><?=$precent?>%</div>
								</div>
								<div class="uitemci_time_b"><div class="uitemci_time_b2" style="width:<?=$precent?>%"></div></div>
							</div>
						</div>
					</div>
	
					<!--  -->
					<? if (@$pack_id == 29): ?>
						<!-- <div class="uitemci_ck">
							<div class="morning_uitemci">Қайырлы күн! Сізге бонус сабақтарға доступ берілді! Әр ай сайын қалған сабақтарға доступ беріледі!</div>
						</div> -->
					<? endif ?>
				</div>
				
				<div class="uc_list">	
					<div class="">
						<?
							// if ($buy == 1) {
							// 	$pack_id = $buy_d['pack_id'];
							// 	$pack = db::query("select * from c_pack where id = '$pack_id'");
							// } else if ($buy == 2) $pack = db::query("select * from c_pack where cours_id = '$cours_id' order by number desc limit 1");
							// else $pack = db::query("select * from c_pack where cours_id = '$cours_id' order by number asc limit 1");
						?>
						<? // $pack_d = mysqli_fetch_assoc($pack); ?>
						<? // $pack_id = $pack_d['id']; ?>
	
						<? // $block = db::query("select * from c_block where pack_id = '$pack_id'"); ?>
						<? if (mysqli_num_rows($block) != 0): ?>
							<? while ($block_d = mysqli_fetch_assoc($block)): ?>
								<div class="cours_ls">
									<?	$block_id = $block_d['id']; ?>
									<?	$lesson = db::query("select * from c_lesson where block_id = '$block_id' order by number asc"); ?>

									<?
										if ($open_type == 1) {
											$days = intval((strtotime(date("d.m.Y")) - strtotime($buy_d['ins_dt'])) / (60*60*24));
											$open_number = floor(($days + $open_days) / $open_days);
											if ($open_number > $block_d['number'] - $open_start) $open_block = 1; else $open_block = 0;
										} else $open_block = 1;
										
										if (!$block_d['open']) $open_block = 0;
										// if (!mysqli_num_rows($pay_lesson_d) && $block['type'] == 'approval') $open_block = 0;
									?>

									<? if (mysqli_num_rows($block) != 1): ?>
										<div class="coursls_i coursls_b">
											<div class="coursls_ic">
												<div class="coursls_in"><?=$block_d['number']?>. <?=$block_d['name_kz']?></div>
											</div>
											<div class="coursls_il2">
												<? if ($open_block): ?> <i class="fal fa-angle-down"></i>
												<? else: ?> <i class="fal fa-lock"></i> <? endif ?>
											</div>
										</div>
									<? endif ?>

									<div class="coursls_c">
										<? if (mysqli_num_rows($lesson) != 0): ?>
											<? while ($lesson_d = mysqli_fetch_assoc($lesson)): ?>
												<? if (fun::lesson_info($lesson_d['id'])) $lesson_d = array_merge($lesson_d, fun::lesson_info($lesson_d['id'])); ?>

												<? 
													if ($open_type == 2) {
														$days = intval((strtotime(date("d.m.Y")) - strtotime($buy_d['ins_dt'])) / (60*60*24));
														$open_number = floor(($days + $open_days) / $open_days);
														if ($open_number > $lesson_d['number'] - $open_start) $open_ls = 1; else $open_ls = 0;
													} else $open_ls = 1;
													
													if (!$lesson_d['open']) $open_ls = 0;
												?>

												<a class="coursls_i" <?=($open_block && $open_ls?'href="../lesson/?id='.$lesson_d['id'].'"':'')?>>
													<div class="coursls_ic">
														<div class="coursls_in"><?=($lesson_d['number']!=0?$lesson_d['number'].'. ':'')?><?=$lesson_d['name_'.$lang]?></div>
													</div>
													<? if ($open_block): ?>
														<div class="coursls_il <?=($open_ls?'':'coursls_il_lock')?>">
															<? if ($open_ls): ?> <i class="fal fa-play"></i>
															<? else: ?> <i class="fal fa-lock"></i> <? endif ?>
														</div>
													<? endif ?>
												</a>
											<? endwhile ?>
										<? endif ?>
										
									</div>
								</div>
							<? endwhile ?>
								
						<? else: ?>
							
						<? endif ?>
					</div>
				</div>
	
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>