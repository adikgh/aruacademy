<?php include "../config/core.php";

	if (!isset($_GET['id'])) {
		header('location: /cours/');
	} else {
		$item_id = $_GET['id'];
		$item = db::query("select * from cours_item where id = '$item_id'");
		if (mysqli_num_rows($item) == 0) {
			header('location: /cours/');
		} else {
			$item = mysqli_fetch_assoc($item);

			$cours_id = $item[cours_id];
			$block_id = $item[block_id];
			$cours = mysqli_fetch_assoc(db::query("select * from cours where id = '$cours_id'"));
			$block = mysqli_fetch_assoc(db::query("select * from cours_block where id = '$block_id'"));
		}
	}

	$cs = [
	   'menu' => 'item',
	   'info' => 'Сабақ',
	];
?>
<?php include "../block/header.php"; ?>

	<div class="top_head">
		<a href="/">
			<div class="back">
				<i class="fas fa-long-arrow-left"></i>
			</div>
		</a>
	</div>

	<div class="bl_c">		
		<div class="cours_con">

			<div class="cours_menu">

				<?php include "c_menu.php"; ?>

			</div>
			<div class="cours_c">
				<div class="coursc_info">
					<div class="coursc_info_img">
						<div class="coursc_info_imgc lazy_img" data-src="/assets/img/cours/<?=$cours[img]?>"></div>
					</div>
					<div class="coursc_info_c">
						<h5 class="coursc_info_name"><?=$cours[name]?></h5>
						<?php if ($user[right] == 0 && $user_id): ?>
							<div class="item_nb_listc_prog">
								<div class="item_nb_listc_progi"><?=mysqli_num_rows($iti)?></div>
								<div class="item_nb_listc_progi">
									<div class="item_nb_listc_progin" style="width: calc(100% / (<?=$cours[item]?> / <?=mysqli_num_rows($iti)?>));"></div>
								</div>
								<div class="item_nb_listc_progi"><?=$cours[item]?></div>
							</div>
						<?php endif;?>
					</div>
				</div>
				<div class="cours_ls">

					<div class="coursls_c">
						<div class="coursls_item">
							<div class="bli_logo">
								<?=($item[logo]!=null?'<div class="lazy_img" data-src="/assets/img/cours/logo/'.$item[logo].'"></div>':'<span>'.$item[logo_txt].'</span>')?>
							</div>
							<div class="bli_info">
								<p class="bli_name"><?=$item[number].'. '.$item[name]?></p>
							</div>
						</div>
					</div>

					<div class="coursls_j">
						<div class="prd_btn">
							<div class="btn btn_video_plus" data-item="<?=$item_id?>">
								<i class="fas fa-cloud-upload"></i>
								<span>Сақтау</span>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

<?php include "../block/footer.php"; ?>