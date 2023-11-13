<? include "icore.php";
	
   // Сайттың баптаулары
	$pod_menu_name = 'info';
	$css = ['education/main', 'education/item', 'education/info'];
	$site_set['utop_nm'] = $sub['name_'.$lang].' (мәлімет)';
	if ($buy == 0 && !$user_right) $site_set['utop_bk'] = '';
?>
<? include "../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="uitem_q">

				<!-- item header -->
				<? include "iheader.php"; ?>

				<div class="uitem_ql">
					<div class="uitem_if">
						<div class="uitem_if_img lazy_img" data-src="/assets/img/cours/<?=$sub['img']?>"></div>
						<div class="uitem_ifc">
							<h4 class="uitem_ifcn"><?=$sub['name_'.$lang]?></h4>
							<div class="uitem_ifcp"><?=$sub['offer_'.$lang]?></div>
							<div class="uitem_ifcm">
								<div class="uitem_ifcmc">
									<? $c_sub_item = db::query("select distinct(autor_id) from c_sub_item where autor_id is not null limit 3"); ?>
									<? while ($c_sub_item_d = mysqli_fetch_assoc($c_sub_item)): ?>
										<? $autor_id = $c_sub_item_d['autor_id']?>
										<? $autor = db::query("select * from u_autor where id = '$autor_id'"); ?>
										<? $autor = mysqli_fetch_assoc($autor); ?>
										<div class="uitem_ifcmi lazy_img" data-src="/assets/img/users/<?=$autor['logo']?>"></div>
									<? endwhile ?>
									<div class="uitem_ifcmi">+7</div>
								</div>
								<div class="uitem_ifcmd">
									<p>Ару Сағи жәнеде</p>
									<span>халықаралық мамандар</span>
								</div>
							</div>
							<div class="uitem_ifs">
								<span>Мәлімет:</span>
								<? $sub_word = db::query("select * from c_sub_word where sub_id = '$sub_id'"); ?>
								<? while ($sub_word_d = mysqli_fetch_assoc($sub_word)): ?>
									<div class="uitem_ifsi">
										<div><?=$sub_word_d['name_'.$lang]?></div>
										<div><?=$sub_word_d['item']?></div>
									</div>
								<? endwhile ?>
							</div>
	
						</div>
					</div>
	
					<div class="">
						<div class="">
							
						</div>
					</div>
					
				</div>
				<div class="uitem_qr">
					<div class="uitem_qrt">
						<div class="uitem_qrp">
							<span>Бағасы:</span>
							<? if ($sub['price_sole'] != null): ?>
								<div class="uitem_qrpi"><?=$sub['price_sole']?> тг</div>
								<div class="uitem_qrpi uitem_qrpim"><?=$sub['price']?> тг</div>
							<? else: ?>
								<div class="uitem_qrpi"><?=$sub['price']?> тг</div>
							<? endif ?>
						</div>
						<div class="uitem_qro">
							<div class="uitem_qroi">
								<i class="fal fa-calendar-check"></i>
								<div>Доступ - <span>12 ай</span></div>
							</div>
							<div class="uitem_qroi">
								<i class="fal fa-map-pin"></i>
								<div><span>Онлайн / Офлайн</span></div>
							</div>
						</div>
						<a class="btn" href="https://wa.me/<?=$site['whatsapp']?>?text=Даму клубына қосылу">Қосылу</a>
						<!-- <div class="bq_cip bq_cip2">
							<span>Бөліп төлем:</span>
							<div class="bq_cipc">
								<div class="bq_cipcn">
									<div data-price=" тг" class="bq_cipcni">3</div>
									<div data-price=" тг" class="bq_cipcni">6</div>
									<div data-price=" тг" class="bq_cipcni bq_cipcni_act">12</div>
									<div data-price=" тг" class="bq_cipcni">24</div>
								</div>
								<p>3333 тг</p>
							</div>
						</div> -->
					</div>
					<div class="uitem_qrb">
						<span>Бөлісу:</span>
						<div class="uitem_qrbc">
							<a class="uitem_qrbi" href=""><i class="fab fa-whatsapp"></i></a>
							<a class="uitem_qrbi" href=""><i class="fab fa-telegram-plane"></i></a>
							<a class="uitem_qrbi" href=""><i class="fab fa-facebook"></i></a>
							<a class="uitem_qrbi" href=""><i class="fab fa-vk"></i></a>
							<a class="uitem_qrbi"><i class="fal fa-link"></i></a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>

<? include "../block/footer.php"; ?>