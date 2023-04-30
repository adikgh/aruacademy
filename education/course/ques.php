<? include "../../config/core_edu.php";
	
	// 
	if (!$user_id) header('location: /user/');

	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			
			$cours = mysqli_fetch_assoc($cours);
			$category = fun::category($cours['category_id']);
			$autor = fun::autor($cours['autor_id']);
			$bookmark = fun::bookmark($cours['id'], $user_id);
			$pack = db::query("select * from c_pack where cours_id = '$cours_id'");
			$sub = db::query("select * from c_sub where cours_id = '$cours_id' and user_id = '$user_id'");
			$ques = db::query("select * from ques where cours_id = '$cours_id' order by ins_dt desc");
			
		} else { header('location: /user/cours/'); }
	} else { header('location: /user/cours/'); }
	

	// site setting
	$menu_name = 'item';
	$pod_menu_name = 'ques';
	$site_set = [
		'header' => 'user',
		'footer' => 'false',
		'ublock' => 'true',
		'utop_nm' => $cours['name'],
		'utop_bk' => 'item/?id='.$cours_id,
	];
   $css = ['user','uitem'];
	$js = ['user'];

?>
<? include "../../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<!-- item hedaer -->
			<? include "iheader.php"; ?>
	
			<div class="ubl5">
				<div class="ubl5_c">
	
					<?php while ($ques_d = mysqli_fetch_assoc($ques)): ?>
						<?php $user_data = fun::user($ques_d['user_id']); ?>
						<div class="ubl5_i">
							<div class="ubl5_il">
								<div class="ubl5_im lazy_img" data-src="/assets/img/users/<?=$user_data['logo']?>"><?=($user_data['logo']!=null?'':'<i class="far fa-user"></i>')?></div>
								<div class="ubl5_ilc">
									<?php if ($ques_d['user_id'] == null): ?>
										<div class="ubl5_in"><?=$ques_d['name']?></div>
									<?php else: ?>
										<div class="ubl5_in"><?=$user_data['name']?> <?=$user_data['surname']?></div>
									<?php endif ?>
									<div class="ubl5_id"><?=date("m-d-Y", strtotime($ques_d['ins_dt']))?></div>
								</div>
							</div>
							<div class="ubl5_ic"><?=$ques_d['txt']?></div>
						</div>
					<?php endwhile ?>
	
				</div>
			</div>


		</div>
	</div>

<? include "../../block/footer.php"; ?>