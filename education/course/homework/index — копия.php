<?php include "../icore.php";
	
	// 
	$work = db::query("select * from home_work where cours_id = '$cours_id' and user_id = '$user_id' order by ins_dt desc");
	$pod_menu_name = 'works';
		
	// $js = ['user', 'admin'];
?>
<? include "../../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<!-- item header -->
			<? include "../iheader.php"; ?>
	
			<div class="uhwa">
				<div class="ucours_t ucours_t2">
					<!-- <div class="ucours_tm swiper swiper_catalog2">
						<div class="swiper-wrapper">
							<a class="swiper-slide ucours_tm_i <?=(!$_GET['pack_id']?'ucours_tm_act':'')?>" href="/u/i/ahomework.php?id=<?=$cours_id?>">Барлығы (<?=mysqli_num_rows($work)?>)</a>
						</div>
						<div class="swiper-button-prev2 swiper-button-prev"><i class="fal fa-chevron-left"></i></div>
						<div class="swiper-button-next2 swiper-button-next"><i class="fal fa-chevron-right"></i></div>
					</div> -->
				</div>
	
				<div class="uhwa_c">
	
					<? if (mysqli_num_rows($work)): ?>
						<? while ($work_d = mysqli_fetch_assoc($work)): ?>
							<? $w_id = $work_d['id']; ?>
							<? $user_d = fun::user($work_d['user_id']); ?>
							<? $pack_d = fun::pack($work_d['pack_id']); ?>
							<? $lesson_d = fun::lesson($work_d['lesson_id']); ?>
							<div class="uhwa_i">
								<div class="uhwa_is"><?=$lesson_d['number']?>. <?=$lesson_d['name']?></div>
								<div class="uhwa_itcp">
									<div><?=date("m-d-Y", strtotime($work_d['ins_dt']))?></div>
									<div><?=date("H:i", strtotime($work_d['ins_dt']))?></div>
									<? if (!$work_d['accept'] && !$work_d['refusal']): ?> <div>Тексерілмеген</div> <? endif ?>
								</div>
								<div class="uhwa_ic"><?=$work_d['txt']?></div>
								<div class="uhwa_ib uhwa_ib12">
	
									<? $work_o = db::query("select * from home_work where homework_id = '$w_id'"); ?>
									<? if (mysqli_num_rows($work_o)): ?>
										<? $work_od = mysqli_fetch_array($work_o) ?>
										<div class="">
											<div class="uhwa_itcp">
												<div>Жауап</div>
												<div><?=date("m-d-Y", strtotime($work_od['ins_dt']))?></div>
												<div><?=date("H:i", strtotime($work_od['ins_dt']))?></div>
											</div>
											<div class="uhwa_ic"><?=$work_od['txt']?></div>
										</div>
									<? endif ?>
	
								</div>
							</div>
						<? endwhile ?>
					<? endif ?>
					
				</div>
			</div>


		</div>
	</div>

<? include "../../block/footer.php"; ?>