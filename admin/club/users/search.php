<?php include "../../../config/core.php"; 

   $date = new DateTime();
   $sum = 0;
?>

   <!--  -->
   <? if (isset($_GET['user_search'])): ?>
		<? $search = strip_tags($_POST['search']); ?>

		<? $user = db::query("select * from user where (phone like '%$search%') or (mail like '%$search%') or (name like '%$search%') or (surname like '%$search%') order by ins_dt desc"); ?>
      <? while ($user_d = mysqli_fetch_assoc($user)): ?>
         <? $userd_id = $user_d['id']; ?>
         <? $cours_buy = db::query("select * from c_sub_buy where user_id = '$userd_id'"); ?>
         <? if (mysqli_num_rows($cours_buy) > 0 && $sum < 50): ?>
            <? $buy_d = mysqli_fetch_assoc($cours_buy); ?>
            <? $sum++; ?>

            <div class="uc_ui">
               <div class="uc_uil">
                  <div class="uc_uile">
                     <div class="uc_ui_right">
                        <div class="form_im form_im_toggle sub_buy_off <?=($buy_d['off']?'':'form_im_toggle_act')?>" data-id="<?=$buy_d['id']?>">
                           <input type="checkbox" class="homework" data-val="" />
                           <div class="form_im_toggle_btn"></div>
                        </div>
                     </div>
                     <div class="uc_ui_number"><?=$sum?></div>
                     <a class="uc_uiln" href="/user/admin/users/item/?id=<?=$user_d['id']?>">
                        <div class="uc_ui_icon lazy_img" data-src="/assets/img/users/<?=$user_d['logo']?>"><?=($user_d['logo']!=null?'':'<i class="fal fa-user"></i>')?></div>
                        <div class="uc_uinu">
                           <div class="uc_ui_name"><?=$user_d['name']?> <?=$user_d['surname']?></div>
                           <div class="uc_ui_phone"><?=($user_d['phone'] != null?$user_d['phone']:$user_d['mail'])?></div>
                        </div>
                     </a>
                  </div>

                  <? if ($buy_d['ins_dt'] != null && $buy_d['end_dt'] != null):?>
                     <? $end_dt = new DateTime($buy_d['end_dt']); ?>
                     <?	$diff = $date->diff($end_dt)->format("%a"); ?>
                     <? $ins_dt = new DateTime($buy_d['ins_dt']); ?>
                     <?	$diff2 = $ins_dt->diff($end_dt)->format("%a"); ?>
                     <?	if (($diff2 - $diff) != 0) $precent = round(100 / ($diff2 / ($diff2 - $diff))); else $precent = 0; ?>
                  <? endif ?>
                  <div class="uc_uin_date">
                     <? if ($buy_d['end_dt'] != null): ?>
                        <div class="uc_uin_date_u">
                           <div class=""><?=$diff?> күн қалды</div>
                           <div class=""><?=$precent?>%</div>
                        </div>
                        <div class="uc_uin_date_i"><span style="width:<?=$precent?>%"></span></div>
                     <? else: ?>
                        <div class="uc_uin_date_u">Шексіз</div>
                     <? endif ?>
                  </div>
                  <div class="uc_uin_other" data-name="Процесс">
                     <div>
                        <? if ($user_d['password']): ?>
                           <? if ($buy_d['open']): ?>Сабақты бастаған
                           <? else: ?>Сабаққа кірмеген<? endif ?>
                        <? else: ?>Аккаунтқа кірмеген<? endif ?>
                     </div>
                  </div>
               </div>
               <div class="uc_uib">
                  <div class="uc_uibo">
                     <i class="fal fa-ellipsis-v"></i>
                     <i class="fal fa-angle-down"></i>
                  </div>
                  <div class="uc_uibs">
                     <div class="uc_uib_i cursor_none" data-title2="Доступ уақытын ауыстыру">
                        <div><i class="fal fa-calendar-alt"></i></div>
                        <span>Доступ уақыты</span>
                     </div>
                     <div class="uc_uib_i sub_sms_send" data-title2="Смс қайта жіберу" data-id="<?=$buy_d['id']?>">
                        <div><i class="fal fa-paper-plane"></i></div>
                        <span>СМС қайта жіберу</span>
                     </div>
                     <div class="uc_uib_i uc_uib_del sub_user_del" data-title2="Оқушыны өшіру" data-id="<?=$buy_d['id']?>">
                        <div><i class="fal fa-trash-alt"></i></div>
                        <span>Оқушыны өшіру</span>
                     </div>
                  </div>
               </div>
            </div>

         <? endif ?>
      <? endwhile ?>
		<? exit(); ?>
	<? endif ?>