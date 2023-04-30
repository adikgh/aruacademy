<?php include "../../../../config/core.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/');

   // 
   if ($_GET['id']) {
      $chat_id = $_GET['id'];
      $chat_d = fun::chat2($chat_id);
      $user_d = fun::user($chat_d['user_id']);
   } elseif ($_GET['user_id']) {
      $u_id = $_GET['user_id'];
      $user_d = fun::user($u_id);
		$chat_d = fun::chat($u_id);
      $chat_id = $chat_d['id'];
   }

   // 
   if ($chat_d != 0) {
      $udb_view = db::query("UPDATE `h_chat` SET `view` = 1 where id = '$chat_id'");
      $udb_item_view = db::query("UPDATE `h_chat_item` SET `view` = 1 where chat_id = '$chat_id' and user_id is null");
   }


	// site setting
	$pod_menu_name = 'works';
	$site_set = [
		'utop_nm' => 'Чат - '.$user_d['name'],
		'utop_bk' => 'chat/admin/',
      'autosize' => true,
	];
	$css = ['user', 'uhomework', 'uchat'];
	$js = ['user', 'admin'];

?>
<?php include "../../../../block/header.php"; ?>

	<div class="uchat">

      <div class="uchat_c">
         <? if ($chat_d): ?>
            <? $chat2 = db::query("select * from h_chat_item where chat_id = '$chat_id'"); ?>
            <? if (mysqli_num_rows($chat2)): ?>
               <? while ($work_d2 = mysqli_fetch_assoc($chat2)): ?>
                  <? if ($work_d2['user_id']) $user_d2 = fun::user($work_d2['user_id']); else $user_d2 = $user_d; ?>
                  <div class="uchat_ci">
                     <div class="uhwa_itm"><i class="fal fa-user"></i></div>
                     <div class="uhwa_ic">
                        <div class="uhwa_it">
                           <div class="uhwa_itcn"><?=$user_d2['name']?> <?=$user_d2['surname']?></div>
                           <div class="uhwa_itcp"><div><?=date("m-d-Y", strtotime($work_d2['ins_dt']))?></div><div><?=date("H:i", strtotime($work_d2['ins_dt']))?></div></div>
                        </div>
                        <div class="uhwa_iw">
                           <div class="uchat_ciw"><?=$work_d2['txt']?></div>
                        </div>
                     </div>
                  </div>
               <? endwhile ?>
            <? endif ?>
         <? endif ?>
      </div>

      <div class="uchat_b">
         <div class="form_im_com">
            <textarea class="form_im_comment inp_form" autocomplete="off" autocorrect="off" aria-label="Жауабыңызды жазыңыз .." placeholder="Жауабыңызды жазыңыз .."></textarea>
            <div class="btn_comment btn_chata_send" data-chat-id="<?=$chat_id?>" data-user-id="<?=$user_d['id']?>">Жіберу</div>
         </div>
         <script>autosize(document.querySelectorAll('.form_im_comment'));</script>
      </div>

	</div>

<?php include "../../../../block/footer.php"; ?>