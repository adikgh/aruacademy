<?php include "../../../config/core.php";

   // 
   if (!$user_id) header('location: /user/');

   if (isset($_GET['id']) || $_GET['id'] != '') {
      $mc_id = $_GET['id'];
      $mc = db::query("select * from cours where id = '$mc_id' and category_id = 2");
      if (isset($_GET['back'])) $mc = db::query("select * from c_sub_item where id = '$mc_id' and category_id = 2");
      if (mysqli_num_rows($mc)) {
         $mc_d = mysqli_fetch_assoc($mc);
         $autor = fun::autor($mc_d['autor_id']);

      } else header('location: /user/cours/');
   } else header('location: /user/cours/');

   // site setting
	$menu_name = 'lesson';
	$site_set = [
      // 'ublock' => 'true',
      'utop_nm' => $mc_d['name_'.$lang],
      'plyr' => true,
      'autosize' => true,
	];
   if (isset($_GET['back'])) $site_set['utop_bk'] = $_GET['back'];
   $css = ['user', 'ulesson'];
   $js = ['user'];

?>
<? include "../../../block/header.php"; ?>


   <div class="ulesson">

      <div class="ulesson_c">

         <? if ($mc_id == 2): ?>
            <div class="lsb">
               <div class="lsb_c lsb_it1">
                  <div class="lsb_i utm1_c">
                     <div class="utm1_v">
                        <div class="container">
                           <div class="player_12" data-plyr-provider="youtube" data-plyr-embed-id="_k9__UfxVcs"></div>
                           <script>const player_12 = new Plyr(".player_12",{fullscreen:{iosNative:true}});</script>
                        </div>
                     </div>
                     <div class="utm1_b">
                        <div class="utm1_bn"><?=$mc_d['name_'.$lang]?></div>
                        <div class="uitemci_ad">
                           <div class="uitemci_ad_i lazy_img" data-src="/assets/img/users/<?=$autor['logo']?>"></div>
                           <div class="uitemci_ad_t"><?=$autor['name']?> <?=$autor['surname']?></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <? elseif ($mc_id == 4): ?>
            <div class="lsb">
               <div class="lsb_c lsb_it1">
                  <div class="lsb_i utm1_c">
                     <div class="utm1_v">
                        <div class="container">
                           <div class="player_12" data-plyr-provider="youtube" data-plyr-embed-id="YfEnzb0CfnA"></div>
                           <script>const player_12 = new Plyr(".player_12",{fullscreen:{iosNative:true}});</script>
                        </div>
                     </div>
                     <div class="utm1_b">
                        <div class="utm1_bn"><?=$mc_d['name_'.$lang]?></div>
                        <div class="uitemci_ad">
                           <div class="uitemci_ad_i lazy_img" data-src="/assets/img/users/<?=$autor['logo']?>"></div>
                           <div class="uitemci_ad_t"><?=$autor['name']?> <?=$autor['surname']?></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <? elseif ($mc_id == 9): ?>
            <div class="lsb">
               <div class="lsb_c lsb_it1">

                  <div class="lsb_i utm1_c">
                     <div class="utm1_v">
                        <div class="container">
                           <div class="player_12" data-plyr-provider="youtube" data-plyr-embed-id="kkVmnalnAZY"></div>
                           <script>const player_12 = new Plyr(".player_12",{fullscreen:{iosNative:true}});</script>
                        </div>
                     </div>
                     <div class="utm1_b">
                        <div class="utm1_bn"><?=$mc_d['name_'.$lang]?></div>
                        <div class="uitemci_ad">
                           <div class="uitemci_ad_i lazy_img" data-src="/assets/img/users/<?=$autor['logo']?>"></div>
                           <div class="uitemci_ad_t"><?=$autor['name']?> <?=$autor['surname']?></div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="lsb_i">
                     <div class="lsb_ic">
                        <div class="lsb_i2">
                           <div class="lsb_i2_r">
                              <div class="lsb_ih3">Қосымша</div>
                           </div>
                        </div>
                        <div class="lsb_i3">
                           <a class="btn btn_cl" href="https://docs.google.com/document/d/16dFBJ4jDcEUwpVnreJfWp6UCweXweCgXIaUyMv82Nlo/edit" target="_blank"><span>Ашу</span><i class="fal fa-long-arrow-right"></i></a>
                        </div>
                     </div>
                  </div>

               </div>
            </div>

         <? endif ?>


         <div class="lsb">
            <div class="head_c"><h4>Пікірлер</h4></div>
            <div class="lsb_c">
               <div class="lsb_crvf">
                  <div class="form_im_com">
                     <textarea class="form_im_comment inp_form" rows="5" autocomplete="off" autocorrect="off" aria-label="Пікіріңізді жазыңыз .." placeholder="Пікіріңізді жазыңыз .."></textarea>
                     <div class="btn_comment btn_add_review" data-mc-id="<?=$mc_id?>" data-type="<?=(isset($_GET['back'])?'sub':'cours')?>">Жіберу</div>
                  </div>
                  <script>autosize(document.querySelectorAll('.form_im_comment'));</script>
               </div>

               <div class="lsb_crv">
                  <? $mc_rv = db::query("select * from review where cours_id = '$mc_id' and review_id is null order by ins_dt desc"); ?>
                  <? if (isset($_GET['back'])) $mc_rv = db::query("select * from review where c_sub_item_id = '$mc_id' and review_id is null order by ins_dt desc"); ?>
                  <? if (mysqli_num_rows($mc_rv)): ?>
                     <? while ($mc_rv_d = mysqli_fetch_array($mc_rv)): ?>
                        <? $mc_rv_id = $mc_rv_d['id']; ?>
							   <? $user_d = fun::user($mc_rv_d['user_id']); ?>
                        <div class="lsb_crv_u">
                           <div class="lsb_crv_i">
                              <div class="lsb_crv_im lazy_img" data-src="/assets/img/users/<?=$user_d['logo']?>">
                                 <? if (!$user_d['logo']): ?> <i class="fal fa-user"></i> <? endif ?>
                              </div>
                              <div class="lsb_crv_ic">
                                 <div class="lsb_crv_ict">
                                    <div class="lsb_crv_ictn"><?=$user_d['name']?> <?=$user_d['surname']?> - </div>
                                    <p><?=$mc_rv_d['txt']?></p>
                                 </div>
                                 <div class="lsb_crv_ics">
                                    <div class="lsb_crv_ictp">
                                       <? if (((strtotime($mc_rv_d['ins_dt']) - strtotime(date("d.m.Y"))) / (60*60*24)) <= 0): ?>
                                          <div><?=date("m-d-Y", strtotime($mc_rv_d['ins_dt']))?></div>
                                          <? if ($user_right): ?> <div><?=date("H:i", strtotime($mc_rv_d['ins_dt']))?></div> <? endif ?>
                                       <? else: ?> <div><?=date("H:i", strtotime($mc_rv_d['ins_dt']))?></div> <? endif ?>
                                    </div>
                                    <? if ($user_right): ?>
                                       <div class="lsb_crv_ictv review_answer_open" data-id="<?=$mc_rv_d['id']?>">Жауап беру</div>
                                       <div class="lsb_crv_ictd" data-id="<?=$mc_rv_d['id']?>" data-type="1">Жою</div>
                                    <? endif ?>
                                 </div>
                              </div>
                           </div>
                           <? $mc_rv2 = db::query("select * from review where review_id = '$mc_rv_id' order by ins_dt desc"); ?>
                           <? if (mysqli_num_rows($mc_rv2)): ?>
                              <div class="lsb_crv_u2">
                                 <? while ($mc_rv_d2 = mysqli_fetch_array($mc_rv2)): ?>
                                    <? $user_d = fun::user($mc_rv_d2['user_id']); ?>
                                    <div class="lsb_crv_i">
                                       <div class="lsb_crv_im lazy_img" data-src="/assets/img/users/stm_lms_avatar2.jpg"></div>
                                       <div class="lsb_crv_ic">
                                          <div class="lsb_crv_ict"> <div class="lsb_crv_ictn">Aru Academy - </div><p><?=$mc_rv_d2['txt']?></p> </div>
                                          <div class="lsb_crv_ics">
                                             <div class="lsb_crv_ictp">
                                                <? if (((strtotime($mc_rv_d2['ins_dt']) - strtotime(date("d.m.Y"))) / (60*60*24)) <= 0): ?>
                                                   <div><?=date("m-d-Y", strtotime($mc_rv_d2['ins_dt']))?></div>
                                                   <? if ($user_right): ?> <div><?=date("H:i", strtotime($mc_rv_d['ins_dt']))?></div> <? endif ?>
                                                <? else: ?> <div><?=date("H:i", strtotime($mc_rv_d2['ins_dt']))?></div> <? endif ?>
                                             </div>
                                             <? if ($user_right): ?> <div class="lsb_crv_ictd" data-id="<?=$mc_rv_d2['id']?>" data-type="2">Жою</div> <? endif ?>
                                          </div>
                                       </div>
                                    </div>
                                 <? endwhile ?>
                              </div>
                           <? endif ?>

                        </div>
                     <? endwhile ?>
                  <? else: ?>
                     <!-- <div class="">
                        <p>Пікіріңізді қалдырыңыз</p>
                     </div> -->
                  <? endif ?>
               </div>

            </div>
         </div>


      
      </div>
	</div>

<? include "../../../block/footer.php"; ?>


<!-- review send -->
<div class="pop_bl review_answer">
   <div class="pop_bl_a review_answer_back"></div>
   <div class="pop_bl_c">
      <div class="head_c txt_c"><h4>Пікірге жауап беру</h4></div>
      <div class="form_c">
         <div class="form_im_com">
            <textarea class="form_im_comment form_im_comment_aut inp_form2" rows="5" autocomplete="off" autocorrect="off" aria-label="Жауабыңызды жазыңыз .." placeholder="Жауабыңызды жазыңыз .."></textarea>
            <script>autosize(document.querySelectorAll('.form_im_comment_aut'));</script>
         </div>
         <div class="form_im form_im_bn">
            <div class="btn btn_review_answer" data-id="<?=$cours_id?>">
               <span>Жіберу</span>
               <i class="fal fa-paper-plane"></i>
            </div>
         </div>
      </div>
   </div>
</div>