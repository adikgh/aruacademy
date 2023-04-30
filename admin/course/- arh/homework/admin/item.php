<?php include "../../i_core.php";


	$work_id = $_GET['work_id'];
	$lesson_id = $_GET['lesson_id'];
   $work = db::query("select * from home_work where id = '$work_id'");


	// site setting
	$pod_menu_name = 'works';
	$site_set = [
		'utop_nm' => '12 - үй жұмысы',
		'utop_bk' => 'cours/item/homework/admin/list.php?id='.$cours_id.'&lesson_id='.$lesson_id,
	];
	$css = ['user', 'uitem', 'uhomework', 'uchat'];
	$js = ['user', 'admin'];

?>
<?php include "../../../../../block/header.php"; ?>

	<div class="">

      <div class="">
         <? $work2 = db::query("select * from home_work where homework_id = '$work_id'"); ?>
         <? if (mysqli_num_rows($work)): ?>
            <div class="">
               <? while ($work_d2 = mysqli_fetch_assoc($work2)): ?>
                  <? $w_id = $work_d2['id']; ?>
                  <? $user_d = fun::user($work_d2['user_id']); ?>
                  <div class="uhwa_i">
                     <div class="uhwa_itm"><i class="fal fa-user"></i></div>
                     <div class="uhwa_ic">
                        <div class="uhwa_it">
                           <div class="uhwa_itcn"><?=$user_d['name']?> <?=$user_d['surname']?></div>
                           <div class="uhwa_itcp"><div><?//=date("m-d-Y", strtotime($work_d2['ins_dt']))?></div><div><?=date("H:i", strtotime($work_d2['ins_dt']))?></div></div>
                        </div>
                        <div class="uhwa_iw">
                           <div class="uhwa_iwc"><?=$work_d2['txt']?></div>
                        </div>
                     </div>
                  </div>
               <? endwhile ?>
            </div>
         <? endif ?>
      </div>

      <div class="">

      </div>

	</div>


<?php include "../../../../../block/footer.php"; ?>