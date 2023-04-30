<? include "../config/core.php";

	// 
	if ($_GET['type'] == 'cours') $cours = db::query("select * from cours where category_id = 1 and selling = 1 and arh is null ORDER BY ins_dt desc");
	elseif ($_GET['type'] == 'master-class') $cours = db::query("select * from cours where category_id = 2 and selling = 1 and arh is null ORDER BY ins_dt desc");
	elseif ($_GET['type'] == 'webinar') $cours = db::query("select * from cours where category_id = 3 and selling = 1 and arh is null ORDER BY ins_dt desc");
	else $cours = db::query("select * from cours where selling = 1 and arh is null ORDER BY ins_dt desc");
	
	if (!isset($_GET['type']) || $_GET['type'] == '') $_GET['type'] = 'project';


	// site setting
	$menu_name = $_GET['type'];
	$site_set['swiper'] = true;	
	$css = ['cours'];
	$js = [];
?>
<? include "../block/header.php"; ?>

	<div class="cours">
		<div class="bl_c">

			<div class="cours_t">
				<h2 class="cours_h">Менің жобаларым</h2>
				<div class="cours_tm swiper swiper_catalog">
					<div class="swiper-wrapper">
						<a class="swiper-slide cours_tm_i <?=($menu_name=='project'?'cours_tm_act':'')?>" href="/cours/">Барлығы</a>
						<a class="swiper-slide cours_tm_i <?=($menu_name=='cours'?'cours_tm_act':'')?>" href="/cours/?type=cours">Курстар</a>
						<a class="swiper-slide cours_tm_i <?=($menu_name=='master-class'?'cours_tm_act':'')?>" href="/cours/?type=master-class">Мастер-класс</a>
						<a class="swiper-slide cours_tm_i <?=($menu_name=='webinar'?'cours_tm_act':'')?>" href="/cours/?type=webinar">Вебинар</a>
					</div>
					<div class="swiper-button-prev swiper-button-prev1"><i class="fal fa-chevron-left"></i></div>
					<div class="swiper-button-next swiper-button-next1"><i class="fal fa-chevron-right"></i></div>
				</div>
			</div>

			<div class="bq3_c">
				<? while($cours_d = mysqli_fetch_array($cours)): ?>
					<? $pack_d = fun::pack_one($cours_d['id']); ?>

					<a class="bq3_ci" href="/cours/item.php?id=<?=$cours_d['id']?>">
						<div class="bq_ci_img">
							<div class="lazy_img" data-src="/assets/img/cours/<?=$cours_d['img']?>"></div>
						</div>
						<div class="bq_ci_info">
							<div class="bq_cit"><?=fun::category_name($cours_d['category_id'], $lang)?></div>
							<div class="bq_cih"><?=$cours_d['name_'.$lang]?></div>

							<? if ($pack_d['price'] || $pack_d['price_sole']): ?>
								<div class="bq_cip">
									<? if ($pack_d['price_sole']): ?>
										<p class="bq_cip_sole"><?=$pack_d['price']?> тг</p>
										<p><?=$pack_d['price_sole']?> тг</p>
									<? else: ?> <p><?=$pack_d['price']?> тг</p> <? endif ?>
								</div>
							<? endif ?>

						</div>
						<div class="bq_ci_btn">
							<div class="btn btn_cm btn_dd"><i class="fal fa-long-arrow-right"></i></div>
						</div>
					</a>
				<? endwhile ?>
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>