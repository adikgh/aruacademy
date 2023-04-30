<?php include "../../../../../config/core_edu.php";

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
      } else header('location: /education/my/');
   } else header('location: /education/my/');


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
   $site_set['swiper'] = true;
	$site_set['ublock'] = true;
	$site_set['utop_nm'] = $test_d['name_kz'].' ('.$lesson['number'].'. '.$lesson['name_'.$lang].')';
	$site_set['utop_bk'] = ' ';
   $css = ['education/lesson', 'education/cours/tk'];
   $js = ['education/cours/tk'];
?>
<?php include "../../../../block/header.php"; ?>

   <div class="ulesson">
      <div class="bl_c">

         <!--  -->

         <div class="swiper sw_tc kt_t4">
            <div class="sw_tca"></div>
            <div class="swiper-wrapper">

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
                              <span>Жоқ, ондай болмайды</span><div></div>
                           </div>
                           <div class="swt_answer_ic"><div></div></div>
                        </div>
                        <div class="swt_answer_i swt_answer_i2">
                           <div class="swt_answer_it">
                              <span>Кейде болады</span><div></div>
                           </div>
                           <div class="swt_answer_ic"><div></div></div>
                        </div>
                        <div class="swt_answer_i swt_answer_i3">
                           <div class="swt_answer_it">
                              <span>Иә, осылай</span><div></div>
                           </div>
                           <div class="swt_answer_ic"><div></div></div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>

         <div class="sw_tbc">
            <!-- <div class="swiper-button-prev kt_t4_prev  swiper-button-disabled"></div> -->
            <div class="swiper-button-next kt_t4_next sw_tb swiper-button-disabled" data-id="<?=$lesson_id?>" data-number="<?=$number?>" data-test-number="<?=$test_d['number']?>" data-ball-v1="0" data-ball-v2="0" data-ball-v3="0">
               <div class="btn">
                  <span>Бісміллә, бастаймын!</span>
                  <i class="far fa-long-arrow-right"></i>
               </div>
            </div>
         </div>

      </div>
	</div>

<? include "../../../../block/footer.php"; ?>