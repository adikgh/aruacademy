<?php include "../../config/core.php";

	// 
	$cours_id = 8;
	$cours = db::query("select * from cours where id = '$cours_id'");
	$cours = mysqli_fetch_assoc($cours);
	$cours = array_merge($cours, fun::cours_info($cours['id']));
	$category = fun::category($cours['category_id']);
	$autor = fun::autor($cours['autor_id']);
	$pack = db::query("select * from c_pack where cours_id = '$cours_id'");
	$pl = db::query("select * from c_pack where cours_id = '$cours_id' and number = 1");


	// site setting
	$menu_name = 'item';
	$site_set['menu'] = 2;
	$css = ['item'];
	$js = [];
	$site_set['swiper'] = true;

	$san = rand(0, 1);
	$whatsapp = ['77776779777', '77476267492'];
	$whatsapp2 = ['77776779777', '77476267492'];
	
?>
<?php include "../../block/header.php"; ?>


	<div class="item">
		<div class="item_c">

			<!--  -->
			<div class="itemc_info">
				<div class="bl_c">

					<div class="itemc_info_c">
						<div class="itemci_l">
							<div class="itemci_ln">
								<div class="itemci_lnc"><i class="fas fa-bell"></i></div>
								<p>Вебинардан орыныңызды <br>алып үлгеріңіз</p>
							</div>
							<h1 class="itemci_h"><?=$cours['name_'.$lang]?></h1>
							<div class="itemci_p"><?=$cours['offer_'.$lang]?></div>
							<div class="itemci_b">
								<a href="#price" class="btn">Қатысқым келеді</a>
							</div>
						</div>
						<div class="itemci_r">
							<div class="lazy_img" data-src="/assets/img/cours/<?=$cours['img']?>"></div>
						</div>
					</div>

					<div class="itemc_dn">
						<div class="itemcd_i">
							<div class="itemcd_ic"><i class="fal fa-book-reader"></i></div>
							<div class="itemcd_in">
								<div>Доступ</div>
								<p><?=$cours['time']?> беріледі</p>
							</div>
						</div>
						<div class="itemcd_i">
							<div class="itemcd_ic"><i class="fal fa-play-circle"></i></div>
							<div class="itemcd_in">
								<div>Вебинар</div>
								<p><?=$cours['item']?> бөлімнен тұрады</p>
							</div>
						</div>
						<div class="itemcd_i">
							<div class="itemcd_ic"><i class="fal fa-globe"></i></div>
							<div class="itemcd_in">
								<div>Онлайн</div>
								<p>Cізге ыңғайлы уақытта</p>
							</div>
						</div>
						<div class="itemcd_i">
							<div class="itemcd_ic"><i class="fal fa-users-class"></i></div>
							<div class="itemcd_in">
								<div>Сізбен бірге</div>
								<p><?=$cours['view']?> бақытты ана бар</p>
							</div>
						</div>
					</div>

				</div>
			</div>

			<!--  -->
			<?php $word = db::query("select * from cours_word where cours_id = '$cours_id' and type = 'one' order by number asc"); ?>
         <?php if (mysqli_num_rows($word)): ?>
            <div class="cr1">
               <div class="bl_c">
                  <div class="cr1c">
                     <div class="head_c head_c1">
                        <h4>Вебинар мақсатқа қол жеткізу үшін білу керек ең басты тақырыптар мен жаттығуларды қамтиды</h4>
                     </div>
                     
                     <div class="cr1_c">
                        <?php while ($word_date = mysqli_fetch_assoc($word)): ?>								
                           <div class="cr1c_i">
                              <div class="cr1ci_img">
                                 <div class="lazy_img" data-src="/assets/img/icons/<?=$word_date['img']?>"></div>
                              </div>
                              <div class="cr1ci_t">
                                 <div><?=$word_date['txt']?></div>
                              </div>
                           </div>
                        <?php endwhile ?>
                     </div>
							<div class="head_c head_c1 cr1_head2">
                        <p>Саналы түрде өз өмірімізге жауапкершілік алып, армандап, мақсат құру арқылы қиялдағы әлемімізді шындыққа айналдыруға болады. Осылайша “өмір”атты өз кітабыңыздың авторына айналыңыз. Мақсатқа апарар жолда қадам-бізден, нәтиже Алладан.</p>
                     </div>
                  </div>
               </div>
            </div>
         <?php endif ?>


			<!--  -->
			<?php $word = db::query("select * from cours_word where cours_id = '$cours_id' and type = 'tuu' and number BETWEEN 1 and 7"); ?>
			<?php if (mysqli_num_rows($word)): ?>
				<div class="cr2">
					<div class="bl_c">
						<div class="head_c head_c1">
							<h3>Вебинардан не үйренесіз?</h3>
						</div>
						<div class="cr2_c">
							<?php while ($word_date = mysqli_fetch_assoc($word)): ?>								
								<div class="cr2_ci">
									<div class="cr2_ci_img"><?=$word_date['img']?></div>
									<div class="cr2_ci_txt"><?=$word_date['txt']?></div>
								</div>
							<?php endwhile ?>
						</div>
					</div>
				</div>
			<?php endif ?>

			<?php include "../block/autor.php"; ?>			

			<!--  -->
			<div id="price" class="iprice">
				<div class="bl_c">
					<div class="iprice_c <?=(mysqli_num_rows($pack)==2?"iprice_c2":"")?> <?=(mysqli_num_rows($pack)>=3?"iprice_c3":"")?>">
						<?php while($pack_date = mysqli_fetch_assoc($pack)): ?>
							<div class="iprice_ci">
								<?php if (mysqli_num_rows($pack) != 1): ?>
									<div class="iprice_cih"><p><?=$pack_date['name']?></p></div>
								<?php endif ?>
								<div class="iprice_cin">
									<?php if ($pack_date['offer']): ?>
										<div class="bq_cih2"><?=$pack_date['offer']?></div>
									<?php endif ?>

									<?php $pack_id = $pack_date['id'] ?>
									<?php $pack_info = db::query("select * from c_pack_word where pack_id = '$pack_id' and bonus is null"); ?>
									<div class="bq_cips">
										<?php while($pi_d = mysqli_fetch_assoc($pack_info)): ?>
											<div class="bq_cipsi <?=($pi_d['none']==1?'bq_cipsi_none':'')?>"><?=$pi_d['txt']?></div>
										<?php endwhile; ?>
									</div>
									
									<?php $pack_info = db::query("select * from c_pack_word where pack_id = '$pack_id' and bonus is not null"); ?>
									<?php if (mysqli_num_rows($pack_info)): ?>
										<div class="bq_cips bq_cips_bonus">
											<span>Бонусқа</span>
											<?php while($pi_d = mysqli_fetch_assoc($pack_info)): ?>
												<div class="bq_cipsi"><?=$pi_d['txt']?></div>
											<?php endwhile; ?>
										</div>
									<?php endif ?>

									<div class="bq_cip">
										<span>Бүгінгі баға:</span>
										<div class="bq_cipc">
											<? if ($pack_date['price_sole']): ?>
												<p class="bq_cip_sole"><?=$pack_date['price']?> тг</p>
												<p><?=$pack_date['price_sole']?> тг</p>
											<? else: ?> <p><?=$pack_date['price']?> тг</p> <? endif ?>
										</div>
									</div>

									<?php if ($pack_date['installment']): ?>
										<div class="bq_cip bq_cip2">
											<span>Бөліп төлем:</span>
											<div class="bq_cipc">
												<div class="bq_cipcn">
													<?php if ($pack_date['count3']): ?>
														<div data-price="<?=round($pack_date['price']/3)?> тг" class="bq_cipcni <?=($pack_date['count_act']=='3'?"bq_cipcni_act":"")?>">3</div>
													<?php endif ?>
													<?php if ($pack_date['count6']): ?>
														<div data-price="<?=round($pack_date['price']/6)?> тг" class="bq_cipcni <?=($pack_date['count_act']=='6'?"bq_cipcni_act":"")?>">6</div>
													<?php endif ?>
													<?php if ($pack_date['count12']): ?>
														<div data-price="<?=round($pack_date['price']/12)?> тг" class="bq_cipcni <?=($pack_date['count_act']=='12'?"bq_cipcni_act":"")?>">12</div>
													<?php endif ?>
													<?php if ($pack_date['count24']): ?>
														<div data-price="<?=round($pack_date['price']/24)?> тг" class="bq_cipcni <?=($pack_date['count_act']=='24'?"bq_cipcni_act":"")?>">24</div>
													<?php endif ?>
												</div>
												<p><?=round($pack_date['price'] / $pack_date['count_act'])?> тг</p>
											</div>
										</div>
									<?php endif ?>

									<div class="bq_cib">
										<div class="btn btn_ukl">Қатысамын</div>
										<?php if ($pack_date['installment']): ?>
											<a class="btn btn_red_cl" href="https://wa.me/<?=$whatsapp[$san]?>" target="_blank">Бөліп төлеймін</a>
										<?php endif ?>
									</div>

								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>


		</div>
	</div>
	

<?php include "../../block/footer.php"; ?>
<?php include "../block/oko.php"; ?>