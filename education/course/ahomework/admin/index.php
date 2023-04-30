<?php include "../../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_right) header('location: /user/');

	if ($_GET['type'] == 'club') $cours = db::query("select * from c_sub_item");
	else $cours = db::query("select * from cours");
	

	// Сайттың баптаулары
	$menu_name = 'homework';
	$site_set = [
		'utop_bk' => '/',
		'utop_nm' => 'Үй жұмыстары',
	];
	$css = ['user', 'ucours', 'uhomework'];
	$js = ['user', 'admin'];
?>
<?php include "../../../block/header.php"; ?>

	<div class="uitem">

		<!--  -->
		<div class="uhwa">
			<div class="uhwa_l">
				<div class="uhwa_lp">
					<a class="uhwa_lpi <?=($_GET['type']!='club'?'uhwa_lpi_act':'')?>" href="/user/homework/admin/?type=cours">
						<span>Типі:</span>
						<p>Курстар</p>
					</a>
					<a class="uhwa_lpi <?=($_GET['type']=='club'?'uhwa_lpi_act':'')?>" href="/user/homework/admin/?type=club">
						<span>Типі:</span>
						<p>Даму клубы</p>
					</a>
				</div>

				<div class="uhwa_c">
					<div class="uhwa_tn">Үй жұмысы бар курстар:</div>

					<div class="uhwa_cb">

						<? if (mysqli_num_rows($cours)): ?>
							<? while ($cours_d = mysqli_fetch_assoc($cours)): ?>
								<? if ($cours_d['cours_id']) $cours_d = array_merge($cours_d, fun::cours($cours_d['cours_id'])); ?>
								<? if (fun::home_work($cours_d['id'])): ?>
									<a class="uhwa_i uhwa_i_sel" data-cours-id="<?=$cours_d['id']?>" href="cours/?id=<?=$cours_d['id']?>">
										<div class="uhwa_itcn"><?=$cours_d['name_'.$lang]?></div>
									</a>
								<? endif ?>
							<? endwhile ?>
						<? endif ?>

					</div>
				</div>

			</div>
			<!-- <div class="uhwa_r">
				<div class="uhwa_c uhwa_c_sel"></div>
			</div> -->
		</div>
		
	</div>


<?php include "../../../block/footer.php"; ?>