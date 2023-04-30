<?php include "../../config/core_admin.php";
	
	// Қолданушыны тексеру
	if (!$user_right) header('location: /admin/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
			$category = fun::category($cours_d['category_id']);
			$autor = fun::autor($cours_d['autor_id']);			
		} else header('location: /admin/works');
	} else header('location: /admin/works');


	
	// $filter = 1;
	// if (isset($_GET['pack_id']) || $_GET['pack_id'] != '') {
	// 	$pack_id = $_GET['pack_id'];
	// 	$work = db::query("select * from home_work where cours_id = '$cours_id' and pack_id = '$pack_id' order by ins_dt desc");
	// } elseif ($_GET['new'] == 1) {
	// 	$work = db::query("select * from home_work where cours_id = '$cours_id' and accept is null and refusal is null order by ins_dt desc");
	// } elseif ($_GET['accept'] == 1) {
	// 	$work = db::query("select * from home_work where cours_id = '$cours_id' and accept = 1 order by ins_dt desc");
	// } elseif ($_GET['refusal'] == 1){
	// 	$work = db::query("select * from home_work where cours_id = '$cours_id' and refusal = 1 order by ins_dt desc");
	// } else {
	// 	$work = db::query("select * from home_work where cours_id = '$cours_id' order by ins_dt desc");
	// 	$filter = 0;
	// }


	if (isset($_GET['pack_id']) || $_GET['pack_id'] != '') {
		$pack_id = $_GET['pack_id'];
		$pack = db::query("select * from c_pack where cours_id = '$cours_id' and id = '$pack_id'");
	} else {
		$pack = db::query("select *, min(number) from c_pack where cours_id = '$cours_id' and home_work = 1 order by number asc");
		$pack_d = mysqli_fetch_assoc($pack);
		$pack_id = $pack_d['id'];
	}

	
	// site setting
	$menu_name = 'works';
	$pod_menu_name = 'item';
	$site_set[''] = $cours_d['name_'.$lang].' - үй жұмысы';
	$site_set[''] = 'works/';
	if (isset($_GET['cours_menu'])) $site_set['utop_bk'] = 'cours/item/?id='.$cours_id;
	$css = ['admin/cours', 'admin/item', 'admin/works'];
	// $js = [''];
?>
<? include "../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<? if ($_GET['cours_menu']): ?> <? include "../../cours/item/iheader.php"; ?> <? endif ?>

			<div class="uhwa">
				<div class="uhwa_l">
					<? $pack2 = db::query("select * from c_pack where cours_id = '$cours_id' order by number asc"); ?>
					<? if (mysqli_num_rows($pack2) > 1): ?>
						<div class="uhwa_lp">
							<? while ($pack_d = mysqli_fetch_assoc($pack2)): ?>
								<a class="uhwa_lpi <?=($pack_id==$pack_d['id']?'uhwa_lpi_act':'')?> <?=($pack_d['home_work']!=1?'uhwa_lpi_de':'')?>" <?=($pack_d['home_work']==1?'href="?id='.$cours_id.'&pack_id='.$pack_d['id'].'"':'')?>>
									<span>Пакет:</span>
									<p><?=$pack_d['name_'.$lang]?></p>
								</a>
							<? endwhile ?>
						</div>
					<? endif ?>

					<div class="uhwa_c">
						<div class="uhwa_cb">
							<a class="uhwa_i" href="#list.php?id=<?=$cours_id?>">
								<div class="uhwa_itcn">Барлығы</div>
							</a>
							<a class="uhwa_i" href="list2.php?id=<?=$cours_id?>">
								<div class="uhwa_itcn">Окушылар бойынша</div>
							</a>
						</div>
					</div>
					<div class="uhwa_c">
						<div class="uhwa_tn">Үй жұмысы бар сабақтар:</div>

						<? $block = db::query("select * from c_block where pack_id = '$pack_id' order by number asc"); ?>
						<? if (mysqli_num_rows($block)): ?>
							<? while ($block_d = mysqli_fetch_assoc($block)): ?>
								<? $block_id = $block_d['id']; ?>
								<div class="uhwa_cb">
									
									<? if (mysqli_num_rows($block) > 1): ?>
										<div class="uhwa_p">
											<div class="uhwa_ph"><span>Пакет:</span><?=$block_d['name']?></div>
											<div class="uhwa_ps">
												<div class="uhwa_psi"><span>Барлығы</span><i class="fal fa-angle-right"></i></div>
												<div class="uhwa_psi2"><i class="fal fa-angle-down"></i></div>
											</div>
										</div>
									<? endif ?>

									<? $lesson = db::query("select * from c_lesson where block_id = '$block_id' order by number asc"); ?>
									<? if (mysqli_num_rows($lesson)): ?>
										<? while ($lesson_d = mysqli_fetch_assoc($lesson)): ?>
											<a class="uhwa_i <?=($lesson_d['home_work']!=1?'uhwa_i_de':'uhwa_i_sel')?>" href="lesson.php?id=<?=$cours_id?>&lesson_id=<?=$lesson_d['id']?>" data-cours-id="<?=$cours_id?>" data-lesson-id="<?=$lesson_d['id']?>">
												<div class="uhwa_itcn"><?=$lesson_d['number']?>. <?=$lesson_d['name_'.$lang]?></div>
											</a>
										<? endwhile ?>
									<? endif ?>

								</div>
							<? endwhile ?>
						<? endif ?>
					</div>

				</div>
				<!-- <div class="uhwa_r">
					<div class="uhwa_c uhwa_c_sel"></div>
				</div> -->
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>