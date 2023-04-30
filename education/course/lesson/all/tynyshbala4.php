<? include "../../../../config/core_edu.php";

   // 
   if ($user_id) {
         $lesson_id = 40;
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
            // $sub_info = db::query("select * from c_sub_lesson where lesson_id = '$lesson_id' and user_id = '$user_id'");
            // if (mysqli_num_rows($sub_info) != 0) {
            //    $sub_info_d = mysqli_fetch_array($sub_info);
            //    db::query("UPDATE `c_sub_lesson` SET `upd_date` = '$date', `lesson_view` = 1 where lesson_id = '$lesson_id' and user_id = '$user_id'");
            //    if (!$sub_info_d['lesson_stage']) $sub_info_d['lesson_stage'] = 1;
            // } else { 
            //    db::query("INSERT INTO `c_sub_lesson`(`lesson_id`, `user_id`, `lesson_view`, `ins_date`, `upd_date`) VALUES ('$lesson_id', '$user_id', 1, '$date', '$date')");
            //    $sub_info_d['lesson_stage'] = 1;
            // }

            $ls = db::query("select * from c_lesson where block_id = '$block_id'");
            $number_prev = $lesson['number'] - 1;
            $number_next = $lesson['number'] + 1;
            while ($ls_d = mysqli_fetch_assoc($ls)) {
               if (($ls_d['number']==$number_prev && $ls_d['status_id'] != 6) || ($ls_d['number']==$number_prev && $user_right)) $lesson_prev_id = $ls_d['id'];
               if (($ls_d['number']==$number_next && $ls_d['status_id'] != 6) || ($ls_d['number']==$number_next && $user_right)) $lesson_next_id = $ls_d['id'];
            }

         } else header('location: /education/my/');
   } else header('location: /education/');

   // site setting
	$menu_name = 'lesson';
	$site_set = [
		'header' => 'full',
		'footer' => 'false',
      'ublock' => 'true',
      'utop_nm' => $lesson['number'].'. '.$lesson['name'],
		'utop_bk' => 'item/?id='.$cours_id,
	];
   $css = ['education/lesson'];
   // $js = [];

?>
<? include "../../../block/header.php"; ?>

   <div class="ulesson">
      <div class="ulesson_c">

         <? $info1 = db::query("select * from c_lesson_item where lesson_id = '$lesson_id' and type = 'video' and number = 1"); ?>
         <? if (!mysqli_num_rows($info1)): ?>
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
         <? endif ?>

         <!--  -->
         <? $info = db::query("select * from c_lesson_item where lesson_id = '$lesson_id' order by number asc"); ?>
         <? if (mysqli_num_rows($info)): ?>
            <div class="lsb">
               <div class="bl_c"> 
                  <div class="lsb_c" data-lesson-id="<?=$lesson['id']?>">
                     <? while ($sql = mysqli_fetch_assoc($info)): ?>

                        <div class="lsb_i" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
                           <div class="lsb_ic">
                              <div class="lsb_it_name2"><?=$sql['type_name']?></div>
                              <? $test_nm = $sql['txt']; ?>
                              <? $test = db::query("select * from test_item where type = '$test_nm'"); ?>
                              <? while ($test_d = mysqli_fetch_assoc($test)): ?>
                                 <? // $test_answer = db::query("select * from test_answer where user_id = '$user_id' and test_id = '$test_id' and lesson_id = '$lesson_id'"); ?>
                                 <? // $test_answer_d = mysqli_fetch_assoc($test_answer); ?>
                                 <div class="lsb_icm">
                                    <div class="lsb_it_name"><?=$test_d['number']?>. <?=$test_d['name']?></div>
                                    <div class="form_im" data-sel="0" data-test-id="<?=$test_d['id']?>" data-test-number="<?=$test_d['number']?>" data-lesson-id="<?=$lesson_id?>">
                                       <div class="form_radio rad2" data-val="1" data-ball="<?=($test_d['answer']==1?'1':'0')?>"><?=$test_d['v1']?></div>
                                       <div class="form_radio rad2" data-val="2" data-ball="<?=($test_d['answer']==2?'1':'0')?>"><?=$test_d['v2']?></div>
                                    </div>
                                 </div>
                                 <? $number = $test_d['number']; ?>
                              <? endwhile ?>
                              <div class="otv_rad2 dsp_n">
                                 <? $test = db::query("select * from test_item where name = '$test_nm'"); ?>
                                 <? $test_d = mysqli_fetch_assoc($test); ?>
                                 <p class="v1 dsp_n"><?=$test_d['v1']?> ИЯ</p>
                                 <p class="v2 dsp_n"><?=$test_d['v2']?> ЖОК</p>
                              </div>
                              <div class="btn rad2_btn" data-ball="0" data-number="<?=$number?>" data-min="<?=$test_d['v3']?>" data-max="<?=$test_d['v4']?>">Жауап беру</div>
                           </div>
                        </div>

                     <? endwhile ?>

                  </div>
               </div>
            </div>

         <? endif ?>

         
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
               </div>
            </div>
         </div>
      </div>
	</div>

<? include "../../../block/footer.php"; ?>