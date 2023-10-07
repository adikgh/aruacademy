<div class="ucours_t ucours_t2">				
					<div class="ucours_tm swiper swiper_catalog2">
						<div class="swiper-wrapper">
							<a class="swiper-slide ucours_tm_i <?=($filter==0?'ucours_tm_act':'')?>" href="/user/item/ahomework.php?id=<?=$cours_id?>">Барлығы (<?=mysqli_num_rows($work)?>)</a>
							<? // if (mysqli_num_rows($pack) > 1): ?>
								<? // while ($pack_d = mysqli_fetch_assoc($pack)): ?>
									<!-- <a class="swiper-slide ucours_tm_i <?=($_GET['pack_id']==$pack_d['id']?'ucours_tm_act':'')?>" href="/user/item/ahomework.php?id=<?=$cours_id?>&pack_id=<?=$pack_d['id']?>"><?=$pack_d['name']?></a> -->
								<? // endwhile ?>
							<? // endif ?>
							<!-- <a class="swiper-slide ucours_tm_i <?=($_GET['new']==1?'ucours_tm_act':'')?>" href="/user/item/ahomework.php?id=<?=$cours_id?>&new=1">Жаңа</a> -->
							<!-- <a class="swiper-slide ucours_tm_i <?=($_GET['accept']==1?'ucours_tm_act':'')?>" href="/user/item/ahomework.php?id=<?=$cours_id?>&accept=1">Қабылданған</a> -->
							<!-- <a class="swiper-slide ucours_tm_i <?=($_GET['refusal']==1?'ucours_tm_act':'')?>" href="/user/item/ahomework.php?id=<?=$cours_id?>&refusal=1">Қабылданбаған</a> -->

						</div>
						<div class="swiper-button-prev2 swiper-button-prev"><i class="fal fa-chevron-left"></i></div>
						<div class="swiper-button-next2 swiper-button-next"><i class="fal fa-chevron-right"></i></div>
					</div>
				</div>