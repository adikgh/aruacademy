<div class="nvg">
   <div class="nvg_c">
      <div class="nvg_bk clc_back"><i class="fal fa-long-arrow-left"></i></div>
      <a class="nvg_i" href="/education/my">Курсы</a>
      <span><?=$cours_d['name_kz']?></span>
   </div>
</div>

<? if ($buy): ?>
   <div class="uitemc_u">
      <div class="uitemc_um">

         <a class="uitemc_umi <?=(!$pod_menu_name?'uitemc_umi_act':'')?>" href="/education/course/?id=<?=$cours_id?>">
            <div><i class="fal fa-list-ol"></i></div>
            <span>Сабақтар</span>
         </a>
         <? // if ($cours_d['home_work']): ?>
            <a class="uitemc_umi <?=($pod_menu_name=='works'?'uitemc_umi_act':'')?>" href="/education/course/homework/?id=<?=$cours_id?>">
               <div><i class="fal fa-pennant"></i></div>
               <span>Үй жұмысы</span>
            </a>
         <? // endif ?>
         <!-- <? if ($cours_d['ques']): ?>
            <a class="uitemc_umi <?=($pod_menu_name=='ques'?'uitemc_umi_act':'')?>" href="/education/course/ques.php?id=<?=$cours_id?>">
               <div><i class="fal fa-question"></i></div>
               <span>Анкета</span>
            </a>
         <? endif ?> -->
         <!-- <? if ($cours_d['reviews']): ?>
            <a class="uitemc_umi <?=($pod_menu_name=='ques'?'uitemc_umi_act':'')?>" href="/education/course/reviews.php?id=<?=$cours_id?>">
               <div><i class="fal fa-question"></i></div>
               <span>Пікірлер</span>
            </a>
         <? endif ?> -->
      
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