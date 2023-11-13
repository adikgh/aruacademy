<? include "../../config/core_edu.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /education/');
	if ($user_right) header('location: /education/my/list.php');
	
	// 
	fun::buy_end_off($user_id);
	
	
	$sub_buy = db::query("select * from c_sub_buy where user_id = '$user_id' and off is null");

	$buy = db::query("select * from c_buy where user_id = '$user_id' and cours_id is not null and off is null ORDER BY ins_dt DESC");
	$buy_off = db::query("select * from c_buy where user_id = '$user_id' and cours_id is not null and off = 1 ORDER BY ins_dt DESC");
	// $item = db::query("select * from c_sub_item where sub_id = '$sub_id' order by number asc");


	// Сайттың баптаулары
	$menu_name = 'my';
	$site_set['utop_nm'] = 'Курстар';
	$site_set['um_menu'] = true;
	$site_set['ut_l'] = false;
	$css = ['education/cours'];
	// $js = [''];
?>
<? include "../block/header.php"; ?>

	<div class="ucours">
		<div class="bl_c">
			
			<div class="head_c">
				<h4>Менің курстарым</h4>
			</div>

			<div class="uc_d">

				<? if (mysqli_num_rows($sub_buy)): ?>
					<? $cours_d = fun::sub(1); ?>
						
					<div class="uc_di ">
						<a class="uc_dio" href="/education/club/">
							<div class="uc_di_img">
								<div class="uc_di_imgc lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div>
							</div>
							<div class="uc_dic">
								<div class="uc_dih"><?=$cours_d['name_'.$lang]?></div>
								<div class="uc_din">
									<div class="uc_did3"></div>
								</div>
							</div>
						</a>
						<div class="btn btn_cm btn_dd uc_di_btn"><i class="fal fa-long-arrow-right"></i></div>
					</div>
				<? endif ?>

				<? if (mysqli_num_rows($buy)): ?>

					<? while($buy_d = mysqli_fetch_array($buy)): ?>
						<? $cours_id = $buy_d['cours_id']; ?>
						<? $cours_d = fun::cours($buy_d['cours_id']); ?>
							
						<? $open = true; $result = 0; $access = 0; $precent = 0; ?>
						<? if ($buy_d['ins_dt'] != null && $buy_d['end_dt'] != null): ?>
							<? $result = intval((strtotime($buy_d['end_dt']) - strtotime(date("d.m.Y"))) / (60*60*24)); ?>
							<? $access = intval((strtotime($buy_d['end_dt']) - strtotime($buy_d['ins_dt'])) / (60*60*24)); ?>
							<? if ($result <= 0) $open = false; ?>
							<?	if (($access - $result) == 0) $precent = 0; elseif (($access - $result) < $access) $precent = round(100 / ($access / ($access - $result))); else $precent = 100; ?>
						<? endif ?>

						<div class="uc_di <?=(!$open||$buy_d['off']?'uc_di_lock':'')?>">
							<a class="uc_dio" href="/education/my/item.php?id=<?=$cours_d['id']?>&cat=<?=$cours_d['category_id']?>" data-id="<?=$buy_d['id']?>">
								<div class="uc_di_img">
									<div class="uc_di_imgc lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div>
									<div class="uc_dip">
										<? if ($cours_d['new']): ?><div class="uc_dipi uc_dipi_new">Жаңа</div><? endif ?>
										<div class="uc_dipi"><?=fun::category_name($cours_d['category_id'], $lang)?></div>
									</div>
									<? if (!$open || $buy_d['off']): ?>
										<!-- <div class="uc_di_imgs"><i class="fal fa-hourglass-end"></i></div> -->
										<!-- <div class="uc_di_imgs">Жуырда</div> -->
									<? else: ?>
										<? if ($buy_d['ins_dt'] != null && $buy_d['end_dt'] != null): ?>
											<div class="uc_di_jh">
												<div class="uc_di_jhc" style="width:<?=$precent?>%"></div>
												<div class="uc_di_jhn"><?=$precent?>%</div>
											</div>
										<? endif ?>
									<? endif ?>
								</div>
								<div class="uc_dic">
									<div class="uc_dih"><?=$cours_d['name_'.$lang]?></div>
									<div class="uc_din">
										<div class="uc_did3"></div>
									</div>
								</div>
							</a>
							<div class="btn btn_cm btn_dd uc_di_btn"><i class="fal fa-long-arrow-right"></i></div>
						</div>

					<? endwhile ?>
					
				<? endif ?>

			</div>


			<? if (mysqli_num_rows($buy_off)): ?>
				<div class="head_c">
					<h4>Доступ аяқталған курстар</h4>
				</div>

				<div class="uc_d">
					<? while($buy_d = mysqli_fetch_array($buy_off)): ?>
						<?	$cours_id = $buy_d['cours_id']; ?>
						<? $cours_d = fun::cours($buy_d['cours_id']); ?>

						<div class="uc_di uc_di_lock">
							<a class="uc_dio" >
								<div class="uc_di_img">
									<div class="uc_di_imgc lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div>
									<div class="uc_dip">
										<div class="uc_dipi"><?=fun::category_name($cours_d['category_id'], $lang)?></div>
									</div>
									<div class="uc_di_imgs"><i class="fal fa-lock"></i></div>
								</div>
								<div class="uc_dic">
									<div class="uc_dih"><?=$cours_d['name_'.$lang]?></div>
									<div class="uc_din">
										<div class="uc_did3">Доступ аяқталған</div>
									</div>
								</div>
							</a>
							<div class="btn btn_cm btn_dd uc_di_btn"><i class="fal fa-long-arrow-right"></i></div>
						</div>

					<? endwhile ?>
				</div>
			<? endif ?>

		</div>
	</div>

<? include "../block/footer.php"; ?>