<?php include "../../config/core.php";

	// 
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$pack_id = $_GET['id'];
		$pack = db::query("select * from cours_pack where id = '$pack_id'");
		if (mysqli_num_rows($pack)) {
         if ($user_right != 1) header('location: /cours/item/pack/?id='.$pack_id);
         $pack = mysqli_fetch_assoc($pack);
			$cours = fun::cours($pack['cours_id']);
         $cours_id = $cours['id'];
			$category = fun::category($cours['category_id']);

		} else { header('location: /u/c/'); }
	} else { header('location: /u/c/'); }



	// site setting
	$menu_name = 'pack';
	$pod_menu_name = 'users';
	$site_set = [
		'header' => 'full',
		'footer' => 'false',
		'ublock' => 'true',
		'form' => 'false',
		'utop_nm' => $cours['name'],
		'utop_bk' => 'cours/item/?id='.$cours_id,
	];
	$css = ['user', 'ucours', 'uitem', 'uc_user'];
	$js = ['user', 'admin'];

	$date = new DateTime(); 
	
?>
<?php include "../../block/header.php"; ?>


	<div class="uitem">
		<div class="uitem_c">

			<!-- item header -->
			<?php include "../item_header.php"; ?>

		<!--  -->
			<div class="">
				<div class="bl_c">
					<div class="coursls_i coursls_i_rg add_user_btn">
						<div class="bq_ci_s">
							<i class="far fa-user-plus"></i>
							<span>Оқушыны қосу</span>
						</div>
					</div>
					<div class="">
						<div class="ucours_t">
							<h3 class="ucours_h">Оқушылар тізімі</h3>
							<div class="ucours_fl">
								<i class="far fa-sliders-h"></i>
								<?php if ($user_right != 1): ?>
									<p>Менің курстарым</p>
								<?php else: ?>
									<p>Барлығы</p>
								<?php endif ?>
							</div>
						</div>

						<!-- list -->
						<div class="uc_u">
							<div class="uc_uc">
								<?php $cours_sub = db::query("select * from cours_sub where cours_id = '$cours_id' order by ins_date desc"); ?>
								<?php if (mysqli_num_rows($cours_sub) != 0): ?>
									<?php while ($sub = mysqli_fetch_assoc($cours_sub)): ?>
										<?php $user = fun::user($sub['user_id']); ?>
										<?php $pack = fun::pack($sub['pack_id']); ?>

										<?php if ($sub['end_date'] != null):?>
											<?php $end_date = new DateTime($sub['end_date']); ?>
											<?php	$diff = $date->diff($end_date)->format("%a"); ?>
										<?php endif ?>
										<?php if ($sub['ins_date'] != null && $sub['end_date'] != null):?>
											<?php $s_date = new DateTime($sub['ins_date']); ?>
											<?php	$diff2 = $s_date->diff($end_date)->format("%a"); ?>
											<?php	$precent = round(100 / ($diff2 / ($diff2 - $diff))); ?>
										<?php endif ?>

										<div class="uc_ui">
											<div class="uc_uic">
												<div class="uc_uil">
													<div class="uc_uiln">
														<div class="uc_uicon lazy_img" data-src="/assets/img/users/<?=$user['logo']?>"><?=($user['logo']!=null?'':'<i class="far fa-user"></i>')?></div>
														<div class="uc_uinu">
															<div class="uc_uin_name"><?=$user['name']?> <?=$user['surname']?></div>
															<div class="uc_uin_phone">8<?=substr($user['phone'],1,0).' ('.substr($user['phone'],1,3).') '.substr($user['phone'],4,3).'-'.substr($user['phone'],7,2).'-'.substr($user['phone'],9)?></div>
														</div>
													</div>
													<?php if ($pack['name'] != null): ?>
														<div class="uc_uin_cu"><?=$pack['name']?></div>
													<?php endif ?>
													<div class="uc_uin_date">
														<?php if ($sub['end_date'] != null || $sub['ins_date'] != null): ?>
															<div class="uc_uin_date_c">
																<p><?=($sub['ins_date']!=null?$sub['ins_date']:'Белгісіз')?> | <?=($sub['end_date']!=null?$sub['end_date']:'Шексіз')?></p>
																<?php if ($sub['end_date'] != null): ?>
																	<div class="uc_uin_date_s">Аяқталуына <?=$diff?> күн қалды</div>
																<?php endif ?>
															</div>
															<?php if ($sub['end_date'] != null && $sub['ins_date'] != null): ?>
																<div class="uc_uin_date_pr">
																	<svg class="progress_ring" width="44" height="44">
																		<circle data-precent="100" class="progress_ring_c2" stroke="#dadada" stroke-width="2" cx="22" cy="22" r="18" fill="transparent" />
																		<circle data-precent="<?=$precent?>" class="progress_ring_c" stroke="#53B8BB" stroke-width="2" cx="22" cy="22" r="18" fill="transparent" />
																	</svg>
																	<div class=""><?=$precent?>%</div>
																</div>
															<?php endif ?>
														<?php endif ?>
													</div>
												</div>
												<div class="uc_uib">
													<div class="uc_uibo">
														<div class="uc_uib_i"><i class="fal fa-ellipsis-v"></i></div>
													</div>
													<div class="uc_uibs">
														<div class="uc_uibs_p user_access" data-title="Доступ басқару (қосулы)" data-id="<?=$sub['id']?>">
															<span>Доступ</span>
															<div class="slider-v3 <?=($sub['status_id'] == 1?'slider_act':'')?>"></div>
														</div>
														<div class="uc_uib_i cursor_none" data-title="Доступ уақытын ауыстыру">
															<i class="fal fa-calendar-alt"></i>
															<span>Доступ уақыты</span>
														</div>
														<div class="uc_uib_i sms_send" data-title="Смс қайта жіберу" data-id="<?=$sub['id']?>">
															<i class="fal fa-paper-plane"></i>
															<span>СМС қайта жіберу</span>
														</div>
														<div class="uc_uib_i uc_uib_del user_del" data-title="Оқушыны өшіру" data-id="<?=$sub['id']?>">
															<i class="fal fa-trash-alt"></i>
															<span>Оқушыны өшіру</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php endwhile ?>
								<?php else: ?>
									Ешкім жоқ
								<?php endif ?>
							</div>
						</div>

					</div>

				</div>
			</div>

		</div>
	</div>

<?php include "../../block/footer.php"; ?>

<!-- user plus -->
<div class="pop_bl add_user">
   <div class="pop_bl_a add_user_back"></div>
   <div class="pop_bl_c">
      <div class="head_c">
         <h4>Оқушыны қосу</h4>
      </div>
      <div class="form_c">
			<div class="form_im form_im_btn">
				<div class="form_im_btn_t">Доступ түрі:</div>
				<div class="form_im_btn_c">
					<div class="form_im_btn_i form_im_btn_act">
						<i class="fal fa-mobile"></i>
					</div>
					<div class="form_im_btn_i">
						<i class="fal fa-at"></i>
					</div>
				</div>
			</div>
         <div class="form_im cn_phone">
           	<i class="far fa-mobile form_icon"></i>
         	<input type="tel" class="form_im_txt phone fr_phone" placeholder="8 (000) 000-00-00" data-lenght="11">
         </div>
         <div class="form_im cn_mail dsp_n">
           	<i class="far fa-at form_icon"></i>
         	<input type="text" class="form_im_txt mail" placeholder="Почта" data-lenght="6">
         </div>
         <div class="form_im form_im_bn">
            <div class="btn add_user_send" data-cours-id="<?=$cours_id?>" data-cours-name="<?=$cours['name']?>" data-pack-id="<?=$pack_id?>">
               <span>Қосу</span>
            </div>
         </div>
      </div>
   </div>
</div>