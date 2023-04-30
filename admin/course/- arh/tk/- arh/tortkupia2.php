<?php include "../../../config/core.php";

   // 
   if ($user_id) {
         $lesson_id = 183;
         $lesson = db::query("select * from c_lesson where id = '$lesson_id'");
         if (mysqli_num_rows($lesson)) {
            $lesson = mysqli_fetch_assoc($lesson);
            $block_id = $lesson['block_id'];
            $pack_id = fun::pack_block($block_id);
            $pack = fun::pack($pack_id);
            $cours_id = fun::cours_pack($pack_id);
            $cours = fun::cours($cours_id);
            $autor = fun::autor($cours['autor_id']);

            // 
            $sub_info = db::query("select * from c_sub_lesson where lesson_id = '$lesson_id' and user_id = '$user_id'");
            if (mysqli_num_rows($sub_info) != 0) {
               $sub_info_d = mysqli_fetch_array($sub_info);
               db::query("UPDATE `c_sub_lesson` SET `upd_date` = '$date', `lesson_view` = 1 where lesson_id = '$lesson_id' and user_id = '$user_id'");
               if (!$sub_info_d['lesson_stage']) $sub_info_d['lesson_stage'] = 1;
            } else { 
               db::query("INSERT INTO `c_sub_lesson`(`lesson_id`, `user_id`, `lesson_view`, `ins_date`, `upd_date`) VALUES ('$lesson_id', '$user_id', 1, '$date', '$date')");
               $sub_info_d['lesson_stage'] = 1;
            }

            $ls = db::query("select * from c_lesson where block_id = '$block_id'");
            $number_prev = $lesson['number'] - 1;
            $number_next = $lesson['number'] + 1;
            while ($ls_d = mysqli_fetch_assoc($ls)) {
               if (($ls_d['number']==$number_prev && $ls_d['status_id'] != 6) || ($ls_d['number']==$number_prev && $user_right)) $lesson_prev_id = $ls_d['id'];
               if (($ls_d['number']==$number_next && $ls_d['status_id'] != 6) || ($ls_d['number']==$number_next && $user_right)) $lesson_next_id = $ls_d['id'];
            }

         } else { header('location: /u/c/'); }
   } else { header('location: /u/'); }

   // site setting
	$menu_name = 'lesson';
	$site_set = [
		'header' => 'full',
		'footer' => 'false',
      'ublock' => 'true',
      'utop_nm' => $lesson['number'].'. '.$lesson['name'],
		'utop_bk' => 'i/?id='.$cours_id,
	];
   $css = ['user','ulesson'];
   $js = ['user'];

?>
<?php include "../../../block/header.php"; ?>



   <div class="ulesson">
      <div class="ulesson_c">

         <?php $info1 = db::query("select * from c_lesson_item where lesson_id = '$lesson_id' and type = 'video' and number = 1"); ?>
         <?php if (!mysqli_num_rows($info1)): ?>
            <div class="utm1">
               <div class="bl_c">
                  <div class="utm1_c">
                     <div class="utm1_b">
                        <div class="utm1_bt"><?=$cours['name']?> <?=(fun::pack_sum($cours_id)>1?'('.$pack['name'].')':'')?></div>
                        <div class="utm1_bn"><?=$lesson['number']?>. <?=$lesson['name']?></div>
                        <div class="uitemci_ad">
                           <div class="uitemci_ad_i lazy_img" data-src="/assets/img/users/<?=$autor['logo']?>"></div>
                           <div class="uitemci_ad_t"><?=$autor['name']?> <?=$autor['surname']?></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php endif ?>

         <!--  -->
         <?php $info = db::query("select * from c_lesson_item where lesson_id = '$lesson_id' order by number asc"); ?>
         <?php if (mysqli_num_rows($info)): ?>
            <div class="lsb">
               <div class="bl_c"> 
                  <div class="lsb_c" data-lesson-id="<?=$lesson['id']?>">
                     <?php while ($sql = mysqli_fetch_assoc($info)): ?>

                        <div class="lsb_i" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
                           <div class="lsb_ic">
                              <div class="lsb_it_name2"><?=$sql['type_name']?></div>
                              <?php $test_nm = $sql['txt']; ?>

                              <div class="otv_rad3">
                                 <p>Күнделікті күйбең тірлік, күйзеліс, үнемі бір ойда жүру, болашақты уайымдау – осының бәрі сіздің мазасыздануыңыздың себебі болуы мүмкін.</p>
                                 <p>Дүниежүзілік денсаулық сақтау ұйымының мәліметінше, әлем бойынша 264 млн адам қорқынышпен өмір сүреді екен. Үнемі қорқыныш, үреймен жүру түрлі психологиялық ауытқуларға алып келеді. Ондай кезде маманның көмегіне жүгінуге тура келеді. </p>
                                 <p>Тесттен өтіп, қорқышыш, уайымды өзіңіз жеңе аласыз ба? Соны анықтаңыз.</p>
                              </div>

                              <?php $test = db::query("select * from test_data where type = '$test_nm'"); ?>
                              <?php while ($test_d = mysqli_fetch_assoc($test)): ?>
                                 <?php // $test_answer = db::query("select * from test_answer where user_id = '$user_id' and test_id = '$test_id' and lesson_id = '$lesson_id'"); ?>
                                 <?php // $test_answer_d = mysqli_fetch_assoc($test_answer); ?>
                                 <div class="lsb_icm">
                                    <div class="lsb_it_name"><?=$test_d['number']?>. <?=$test_d['name']?></div>
                                    <div class="form_im" data-sel="0" data-test-id="<?=$test_d['id']?>" data-test-number="<?=$test_d['number']?>" data-lesson-id="<?=$lesson_id?>">
                                       <div class="form_radio rad3" data-val="0" data-ball="0"><?=$test_d['v1']?></div>
                                       <div class="form_radio rad3" data-val="1" data-ball="1"><?=$test_d['v2']?></div>
                                       <div class="form_radio rad3" data-val="2" data-ball="2"><?=$test_d['v3']?></div>
                                    </div>
                                 </div>
                                 <?php $number = $test_d['number']; ?>
                              <?php endwhile ?>
                              <div class="otv_rad3 dsp_n">
                                 <div class="v1 otv_rads dsp_n">
                                    <div>Сізге бәрібір</div>
                                    <p>Қорқыныш дегенді білмейсіз. Өйткені сіз эмоцияңызды бақылай аласыз. Және кез келген төтенше жағдайға моральді тұрғыда дайынсыз.</p>
                                    <p>Осы қарқынмен өзіңіздің физикалық және психологиялық саулығыңызды сақтап, айналаңызға жақсы энергия сыйлап жүре беріңіз.</p>
                                 </div>
                                 <div class="v2 otv_rads dsp_n">
                                    <div>Маған тыныштық беріңдерші!</div>
                                    <p>із үнемі қорқып жүрмейсіз. Кейде белгілі бір жағдайға байланысты болып тұрады. Ойланып көріңіз. Қорқыныш, уайымның себебі неден болуы мүмкін? Психологтар мұндай күй көбіне болашаққа уайымдағаннан болады дейді. Кейбір адамдар болмаған дүниеге уайымдап жүреді.</p>
                                    <p>Өмір салтыңызды қайта қарастырыңыз. Нені көп уайымдайсыз? Неден қорқасыз? Жұмысыңыз ауыр ма? Сізді не шаршатады? Тыныс алу жаттығуларын жасаңыз. Міндетті түрде сырттан келетін аұпаратты азайтуға,кімге жазылдыңыз бәрене қарап, сүзгіден қткізіңіз. Бір уақыт шығармашылықпен айналысыңыз. Көңіл күйіңізді, ойыңызды қағазға түсіріңіз. Одан кейін демалып үйреніңіз.</p>
                                 </div>
                                 <div class="v3 otv_rads dsp_n">
                                    <div class="">Енді сәл болмаңанда есіңізден тануыңыз мүмкін!</div>
                                    <p>Тест нәтижесі мәз есем. Сізге шұғыл түрде дәрігерге қаралу керек. Жай ғана тыныс алу жаттығуы мен 1-2 күн демалыс сіздің жағдайда көмектесе қоймайды.</p>
                                    <p>Егер дәл қазір өзіңізді қолыңызға алып, өз денсааулығыңыздың маңыздылығын сезінбесеңіз бұндай күйдің соңы депрессияға әкелуі мүмкін.</p>
                                 </div>
                              </div>
                              <div class="btn rad3_btn" data-ball="0" data-number="<?=$number?>">Жауап беру</div>
                           </div>
                        </div>

                     <?php endwhile ?>

                  </div>
               </div>
            </div>

         <?php endif ?>

         
         <div class="ulesson_btn">
            <div class="bl_c">
               <div class="ulesson_btn_c">
                  <?php if ($lesson_prev_id): ?>
                     <a href="/u/l/?id=<?=$lesson_prev_id?>" class="btn_prev">
                        <div class="btn btn_cl">
                           <i class="fal fa-long-arrow-left"></i>
                           <span>Алдыңғы сабаққа</span>
                        </div>
                     </a>
                  <?php endif ?>
                  <a href="/u/i/?id=<?=$cours['id']?>" class="btn_end">
                     <div class="btn btn_red_cl">
                        <i class="far fa-times"></i>
                        <span>Сабақты аяқтау</span>
                     </div>
                  </a>
                  <?php if ($lesson_next_id): ?>
                     <a href="/u/l/?id=<?=$lesson_next_id?>" class="btn_next">
                        <div class="btn">
                           <span>Келесі сабаққа</span>
                           <i class="fal fa-long-arrow-right"></i>
                        </div>
                     </a>
                  <?php endif ?>
               </div>
            </div>
         </div>
      </div>
	</div>



<?php include "../../../block/footer.php"; ?>