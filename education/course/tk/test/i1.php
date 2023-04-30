<?php include "../../../../config/core_edu.php";

   // 
   if (isset($_GET['id']) || $_GET['id'] != '') {
      $lesson_id = $_GET['id'];
      $lesson = db::query("select * from c_lesson where id = '$lesson_id'");
      if (mysqli_num_rows($lesson)) {
         $lesson = mysqli_fetch_assoc($lesson);
         $block_id = $lesson['block_id'];
         $pack_id = fun::pack_block($block_id);
         $pack = fun::pack($pack_id);
         $cours_id = fun::cours_pack($pack_id);
         $cours = fun::cours($cours_id);
         $autor = fun::autor($cours['autor_id']);      
      } else { header('location: /education/my/'); }
   } else { header('location: /education/my'); }

   
   // 
   $test_id = 1;
   $test_answer = db::query("select * from test_answer where test_id = '$test_id' and user_id = '$user_id'");
   if (mysqli_num_rows($test_answer)) {
      $test_answer_d = mysqli_fetch_array($test_answer);
      $test_answer_id = $test_answer_d['id'];
      $sql = db::query("UPDATE `test_answer` SET `ubd_dt`='$datetime' WHERE id = '$test_answer_id'");
   } else { 
      db::query("insert into `test_answer`(`test_id`, `user_id`, `ins_dt`) VALUES ('$test_id', '$user_id', '$datetime')");
      $test_answer = db::query("select * from test_answer where test_id = '$test_id' and user_id = '$user_id'");
      $test_answer_d = mysqli_fetch_array($test_answer);
      $test_answer_id = $test_answer_d['id'];
   }


   // site setting
	$menu_name = 'lesson';
   $site_set['swiper'] = true;
	$site_set['ublock'] = true;
	$site_set['utop_nm'] = 'Қорқыныш деңгейін анықтайтын тест ('.$lesson['number'].'. '.$lesson['name_'.$lang].')';
	$site_set['utop_bk'] = 'course/tk/test/?id='.$lesson_id;
   $css = ['education/lesson', 'education/cours/tk'];
   $js = ['education/cours/tk'];
?>
<?php include "../../../block/header.php"; ?>

   <div class="ulesson">
      <div class="bl_c">

         <!--  -->

         <div class="sw_t">
            <div class="swiper sw_tc kt_t1">
               <div class="sw_tca"></div>
               <div class="swiper-wrapper">

                  <div class="swiper-slide sw_ti">
                     <div class="">
                        <div class="sw_tih">Тесттен өтіп, қорқышыш, уайымды өзіңіз жеңе аласыз ба? Соны анықтаңыз</div>
                        <div class="otv_rad3">
                           <p>Күнделікті күйбең тірлік, күйзеліс, үнемі бір ойда жүру, болашақты уайымдау – осының бәрі сіздің мазасыздануыңыздың себебі болуы мүмкін.</p>
                           <p>Дүниежүзілік денсаулық сақтау ұйымының мәліметінше, әлем бойынша 264 млн адам қорқынышпен өмір сүреді екен. Үнемі қорқыныш, үреймен жүру түрлі психологиялық ауытқуларға алып келеді. Ондай кезде маманның көмегіне жүгінуге тура келеді. </p>
                        </div>
                     </div>
                  </div>
      
                  <?php $test = db::query("select * from test_item where test_id = '$test_id'"); ?>
                  <?php while ($test_d = mysqli_fetch_assoc($test)): ?>
                     <div class="swiper-slide sw_ti">
                        <div class="">
                           <div class="sw_tih"><?=$test_d['number']?>. <?=$test_d['name']?></div>
                           <div class="form_im" data-sel="0" data-test-answer-id="<?=$test_answer_id?>" data-test-item-id="<?=$test_d['id']?>" data-test-number="<?=$test_d['number']?>" >
                              <div class="form_radio rad3" data-val="1" data-ball="0"><?=$test_d['v1']?></div>
                              <div class="form_radio rad3" data-val="2" data-ball="1"><?=$test_d['v2']?></div>
                              <div class="form_radio rad3" data-val="3" data-ball="2"><?=$test_d['v3']?></div>
                           </div>
                        </div>
                     </div>
                     <?php $number = $test_d['number']; ?>
                  <?php endwhile ?>
      
                  <div class="swiper-slide sw_ti">
                     <div class="">
                        <div class="otv_rad3 dsp_n">
                           <div class="v1 otv_rads dsp_n">
                              <div>Сізге бәрібір</div>
                              <p>Қорқыныш дегенді білмейсіз. Өйткені сіз эмоцияңызды бақылай аласыз. Және кез келген төтенше жағдайға моральді тұрғыда дайынсыз.</p>
                              <p>Осы қарқынмен өзіңіздің физикалық және психологиялық саулығыңызды сақтап, айналаңызға жақсы энергия сыйлап жүре беріңіз.</p>
                           </div>
                           <div class="v2 otv_rads dsp_n">
                              <div>Маған тыныштық беріңдерші!</div>
                              <p>Cіз үнемі қорқып жүрмейсіз. Кейде белгілі бір жағдайға байланысты болып тұрады. Ойланып көріңіз. Қорқыныш, уайымның себебі неден болуы мүмкін? Психологтар мұндай күй көбіне болашаққа уайымдағаннан болады дейді. Кейбір адамдар болмаған дүниеге уайымдап жүреді.</p>
                              <p>Өмір салтыңызды қайта қарастырыңыз. Нені көп уайымдайсыз? Неден қорқасыз? Жұмысыңыз ауыр ма? Сізді не шаршатады? Тыныс алу жаттығуларын жасаңыз. Міндетті түрде сырттан келетін аұпаратты азайтуға,кімге жазылдыңыз бәрене қарап, сүзгіден қткізіңіз. Бір уақыт шығармашылықпен айналысыңыз. Көңіл күйіңізді, ойыңызды қағазға түсіріңіз. Одан кейін демалып үйреніңіз.</p>
                           </div>
                           <div class="v3 otv_rads dsp_n">
                              <div class="">Енді сәл болмаңанда есіңізден тануыңыз мүмкін!</div>
                              <p>Тест нәтижесі мәз есем. Сізге шұғыл түрде дәрігерге қаралу керек. Жай ғана тыныс алу жаттығуы мен 1-2 күн демалыс сіздің жағдайда көмектесе қоймайды.</p>
                              <p>Егер дәл қазір өзіңізді қолыңызға алып, өз денсааулығыңыздың маңыздылығын сезінбесеңіз бұндай күйдің соңы депрессияға әкелуі мүмкін.</p>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
      
            <div class="sw_tbc">
               <!-- <div class="swiper-button-prev kt_t1_prev swiper-button-disabled"></div> -->
               <div class="swiper-button-next kt_t1_next sw_tb" data-ball="0" data-ball-end="0" data-number="<?=$number?>" data-n="0">
                  <div class="btn">
                     <span>Бісміллә, бастаймын!</span>
                     <i class="far fa-long-arrow-right"></i>
                  </div>
               </div>
            </div>

         </div>


      </div>
   </div>

<?php include "../../../block/footer.php"; ?>