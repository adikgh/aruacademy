<div class="ucours_t">
			<div class="ucours_tm swiper swiper_catalog2">
				<div class="swiper-wrapper">
					<a class="swiper-slide ucours_tm_i ucours_tm_act" href="/user/admin/users">Барлығы (<?=mysqli_num_rows($user_f)?>)</a>
					<a class="swiper-slide ucours_tm_i" href="/user/admin/autors">
						Ұстаздар
						<!-- <i class="fal fa-user-tie"></i> -->
					</a>
					<? if ($user_super_right): ?>
						<a class="swiper-slide ucours_tm_i" href="/user/admin/rights">
							Басқарушылар
							<!-- <i class="fal fa-users-cog"></i> -->
						</a>
					<? endif ?>
				</div>
				<div class="swiper-button-prev2 swiper-button-prev"><i class="fal fa-chevron-left"></i></div>
				<div class="swiper-button-next2 swiper-button-next"><i class="fal fa-chevron-right"></i></div>
			</div>
		</div>

		<br>


						<!-- <div class="ucours_tm">
					<div class="ucours_tmi ucours_tm_act">
						<i class="fal fa-lock ucours_tmic"></i>
						<span>Құлыпталған</span>
						<i class="fal fa-angle-down ucours_tmis"></i>
					</div>
					<div class="menu_c ucours_tma">
						<a class="menu_ci" href="/admin/products/all/warehouses.php?id=1">
							<div class="menu_cin"><i class="fal fa-square"></i></div>
							<div class="menu_cih">Ия</div>
						</a>
						<a class="menu_ci" href="/admin/products/all/warehouses.php?id=2">
							<div class="menu_cin"><i class="fal fa-square"></i></div>
							<div class="menu_cih">Жок</div>
						</a>
					</div>
				</div> -->