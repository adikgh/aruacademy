<?php include "../../../config/core.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/');

   // 
	$work_id = $_GET['work_id'];
	$lesson_id = $_GET['lesson_id'];
   $work = db::query("select * from home_work where id = '$work_id'");
   $work_d = mysqli_fetch_assoc($work);
   $user_d = fun::user($work_d['user_id']);

	// site setting
	$pod_menu_name = 'works';
	$site_set = [
		'utop_nm' => '12 - үй жұмысы',
		'utop_bk' => 'homework/admin/cours/list.php?id='.$_GET['id'].'&lesson_id='.$lesson_id,
      'autosize' => true,
	];
	$css = ['user', 'uhomework', 'uchat'];
	$js = ['user', 'admin'];
?>
<?php include "../../../block/header.php"; ?>

	<div class="uchat">

      <div class="uchat_c">

         <div class="uchat_ci">
            <div class="uhwa_itm"><i class="fal fa-user"></i></div>
            <div class="uhwa_ic">
               <div class="uhwa_it">
                  <div class="uhwa_itcn">
                     <? if ($user_d['name'] && $user_d['name'] != 'USER'): ?> <?=$user_d['name']?> <?=$user_d['surname']?> / <? endif ?>
							<?=$user_d['phone']?>
                  </div>
                  <div class="uhwa_itcp"><div><?=date("m-d-Y", strtotime($work_d['ins_dt']))?></div><div><?=date("H:i", strtotime($work_d['ins_dt']))?></div></div>
               </div>
               <div class="uhwa_iw">
                  <div class="uchat_ciw"><?=$work_d['txt']?></div>
               </div>
            </div>
         </div>

         <? $work2 = db::query("select * from home_work where homework_id = '$work_id'"); ?>
         <? if (mysqli_num_rows($work2)): ?>
            <? while ($work_d2 = mysqli_fetch_assoc($work2)): ?>
               <? $user_d = fun::user($work_d2['user_id']); ?>
               <div class="uchat_ci <?=($user_d['right']?'uchat_cir':'')?>">
                  <div class="uhwa_itm"><i class="fal fa-user"></i></div>
                  <div class="uhwa_ic">
                     <div class="uhwa_it">
                        <div class="uhwa_itcn">
                           <? if ($user_d['name'] && $user_d['name'] != 'USER'): ?> <?=$user_d['name']?> <?=$user_d['surname']?> / <? endif ?>
                           <? if ($user_d['phone'] && !$user_d['right']): ?> <?=$user_d['phone']?> <? endif ?>
                        </div>
                        <div class="uhwa_itcp"><div><?=date("m-d-Y", strtotime($work_d2['ins_dt']))?></div><div><?=date("H:i", strtotime($work_d2['ins_dt']))?></div></div>
                     </div>
                     <div class="uhwa_iw">
                        <div class="uchat_ciw"><?=$work_d2['txt']?></div>
                     </div>
                  </div>
               </div>
            <? endwhile ?>
         <? endif ?>

      </div>

      <div class="uchat_b">
         <div class="form_im_com">
            <textarea class="form_im_comment inp_form" rows="5" autocomplete="off" autocorrect="off" aria-label="Жауабыңызды жазыңыз .." placeholder="Жауабыңызды жазыңыз .."></textarea>
            <div class="btn_comment btn_add_work" data-work-id="<?=$work_id?>">Жіберу</div>
         </div>
         <script>autosize(document.querySelectorAll('.form_im_comment'));</script>
      </div>

	</div>


<?php include "../../../block/footer.php"; ?>