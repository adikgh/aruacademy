<!-- body end -->
</div>

	<? if ($site_set['footer']): ?>
		<footer class="footer">
			<div class="bl_c">
				
				<? if ($site_set['footer_t']): ?>
					<div class="footer_t">
						<div class="foot_c">
							<ul>
								<li><a href="/p/cours/">Курстар</a></li>
								<li><a href="/p/webinar/">Вебинарлар</a></li>
								<li><a href="/p/master-class/">Мастер-класстар</a></li>
								<li><a href="/u/">Менің аккаунтым</a></li>
							</ul>
						</div>
						<div class="foot_c">
							<ul>
								<li><a href="/about/">Академия жайлы</a></li>
								<li><a href="/about/faq/privacy.php">Авторлық құқық</a></li>
								<li><a href="/about/faq/offer.php">Қолдану ережелері</a></li>
								<li><a href="/about/faq/">Жиі қойылатын сұрақтар</a></li>
							</ul>
						</div>
						<div class="footer_tr">
							<a class="footer_tr_phone" href="tel:<?=$site['phone']?>">
								<p><?=$site['phone_view']?></p>
								<div class="footer_tr_phone_act">Қызмет көрсету бөлімі</div>
							</a>
							<div class="footer_tr_s">
								<a href="https://www.instagram.com/aru_sagi" class="footer_tr_si">
									<i class="fab fa-instagram"></i>
								</a>
								<a href="https://www.youtube.com/arusagi87" class="footer_tr_si">
									<i class="fab fa-telegram-plane"></i>
								</a>
								<a href="https://t.me/arusagi" class="footer_tr_si">
									<i class="fab fa-youtube"></i>
								</a>
							</div>
						</div>
					</div>
				<? endif ?>

				<div class="footer_b">
					<div class="footer_bl">© <?=$site['name']?>, 2022</div>
					<div class="footer_br">
						<a href="https://gprog.kz" target="_blank" class="gprog_bl">
							<span>#gprog-та</span>
							<div class="gprog_heart"><i class="fas fa-heart"></i></div>
							<span>жасалған</span>
							<div class="gprog_ab">
								<div class="gprog_lg"><div class="lazy_img" data-src="https://gprog.kz/assets/img/logo/logo_tr_1200.png"></div></div>
								<div class="gprog_h">G prog</div>
								<div class="gprog_p">Бізбен өз онлайн мектебіңді аш!</div>
							</div>
						</a>
					</div>
				</div>

			</div>
		</footer>
	<? endif ?>
	
	<!-- main js -->
	<? foreach ($sjs as $i): ?> <script src="/assets/js/<?=$i?>.js?v=<?=$ver?>"></script> <? endforeach ?>
	<? foreach ($js as $i): ?> <script src="/assets/js/<?=$i?>.js?v=<?=$ver?>"></script> <? endforeach ?>
		
</body>
</html>

	<? include "modal.php"; ?>