<?php include "../config/core.php";

	// 
	$sub_id = 1;
	$sub = db::query("select * from c_sub where id = '$sub_id'");
	$sub_d = mysqli_fetch_assoc($sub);
	$category = fun::category($sub_d['category_id']);
	$autor = fun::autor($sub_d['autor_id']);


	// site setting
	$menu_name = 'club';
   $site_set = [
      'menu' => 2,
      'header' => 'false',
      'footer_t' => 'false',
   ];
	$css = ['item', 'club/main'];
	$js = ['club/main'];

	$san = rand(0, 1);
	$whatsapp = ['77776779777', '77476267492'];
	$whatsapp2 = ['77776779777', '77476267492'];
	
?>
<?php include "../block/header.php"; ?>


	<div class="club_bl">
		<div class="item_c">

         <!-- Оффер -->
			<div class="bl1">
				<div class="bl_c">

					<div class="bl1_c">
                  <div class="bl1_t">
                     <div class="bl1_tl"><?=$site['name']?></div>
                     <div class="bl1_tr">
                        <div class="lazy_img bl1_tri" data-src="/assets/img/icons/all/5143181sss.png"></div>
                        <div class="bl1_trs">Ұзақтығы: <span>12 ай</span></div>
                     </div>
                  </div>

                  <div class="bl1_s">
                     <h2>Қыз-келіншектерге арналған <br> 1-жылдық «Даму» клубы</h2>
                     <h6>Әр айда белгілі бір бағдарлама <br> бойынша Ару ханыммен берге даму</h6>
                     <div class="bl1_btn"><a href="#price" class="btn">Клубқа қосыламын</a></div>
                  </div>
                  
						<div class="bl1_imc"><div class="lazy_img bl1_img" data-src="/assets/img/bag/aru_bg2.jpeg"></div></div>
					</div>

				</div>
			</div>


         <!-- Клуб кімге арналған -->
         <? if ($_GET['admin']): ?>
            <div class="bl2">
               <div class="bl_c">
                  <div class="head_c head_co"><h4><span>«Даму»</span> клубы <br> кімдерге?</h4></div>
                  <div class="bl2_c">
                     <div class="bl2_i">
                        <div class="bl2_im"><div class="lazy_img" data-src="/assets/img/icons/"></div></div>
                        <div class="bl2_it">Lorem ipsum dolor sit amet consectetur adipisicing elit</div>
                     </div>
                     <div class="bl2_i">
                        <div class="bl2_im"><div class="lazy_img" data-src="/assets/img/icons/"></div></div>
                        <div class="bl2_it">Lorem ipsum dolor sit amet consectetur adipisicing elit</div>
                     </div>
                     <div class="bl2_i">
                        <div class="bl2_im"><div class="lazy_img" data-src="/assets/img/icons/"></div></div>
                        <div class="bl2_it">Lorem ipsum dolor sit amet consectetur adipisicing elit</div>
                     </div>
                     <div class="bl2_i">
                        <div class="bl2_im"><div class="lazy_img" data-src="/assets/img/icons/"></div></div>
                        <div class="bl2_it">Lorem ipsum dolor sit amet consectetur adipisicing elit</div>
                     </div>
                  </div>
               </div>
            </div>
         <? endif ?>


         <!-- Даму клубы - бұл … -->
         <div class="bl3">
            <div class="bl_c">
               <div class="head_c head_co txt_c"><h4>«Даму» клубы - <br> <span>бұл ..</span></h4></div>
               <div class="bl3_c">
                  <div class="bl3_i">
                     <div class="bl3_im">
                        <div class="lazy_img bl3_img" data-src="/assets/img/bag/272360971_3067204203538452_3432366329705446178_n.jpg"></div>
                        <div class="bl3_it">Ару Cағи жәнеде 12 эксперттен <br> алтын кеңестер</div>
                     </div>
                  </div>
                  <div class="bl3_i bl3_i2">
                     <div class="bl3_im">
                        <div class="lazy_img bl3_img" data-src="/assets/img/bag/271270609_453840562943823_6992594040342960022_n.jpg"></div>
                        <div class="bl3_it">1 жыл толық бағыт-бағдар <br> аул мүмкіндігі</div>
                     </div>
                  </div>
                  <div class="bl3_i">
                     <div class="bl3_im">
                        <div class="lazy_img bl3_img" data-src="/assets/img/bag/photo5303050370559356957-p3bnhowpx1xqy4z1rze6yemhuenr26ffemrzh7oebg.jpg"></div>
                        <div class="bl3_it">11 курстар, 7 вебинарлар жинағын <br> 12 ай бойы қарай алу</div>
                     </div>
                  </div>
                  <div class="bl3_i bl3_i2">
                     <div class="bl3_im">
                        <div class="lazy_img bl3_img" data-src="/assets/img/bag/240781344_998986297618625_693357566437006587_n.jpg"></div>
                        <div class="bl3_it">Өзіңіз секілді дамушы ортаны <br> қалайтын жандармен бірге болу</div>
                     </div>
                  </div>
                  <div class="bl3_i">
                     <div class="bl3_im">
                        <div class="lazy_img bl3_img" data-src="/assets/img/bag/WhatsApp Image 2021-12-21 at 12.39.54.jpeg"></div>
                        <div class="bl3_it">6 онлайн групповая терапия, <br> 2 офлайн кездесу мүмкіндігі</div>
                     </div>
                  </div>
                  <div class="bl3_ibt">
                     <a href="#price" class="btn">Клубқа қосыламын</a>
                  </div>
               </div>
            </div>
         </div>


         <!-- Ару Сағи (Даму клубын құрушы және тәлімгері) -->
         <div class="bl4">
            <div class="bl_c">
               <div class="head_c head_co txt_c">
                  <h4>Ару Сағи</h4>
                  <p>«Даму» клубын құрушы <br> және тәлімгері</p>
               </div>
               <div class="bl4_cm">
                  <div class="lazy_img" data-src="/assets/img/bag/271641741_248449760753640_6346307899355939717_n-removebg-preview.png"></div>
               </div>
               <div class="bl4_c">
                  <div class="bl4_i">
                     <i class="fas fa-badge-check"></i>
                     <div>Халықаралық дәрежедегі <br> сертификатталған коуч</div>
                  </div>
                  <div class="bl4_i">
                     <i class="fas fa-badge-check"></i>
                     <div>10 жасқа дейінгі балалар маманы</div>
                  </div>
                  <div class="bl4_i">
                     <i class="fas fa-badge-check"></i>
                     <div>Инстаграмда блогер</div>
                  </div>
               </div>
            </div>
         </div>


         <!-- Клубтың жоспары -->
         <div class="bl6">
            <div class="bl_c">
               <div class="head_c head_co">
                  <h4>Клубтың <br> <span>жоспары</span></h4>
                  <div class="lazy_img head_cms" data-src="/assets/img/icons/all/5143181sss.png"></div>
               </div>
               <div class="bl6_c">
                  <div class="bl6_i">
                     <div class="bl6_it">Қаңтар</div>
                     <div class="bl6_is">
                        <div class="">1. Мақсатқа жету мен мотивация құпиясы</div>
                        <div class="">2. Қалай бәріне үлгерем</div>
                        <div class="">3. Бонус курстар мен вебинарларды оқу</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Ақпан</div>
                     <div class="bl6_is">
                        <div class="">4. Сепарация</div>
                        <div class="">5. Дауыспен әсер ету құпиясы</div>
                        <div class="">6. 1-Онлайн групповая терапия</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Наурыз</div>
                     <div class="bl6_is">
                        <div class="">7. Жеке шекара</div>
                        <div class="">8. Бауырлар достығы</div>
                        <div class="">9. Артық шығынсыз өз гордеробыңды жаса</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Сәуір</div>
                     <div class="bl6_is">
                        <div class="">10. Психологпен кездесу</div>
                        <div class="">11. Ата-әже, ата-енемен қатынас</div>
                        <div class="">12. 2-Онлайн групповая терапия</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Мамыр</div>
                     <div class="bl6_is">
                        <div class="">13. Бизнес бастаушылардың басты қателіктері қандай</div>
                        <div class="">14. Cторис арқылы өз ерекшелігіңді көрсетіп, ақша табу жолдары</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Маусым</div>
                     <div class="bl6_is">
                        <div class="">15. Көзді операциясыз қалыпқа келтіру</div>
                        <div class="">16. Эмоция. Өзіңдікіне ие болу, өзгенікін түсіну туралы</div>
                        <div class="">17. 3-Онлайн групповая терапия</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Шілде</div>
                     <div class="bl6_is">
                        <div class="">18. Өз-өзіңе визажист бол</div>
                        <div class="">19. Жасөспірімнің қабілетін анықтау</div>
                        <div class="">20. 1-жарты жылдық офлайн кездесу</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Тамыз</div>
                     <div class="bl6_is">
                        <div class="">21. Cексолог маманы</div>
                        <div class="">22. 4-Онлайн групповая терапия</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Қыркүйек</div>
                     <div class="bl6_is">
                        <div class="">23. Дизайнер маманы</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Қазан</div>
                     <div class="bl6_is">
                        <div class="">24. Инвестиция жасау бойынша эксперт</div>
                        <div class="">25. 5-Онлайн групповая терапия</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Қараша</div>
                     <div class="bl6_is">
                        <div class="">26. Ақшамен қатынасқа байланысты эксперт</div>
                        <div class="">27. 2-жарты жылдық офлайн кездесу</div>
                     </div>
                  </div>
                  <div class="bl6_i">
                     <div class="bl6_it">Желтоқсан</div>
                     <div class="bl6_is">
                        <div class="">28. Балалардың қаржылық сауаттылығын ашу</div>
                        <div class="">29. 6-Онлайн групповая терапия</div>
                     </div>
                  </div>
               </div>
               <div class="bl6b">
                  <i class="fal fa-exclamation"></i>
                  <p>Клубымыздың басты ерекшелігі бүкіл ақпаратты үйіп-төгіп сізді жалғыз қалдырмаймыз.</p>
                  <p>Әр қатысушының жеке кураторы болады. Орта жолдан тастамай, барлығын соңына дейін меңгеріп результат шығаруға көмектесетін онлайн құрбыңыз</p>
               </div>
            </div>
         </div>

         <!-- Жарты жылдық офлайн кездесу -->
         <div class="bl9">
            <div class="bl_c">
               <div class="bl9_c">
                  <div class="lazy_img bl9_img" data-src="/assets/img/bag/240781344_998986297618625_693357566437006587_n.jpg"></div>
                  <div class="head_c txt_c"><h4>Жарты жылдық <br> офлайн кездесу</h4></div>
               </div>
               <div class="bl9_cm"><a href="#price" class="btn">Клубқа қосыламын</a></div>
            </div>
         </div>

         <!-- СНГ-ға танымал эксеперттер -->
         <div class="bl8">
            <div class="bl_c">
               <div class="head_c head_co txt_c"><h4>СНГ-ға танымал <br> <span>эксеперттер</span></h4></div>
               <div class="bl8_c">
                  <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/cours/250157654_557706011981927_1836952811139448537_n.jpg"></div></div>
                     <div class="bl8_it">
                        <div>Тайм-менеджмент маманы</div>
                        <p>Назым Есмағанбет</p>
                     </div>
                  </div>
                  <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/cours/272703911_1136290680472391_6322853162163829668_n.jpg"></div></div>
                     <div class="bl8_it">
                        <div>Оратор маманы</div>
                        <p>Бағлан Каукербекова</p>
                     </div>
                  </div>
                  <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/cours/94476030_561213034776116_7511697370413117089_n.jpg"></div></div>
                     <div class="bl8_it">
                        <div>Стилист маманы</div>
                        <p>Камалия Аянкызы</p>
                     </div>
                  </div>
                  <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/cours/167256505_137683871629480_6391251648611065487_n.jpg"></div></div>
                     <div class="bl8_it">
                        <div>Психолог маманы</div>
                        <p>Анар Есен</p>
                     </div>
                  </div>
                  <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/cours/274750910_917165868870552_4249557291565745671_n.jpg"></div></div>
                     <div class="bl8_it">
                        <div>Маркетолог маманы</div>
                        <p>Дамира Исмаилова</p>
                     </div>
                  </div>
                  <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/cours/272404223_937451410474541_901989509299717684_n.jpg"></div></div>
                     <div class="bl8_it">
                        <div>Нутрициолог маманы</div>
                        <p>Зауре Жаңабай</p>
                     </div>
                  </div>
                  <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/cours/252573624_1221798048310941_458079618304541035_n.jpg"></div></div>
                     <div class="bl8_it">
                        <div>Визажист маманы</div>
                        <p>Гүлхат Нұржанқызы</p>
                     </div>
                  </div>
                  <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/cours/f0bbf8b7baf96c7593804554948629d3.png"></div></div>
                     <div class="bl8_it">
                        <div>Cексолог маманы</div>
                        <p></p>
                     </div>
                  </div>
                  <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/cours/dizajner-odezhdy-1-918x516.jpeg"></div></div>
                     <div class="bl8_it">
                        <div>Дизайнер маманы</div>
                        <p></p>
                     </div>
                  </div>
                  <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/cours/Vidy-investicij.jpg"></div></div>
                     <div class="bl8_it">
                        <div>Инвестиция жасау бойынша эксперт</div>
                        <p></p>
                     </div>
                  </div>
                  <!-- <div class="bl8_i">
                     <div class="bl8_im"><div class="lazy_img" data-src="/assets/img/users/"></div></div>
                     <div class="bl8_it">
                        <div>Ақшамен қатынасқа байланысты эксперт</div>
                        <p></p>
                     </div>
                  </div> -->
               </div>
            </div>
         </div>


         <!-- Курстар мен Вебинарлар тізімі -->
         <div class="bl5">
            <div class="bl_c">
               <div class="head_c head_co">
                  <span>Бонус</span>
                  <h4>Курстар мен <br>Вебинарлар тізімі</h4>
                  <div class="lazy_img head_cms" data-src="/assets/img/icons/all/5142968sada.png"></div>
               </div>
               <div class="bl5_c">
                  <span>Курстар:</span>
                  <div class="bl5_i bl5_i2">
                     <div class="bl5_im"><div class="lazy_img" data-src="/assets/img/cours/269900946_519427335959836_1348103711224063543_n.jpg"></div></div>
                     <div class="bl5_it">
                        <div class="bl5_itn">ДОС БОЛАЙЫҚ</div>
                        <p>Балалар арасындағы буллинг</p>
                        <div class="bl5_its">Құны: <span>20.000 тг</span></div>
                     </div>
                  </div>
                  <div class="bl5_i bl5_i2">
                     <div class="bl5_im"><div class="lazy_img" data-src="/assets/img/cours/makabbat_degen2.jpg"></div></div>
                     <div class="bl5_it">
                        <div class="bl5_itn">МАХАББАТ ДЕГЕН ҚАНДАЙДЫ</div>
                        <p>Жұбайлар арасындағы сау, сапалы қарым-қатынас</p>
                        <div class="bl5_its">Құны: <span>20.000 тг</span></div>
                     </div>
                  </div>
                  <div class="bl5_i bl5_i2">
                     <div class="bl5_im"><div class="lazy_img" data-src="/assets/img/cours/tynysh_balasm.jpg"></div></div>
                     <div class="bl5_it">
                        <div class="bl5_itn">ТЫНЫШ БАЛА</div>
                        <p>0-2 жас аралығындағы бала күтімі, салқынға үйрету, бесіктегі тәрбие, емізу процессін жақсарту және горшокқа үйрету туралы</p>
                        <div class="bl5_its">Құны: <span>10.000 тг</span></div>
                     </div>
                  </div>
                  <div class="bl5_i">
                     <div class="bl5_im"><div class="lazy_img" data-src="/assets/img/cours/tynysh_balam_2.jpg"></div></div>
                     <div class="bl5_it">
                        <div class="bl5_itn">ТЫНЫШ БАЛА 2</div>
                        <div class="bl5_its">Құны: <span>10.000 тг</span></div>
                     </div>
                  </div>
                  <div class="bl5_i bl5_i2">
                     <div class="bl5_im"><div class="lazy_img" data-src="/assets/img/cours/balam_jane_gadjet.jpg"></div></div>
                     <div class="bl5_it">
                        <div class="bl5_itn">БАЛАМ ЖӘНЕ ГАДЖЕТ</div>
                        <p>Гаджетке тәуелсіз баланы қалай өсіреміз</p>
                        <div class="bl5_its">Құны: <span>10.000 тг</span></div>
                     </div>
                  </div>
                  <div class="bl5_i">
                     <div class="bl5_im"><div class="lazy_img" data-src="/assets/img/cours/allaga_jol.jpg"></div></div>
                     <div class="bl5_it">
                        <div class="bl5_itn">АЛЛАҒА ЖОЛ</div>
                        <div class="bl5_its">Құны: <span>5.000 тг</span></div>
                     </div>
                  </div>                  
               </div>
               <div class="bl5_c">
                  <span>Вебинарлар:</span>
                  <div class="bl5_i">
                     <div class="bl5_im"><div class="lazy_img" data-src="/assets/img/cours/menin_jana_kylym.jpg"></div></div>
                     <div class="bl5_it">
                        <div class="bl5_itn">МЕНІҢ ЖАҢА ЖЫЛЫМ</div>
                        <div class="bl5_its">Құны: <span>5.000 тг</span></div>
                     </div>
                  </div>
                  <div class="bl5_i">
                     <div class="bl5_im"><div class="lazy_img" data-src="/assets/img/cours/IMG_0591.jpg"></div></div>
                     <div class="bl5_it">
                        <div class="bl5_itn">МЕН ОРИГИНАЛМЫН</div>
                        <div class="bl5_its">Құны: <span>5.000 тг</span></div>
                     </div>
                  </div>
                  <div class="bl5_i">
                     <div class="bl5_im"><div class="lazy_img" data-src="/assets/img/cours/balam_ashylansam.jpg"></div></div>
                     <div class="bl5_it">
                        <div class="bl5_itn">БАЛАМ АШУЛАНСА ҚАЙТЕМ</div>
                        <div class="bl5_its">Құны: <span>5.000 тг</span></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
         <!-- Клуб мүшелеріне бонустар -->
         <!-- <div class="bl7">
            <div class="bl_c">
               <div class="head_c txt_c"><h4>Клуб мүшелеріне бонустар</h4></div>
               <div class="">

               </div>
            </div>
         </div> -->

         <!-- Тариф барлығына ортақ -->
         <div class="bl10" id="price">
            <div class="bl_c">
               <div class="bl10_c">
                  <div class="head_c head_co">
                     <h4><span>Тариф</span> <br> барлығына ортақ</h4>
                     <div class="lazy_img head_cms" data-src="/assets/img/icons/all/5143265dasdas.png"></div>
                  </div>
                  <div class="bl10_cm">
                     <div class="bl10_cmi">11 курс, 7 вебинар</div>
                     <div class="bl10_cmi">Эксепертпен 11 мастеркласс</div>
                     <div class="bl10_cmi">Ортақ чат Ару Сағимен</div>
                     <div class="bl10_cmi">2 рет офлайн кездесу</div>
                     <div class="bl10_cmi">6 рет онлайн терапия</div>
                     <div class="bl10_cmi">12 ай доступ (365 күн)</div>
                     <div class="bl10_cmi">Клубымыздағы ең белсенді анаға 300.000 тг сыйлық</div>
                  </div>
                  <div class="bl10_cp">
                     <div class="bl10_cpns">350.000 тг</div>
                     <div class="bl10_cpn">250.000 тг</div>
                     <div class="bl10_cb">
                        <div class="btn btn_ukl">Клуб-қа қосыламын</div>
                        <a class="btn btn_cl" href="https://wa.me/<?=$whatsapp[$san]?>" target="_blank">Бөліп төлеймін</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>


         <!-- Жиі қойылатын сұрақтар -->
         <div class="bl11">
            <div class="bl_c">
               <div class="head_c"><h4>Басқада сұрақтарға жауап</h4></div>
               <div class="bl11_c">
                  <div class="bl11_i">
                     <div class="bl11_it">1. БҰЛ КЛУБ ИДЕЯСЫ СІЗГЕ ҚАЛАЙ КЕЛДІ?</div>
                     <div class="bl11_ix"><i class="fal fa-plus"></i></div>
                     <div class="bl11_ic">Аналар клубын құрсам деп стористе бұрыннан айтатынмын. Себебі мектепте бізге физика, химия, математика үйретеді. Иә, оның бәрі маңызды, керек сабақтар. Бірақ барлығымыз күйеуге шығып ана болған кезде бірнәрсе жетіспей қалғандай болады. Не жетіспейді? Күйеуімен, ата - енемен қарым-қатынас, ең бастысы - баланың психологиялық/физикалық дамуы қалай жүреді? Осы туралы білім жетіспегенін байқаймыз. Соның кесірінен неше түрлі қателіктер жібереміз. Мен білімді толықтыратын қыз-келіншектердің ортасы болғанын бұрыннан ойлайтынмын және осы ойымды іске асыратын кез келді!</div>
                  </div>
                  <div class="bl11_i">
                     <div class="bl11_it">2. НЕГЕ КЛУБ 1 ЖЫЛ? 3 / 6 АЙ ЕМЕС?</div>
                     <div class="bl11_ix"><i class="fal fa-plus"></i></div>
                     <div class="bl11_ic">
                        Өйткені ол жерде тек бала тәрбиесі, күйеуімен қарымқатынас емес.
                        <ul>
                           <li>Ол жерде сихолог, сексолог, маркетолог, дизайнер сияқты көптеген мықты эксперттер болады.Дизайнер мысалы үйіңнің дизайнын қалай ерекше етіп жасауға болатынын үйретеді.</li>
                           <li>Ол жерде стилист те бар. Мысалы кез-келген әйел адам өзінің ерекше стилін қалыптастырғысы келеді. Сыртқы келбетінің де әдемі болғанын қалайды. Дұрыс па?</li>
                           <li>Инвестиция бойынша білім беретін адам болады. Осыншама білімнің бәрін беріп 3 айдың ішінде результат шығар дейтін болсақ, ол өтірік болар еді. Себебі оның бәрін меңгеруге, нәтиже шығаруға 3-6 ай аз.</li>
                        </ul>
                     </div>
                  </div>
                  <div class="bl11_i">
                     <div class="bl11_it">3. Клуб жұмыс жасайтын әйелдерге ме?! Әлде үйде отырған аналарға арналған ба?</div>
                     <div class="bl11_ix"><i class="fal fa-plus"></i></div>
                     <div class="bl11_ic">Барлығына арналған. Мысалы «декреттен шығып немен айналыссам болады, бұрынғы жұмысыма барғым келмейді, өзімнің ісімді бастағым келеді» немесе «күйеуіммен қарым-қатынасым нашарлап кетті» деген сияқты проблема барлық келіншектерде болуы мүмкін. Сондықтан бұл барлық қызкеліншектерге арналған клуб. </div>
                  </div>
               </div>
            </div>
         </div>


         <!-- Блок атауы жоқ = Ару Сағи қанатты сөзін әдемілеп жазамыз + Дожим жасаймыз -->
         <div class="bl22">
            <div class="bl_c">
               <div class="bl22_s"><i class="fas fa-quote-right"></i></div>
               <div class="bl22_c">
                  <div class="bl22_ct">БҰЛ - ӨЗІҢІЗГЕ АРНАҒАН <br> ЕҢ МЫҚТЫ ИНВЕСТИЦИЯ!</div>
                  <a class="btn btn_cl" href="#price">Клуб мүшесі болғым келеді</a>
                  <div class="bl22_cp">Құрметпен, Ару Сағи <div class="lazy_img bl22_cw" data-src="/assets/img/bag/gjlgbc.png"></div></div>
                  <div class="bl22_cm">
                     <div class="lazy_img" data-src="/assets/img/bag/271641741_248449760753640_6346307899355939717_n-removebg-preview.png"></div>
                  </div>
               </div>
            </div>
         </div>

		</div>
	</div>
	

<? include "../block/footer.php"; ?>

   <div class="oko">
      <div class="oko_a oko_close"></div>
      <div class="bl_c">
         <div class="oko_s">
            <div class="oko_s_name">Төлем жасау үшін KASPI <br>GOLD жібересіз</div>
            <img class="lazy_img copy" onclick="copytext('4400430125582806')" data-src="/assets/img/bag/Карта_Kaspi_Gold_aru.png" />
            <div class="oko_s_s">Көшіріп алу үшін картаны басыңыз</div>
            <div class="oko_s_p">Whatsapp желісіне <br>чек-ті жібересіз</div>
            <a href="https://wa.me/<?=$whatsapp[$san]?>" target="_blank" class="btn btn_cl">Жіберемін</a>
         </div>
      </div>
   </div>