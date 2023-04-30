<?php include "../../../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_right) header('location: /user/');

	$type = 'all';
	if ($_GET['type'] == 'club') {
		$type = $_GET['type'];
		$users = db::query("select * from c_sub_buy order by ins_dt desc limit 50");
	} else $users = db::query("select * from user order by ins_dt desc limit 50");
	

	// Сайттың баптаулары
	$menu_name = 'chat';
	$site_set = [
		'utop_bk' => 'chat/admin/',
		'utop_nm' => 'Жеке хат жіберу',
	];
	$css = ['user', 'uchat'];
	$js = ['user', 'admin'];
?>
<?php include "../../../../block/header.php"; ?>

	<div class="ublock">

		<!--  -->
		<div class="ublock_c">
			<div class="ublock_l">

				<div class="ucours_t" id="ucours_t">
					<div class="swiper ucours_tm swiper_catalog2">
					<div class="swiper-wrapper">
							<a class="swiper-slide ucours_tm_i <?=($type=='all'?'ucours_tm_act':'')?>" href="/user/chat/admin/start/">Барлығы</a>
							<a class="swiper-slide ucours_tm_i <?=($type=='club'?'ucours_tm_act':'')?>" href="/user/chat/admin/start/?type=club">Клуб мүшелері</a>
						</div>
						<div class="swiper-button-prev2 swiper-button-prev"><i class="fal fa-chevron-left"></i></div>
						<div class="swiper-button-next2 swiper-button-next"><i class="fal fa-chevron-right"></i></div>
					</div>
				</div>

				<div class="ublock_s">
					<div class="ublock_tn">Қолданушылар тізімі:</div>
					<div class="ublock_cn">
						<!-- <div class="ublock_i ublock_inxt" href="start/?type=<?=$type?>">
							<div class="ublock_ictn">Барлығына жалпылама хат жіберу</div>
						</div> -->

						<? if (mysqli_num_rows($users)): ?>
							<? while ($user_d = mysqli_fetch_assoc($users)): ?>
								<? if ($type == 'club') $user_d = fun::user($user_d['user_id']); ?>
								<? $work_d = fun::chat($user_d['id']); ?>
								<a class="ublock_i ublock_inxt" href="../item/?<?=($work_d?'id='.$work_d['id']:'user_id='.$user_d['id'])?>">
									<div class="ublock_im"><i class="fal fa-user"></i></div>
									<div class="ublock_ic">
										<div class="ublock_ict">
											<div class="ublock_ictn"><?=$user_d['name']?> <?=$user_d['surname']?></div>
										</div>
										<div class="ublock_icw">
											<div class="ublock_icwc"><?=$user_d['phone']?></div>
										</div>
									</div>
								</a>
							<? endwhile ?>
						<? endif ?>
					</div>
				</div>

			</div>
		</div>
		
	</div>


<?php include "../../../../block/footer.php"; ?>