<?php include "../../../config/core_admin.php";

   // 
   if (!$user_id) header('location: /user/');

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


         // if ($cours['private_link']) {
         //    if ($lesson['site']) header('location: /user/cours/'.$lesson['site'].'?id='.$lesson_id);
         //    else header('location: /user/cours/'.$cours['private_link'].'/lesson.php?id='.$lesson_id);
         // } else {
         //    if ($lesson['site']) header('location: /user/cours/lesson/'.$lesson['site'].'?id='.$lesson_id);
         // }


         $ls = db::query("select * from c_lesson where block_id = '$block_id'");
         $number_prev = $lesson['number'] - 1;
         $number_next = $lesson['number'] + 1;
         while ($ls_d = mysqli_fetch_assoc($ls)) {
            $result = (strtotime(date("d.m.Y")) - strtotime($sub_i['ins_date'])) / (60*60*24*7);
            $weeks = floor($result);
            if (($ls_d['number']==$number_prev && $user_right) || ($ls_d['number']==$number_prev && $ls_d['open'] == 1)) $lesson_prev_id = $ls_d['id'];
            if (($ls_d['number']==$number_next && $user_right) || ($ls_d['number']==$number_next && $ls_d['open'] == 1 && $weeks >= $number_next)) $lesson_next_id = $ls_d['id'];
         }

      } else header('location: /admin/list');
   } else header('location: /admin/list');


   // site setting
	$menu_name = 'lesson';
   // $site_set['header'] = 'user';
   // $site_set['footer'] = 'false';
   // $site_set['ublock'] = 'true';
   $site_set['utop_nm'] = ($lesson['number']!=0?$lesson['number'].'. ':'').$lesson['name_'.$lang];
   $site_set['utop_bk'] = 'cours/item/?id='.$cours_id;
   $site_set['plyr'] = 'true';
   $css = ['admin/lesson'];
   // $js = [];
?>
<? include "../../block/header.php"; ?>

   <div class="ulesson">
      <div class="bl_c">

         <div class="ulesson_c">
         
            <?php $info = db::query("select * from c_lesson_item where lesson_id = '$lesson_id' order by number asc"); ?>
            <?php if (mysqli_num_rows($info)): ?>
               <div class="lsb">
                  <div class="lsb_c lsb_it1" data-lesson-id="<?=$lesson['id']?>">
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
                                    <script> const player_<?=$sql['id']?> = new Plyr(".player_<?=$sql['id']?>", { fullscreen: {iosNative: true} }); </script>
                                 </div>
                                 <div class="utm1_b">
                                    <div class="utm1_bt"><?=$cours['name_'.$lang]?><?=(fun::pack_sum($cours_id)>1?'('.$pack['name_'.$lang].')':'')?></div>
                                    <div class="utm1_bn"><?=$lesson['number']?>. <?=$lesson['name_'.$lang]?></div>
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
                                    const player_<?=$sql['id']?> = new Plyr(".player_<?=$sql['id']?>", { fullscreen: {iosNative: true} });
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
         
                        <? elseif ($sql['type'] == 'link'): ?>
         
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
                           
                        <? elseif ($sql['type'] == 'test'): ?>
                           <? $test_id = $sql['test_id']; ?>
                           <? $test = db::query("select * from test_item where id = '$test_id'"); ?>
                           <? $test_d = mysqli_fetch_assoc($test); ?>
                           <? $test_answer = db::query("select * from test_answer where user_id = '$user_id' and test_id = '$test_id' and lesson_id = '$lesson_id'"); ?>
                           <? if (mysqli_num_rows($test_answer)): ?>
                              <? $test_answer_d = mysqli_fetch_assoc($test_answer); ?>
                              <div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
                                 <div class="lsb_ic">
                                    <div class="lsb_it_name"><?=$test_d['name']?></div>
                                    <div class="form_im">
                                       <div class="form_radio <?=($test_answer_d['v']==1?'form_radio_act':'')?> <?=($test_d['answer']==1?'form_radio_true':'')?> <?=(($test_answer_d['answer']==0 && $test_answer_d['v']==1)?'form_radio_false':'')?> "><?=$test_d['v1']?></div>
                                       <div class="form_radio <?=($test_answer_d['v']==2?'form_radio_act':'')?> <?=($test_d['answer']==2?'form_radio_true':'')?> <?=(($test_answer_d['answer']==0 && $test_answer_d['v']==2)?'form_radio_false':'')?> "><?=$test_d['v2']?></div>
                                    </div>
                                 </div>
                              </div>
                           <? else: ?>
                              <div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
                                 <div class="lsb_ic">
                                    <div class="lsb_it_name"><?=$test_d['name']?></div>
                                    <div class="form_im" data-sel="0" data-test-id="<?=$test_d['id']?>" data-lesson-id="<?=$lesson_id?>">
                                       <div class="form_radio rad1 <?=($test_d['answer']==1?'answer':'')?>" data-val="1"><?=$test_d['v1']?></div>
                                       <div class="form_radio rad1 <?=($test_d['answer']==2?'answer':'')?>"  data-val="2"><?=$test_d['v2']?></div>
                                    </div>
                                 </div>
                              </div>
                           <? endif ?>
                        <? endif ?>
         
                        <? $data_number = $sql['number']; ?>
                     <? endwhile ?>
         
         
                     <? if ($lesson['home_work']): ?>
                        <? $home_work = db::query("select * from home_work where lesson_id = '$lesson_id' and user_id = $user_id"); ?>
                        <? if (!mysqli_num_rows($home_work)): ?>
                           <div class="lsb_i lsb_i_home <?=(($data_number>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?>" data-number="<?=$data_number?>" data-type="home_work">
                              <div class="lsb_ic">
                                 <div class="lsb_ih">Үй жұмысын орындау:</div>
                                 <div class="form_im">
                                    <i class="fal fa-comment-lines form_icon"></i>
                                    <textarea class="form_txt inp_hm"></textarea>
                                 </div>
                                 <div class="form_im">
                                    <div class="btn btn_cl btn_hw" data-cours-id="<?=$cours_id?>" data-pack-id="<?=$pack_id?>" data-lesson-id="<?=$lesson_id?>">Жіберу</div>
                                 </div>
                              </div>
                           </div>
                        <? else: ?>
                           <div class="lsb_i_home">
                              <div class="lsb_ic">
                                 <div class="lsb_ih">Cіздің үй жұмыстарыңыз:</div>
                                 <? while ($home_work_d = mysqli_fetch_array($home_work)): ?>
                                    <div class="lsb_i_home_i">
                                       <p><?=$home_work_d['txt']?></p>
                                    </div>
                                 <? endwhile ?>
                              </div>
                           </div>
                        <? endif ?>
                     <? endif ?>
         
         
                     <? if ($lesson['ques']): ?>
                        <? $ques = db::query("select * from ques where lesson_id = '$lesson_id' and user_id = $user_id"); ?>
                        <? if (!mysqli_num_rows($ques)): ?>
                           <div class="lsb_i lsb_i_home">
                              <div class="lsb_ic">
                                 <div class="lsb_ih">Пікір қалдыру:</div>
                                 <div class="form_im">
                                    <i class="fal fa-comment-lines form_icon"></i>
                                    <textarea class="form_txt inp_form"></textarea>
                                 </div>
                                 <div class="form_im">
                                    <div class="btn btn_cl btn_add_ques" data-cours-id="<?=$cours_id?>" data-pack-id="<?=$pack_id?>" data-lesson-id="<?=$lesson_id?>">Жіберу</div>
                                 </div>
                              </div>
                           </div>
                        <? else: ?>
                           <div class="lsb_i_home">
                              <div class="lsb_ic">
                                 <div class="lsb_ih">Cіздің жазбаларыңыз:</div>
                                 <? while ($ques_d = mysqli_fetch_array($ques)): ?>
                                    <div class="lsb_i_home_i">
                                       <p><?=$ques_d['txt']?></p>
                                    </div>
                                 <? endwhile ?>
                              </div>
                           </div>
                        <? endif ?>
                     <? endif ?>
         
                  </div>
               </div>
         
            <? else: ?>
               <div class="cup_cc">
                  <div class="cup_ccname"> Сабақ әлі шыққан жоқ</div>
               </div>
            <? endif ?>
         
         
            <div class="ulesson_btn">
               <div class="ulesson_btn_c">
                  <? if ($lesson_prev_id): ?>
                     <a href="/user/cours/lesson/?id=<?=$lesson_prev_id?>" class="btn_prev">
                        <div class="btn btn_back2">
                           <i class="fal fa-long-arrow-left"></i>
                           <span>Алдыңғы сабаққа</span>
                        </div>
                     </a>
                  <? endif ?>
                  <a href="/user/cours/item/?id=<?=$cours['id']?>" class="btn_end">
                     <div class="btn btn_back_red">
                        <i class="far fa-times"></i>
                        <span>Сабақты аяқтау</span>
                     </div>
                  </a>
                  <? if ($lesson_next_id): ?>
                     <a href="/user/cours/lesson/?id=<?=$lesson_next_id?>" class="btn_next">
                        <div class="btn btn_back2">
                           <span>Келесі сабаққа</span>
                           <i class="fal fa-long-arrow-right"></i>
                        </div>
                     </a>
                  <? endif ?>
               </div>
            </div>

         </div>
      
      </div>
	</div>

<? include "../../block/footer.php"; ?>