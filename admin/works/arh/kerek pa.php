if (isset($_GET['pack_id']) ||  != '') {
   $pack_id = $_GET['pack_id'];
   $pack = db::query("select * from c_pack where cours_id = '$cours_id' and id = '$pack_id'");
} else {
   $pack = db::query("select *, min(number) from c_pack where cours_id = '$cours_id' and home_work = 1 order by number asc");
   $pack_d = mysqli_fetch_assoc($pack);
   $pack_id = $pack_d['id'];
}


            <? if (mysqli_num_rows($block) > 1): ?>
               <div class="uhwa_p">
                  <div class="uhwa_ph"><span>Пакет:</span><?=$block_d['name']?></div>
                  <div class="uhwa_ps">
                     <div class="uhwa_psi"><span>Барлығы</span><i class="fal fa-angle-right"></i></div>
                     <div class="uhwa_psi2"><i class="fal fa-angle-down"></i></div>
                  </div>
               </div>
            <? endif ?>