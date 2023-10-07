<?php include "../../../../config/core.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
	      $cours_d = array_merge($cours_d, fun::cours_info($cours_d['id']));
			$category = fun::category($cours_d['category_id']);
			$autor = fun::autor($cours_d['autor_id']);
			// $bookmark = fun::bookmark($cours['id'], $user_id);

         $price = fun::cours_price_min($cours_id);
			
		} else header('location: /user/cours/');
	} else header('location: /user/cours/');

   // Жазылымды тексеру
	if (!$user_right) {
		$buy = db::query("select * from c_buy where cours_id = '$cours_id' and user_id = '$user_id'");
		$sub_buy = db::query("select * from c_sub_buy where sub_id = 1 and user_id = '$user_id'");
	}

   // Сайттың баптаулары
	$menu_name = 'item';
   $pod_menu_name = 'info';
	$site_set = [
		'utop_nm' => $cours_d['name_'.$lang].' - мәлімет',
		'utop_pod_nm' => 'Мәлімет',
		'utop_bk' => 'cours/',
	];
	$css = ['user', 'uitem', 'uinfo'];
	$js = ['user', 'admin'];
	
?>
<?php include "../../../../block/header.php"; ?>

   
   <div class="uitem">
      
      <div class="uitem_q">
         <div class="uitem_ql">
            
            <!-- item header -->
				<?php include "../i_header.php"; ?>
            <!-- <div class="ds_nr"><i class="fal fa-ghost"></i><p>Бұл бет жасалуда</p></div> -->

				<div class="uitem_if">
					<div class="uitem_if_img lazy_img" data-src="/assets/img/cours/<?=$cours_d['img']?>"></div>
					<div class="uitem_ifc">
						<h4 class="uitem_ifcn"><?=$cours_d['name_'.$lang]?></h4>
						<div class="uitem_ifcp"><?=$cours_d['offer_'.$lang]?></div>
						<div class="uitem_ifcm">
							<div class="uitem_ifcmc">
								<div class="uitem_ifcmi lazy_img" data-src="/assets/img/users/<?=$autor['logo']?>"></div>
							</div>
							<div class="uitem_ifcmd">
								<p><?=$autor['name']?></p>
							</div>
						</div>
						<div class="uitem_ifs">
							<span>Мәлімет:</span>
							<? $cours_dt = db::query("select * from cours_data where cours_id = '$cours_id'"); ?>
							<? while ($cours_data = mysqli_fetch_assoc($cours_dt)): ?>
								<div class="uitem_ifsi">
									<div><?=$cours_data['name_'.$lang]?></div>
									<div><?=$cours_data['item']?></div>
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
						<? if ($price[1] != null): ?>
                     <div class="uitem_qrpi uitem_qrpim"><?=$price[1]?> тг</div>
							<div class="uitem_qrpi"><?=$price[0]?> тг</div>
						<? else: ?>
							<div class="uitem_qrpi"><?=$price[0]?> тг</div>
						<? endif ?>
					</div>
					<div class="uitem_qro">
						<div class="uitem_qroi">
							<i class="fal fa-calendar-check"></i>
							<div>Доступ - <span><?=$cours_d['standart_acc_time']?> ай</span></div>
						</div>
						<div class="uitem_qroi">
							<i class="fal fa-map-pin"></i>
							<div>Формат - <span>Онлайн</span></div>
						</div>
					</div>
					<a class="btn" href="https://wa.me/<?=$site['whatsapp']?>?text=<?=$cours_d['name_'.$lang]?> курсын алғым келеді">Қосылу</a>
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


<?php include "../../../../block/footer.php"; ?>