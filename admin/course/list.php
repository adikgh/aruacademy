<? $block = db::query("select * from c_block where pack_id = '$pack_id'"); ?>
<? if (mysqli_num_rows($block) != 0): ?>
   <div class="cours_ls">
      <? while ($block_d = mysqli_fetch_assoc($block)): ?>
         <?	$block_id = $block_d['id']; ?>
         <?	$lesson = db::query("select * from c_lesson where block_id = '$block_id' order by number asc"); ?>
         <? if (mysqli_num_rows($block) != 1): ?>
            <div class="coursls_i coursls_b">
               <div class="coursls_ic">
                  <div class="coursls_in"><p><?=$block_d['name']?></p></div>
               </div>
            </div>
         <? endif ?>
         <div class="coursls_c">
            <? if (mysqli_num_rows($lesson) != 0): ?>
               <? while ($lesson_d = mysqli_fetch_assoc($lesson)): ?>
                  <? if (fun::lesson_info($lesson_d['id'])) $lesson_d = array_merge($lesson_d, fun::lesson_info($lesson_d['id'])); ?>

                  <? if ($buy || $user_right) {
                        if ($cours_d['open_days']) {
                           $result = intval((strtotime(date("d.m.Y")) - strtotime($buy_d['ins_dt'])) / (60*60*24));
                           $days = floor(($result + $cours_d['open_days']) / $cours_d['open_days']);
                           if ($user_right || !$cours_d['open_days'] || ($lesson_d['open'] == 1 && $days >= $lesson_d['number'])) $open = 1; else $open = 0;
                        } else if ($user_right || $lesson_d['open'] == 1) $open = 1;
                        else $open = 0;
                     } else $open = 0;
                  ?>

                  <a class="coursls_i" <?=($open==1?'href="lesson/?id='.$lesson_d['id'].'"':'')?>>
                     <div class="coursls_ic">
                        <div class="coursls_in"><?=($lesson_d['number']!=0?$lesson_d['number'].'. ':'')?><?=$lesson_d['name_'.$lang]?></div>
                        <? if ($lesson_d['video'] || $lesson_d['video_time']): ?>
                           <div class="coursls_ip">
                              <? if ($lesson_d['video']): ?>
                                 <div class="coursls_ipi">
                                    <i class="fal fa-play-circle"></i><?=$lesson_d['video']?> видео
                                 </div>
                              <? endif ?>
                              <? if ($lesson_d['video_time']): ?>
                                 <div class="coursls_ipi">
                                    <i class="fal fa-stopwatch"></i><?=$lesson_d['video_time']?>
                                 </div>
                              <? endif ?>
                           </div>
                        <? endif ?>
                     </div>
                     <div class="coursls_il <?=($open==1?'':'coursls_il_lock')?>">
                        <? if ($open == 1): ?><i class="far fa-play"></i>
                        <? else: ?><i class="far fa-lock"></i><? endif ?>
                     </div>
                  </a>
               <? endwhile ?>
            <? endif ?>
            
            <? if ($user_right == 1): ?>
               <div class="coursls_i_rg">
                  <div class="btn btn_k add_lesson_b">
                     <i class="fal fa-plus"></i>
                     <span>Cабақ қосу</span>
                  </div>
               </div>
            <? endif ?>
         </div>
      <? endwhile ?>
      <? if ($user_right == 1): ?>
         <!-- <a class="coursls_i coursls_i_rg" href="/user/cours/item/lesson/add.php">
            <div class="bq_ci_s">
               <i class="far fa-plus"></i>
               <span>Бөлім қосу</span>
            </div>
         </a> -->
      <? endif ?>
   </div>
<? else: ?>
   <? if ($user_right == 1): ?>
      <div class="coursls_i_rg">
         <div class="btn btn_k add_lesson_b">
            <i class="far fa-plus"></i>
            <span>Cабақ қосу</span>
         </div>
      </div>
   <? endif ?>
<? endif ?>