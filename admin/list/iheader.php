<div class="uitemc_u">
   <div class="uitemc_um">
      <a class="uitemc_umi <?=($pod_menu_name=='all'?'uitemc_umi_act':'')?>" href="/admin/list/">Барлығы (<?=fun::cours_sum()?>)</a>      
      <a class="uitemc_umi <?=($pod_menu_name=='club'?'uitemc_umi_act':'')?>" href="/admin/club/">Клуб <?=($pod_menu_name=='subscription'?'('.mysqli_num_rows($cours).')':'')?></a>
   </div>
</div>

<!-- <div class="ucours_t">
   <div class="ucours_tl">
      <div class="ucours_tm">
         <div class="ucours_tmi">
            <i class="fal fa-sort ucours_tmic"></i>
            <span>Сұрыптау</span>
         </div>
         <div class="menu_c ucours_tma">
            <a class="menu_ci" href="/admin/products/all/?sort=1">
               <div class="menu_cin"><i class="fal fa-circle"></i></div>
               <div class="menu_cih">по дата создание</div>
            </a>
            <a class="menu_ci" href="/admin/products/all/?sort=1">
               <div class="menu_cin"><i class="fal fa-circle"></i></div>
               <div class="menu_cih">по названием</div>
            </a>
            <a class="menu_ci" href="/admin/products/all/?sort=1">
               <div class="menu_cin"><i class="fal fa-circle"></i></div>
               <div class="menu_cih">по ценам</div>
            </a>
         </div>
      </div>
      <div class="ucours_tm">
         <div class="ucours_tmi">
            <i class="fal fa-filter ucours_tmic"></i>
            <span>Сұзгі</span>
         </div>
      </div>
   </div>
</div> -->