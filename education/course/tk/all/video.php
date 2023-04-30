<div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
   <? if ($sql['type_name']): ?> <div class="lsb_ih"><?=$sql['type_name']?>:</div> <? endif ?>
   <div class="lsbi_video">
      <div class="container">
         <div class="player_<?=$sql['id']?>" data-plyr-provider="<?=$sql['type_video']?>" data-plyr-embed-id="<?=$sql['txt']?>"></div>
      </div>
   </div>
   <script>
      const player_<?=$sql['id']?> = new Plyr(".player_<?=$sql['id']?>", {});
      player_<?=$sql['id']?>.on("enterfullscreen", function() { $(".pmenu").addClass("pmenu_hide"); $(".header").addClass("header_hide");  });
      player_<?=$sql['id']?>.on("exitfullscreen", function() { $(".pmenu").removeClass("pmenu_hide"); $(".header").removeClass("header_hide");  });
   </script>

   <? if ($sql['number'] == 1): ?>
      <div class="utm1_b">
         <div class="utm1_bn"><?=$site_set['utop_nm']?></div>
         <div class="uitemci_ad">
            <div class="uitemci_ad_i lazy_img" data-src="/assets/uploads/users/<?=$autor['logo']?>"></div>
            <div class="uitemci_ad_t">
               <span><?=$cours_d['name_'.$lang]?></span>
               <p><?=$autor['name']?> <?=$autor['surname']?></p>
            </div>
         </div>
      </div>
   <? endif ?>
</div>