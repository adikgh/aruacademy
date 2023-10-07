<div class="nvg">
   <div class="nvg_c">
      <div class="nvg_bk clc_back"><i class="fal fa-long-arrow-left"></i></div>
      <a class="nvg_i" href="/admin/">Курсы</a>
      <? if ($pod_menu_name == 'main'): ?> <span><?=$site_set['utop_nm']?></span>
      <? else: ?>
         <a class="nvg_i" href="/admin/course/?id=<?=$cours_id?>"><?=$cours_d['name_kz']?></a>
         <span><?=$site_set['utop_nm']?></span>
      <? endif ?>
   </div>
</div>

<div class="uitemc_u">
   <div class="uitemc_um">
      <a class="uitemc_umi <?=($pod_menu_name=='main'?'uitemc_umi_act':'')?>" href="/education/course/admin/?id=<?=$cours_id?>">
         <div><i class="fal fa-info-circle"></i></div>
         <span>Жалпы</span>
      </a>
      <a class="uitemc_umi <?=($pod_menu_name=='users'?'uitemc_umi_act':'')?>" href="/education/course/admin/users/?id=<?=$cours_id?>">
         <div><i class="fal fa-users"></i></div>
         <span>Оқушылар</span>
      </a>
      <? if ($cours_d['ques']): ?>
         <a class="uitemc_umi <?=($pod_menu_name=='ques'?'uitemc_umi_act':'')?>" href="/education/course/ques.php?id=<?=$cours_id?>">
            <div><i class="fal fa-question"></i></div>
            <span>Анкета</span>
         </a>
      <? endif ?>
      <div class="uitemc_umi cours_copy_pop">
         <div><i class="fal fa-copy"></i></div>
         <span>Көшіру</span>
      </div>
      <div class="uitemc_umi cours_edit_pop">
         <div><i class="fal fa-pen"></i></div>
         <span>Өңдеу</span>
      </div>
      <div class="uitemc_umi <?=($pod_menu_name=='setting'?'uitemc_umi_act':'')?>">
         <div><i class="fal fa-archive"></i></div>
         <span>Архивке салу</span>
      </div>
      <? if (!$cours_d['setting']): ?>
         <!-- <a class="uitemc_umi <?=($pod_menu_name=='analytics'?'uitemc_umi_act':'')?>" href="/admin/cours/item/analytics/?id=<?=$cours_id?>">
            <div><i class="fal fa-chart-bar"></i></div>
            <span>Аналитика</span>
         </a>
         <? if ($home_work): ?>
            <a class="uitemc_umi <?=($pod_menu_name=='works'?'uitemc_umi_act':'')?>" href="/admin/homework/course/?id=<?=$cours_id?>&cours_menu=true">
               <div><i class="fal fa-pennant"></i></div>
               <span>Үй жұмысы</span>
            </a>
         <? endif ?>
         <a class="uitemc_umi <?=($pod_menu_name=='analytics'?'uitemc_umi_act':'')?>" href="/admin/cours/item/analytics/?id=<?=$cours_id?>">
            <div><i class="fal fa-question"></i></div>
            <span>Пікірлер</span>
         </a>
         <a class="uitemc_umi <?=($pod_menu_name=='list'?'uitemc_umi_act':'')?>" href="/admin/course/lessons.php?id=<?=$cours_id?>">
            <div><i class="fal fa-list"></i></div>
            <span>Сабақтары</span>
         </a>
         <a class="uitemc_umi <?=($pod_menu_name=='setting'?'uitemc_umi_act':'')?>" href="/admin/cours/item/setting/?id=<?=$cours_id?>">
            <div><i class="fal fa-archive"></i></div>
            <span>Баптаулар</span>
         </a> -->
      <? endif ?>
   
      <div class="uitemc_umid dsp_n">
         <div class="uitemc_umidl">
            <div><i class="far fa-ellipsis-v"></i></div>
            <span>Қосымша</span>
         </div>
         <div class="uitemc_umidc"><div class="uitemc_umidcs"></div></div>
      </div>
      
   </div>
</div>