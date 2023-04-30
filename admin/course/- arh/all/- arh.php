		<!-- <div class="uc_pack">
			<div class="bq3_c">

         <?php while($pack_date = mysqli_fetch_assoc($pack)): ?>
					<?php $pack_id = $pack_date['id']; ?>
					<?php $sub = db::query("select * from c_sub where pack_id = '$pack_id' and user_id = '$user_id'"); ?>
					<?php if (mysqli_num_rows($sub) || $user_right == 1): ?>
						<a class="bq3_ci" href="/user/item/pack.php?id=<?=$pack_date['id']?>">
							<div class="bq_ci_img"><div class="lazy_img" data-src="/assets/img/cours/<?=$pack_date['img']?>"></div></div>
							<div class="bq_ci_info">
								<div class="bq_cit"><?=$cours['name']?></div>
								<div class="bq_cih"><?=$pack_date['name']?></div>
							</div>
							<div class="bq_ci_btn"><div class="btn btn_cm btn_dd"><i class="fal fa-long-arrow-right"></i></div></div>
						</a>
					<?php endif; ?>
				<?php endwhile; ?>

				<?php if ($user_right == 1): ?>
					<a class="bq3_ci bq3_ci_rg" href="/u/i/pack_add.php?id=<?=$cours_id?>">
						<div class="bq_ci_s">
							<i class="far fa-plus"></i>
							<span>Пакет қосу</span>
						</div>
					</a>
				<?php endif ?>

			</div>
		</div> -->











		<div class="uhwa_bc">
					<div class="uhwa_bcm">
						<div class="btn btn_cl">Реттеу</div>
						<div class="btn btn_cl filter_btn">Сүзгі</div>

						<div class="uhwa_bca">
      					<div class="uhwa_bca_a uhwa_bca_back"></div>
							<div class="uhwa_bcac">
								
								<div class="uhwa_bcacs">
									<div class="uhwa_bcaci">
										<div class="uhwa_bcach">Пакет:</div>
										<div class="uhwa_bcacc pack" data-val="">
											<?php $pack = db::query("select * from c_pack where cours_id = '$cours_id' and home_work = 1"); ?>
											<?php if (mysqli_num_rows($pack) > 1): ?>
												<?php while ($pack_d = mysqli_fetch_assoc($pack)): ?>
													<div class="uhwa_bcacci" data-val="<?=$pack_d['id']?>"><?=$pack_d['name']?></div>
												<?php endwhile ?>
											<?php endif ?>
										</div>
									</div>
									<!-- Сабақ -->
									<div class="uhwa_bcaci">
										<div class="uhwa_bcach">Статус:</div>
										<div class="uhwa_bcacc status" data-val="">
											<div class="uhwa_bcacci" data-val="0">Жаңа</div>
											<div class="uhwa_bcacci" data-val="1">Қабылданған</div>
											<div class="uhwa_bcacci" data-val="2">Қабылданбаған</div>
										</div>
									</div>
								</div>

								<div class="btn btn_cl filter_awork" data-cours-id="<?=$cours_id?>">Көрсету</div>
							</div>
						</div>

					</div>
				</div>