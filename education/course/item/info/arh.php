      <!--  -->
      <div class="uitemc_info">
         <div class="uitemc_info_c">

            <div class="uitemci_r">
               <div class="lazy_img" data-src="/assets/img/cours/<?=$cours['img']?>"></div>
            </div>

            <div class="uitemci_l">

               <div class="uitemci_ll">
                  <div class="uitemci_c"><?=$category['name']?></div>
                  <h1 class="uitemci_h"><?=$cours['name']?></h1>
                  <div class="uitemci_ad">
                     <div class="uitemci_ad_i lazy_img" data-src="/assets/img/users/<?=$autor['logo']?>"></div>
                     <div class="uitemci_ad_t"><?=$autor['name']?> <?=$autor['surname']?></div>
                  </div>
                  <?php if (!$user_right && $sub_i != 0): ?>
                     <?php $date = new DateTime(); ?>
                     <?php if ($sub_i['end_date'] != null):?>
                        <?php $end_date = new DateTime($sub_i['end_date']); ?>
                        <?php	$diff = $date->diff($end_date)->format("%a"); ?>
                     <?php endif ?>
                     <?php if ($sub_i['ins_date'] != null && $sub_i['end_date'] != null):?>
                        <?php $s_date = new DateTime($sub_i['ins_date']); ?>
                        <?php	$diff2 = $s_date->diff($end_date)->format("%a"); ?>
                        <?php	$precent = round(100 / ($diff2 / ($diff2 - $diff))); ?>
                     <?php endif ?>

                     <div class="uitemci_time">
                        <div class="uitemci_time_t">
                           <div class=""><?=date("m-d", strtotime($sub_i['ins_date']))?></div>
                           <div class=""><?=$diff?> күн қалды</div>
                           <div class=""><?=date("m-d", strtotime($sub_i['end_date']))?></div>
                        </div>
                        <div class="uitemci_time_b">
                           <div class="uitemci_time_b2" style="width:<?=$precent?>%"></div>
                        </div>
                     </div>
                  <?php endif ?>
               </div>

               <!-- <div class="itemci_ls">
                  <div class="itemci_lsi">
                     <div class="itemci_lsic"><i class="far fa-clock"></i></div>
                     <div class="itemci_lsin">
                        <span>Сабақ уақыты</span>
                        <p>10 күн, 3 сағ.</p>
                     </div>
                  </div>
                  <div class="itemci_lsi">
                     <div class="itemci_lsic"><i class="far fa-users"></i></div>
                     <div class="itemci_lsin">
                        <span>Оқушылар</span>
                        <p>200+</p>
                     </div>
                  </div>
               </div> -->
               
               <!-- <div class="uitemci_lr">
                  <div class="bq3_ci_book <?=($bookmark?'bq3_ci_book_act':'')?>" data-id="<?=$cours['id']?>">
                     <div class="btn btn_back btn_dd">
                        <i class="far <?=($bookmark?'fas':'')?> fa-bookmark"></i>
                     </div>
                  </div>
                  <div class="uitemci_lri" data-id="<?=$cours['id']?>">
                     <div class="btn btn_back btn_dd">
                        <i class="far fa-paper-plane"></i>
                     </div>
                  </div>
               </div> -->

            </div>

         </div>
      </div>