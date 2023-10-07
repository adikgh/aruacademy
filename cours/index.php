<? include "../config/core.php";

	// 
	if (isset($_GET['type']) && $_GET['type'] == 'cours') $cours = db::query("select * from cours where category_id = 1 and selling = 1 and arh is null ORDER BY ins_dt desc");
	elseif (isset($_GET['type']) && $_GET['type'] == 'master-class') $cours = db::query("select * from cours where category_id = 2 and selling = 1 and arh is null ORDER BY ins_dt desc");
	elseif (isset($_GET['type']) && $_GET['type'] == 'webinar') $cours = db::query("select * from cours where category_id = 3 and selling = 1 and arh is null ORDER BY ins_dt desc");
	else $cours = db::query("select * from cours where selling = 1 and arh is null ORDER BY ins_dt desc");
	
	if (!isset($_GET['type']) || $_GET['type'] == '') $_GET['type'] = 'project';


	// site setting
	$menu_name = $_GET['type'];
	$site_set['swiper'] = true;	
	$css = ['project/cours'];
	$js = [];
?>
<? include "../block/header.php"; ?>

	<div class="cours">
		<div class="bl_c">

			<div class="cours_t">
				<h2 class="cours_h">Менің жобаларым</h2>
				<div class="cours_tm">
					<a class="cours_tm_i <?=($menu_name=='project'?'cours_tm_act':'')?>" href="/cours/">Барлығы</a>
					<a class="cours_tm_i <?=($menu_name=='cours'?'cours_tm_act':'')?>" href="/cours/?type=cours">Курстар</a>
					<!-- <a class="cours_tm_i <?=($menu_name=='master-class'?'cours_tm_act':'')?>" href="/cours/?type=master-class">Мастер-класс</a> -->
					<a class="cours_tm_i <?=($menu_name=='webinar'?'cours_tm_act':'')?>" href="/cours/?type=webinar">Вебинар</a>
				</div>
			</div>

			<div class="bq3_c">
				<? while($cours_d = mysqli_fetch_array($cours)): ?>
					<? $pack_d = fun::pack_one($cours_d['id']); ?>

					<a class="bq3_ci" href="/cours/<?=($cours_d['site']?$cours_d['site']:'item.php?id='.$cours_d['id'])?>">
						<div class="bq_ci_img">
							<div class="lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div>
						</div>
						<div class="bq_ci_info">
							<? if ($menu_name == 'project'): ?> <div class="bq_cit"><?=fun::category_name($cours_d['category_id'], $lang)?></div> <? endif ?>
							<div class="bq_cih"><?=$cours_d['name_'.$lang]?><?=($cours_d['add_name_'.$lang]?' ('.$cours_d['add_name_'.$lang].')':'')?></div>

							<? if ($cours_d['price'] || ($pack_d['price'] || $pack_d['price_sole'])): ?>
								<div class="bq_cip">
									<? if (isset($pack_d) && $pack_d['price_sole']): ?>
										<p class="bq_cip_sole fr_price"><?=$pack_d['price']?></p>
										<p class="fr_price"><?=$pack_d['price_sole']?></p>
									<? else: ?> 
										<? if (isset($pack_d) && $pack_d['price']): ?> <p class="fr_price"><?=$pack_d['price']?></p>
										<? else: ?> <p class="fr_price"><?=$cours_d['price']?></p> <? endif ?>
									<? endif ?>
								</div>
							<? endif ?>
						</div>
						<div class="bq_ci_btn">
							<div class="btn btn2 btn_cm">Толығырақ</div>
						</div>
					</a>
				<? endwhile ?>
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>