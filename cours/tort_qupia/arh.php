<!--  -->
<div id="program" class="iprog">
   <div class="bl_c">
      <div class="cours_ls">
         <div class="head_c">
            <h3>Практикум бағдарламасы</h3>
         </div>
         <div class="coursls_c">
         
            <? $pl_d = mysqli_fetch_assoc($pl); ?>
            <? $pack_id = $pl_d['id']; ?>
            <? $pack_block = db::query("select * from c_block where pack_id = '$pack_id'"); ?>
            <? if (mysqli_num_rows($pack_block) != 0): ?>
               <? while ($block = mysqli_fetch_assoc($pack_block)): ?>
                  <?	$block_id = $block['id']; ?>
                  <?	$pack_item = db::query("select * from c_lesson where block_id = '$block_id' order by number asc"); ?>

                  <div class="coursls_cn">
                     <? if (mysqli_num_rows($pack_block) != 1): ?>
                        <div class="coursls_i coursls_b">
                           <div class="coursls_ic">
                              <div class="coursls_in"><p><?=$block['name_kz']?></p></div>
                           </div>
                        </div>
                     <? endif ?>
                     <? if (mysqli_num_rows($pack_item) != 0): ?>
                        <? while ($item = mysqli_fetch_assoc($pack_item)): ?>
                           <div class="coursls_i">
                              <div class="coursls_ic">
                                 <!-- <div class="coursls_il"><?=$item['logo_txt']?></div> -->
                                 <div class="coursls_in"><p><?=$item['number']?>. <?=$item['name_kz']?></p></div>
                              </div>
                           </div>
                        <? endwhile ?>
                     <? endif ?>
                  </div>

               <? endwhile ?>
            <? endif ?>
         </div>
      </div>
   </div>
</div>