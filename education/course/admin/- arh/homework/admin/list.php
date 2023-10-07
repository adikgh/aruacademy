<?php include "../../i_core.php";

	$pack = db::query("select * from c_pack where cours_id = '$cours_id'");

	$lesson_id = $_GET['lesson_id'];
	$lesson_d = fun::lesson($lesson_id);


	// site setting
	$pod_menu_name = 'works';
	$site_set = [
		'utop_nm' => $lesson_d['number'].'. '.$lesson_d['name_'.$lang].' ('.$cours_d['name_'.$lang].') - үй жұмысы',
		'utop_bk' => 'cours/item/homework/admin/?id='.$cours_id,
	];
	$css = ['user', 'uitem', 'uhomework'];
	$js = ['user', 'admin'];

?>
<?php include "../../../../../block/header.php"; ?>

	<div class="uitem">
		
		<!-- item header -->
		<? include "../../i_header.php"; ?>

		<!--  -->
		<div class="uhwa">
			<div class="uhwa_l">
				<div class="uhwa_c">

					<? $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit 25"); ?>
					<? if (mysqli_num_rows($work)): ?>
						<? while ($work_d = mysqli_fetch_assoc($work)): ?>
							<? $user_d = fun::user($work_d['user_id']); ?>
							<a class="uhwa_i" href="item.php?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&work_id=<?=$work_d['id']?>">
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
							</a>
						<? endwhile ?>
					<? endif ?>

				</div>

			</div>
		</div>
	</div>


<?php include "../../../../../block/footer.php"; ?>