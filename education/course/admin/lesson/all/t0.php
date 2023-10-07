<div class="lsb_c <?=($lesson['type']==1?'lsb_it1':'')?>" data-lesson-id="<?=$lesson['id']?>">
   <?php while ($sql = mysqli_fetch_assoc($info)): ?>
      <?php if ($sql['type'] == 'txt' || $sql['type'] == 'txt_warning'): ?>
         
         <div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
            <div class="lsb_ic">
               <?php if ($sql['type_name']): ?>
                  <div class="lsb_ih"><?=$sql['type_name']?>:</div>
               <?php endif ?>
               <div class="prd_txt <?=($sql['type'] == 'txt_warning'?'prd_txt_warning':'')?>">
                  <?php if ($sql['type'] == 'txt_warning'): ?>
                     <i class="fal fa-exclamation-circle"></i>
                  <?php endif ?>
                  <?=$sql['txt']?>
               </div>
            </div>
         </div>

      <?php elseif ($sql['type'] == 'video'): ?>

         <?php if ($sql['number'] == 1): ?>

            <div class="lsb_i utm1_c <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
               <div class="utm1_v">
                  <div class="container">
                     <div class="player_<?=$sql['id']?>" data-plyr-provider="<?=$sql['type_video']?>" data-plyr-embed-id="<?=$sql['txt']?>"></div>
                  </div>
                  <script>
                     const player_<?=$sql['id']?> = new Plyr(".player_<?=$sql['id']?>", {});
                     player_<?=$sql['id']?>.on("enterfullscreen", function() { $(".pmenu").addClass("pmenu_hide"); $(".header").addClass("header_hide");  });
                     player_<?=$sql['id']?>.on("exitfullscreen", function() { $(".pmenu").removeClass("pmenu_hide"); $(".header").removeClass("header_hide");  });
                  </script>
               </div>
               <div class="utm1_b">
                  <div class="utm1_bt"><?=$cours['name']?><?=(fun::pack_sum($cours_id)>1?'('.$pack['name'].')':'')?></div>
                  <div class="utm1_bn"><?=$lesson['number']?>. <?=$lesson['name']?></div>
                  <div class="uitemci_ad">
                     <div class="uitemci_ad_i lazy_img" data-src="/assets/img/users/<?=$autor['logo']?>"></div>
                     <div class="uitemci_ad_t"><?=$autor['name']?> <?=$autor['surname']?></div>
                  </div>
               </div>
            </div>

         <?php else: ?>
         
            <div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
               <div class="lsb_ih"><?=$sql['type_name']?>:</div>
               <div class="lsbi_video">
                  <div class="container">
                     <div class="player_<?=$sql['id']?>" data-plyr-provider="<?=$sql['type_video']?>" data-plyr-embed-id="<?=$sql['txt']?>"></div>
                  </div>
               </div>
               <script>
                  const player_<?=$sql['id']?> = new Plyr(".player_<?=$sql['id']?>", {});
                  player_<?=$sql['id']?>.on("enterfullscreen", function() { $(".pmenu").addClass("pmenu_hide"); $(".header").addClass("header_hide");  });
                  player_<?=$sql['id']?>.on("exitfullscreen", function() { $(".pmenu").removeClass("pmenu_hide"); $(".header").removeClass("header_hide");  });
               </script>
            </div>
         <?php endif ?>
      
      <?php elseif ($sql['type'] == 'mat'): ?>

         <div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
            <div class="lsb_ic">
               <div class="lsb_i2">
                  <div class="lsb_i2_l"><?=$sql['icon']?></div>
                  <div class="lsb_i2_r">
                     <div class="lsb_ih2"><span><?=$sql['type_name']?>:</span></div>
                     <div class="lsb_ih3"><?=$sql['txt']?></div>
                  </div>
               </div>
               <div class="lsb_i3">
                  <a class="btn btn_cl" href="/assets/uploads/<?=$sql['txt']?>" target="_blank"><i class="fal fa-folder-open"></i><span>Ашу</span></a>
                  <a class="btn btn_cl" href="/assets/uploads/<?=$sql['txt']?>" download><i class="fal fa-cloud-download"></i><span>Жүктеп алу</span></a>
               </div>
            </div>
         </div>

      <?php elseif ($sql['type'] == 'link'): ?>

         <div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
            <div class="lsb_ic">
               <div class="lsb_i2">
                  <div class="lsb_i2_l"><?=$sql['icon']?></div>
                  <div class="lsb_i2_r">
                     <div class="lsb_ih2"><span><?=$sql['type_name']?>:</span></div>
                     <div class="lsb_ih3"><?=$sql['txt']?></div>
                  </div>
               </div>
               <div class="lsb_i3">
                  <a class="btn btn_cl" href="<?=$sql['txt']?>" target="_blank"><span>Қосылу</span><i class="fal fa-long-arrow-right"></i></a>
               </div>
            </div>
         </div>
         
      <?php elseif ($sql['type'] == 'test'): ?>
         <?php $test_id = $sql['test_id']; ?>
         <?php $test = db::query("select * from test_item where id = '$test_id'"); ?>
         <?php $test_d = mysqli_fetch_assoc($test); ?>
         <?php $test_answer = db::query("select * from test_answer where user_id = '$user_id' and test_id = '$test_id' and lesson_id = '$lesson_id'"); ?>
         <?php if (mysqli_num_rows($test_answer)): ?>
            <?php $test_answer_d = mysqli_fetch_assoc($test_answer); ?>
            <div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
               <div class="lsb_ic">
                  <div class="lsb_it_name"><?=$test_d['name']?></div>
                  <div class="form_im">
                     <div class="form_radio <?=($test_answer_d['v']==1?'form_radio_act':'')?> <?=($test_d['answer']==1?'form_radio_true':'')?> <?=(($test_answer_d['answer']==0 && $test_answer_d['v']==1)?'form_radio_false':'')?> "><?=$test_d['v1']?></div>
                     <div class="form_radio <?=($test_answer_d['v']==2?'form_radio_act':'')?> <?=($test_d['answer']==2?'form_radio_true':'')?> <?=(($test_answer_d['answer']==0 && $test_answer_d['v']==2)?'form_radio_false':'')?> "><?=$test_d['v2']?></div>
                  </div>
               </div>
            </div>
         <?php else: ?>
            <div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
               <div class="lsb_ic">
                  <div class="lsb_it_name"><?=$test_d['name']?></div>
                  <div class="form_im" data-sel="0" data-test-id="<?=$test_d['id']?>" data-lesson-id="<?=$lesson_id?>">
                     <div class="form_radio rad1 <?=($test_d['answer']==1?'answer':'')?>" data-val="1"><?=$test_d['v1']?></div>
                     <div class="form_radio rad1 <?=($test_d['answer']==2?'answer':'')?>"  data-val="2"><?=$test_d['v2']?></div>
                  </div>
               </div>
            </div>
         <?php endif ?>
      <?php endif ?>
      <?php $data_number = $sql['number']; ?>
   <?php endwhile ?>

   <?php if ($pack['home_work'] && $lesson['home_work']): ?>
      <div class="lsb_i lsb_i_home <?=(($data_number>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?>" data-number="<?=$data_number?>" data-type="home_work">
         <div class="lsb_ic">
            <div class="lsb_ih">Үй жұмысын орындау:</div>
            <div class="form_im">
               <i class="fal fa-comment-lines form_icon"></i>
               <textarea class="form_im_txt inp_hm"></textarea>
            </div>
            <div class="form_im">
               <div class="btn btn_cl btn_hw" data-cours-id="<?=$cours_id?>" data-pack-id="<?=$pack_id?>" data-lesson-id="<?=$lesson_id?>">Жіберу</div>
            </div>
         </div>
      </div>
   <?php endif ?>

   <?php $home_work = db::query("select * from home_work where lesson_id = '$lesson_id' and user_id = $user_id"); ?>
   <?php if (mysqli_num_rows($home_work)): ?>
      <div class="lsb_i_home">
         <div class="lsb_ic">
            <div class="lsb_ih">Cіздің үй жұмыстарыңыз:</div>
            <?php while ($home_work_d = mysqli_fetch_array($home_work)): ?>
               <?php $w_id = $home_work_d['id']; ?>
               <div class="lsb_i_home_i">
                  <div class="lsb_i_home_id"><div><?=date("m-d-Y", strtotime($home_work_d['ins_dt']))?></div><div><?=date("H:i", strtotime($home_work_d['ins_dt']))?></div></div>
                  <p><?=$home_work_d['txt']?></p>
                  
                  <?php $work_o = db::query("select * from home_work where homework_id = '$w_id'"); ?>
                  <?php if (mysqli_num_rows($work_o)): ?>
                     <?php $work_od = mysqli_fetch_array($work_o) ?>
                     <div class="lsb_i_home_b"><?=$work_od['txt']?></div>
                  <?php endif ?>
               </div>
            <?php endwhile ?>
         </div>
      </div>
   <?php endif ?>

   <?php if ($lesson['form']): ?>
      <div class="lsb_i lsb_i_home">
         <div class="lsb_ic">
            <div class="lsb_ih">Форманы толтыру:</div>
            <div class="form_im">
               <i class="fal fa-comment-lines form_icon"></i>
               <textarea class="form_im_txt inp_form"></textarea>
            </div>
            <div class="form_im">
               <div class="btn btn_cl btn_add_form" data-cours-id="<?=$cours_id?>" data-pack-id="<?=$pack_id?>" data-lesson-id="<?=$lesson_id?>">Жіберу</div>
            </div>
         </div>
      </div>

      <?php $form = db::query("select * from quiz where lesson_id = '$lesson_id' and user_id = $user_id"); ?>
      <?php if (mysqli_num_rows($form)): ?>
         <div class="lsb_i_home">
            <div class="lsb_ic">
               <div class="lsb_ih">Cіздің жазбаларыңыз:</div>
               <?php while ($form_d = mysqli_fetch_array($form)): ?>
                  <div class="lsb_i_home_i">
                     <p><?=$form_d['txt']?></p>
                  </div>
               <?php endwhile ?>
            </div>
         </div>
      <?php endif ?>
   <?php endif ?>

</div>