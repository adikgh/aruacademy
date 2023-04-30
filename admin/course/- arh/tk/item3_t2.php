<?php include "../../../config/core.php";

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
      } else { header('location: /user/cours/'); }
   } else { header('location: /user/cours/'); }


   // 
   $test_id = $_GET['test_id'];
   $test = db::query("select * from test where id = '$test_id'");
   $test_d = mysqli_fetch_assoc($test);
   $test_number = $test_d['number'];

   // 
   $tk_test = db::query("select * from tk_test_b where user_id = '$user_id'");
   if (mysqli_num_rows($tk_test)) {
      $tk_test_b = mysqli_fetch_array($tk_test);
      $tk_test_id = $tk_test_b['id'];
      $sql = db::query("UPDATE `tk_test_b` SET `n`='$test_number', `ubd_dt`='$datetime' WHERE id = '$tk_test_id'");
   }

   // 
   $test_answer = db::query("select * from test_answer where test_id = '$test_id' and user_id = '$user_id'");
   if (mysqli_num_rows($test_answer)) {
      $test_answer_d = mysqli_fetch_array($test_answer);
      $test_answer_id = $test_answer_d['id'];
      $sql = db::query("UPDATE `test_answer` SET `ubd_dt`='$datetime', `tk_test_id`='$tk_test_id' WHERE id = '$test_answer_id'");
   } else { 
      db::query("insert into `test_answer`(`test_id`, `tk_test_id`, `user_id`, `ins_dt`) VALUES ('$test_id', '$tk_test_id', '$user_id', '$datetime')");
      $test_answer = db::query("select * from test_answer where test_id = '$test_id' and user_id = '$user_id'");
      $test_answer_d = mysqli_fetch_array($test_answer);
      $test_answer_id = $test_answer_d['id'];
   }

   // site setting
	$menu_name = 'lesson';
	$site_set = [
		'header' => 'user',
		'footer' => 'false',
      'ublock' => 'true',
      'utop_nm' => $test_d['name_kz'].' ('.$lesson['number'].'. '.$lesson['name_'.$lang].')',
		'utop_bk' => 'cours/tk/item332.php?id='.$lesson_id,
      'um_menu' => 'false',
	];
   $css = ['user', 'ulesson', 'cours/tk'];
   $js = ['user', 'cours/tk'];

?>
<?php include "../../../block/header.php"; ?>

   <div class="ulesson">
      <div class="ulesson_c">

         <!-- <div class="ut_l">
            <a class="ut_li" href="/user/cours/">Курстар</a>
            <a class="ut_li" href="/user/item/?id=<?=$cours['id']?>"><?=$cours['name']?></a>
            <a class="ut_li" href="/user/tk/item3.php?id=<?=$lesson_id?>"><?=$lesson['number']?>. <?=$lesson['name']?></a>
            <a class="ut_li" href="/user/tk/item332.php?id=<?=$lesson_id?>">5-10 жасқа дейінгі ..</a>
            <span><?=$test_d['name_kz']?></span>
         </div> -->

         <div class="swiper sw_tc kt_t2">
            <div class="sw_tca"></div>
            <div class="swiper-wrapper">

               <?php if ($test_d['number'] == 1): ?>
                  <!-- <div class="swiper-slide sw_ti">
                     <div class="">
                        <div class="sw_tih">Сұрақтарға төмендегі жауаптардан балаңыздың бойынан күнделікті байқайтын қылықты, мінезді белгілеңіз</div>
                        <div class="form_im">
                           <div class="form_radio rad4_all">Жоқ, ондай болмайды</div>
                           <div class="form_radio rad4_all">Кейде болады</div>
                           <div class="form_radio rad4_all">Осылай боп тұрады</div>
                        </div>
                     </div>
                  </div> -->
               <?php endif ?>

               <?php $test_item = db::query("select * from test_item where test_id = '$test_id'"); ?>
               <?php while ($test_item_d = mysqli_fetch_assoc($test_item)): ?>
                  <div class="swiper-slide sw_ti">
                     <div class="">
                        <div class="sw_tih"><?=$test_item_d['number']?>. <?=$test_item_d['name']?></div>
                        <div class="form_im" data-sel="0" data-test-answer-id="<?=$test_answer_id?>" data-test-item-id="<?=$test_item_d['id']?>" data-test-number="<?=$test_item_d['number']?>" >
                           <div class="form_radio rad4" data-val="1"><?=$test_item_d['v1']?></div>
                           <div class="form_radio rad4" data-val="2"><?=$test_item_d['v2']?></div>
                           <div class="form_radio rad4" data-val="3"><?=$test_item_d['v3']?></div>
                        </div>
                     </div>
                  </div>
                  <?php $number = $test_item_d['number']; ?>
               <?php endwhile ?>

               <div class="swiper-slide sw_ti">
                  <div class="">
                     <div class="sw_tih">Жауап</div>
                     <div class="swt_answer">
                        <div class="swt_answer_i swt_answer_i1">
                           <div class="swt_answer_it">
                              <span>Жоқ, ондай болмайды</span>
                              <div>3/9</div>
                           </div>
                           <div class="swt_answer_ic"><div></div></div>
                        </div>
                        <div class="swt_answer_i swt_answer_i2">
                           <div class="swt_answer_it">
                              <span>Кейде болады</span>
                              <div></div>
                           </div>
                           <div class="swt_answer_ic"><div></div></div>
                        </div>
                        <div class="swt_answer_i swt_answer_i3">
                           <div class="swt_answer_it">
                              <span>Иә, осылай</span>
                              <div></div>
                           </div>
                           <div class="swt_answer_ic"><div></div></div>
                        </div>
                     </div>
                  </div>
                  <div class="tk3_lo" data-n="<?=($test_d['age1']>=$tk_test_b['child_age']?$test_d['answer1']:$test_d['answer2'])?>">
                     <div class="tk3_loi tk3_loi1 dsp_n">Қалыпты жағдай</div>
                     <div class="tk3_loi tk3_loi2 dsp_n">Қауіпті болып тұр</div>
                  </div>
                  <div class="tk3_ans" data-n="<?=($test_d['age1']>=$tk_test_b['child_age']?$test_d['answer1']:$test_d['answer2'])?>">
                     <div class="tk3_ans1"><?=($test_d['age1']>=$tk_test_b['child_age']?$test_d['result1']:$test_d['result2'])?></div>
                  </div>
               </div>
               
            </div>
         </div>

         <div class="sw_tbc">
            <div class="swiper-button-next kt_t2_next sw_tb sw_tb_start swiper-button-disabled" data-id="<?=$lesson_id?>" data-number="<?=$number?>" data-test-number="<?=$test_d['number']?>" data-ball-v1="0" data-ball-v2="0" data-ball-v3="0">
               <div class="btn">
                  <span>Бісміллә, бастаймын!</span>
                  <i class="far fa-long-arrow-right"></i>
               </div>
            </div>
         </div>

      </div>
	</div>

<?php include "../../../block/footer.php"; ?>