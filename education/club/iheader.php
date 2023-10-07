<? if ($buy != 0): ?>
   <div class="head_c">
      <h3>Менің клубым</h3>
   </div>
   
   <div class="uitemc_u">
      <div class="uitemc_um">
         <!-- <a class="uitemc_umi <?=($pod_menu_name=='info'?'uitemc_umi_act':'')?>" href="/club/">
            <div><i class="fal fa-info-circle"></i></div>
            <span>Мәлімет</span>
         </a> -->
         <a class="uitemc_umi <?=($pod_menu_name=='plan'?'uitemc_umi_act':'')?>" href="/education/club/">
            <div><i class="fal fa-clipboard-list-check"></i></div>
            <span>Жоспар</span>
         </a>
         <a class="uitemc_umi <?=($pod_menu_name=='calendar'?'uitemc_umi_act':'')?>" href="/education/club/calendar.php">
            <div><i class="fal fa-clipboard-list-check"></i></div>
            <span>Күнтізбе</span>
         </a>
         <a class="uitemc_umi" href="/education/chat/">
            <div><i class="fal fa-comments-alt"></i></div>
            <span>Куратор</span>
            <? if (fun::chat_view_sum2($user_id) != 0): ?> <p><?=fun::chat_view_sum2($user_id)?></p> <? endif ?>
         </a>
      
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
<? endif ?>