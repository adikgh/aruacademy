<?php include "../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/sign_in.php');

	if ($_GET['type'] == 'club') $cours = db::query("select * from c_sub_item");
	else $cours = db::query("select * from cours");

	// Сайттың баптаулары
	$menu_name = 'homework';
	$site_set['utop_bk'] = '/';
	$site_set['utop_nm'] = 'Үй жұмыстарым';
	$css = ['user/main', 'user/uhomework'];
	$js = ['user'];
?>
<? include "../../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="uhwa">
				<div class="uhwa_l">
					<div class="uhwa_lp">
						<a class="uhwa_lpi <?=($_GET['type']!='club'?'uhwa_lpi_act':'')?>" href="/user/homework/?type=cours">
							<span>Типі:</span>
							<p>Курстар</p>
						</a>
						<!-- <a class="uhwa_lpi <?=($_GET['type']=='club'?'uhwa_lpi_act':'')?>" href="/user/homework/?type=club">
							<span>Типі:</span>
							<p>Даму клубы</p>
						</a> -->
					</div>
	
					<div class="uhwa_c">
						<div class="uhwa_tn">Үй жұмысы бар курстар:</div>
	
						<div class="uhwa_cb">
	
							<? if (mysqli_num_rows($cours)): ?>
								<? while ($cours_d = mysqli_fetch_assoc($cours)): ?>
									<? if ($cours_d['cours_id']) $cours_d = array_merge($cours_d, fun::cours($cours_d['cours_id'])); ?>
									<? $buy = fun::buy($cours_d['id'], $user_id) ?>
									<? // if ($cours_d['home_work'] == 1 && $buy == 1): ?>
										<a class="uhwa_i uhwa_i_sel" data-cours-id="<?=$cours_d['id']?>" href="cours/?id=<?=$cours_d['id']?>">
											<div class="uhwa_itcn"><?=$cours_d['name_'.$lang]?></div>
										</a>
									<? // endif ?>
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
	</div>

<? include "../../block/footer.php"; ?>