<?php include "../../config/core_admin.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /admin/');

	// Сайттың баптаулары
	$menu_name = 'user';
	$site_set['utop_nm'] = 'Жеке деректер';
	$site_set['um_menu'] = true;
	$site_set['utop'] = false;
	$css = ['admin/acc'];
	// $js = [''];
?>
<? include "../block/header.php"; ?>

	<div class="up">
		<div class="bl_c">

			<div class="up_top">
				<div class="up_lg">
					<div class="up_logo">
						<?php if ($user['logo']): ?>
							<div class="up_logo_c lazy_img" data-src="/assets/img/users/<?=$user['logo']?>"></div>
							<?php else: ?>
							<div class="up_logo_icons lazy_img" data-src="/assets/img/icons/princess_light-skin-tone_1f478-1f3fb_1f3fb.png"></div>
						<?php endif ?>
					</div>
					<div class="up_logo_upd"><i class="fal fa-camera"></i></div>
				</div>
				<div class="up_inf">
					<div class="up_name"><?=$user['name']?> <?=$user['surname']?></div>
					<div class="up_phone " fr_phone>
						<? if ($user['phone'] != null): ?> <?=$user['phone']?>
						<? else: ?> <?=$user['mail']?> <? endif ?>
					</div>
				</div>
			</div>

			<div class="up_c">

				<div class="up_lt">
					<a class="up_li" href="/admin/chats/">
						<div class="menu_cin"><i class="fal fa-comments-alt"></i></div>
						<div class="menu_cih">Чат
							<? if (fun::chat_view_sum() != 0): ?>
								<span><?=fun::chat_view_sum()?></span>
							<? endif ?>
						</div>
					</a>
					<a class="up_li" href="/admin/works/">
						<div class="menu_cin"><i class="fal fa-pennant"></i></div>
						<div class="menu_cih">Үй жұмысы</div>
					</a>
					<a class="up_li" href="/admin/works/ques/">
						<div class="menu_cin"><i class="fal fa-comment-dots"></i></div>
						<div class="menu_cih">Сұрақ-жауап</div>
					</a>
					<a class="up_li" href="/admin/works/reviews/">
						<div class="menu_cin"><i class="fal fa-comment-alt-lines"></i></div>
						<div class="menu_cih">Пікірлер</div>
					</a>
					<a class="up_li" href="/admin/works/test/">
						<div class="menu_cin"><i class="fal fa-clipboard-list-check"></i></div>
						<div class="menu_cih">Тесттер</div>
					</a>
				</div>

				<div class="up_lt">
					<!-- <a class="up_li" href="">
						<div class="menu_cin"><i class="far fa-cog"></i></div>
						<div class="menu_cih">Баптаулар</div>
					</a> -->
					<div class="up_li">
						<div class="menu_cin"><i class="fal fa-user-circle"></i></div>
						<div class="menu_cih">Жеке деректер</div>
					</div>
					<a class="up_li" href="/admin/company/">
						<div class="menu_cin"><i class="fal fa-award"></i></div>
						<div class="menu_cih">Компания</div>
					</a>
					<div class="up_li">
						<div class="menu_cin"><i class="fal fa-wallet"></i></div>
						<div class="menu_cih">
							<!-- <?// if (get_balance()): ?> <?//=get_balance();?> тг -->
							<?// else: ?> Белгісіз <?// endif ?>
						</div>
					</div>
				</div>

				<div class="up_lt">
						<a class="up_li" href="#">
							<div class="menu_cin"><i class="fal fa-question-circle"></i></div>
							<div class="menu_cih">Жиі қойылатын сұрақтар</div>
						</a>
						<a class="up_li" href="https://wa.me/<?=$site['whatsapp']?>">
							<div class="menu_cin"><i class="fal fa-comment-dots"></i></div>
							<div class="menu_cih">Көмек (Whatsapp)</div>
						</a>
					<a class="up_li" href="/admin/all/offer.php">
						<div class="menu_cin"><i class="fal fa-users-cog"></i></div>
						<div class="menu_cih">Қолдану ережелері</div>
					</a>
					<a class="up_li" href="/admin/all/privacy.php">
						<div class="menu_cin"><i class="fal fa-users-cog"></i></div>
						<div class="menu_cih">Авторлық құқық</div>
					</a>
				</div>

				<div class="up_exit">
					<a class="btn btn_back" href="/admin/exit.php">
						<i class="far fa-sign-out"></i>
						<span>Шығу</span>
					</a>
				</div>

			</div>
			<div class="up_cg">
				<a href="https://gprog.kz" target="_blank" class="gprog_bl">
					<span>#gprog-та</span>
					<div class="gprog_heart"><i class="fas fa-heart"></i></div>
					<span>жасалған</span>
				</a>
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>