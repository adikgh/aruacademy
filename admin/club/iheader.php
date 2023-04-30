<? if ($buy != 0 || $user_right): ?>
   <!--  -->
   <div class="uitemc_u">
      <div class="uitemc_um">
         <!-- <a class="uitemc_umi <?=($pod_menu_name=='info'?'uitemc_umi_act':'')?>" href="/admin/club/info/">
            <div><i class="fal fa-info-circle"></i></div>
            <span>Мәлімет</span>
         </a> -->
         <a class="uitemc_umi <?=($pod_menu_name=='plan'?'uitemc_umi_act':'')?>" href="/admin/club/">
            <div><i class="fal fa-clipboard-list-check"></i></div>
            <span>Жоспар</span>
         </a>
         <? if (!$user_right): ?>
            <!-- <a class="uitemc_umi <?=($menu_name=='chat'?'uitemc_umi_act':'')?>" href="/admin/club/">
               <div><i class="fal fa-comments-alt"></i></div>
               <span>Куратор</span>
               <? if (fun::chat_view_sum2($user_id) != 0): ?> <p><?=fun::chat_view_sum2($user_id)?></p> <? endif ?>
            </a> -->
         <? endif ?>
         <!-- <a class="uitemc_umi <?=($pod_menu_name=='calendar'?'uitemc_umi_act':'')?>" href="/admin/club/calendar/">
            <div><i class="fal fa-calendar-alt"></i></div>
            <span>Күнтізбе</span>
         </a> -->
         <a class="uitemc_umi <?=($pod_menu_name=='users'?'uitemc_umi_act':'')?>" href="/admin/club/users/">
            <div><i class="fal fa-users"></i></div>
            <span>Қатысушылар</span>
         </a>
         <!-- <a class="uitemc_umi <?=($pod_menu_name=='analytics'?'uitemc_umi_act':'')?>" href="/admin/club/analytics/">
            <div><i class="fal fa-chart-bar"></i></div>
            <span>Аналитика</span>
         </a> -->
      
         <div class="uitemc_umid dsp_n">
            <div class="uitemc_umidl">
               <div><i class="far fa-ellipsis-v"></i></div>
               <span>Қосымша</span>
            </div>
            <div class="uitemc_umidc">
               <div class="uitemc_umidcs"></div>
            </div>
         </div>

      </div>
   </div>
<?php endif ?>