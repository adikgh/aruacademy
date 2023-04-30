<?php include "../../config/core_edu.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /user/sign_in.php');


	// 
	$chat_d = fun::chat($user_id);
	$chat_id = $chat_d['id'];

	// 
	if ($chat_d != 0) $udb_view = db::query("UPDATE `h_chat_item` SET `view` = 1 where chat_id = '$chat_id' and user_id is not null");


	// Сайттың баптаулары
	$menu_name = 'chat';
	$site_set['utop_bk'] = ' ';
	$site_set['utop_nm'] = 'Куратормен чат';
	$site_set['autosize'] = true;
	$css = ['education/homework', 'education/chat'];
	// $js = ['user'];
?>
<? include "../block/header.php"; ?>

	<div class="uchat">
		<div class="bl_c">
			
			<div class="">
				<div class="uchat_c">
					<? if ($chat_d != 0): ?>
						<? $work2 = db::query("select * from h_chat_item where chat_id = '$chat_id'"); ?>
						<? if (mysqli_num_rows($work2)): ?>
							<? while ($work_d2 = mysqli_fetch_assoc($work2)): ?>
								<? if ($work_d2['user_id']) $user_d = fun::user($work_d2['user_id']); else $user_d = $user; ?>
								<div class="uchat_ci <?=($user_d['right']==1?'uchat_cir':'')?>">
									<div class="uhwa_itm"><i class="fal fa-user"></i></div>
									<div class="uhwa_ic">
										<div class="uhwa_it">
											<div class="uhwa_itcn">
												<? if ($user_d['id']==1): ?> Ару Сағи
												<? else: ?> <?=$user_d['name']?> <?=$user_d['surname']?> <? endif ?>
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
					<? endif ?>
				</div>

				<div class="uchat_b">
					<div class="form_im_com">
						<textarea class="form_im_comment inp_form" rows="5" autocomplete="off" autocorrect="off" aria-label="Жауабыңызды жазыңыз .." placeholder="Жауабыңызды жазыңыз .."></textarea>
						<div class="btn_comment btn_chat_send" data-chat-id="<?=$chat_id?>">Жіберу</div>
					</div>
					<script>autosize(document.querySelectorAll('.form_im_comment'));</script>
				</div>
			</div>
		
		</div>
	</div>

<? include "../block/footer.php"; ?>