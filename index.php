<? include "config/core.php";

	// cours
	if (isset($_GET['c'])) header('location: /education/sign.php?c='.$_GET['c']);
	if (isset($_GET['cm']) && isset($_GET['mail'])) header('location: /education/sign_ui_mail.php?cm='.$_GET['cm']);
	// if (isset($_GET['cl'])) header('location: /education/sign_up.php?cl='.$_GET['cl']);
	// if (isset($_GET['cml']) && isset($_GET['mail'])) header('location: /education/sign_up_mail.php?clm='.$_GET['cml']);

	// club
	// if (isset($_GET['sub'])) header('location: /education/sign_up.php?sub');
	// if (isset($_GET['sub']) && isset($_GET['mail'])) header('location: /education/sign_up_mail.php?sub');

	// masterclass
	if ($user_id) { if (isset($_GET['subm'])) header('location: /education/cours/masterclass/?id='.$_GET['subm'].'&back=sub'); }
	else { if (isset($_GET['subm'])) header('location: /education/sign.php/?subm='.$_GET['subm']); }


	// site setting
	$menu_name = 'cours';
	// $site_set[''] = '';
?>
<? include "block/header.php"; ?>

	<!--  -->
	<div class="hbl1">
		<div class="bl_c">
			<div class="htbl1_c">
				<div class="hbl1_img lazy_img" data-src="/assets/img/bag/bag2_final.png"></div>
				<div class="hbl1_i hbl1_sn">
					<h1 class="hbl1_h">Ару Сағидың</h1>
					<h2 class="hbl1_p">Білім беру платформасы</h2>
				</div>
				<div class="hbl1_i">
					<h1 class="hbl1_h">Ару Сағидың</h1>
					<h2 class="hbl1_p">Білім беру платформасы</h2>
				</div>
				<div class="hbl1_b">
					<a class="btn" href="/cours/">Курстарды қарау</A>
					<a class="btn btn_cl" href="/education/my/">Менің аккаунтым</A>
				</div>
			</div>
		</div>
	</div>

	<!--  -->
	<div class="hbl3">
		<div class="bl_c">
			<div class="hbl3_c">
				<div class="hbl3_i lazy_img" data-src="/assets/img/bag/2021-01-17-17.07.30-Копировать.jpg"></div>
				<div class="hbl3_n">
					<h4 class="hbl3_h">- Баршаңызға Сәлем! Ару Академиясына қош келдіңіз!</h4>
					<div class="hbl3_ni1">
						<p>Ару Академиясы? Елең етсеңіз, түсіндірем.</p>
						<p>Мектептегі қызыл аттестат, универдегі қызыл диплом, жұмысымдағы бедел. Бұның бәрі де Ана болуға жарамады. Мінсіз әйел бейнесінің күлі көкке ұшты. Өте сұсты ақырған қатын болдым.</p>
						<p>Тұңғышым ақымақтығымның зардабын тартты, қайтсем жақсы ана болам деп басым қатты. Кеш болмай қамданып, ана академиясын іздеп сандалдым. Жылдар бойы ізденіс, шетелдік курстар, коуч, психологтардың сабағы.</p>
						<p>Нәтижесінде сұсты Арудың орнын адекват, сабырлы, күшті Ару басты. Балаларыммен қарым – қатынасым реттелді, қателіктер түзеліп, зерттелді.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--  -->
	<div class="hbl4">
		<div class="bl_c">
			<div class="hbl4_c">
				<div class="hbl4_i">
					<div class="hbl4_img lazy_img" data-src="/assets/img/bag/IMG_9617-ggsd.png"></div>
				</div>
				<div class="hbl4_n">
					<div class="hbl4_h">Бүгінде мен Ару Сағи</div>
					<div class="hbl4_p">
						<p>Халықаралық дәрежедегі <br>сертификатталған коуч</p>
						<p>10 жасқа дейінгі балалар маманы</p>
						<p>Инстаграмда блогер</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--  -->
	<div class="hbl3 hbl32">
		<div class="bl_c">
			<div class="hbl3_c">
				<div class="hbl3_i lazy_img" data-src="/assets/img/bag/2021-01-17-17.30.57-Копировать-683x1024.jpg"></div>
				<div class="hbl3_n">
					<h4 class="hbl3_h">Менің мақсатым</h4>
					<div class="hbl3_ni1">
						<p>Мектеп пен Универ жақсы жар, ана болуды үйретпейді. Ару Академиясы осы олқылықтың орнын толтыру үшін ашылды.</p>
						<p>Бақытты бала тәрбиелеудің дайын формуласы бар. Ол мейірім мен тәртіптің нақты мөлшерін білу.</p>
						<p>Ару Академиясы – ата-ана мен бала арасындағы көпір. Байланысты көркем қарым – қатынасқа айналдырып, проблеманы шешетін жер.</p>
						<p>Ғылыми ақпарат пен шариғат аясындағы білім, қарапайым әйел тілінде түсіндіріледі.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--  -->
	<div class="hbl2">
		<div class="bl_c">
			<div class="head_c head_c1">
				<h2>Танымал курстар</h2>
				<p>Егер сіз жаңа салада білім алғыңыз келсе, біздің үлкен бағдарламаларды қараңыз. Олардың көмегімен сіз дағдыларды дамыта аласыз, оларды іс жүзінде шыңдай аласыз.</p>
			</div>
			<div class="bq2_c">
				<?php $cours = db::query("select * from cours where selling = 1 and arh is null and offer = 1 ORDER BY ins_dt desc limit 4"); ?>
				<?php while($item_d = mysqli_fetch_array($cours)): ?>
					<? $item_d = array_merge($item_d, fun::cours_info($item_d['id'])); ?>
					<a class="bq2_ci" href="/cours/item.php?id=<?=$item_d['id']?>">
						<div class="bq_ci_img"><div class="lazy_img" data-src="/assets/img/cours/<?=$item_d['img']?>"></div></div>
						<div class="bq_ci_info">
							<div class="bq_cih"><?=$item_d['name_'.$lang]?></div>
							<div class="bq_cif"><?=$item_d['offer_'.$lang]?></div>
						</div>
					</a>
				<?php endwhile ?>
			</div>
		</div>
	</div>

<? include "block/footer.php"; ?>