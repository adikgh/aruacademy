<?php include "icore.php"; 

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
							<div class="uitemci_cktr"><div class="lazy_img" data-src="/assets/img/cours/<?=$cours_d['img']?>"></div></div>
						</div>
	
						<div class="uitemci_ckb">
							<? if ($sub_i['view']) $precent = round(100 / ($cours_d['item'] / $sub_i['view'])); ?>
							<div class="uitemci_ckb2">
								<div class="itemci_ls">
									<? if ($cours_d['arh']): ?> <div class="itemci_lsi itemci_lsi_arh">Курс архивте</div> <? endif ?>
									<? if ($cours_d['item']): ?> <div class="itemci_lsi"><?=($sub_i['view']?$sub_i['view'].'/':'')?><?=$cours_d['item']?> сабақ</div> <? endif ?>
									<? if ($cours_d['test']): ?> <div class="itemci_lsi"><?=$cours_d['test']?> тест</div> <? endif ?>
									<? if ($cours_d['assig']): ?> <div class="itemci_lsi"><?=$cours_d['assig']?> тапсырма</div> <? endif ?>
								</div>
								<? if ($sub_i['view']): ?> <div class=""><?=$precent?>%</div> <? endif ?>
							</div>
							<? if ($sub_i['view']): ?>
								<div class="uitemci_time_b">
									<div class="uitemci_time_b2" style="width:<?=$precent?>%"></div>
								</div>
							<? endif ?>
						</div>
	
						<? if ($buy != 0): ?>
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
						<? endif ?>
					</div>
	
					<!--  -->
					<div class="">
						
					</div>
				</div>
				
				<div class="uc_list">	
					<div class="">
						<?
							if ($buy == 1) {
								$pack_id = $buy_d['pack_id'];
								$pack = db::query("select * from c_pack where id = '$pack_id'");
							} else if ($buy == 2) $pack = db::query("select * from c_pack where cours_id = '$cours_id' order by number desc limit 1");
							else $pack = db::query("select * from c_pack where cours_id = '$cours_id' order by number asc limit 1");
						?>
						<? $pack_d = mysqli_fetch_assoc($pack); ?>
						<? $pack_id = $pack_d['id']; ?>
	
						<? $block = db::query("select * from c_block where pack_id = '$pack_id'"); ?>
						<? if (mysqli_num_rows($block) != 0): ?>
							<div class="cours_ls">
								<? while ($block_d = mysqli_fetch_assoc($block)): ?>
									<?	$block_id = $block_d['id']; ?>
									<?	$lesson = db::query("select * from c_lesson where block_id = '$block_id' order by number asc"); ?>
									<? if (mysqli_num_rows($block) != 1): ?>
										<div class="coursls_i coursls_b">
											<div class="coursls_ic">
												<div class="coursls_in"><h5><?=$block_d['number']?>. <?=$block_d['name_kz']?></h5></div>
											</div>
										</div>
									<? endif ?>
									<div class="coursls_c">
										<? if (mysqli_num_rows($lesson) != 0): ?>
											<? while ($lesson_d = mysqli_fetch_assoc($lesson)): ?>
												<? if (fun::lesson_info($lesson_d['id'])) $lesson_d = array_merge($lesson_d, fun::lesson_info($lesson_d['id'])); ?>

												<? if ($buy) {
														if ($cours_d['open_days']) {
															$result = intval((strtotime(date("d.m.Y")) - strtotime($buy_d['ins_dt'])) / (60*60*24));
															$days = floor(($result + $cours_d['open_days']) / $cours_d['open_days']);
															if (!$cours_d['open_days'] || ($lesson_d['open'] == 1 && $days >= $lesson_d['number'])) $open = 1; else $open = 0;
														} else if ($lesson_d['open'] == 1) $open = 1;
														else $open = 0;
													} else $open = 0;
												?>

												<a class="coursls_i" <?=($open==1?'href="lesson/?id='.$lesson_d['id'].'"':'')?>>
													<div class="coursls_ic">
														<div class="coursls_in"><?=($lesson_d['number']!=0?$lesson_d['number'].'. ':'')?><?=$lesson_d['name_'.$lang]?></div>
														<? if ($lesson_d['video'] || $lesson_d['video_time']): ?>
															<div class="coursls_ip">
																<? if ($lesson_d['video']): ?>
																	<div class="coursls_ipi">
																		<i class="fal fa-play-circle"></i><?=$lesson_d['video']?> видео
																	</div>
																<? endif ?>
																<? if ($lesson_d['video_time']): ?>
																	<div class="coursls_ipi">
																		<i class="fal fa-stopwatch"></i><?=$lesson_d['video_time']?>
																	</div>
																<? endif ?>
															</div>
														<? endif ?>
													</div>
													<div class="coursls_il <?=($open==1?'':'coursls_il_lock')?>">
														<? if ($open == 1): ?><i class="far fa-play"></i>
														<? else: ?><i class="far fa-lock"></i><? endif ?>
													</div>
												</a>
											<? endwhile ?>
										<? endif ?>
										
									</div>
								<? endwhile ?>
								
							</div>
						<? else: ?>
							
						<? endif ?>
					</div>
				</div>
	
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>