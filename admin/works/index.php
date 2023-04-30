<? include "../../config/core_admin.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /admin/');

	// Сайттың баптаулары
	$menu_name = 'works';
	$site_set['utop_bk'] = '/';
	$site_set['utop_nm'] = 'Үй жұмыстары';
	$css = ['admin/cours', 'admin/item', 'admin/works'];
	// $js = [''];	
?>
<? include "../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="head_c">
				<h4>Үй жұмыстары</h4>
			</div>

			<div class="ucours_t">
				<div class="ucours_tl">
					<div class="ucours_tm ucours_tm_sel">
						<a class="ucours_tmi <?=(!$_GET['type']?'ucours_tm_act':'')?>" href="?">Курстар</a>
						<a class="ucours_tmi <?=($_GET['type']=='club'?'ucours_tm_act':'')?>" href="?type=club">Даму клубы</a>
					</div>
				</div>
			</div>

			<div class="uc_u">
				<div class="uc_uh">
					<div class="uc_uhn">
						<div class="uc_uh_number">#</div>
						<div class="uc_uh_name">Курс атауы</div>
						<div class="uc_uh_other"></div>
						<div class="uc_uh_other">Қолданушылар</div>
						<div class="uc_uh_other">Жұмыстар</div>
					</div>
				</div>
				<div class="uc_uc">
					
					<? $cours = db::query("select * from cours"); ?>
					<? while ($cours_d = mysqli_fetch_assoc($cours)): ?>
						<? $work = fun::cours_work($cours_d['id']); $club = fun::club_yes($cours_d['id']); ?>
						<? if (($work && !$_GET['type']) || ($_GET['type'] == 'club' && $club) && $work): ?>
							<? $number++ ?>
							<div class="uc_ui uc_ui2" data-cours-id="<?=$cours_d['id']?>">
								<a class="uc_uil" href="list/?cours_id=<?=$cours_d['id']?>">
									<div class="uc_ui_number"><?=$number?></div>
									<div class="uc_uiln" >
										<div class="uc_ui_img lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>">
											<?=($cours_d['img']!=null?'':'<i class="fal fa-user"></i>')?>
										</div>
										<div class="uc_ui_name"><?=$cours_d['name_'.$lang]?></div>
									</div>
									<div class="uc_uin_other"></div>
									<div class="uc_uin_other"><?=fun::buy_cours_sum($cours_d['id'])?></div>
									<div class="uc_uin_other"><?=fun::home_work_sum($cours_d['id'])?></div>
								</a>
							</div>
						<? endif ?>
					<? endwhile ?>

				</div>
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>