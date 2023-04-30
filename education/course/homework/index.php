<? include "../icore.php";
	
	// 
	// $work = db::query("select * from home_work where cours_id = '$cours_id' and user_id = '$user_id' order by ins_dt desc");
	$pod_menu_name = 'works';


	$buy = fun::buy_i($cours_d['id'], $user_id);
	$pack_id = $buy['pack_id'];
	
	$css = ['education/item', 'education/homework'];
	// $js = ['user', 'admin'];
?>
<? include "../../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<!-- item header -->
			<? include "../iheader.php"; ?>
	
			<div class="uhwa">
				<div class="uhwa_l">

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
											<? $work_d = fun::work($lesson_d['id'], $user_id); ?>
											<a class="uhwa_i <?=($lesson_d['home_work']!=1?'uhwa_i_de':'uhwa_i_sel')?>" href="item.php?id=<?=$cours_id?>&lesson_id=<?=$lesson_d['id']?>&work_id=<?=$work_d['id']?>">
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

<? include "../../block/footer.php"; ?>