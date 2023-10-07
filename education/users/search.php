<? include "../../config/core_edu.php";


   $number = 0;
?>

   <!--  -->
   <? if (isset($_GET['user_search'])): ?>
		<? $search = strip_tags($_POST['search']); ?>

		<? $users = db::query("select * from user where ((phone like '%$search%') or (mail like '%$search%') or (name like '%$search%') or (surname like '%$search%')) and `right` is null order by id desc limit 50"); ?>
      <? if (mysqli_num_rows($users)): ?>
         <? while ($user_d = mysqli_fetch_assoc($users)): ?>
            <? $number++; ?>

            <div class="uc_ui">
               <div class="uc_uil">
                  <div class="uc_ui_number"><?=$number?></div>
                  <div class="uc_ui_right">
                     <div class="form_im form_im_toggle">
                        <input type="checkbox" class="homework" data-val="" />
                        <div class="form_im_toggle_btn <?=($user_d['locked']?'':'form_im_toggle_act')?> sub_buy_off" data-id="<?=$user_d['id']?>"></div>
                     </div>
                  </div>
                  <a class="uc_uiln" href="/user/admin/users/item/?id=<?=$user_d['id']?>">
                     <div class="uc_ui_icon lazy_img" data-src="/assets/img/users/<?=$user_d['logo']?>"><?=($user_d['logo']!=null?'':'<i class="fal fa-user"></i>')?></div>
                     <div class="uc_ui_name"><?=$user_d['name']?> <?=$user_d['surname']?></div>
                  </a>
                  <div class="uc_uin_other">
                     <? if ($user_d['phone']): ?> <div class="uc_ui_phone fr_phone" data-name="Телефон:"><?=$user_d['phone']?></div> <? endif ?>
                     <? if ($user_d['mail']): ?> <div class="uc_ui_phone" data-name="Почта:"><?=$user_d['mail']?></div> <? endif ?>
                  </div>
                  <div class="uc_uin_other" data-name="Тіркелген уақыты:">
                     <? if ($user_d['ins_dt']): ?> <?=date("d.m.Y", strtotime($user_d['ins_dt']))?> <?=date("H:i", strtotime($user_d['ins_dt']))?> 
                     <? else: ?> Белгісіз <? endif ?>
                  </div>
               </div>
               <div class="uc_uib sel_id" data-id="<?=$user_d['id']?>" data-pass="<?=$user_d['password']?>">
                  <div class="uc_uibo" ><i class="fal fa-ellipsis-v"></i></div>
                  <div class="menu_c uc_uibs">
                     <div class="menu_ci ">
                        <div class="menu_cin"><i class="fal fa-paper-plane"></i></div>
                        <div class="menu_cih">Қабарлама жіберу</div>
                     </div>
                     <div class="menu_ci ">
                        <div class="menu_cin"><i class="fal fa-pen"></i></div>
                        <div class="menu_cih">Өзгерту</div>
                     </div>
                     <div class="menu_ci copy_pass">
                        <div class="menu_cin"><i class="fal fa-key"></i></div>
                        <div class="menu_cih">Кілт сөзді көшіріп алу</div>
                     </div>
                     <div class="menu_ci ">
                        <div class="menu_cin"><i class="fal fa-trash-alt"></i></div>
                        <div class="menu_cih">Оқушыны өшіру</div>
                     </div>
                  </div>
               </div>
            </div>

         <? endwhile ?>

      <? else: ?> <div class="ds_nr"><i class="fal fa-ghost"></i><p>Ешкім жоқ</p></div> <? endif ?>

		<? exit(); ?>
	<? endif ?>