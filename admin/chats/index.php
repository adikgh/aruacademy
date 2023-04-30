<?php include "../../config/core_admin.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /admin/');

	$type = 'all';
	if ($_GET['type'] == 'club') $type = $_GET['type'];
	$chat = db::query("select * from h_chat order by ubd_dt desc limit 100");
	

	// Сайттың баптаулары
	$menu_name = 'chats';
	$site_set['autosize'] = true;
	// $site_set = [
	// 	'utop_bk' => '/',
	// 	'utop_nm' => 'Чат',
	// ];
	$css = ['admin/chat'];
	// $js = ['admin'];
?>
<? include "../block/header.php"; ?>

	<div class="ublock">
		<div class="bl_c">

			<div class="head_c">
				<h4>Чат</h4>
			</div>

			<div class="uitemc_u">
				<div class="uitemc_um">
					<a class="uitemc_umi <?=($type=='all'?'uitemc_umi_act':'')?>" href="?">Барлығы</a>
					<a class="uitemc_umi <?=($type=='club'?'uitemc_umi_act':'')?>" href="?type=club">Клуб мүшелері</a>
				</div>
			</div>

			<div class="ublock_c">
				<div class="ublock_l">

					<div class="ublock_s">
						<div class="ublock_tn">Чатты бастау:</div>
						<div class="ublock_cn">
							<div class="ublock_i ublock_inxt chat_all_pop_open" href="start/?type=<?=$type?>">
								<div class="ublock_ictn">Барлығына жалпылама хат жіберу</div>
							</div>
							<a class="ublock_i ublock_inxt" href="start/?type=<?=$type?>">
								<div class="ublock_ictn">Жеке қолданушыға хат жіберу</div>
							</a>
						</div>
					</div>

					<div class="ublock_s">
						<div class="ublock_tn">Ашық чаттар тізімі:</div>
						<div class="ublock_cn">
							<? if (mysqli_num_rows($chat)): ?>
								<? while ($chat_d = mysqli_fetch_assoc($chat)): ?>
									<? $user_d = fun::user($chat_d['user_id']); ?>
									<? if (($type == 'all' || ($type == 'club' && fun::sub_buy_true($user_d['id']) == true)) && $chat_d): ?>
										<a class="ublock_i <?=(fun::chat_txt_end($chat_d['id'])==0?'ublock_inxt':'')?>" href="item/?id=<?=$chat_d['id']?>">
											<div class="ublock_im"><i class="fal fa-user"></i></div>
											<div class="ublock_ic">
												<div class="ublock_ict">
													<div class="ublock_ictn"><?=$user_d['name']?> <?=$user_d['surname']?> <span>(<?=$user_d['phone']?>)</span></div>
													<? if (fun::chat_txt_end($chat_d['id']) != 0): ?>
														<div class="ublock_ictp">
															<div><?=date("m-d-Y", strtotime((fun::chat_txt_end($chat_d['id']))['ins_dt']))?></div>
															<div><?=date("H:i", strtotime((fun::chat_txt_end($chat_d['id']))['ins_dt']))?></div>
														</div>
													<? endif ?>
												</div>
												<? if (fun::chat_txt_end($chat_d['id']) != 0): ?>
													<div class="ublock_icw">
														<div class="ublock_icwc"><?=(fun::chat_txt_end($chat_d['id']))['txt']?></div>
														<? if (fun::chat_item_view_sum($chat_d['id']) != 0): ?> <div class="ublock_icp"><?=fun::chat_item_view_sum($chat_d['id'])?></div> <? endif ?>
													</div>
												<? endif ?>
											</div>
										</a>
									<? endif ?>
								<? endwhile ?>
							<? endif ?>
						</div>
					</div>

				</div>
			</div>
					
		</div>
	</div>

<? include "../block/footer.php"; ?>

	<!-- review send -->
	<div class="pop_bl chat_all_pop">
		<div class="pop_bl_a chat_all_pop_back"></div>
		<div class="pop_bl_c">
			<div class="head_c txt_c"><h4>Барлығына хат жіберу</h4></div>
			<div class="form_c">
				<div class="form_im_com">
					<textarea class="form_im_comment form_im_comment_aut inp_form2" autocomplete="off" autocorrect="off" aria-label="Хатты жазыңыз .." placeholder="Хатты жазыңыз .."></textarea>
					<script>autosize(document.querySelectorAll('.form_im_comment_aut'));</script>
				</div>
				<div class="form_im form_im_bn">
					<div class="btn btn_chat_all_pop" data-type="<?=$type?>">
						<span>Жіберу</span>
						<i class="fal fa-paper-plane"></i>
					</div>
				</div>
			</div>
		</div>
	</div>