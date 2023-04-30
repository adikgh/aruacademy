<?php include "../../i_core.php";


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
	$pod_menu_name = 'works';
	$site_set = [
		'utop_nm' => $cours_d['name_'.$lang].' - үй жұмысы',
		'utop_bk' => 'cours/item/?id='.$cours_id,
	];
	$css = ['user', 'uitem', 'uhomework'];
	$js = ['user', 'admin'];

?>
<?php include "../../../../../block/header.php"; ?>

	<div class="uitem">
		<!-- item header -->
		<?php include "../../i_header.php"; ?>

		<!--  -->
		<div class="uhwa">
			<div class="uhwa_l">
				<? $pack2 = db::query("select * from c_pack where cours_id = '$cours_id' order by number asc"); ?>
				<? if (mysqli_num_rows($pack2) > 1): ?>
					<div class="uhwa_lp">
						<? while ($pack_d = mysqli_fetch_assoc($pack2)): ?>
							<a class="uhwa_lpi <?=($pack_id==$pack_d['id']?'uhwa_lpi_act':'')?> <?=($pack_d['home_work']!=1?'uhwa_lpi_de':'')?>" <?=($pack_d['home_work']==1?'href="/user/cours/item/homework/admin/?id='.$cours_id.'&pack_id='.$pack_d['id'].'"':'')?>>
								<span>Пакет:</span>
								<p><?=$pack_d['name_'.$lang]?></p>
							</a>
						<? endwhile ?>
					</div>
				<? endif ?>

				<div class="uhwa_c">
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
										<div class="uhwa_i <?=($lesson_d['home_work']!=1?'uhwa_i_de':'uhwa_i_sel')?>" data-cours-id="<?=$cours_id?>" data-lesson-id="<?=$lesson_d['id']?>">
											<div class="uhwa_itcn"><?=$lesson_d['number']?>. <?=$lesson_d['name_'.$lang]?></div>
										</div>
									<? endwhile ?>
								<? endif ?>

							</div>
						<? endwhile ?>
					<? endif ?>
				</div>

			</div>
			<div class="uhwa_r">
				<div class="uhwa_c uhwa_c_sel"></div>
			</div>
		</div>
	</div>


<?php include "../../../../../block/footer.php"; ?>