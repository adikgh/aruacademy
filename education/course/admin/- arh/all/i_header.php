<!--  -->
<? if ($user_right || ((mysqli_num_rows($buy) && $cours_d['home_work']) || (mysqli_num_rows($sub_buy) && $cours_d['home_work']))): ?>
   <div class="uitemc_u">
      <div class="uitemc_um">
         <? if (!$user_right || (mysqli_num_rows($buy) || mysqli_num_rows($sub_buy))): ?>
            <a class="uitemc_umi <?=(!$pod_menu_name?'uitemc_umi_act':'')?>" href="/user/cours/item/?id=<?=$cours_id?>">
               <div><i class="fal fa-list-ol"></i></div>
               <span>Сабақтарым</span>
            </a>
            <? if ($cours_d['home_work']): ?>
               <a class="uitemc_umi <?=($pod_menu_name=='works'?'uitemc_umi_act':'')?>" href="/user/cours/item/homework/?id=<?=$cours_id?>">
                  <div><i class="fal fa-pennant"></i></div>
                  <span>Үй жұмысым</span>
               </a>
            <? endif ?>
         <? else: ?>
            <a class="uitemc_umi <?=(!$pod_menu_name?'uitemc_umi_act':'')?>" href="/user/cours/item/?id=<?=$cours_id?>">
               <div><i class="fal fa-list-ol"></i></div>
               <span>Сабақтар</span>
            </a>
            <a class="uitemc_umi <?=($pod_menu_name=='users'?'uitemc_umi_act':'')?>" href="/user/cours/item/users/?id=<?=$cours_id?>">
               <div><i class="fal fa-users"></i></div>
               <span>Оқушылар</span>
            </a>
            <? if ($cours_d['home_work']): ?>
               <a class="uitemc_umi <?=($pod_menu_name=='works'?'uitemc_umi_act':'')?>" href="/user/homework/admin/cours/?id=<?=$cours_id?>&cours_menu=true">
                  <div><i class="fal fa-pennant"></i></div>
                  <span>Үй жұмысы</span>
               </a>
            <? endif ?>
            <? if ($cours_d['ques']): ?>
               <a class="uitemc_umi <?=($pod_menu_name=='ques'?'uitemc_umi_act':'')?>" href="/user/cours/item/ques.php?id=<?=$cours_id?>">
                  <div><i class="fal fa-question"></i></div>
                  <span>Анкета</span>
               </a>
            <? endif ?>
            <!-- <a class="uitemc_umi <?=($pod_menu_name=='analytics'?'uitemc_umi_act':'')?>" href="/user/cours/item/analytics/?id=<?=$cours_id?>">
               <div><i class="fal fa-chart-bar"></i></div>
               <span>Аналитика</span>
            </a> -->
            <!-- <a class="uitemc_umi <?=($pod_menu_name=='setting'?'uitemc_umi_act':'')?>" href="/user/cours/item/setting/?id=<?=$cours_id?>">
               <div><i class="fal fa-archive"></i></div>
               <span>Баптаулар</span>
            </a> -->
            <? if (!$cours_d['setting']): ?>
               <!-- <a class="uitemc_umi <?=($pod_menu_name=='setting'?'uitemc_umi_act':'')?>" href="/user/cours/item/edit.php?id=<?=$cours_id?>">
                  <div><i class="fal fa-pen"></i></div>
                  <span>Өңдеу</span>
               </a> -->
            <? endif ?>
            <!-- <a class="uitemc_umi <?=($pod_menu_name=='setting'?'uitemc_umi_act':'')?>" href="/user/cours/item/edit.php?id=<?=$cours_id?>">
               <div><i class="fal fa-archive"></i></div>
               <span>Архивке салу</span>
            </a> -->
            <!-- <a class="uitemc_umi <?=($pod_menu_name=='info'?'uitemc_umi_act':'')?>" href="/user/cours/item/info/?id=<?=$cours_id?>">
               <div><i class="fal fa-info-circle"></i></div>
               <span>Мәлімет</span>
            </a> -->
         <? endif ?>
         <!-- <a class="uitemc_umi <?=($pod_menu_name=='reviews'?'uitemc_umi_act':'')?>" href="/user/cours/item/reviews.php?id=<?=$cours_id?>">Пікірлер</a> -->
      
         <div class="uitemc_umid dsp_n">
            <div class="uitemc_umidl">
               <div><i class="far fa-ellipsis-v"></i></div>
               <span>Қосымша</span>
            </div>
            <div class="uitemc_umidc"><div class="uitemc_umidcs"></div></div>
         </div>
         
      </div>
   </div>
<? endif ?>