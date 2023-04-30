<? include "../../../../../config/core.php"; ?>

   <!--  -->
   <? if (isset($_GET['select_work'])): ?>
		<? $lesson_id = strip_tags($_POST['lesson_id']); ?>

      <? $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit 25"); ?>
      <? if (mysqli_num_rows($work)): ?>
         <? while ($work_d = mysqli_fetch_assoc($work)): ?>
            <? $w_id = $work_d['id']; ?>
            <? $user_d = fun::user($work_d['user_id']); ?>
            <? $pack_d = fun::pack($work_d['pack_id']); ?>
            <? $lesson_d = fun::lesson($work_d['lesson_id']); ?>
            <div class="uhwa_i">
               <div class="uhwa_itm"><i class="fal fa-user"></i></div>
               <div class="uhwa_ic">
                  <div class="uhwa_it">
                     <div class="uhwa_itcn"><?=$user_d['name']?> <?=$user_d['surname']?></div>
                     <div class="uhwa_itcp"><div><?//=date("m-d-Y", strtotime($work_d['ins_dt']))?></div><div><?=date("H:i", strtotime($work_d['ins_dt']))?></div></div>
                  </div>
                  <div class="uhwa_iw">
                     <div class="uhwa_iwc"><?=$work_d['txt']?></div>
                  </div>
               </div>
            </div>
         <? endwhile ?>
      <? endif ?>

		<? exit(); ?>
	<? endif ?>