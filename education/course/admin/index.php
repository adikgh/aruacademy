<? include "../../../config/core_edu.php";
	
	// Қолданушыны тексеру
	if (!$user_right) header('location: /education/');


	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
			$category = fun::category($cours_d['category_id']);
			// $autor = fun::autor($cours_d['autor_id']);
			
			$home_work = fun::cours_work($cours_id);

			// if ($course_d['info']) $course_d = array_merge($course_d, fun::course_info($course_d['id']));
		} else header('location: /education/');
	} else header('location: /education/');

	// Тариф деректері
	$pack_all = db::query("select * from c_pack where cours_id = '$cours_id' order by number asc");
	$pack_id = false;

	// Тариф деректері
	if (mysqli_num_rows($pack_all)) {
		if (isset($_GET['pack_id']) && $_GET['pack_id'] != '') {
			$pack_id = $_GET['pack_id'];
			$pack = db::query("select * from c_pack where id = '$pack_id'");
			if (mysqli_num_rows($pack)) $pack_dd = mysqli_fetch_assoc($pack);
		} else {
			$pack_dd = mysqli_fetch_assoc(db::query("select * from c_pack where cours_id = '$cours_id' order by number asc limit 1"));
			$pack_id = $pack_dd['id'];
		}
	}

	// Блок деректері
	if ($pack_id) $block = db::query("select * from c_block where pack_id = '$pack_id' order by number asc");
	else $block = db::query("select * from c_block where cours_id = '$cours_id' order by number asc");



   // Сайттың баптаулары
	$menu_name = 'item';
	$pod_menu_name = 'main';

	$site_set['menu_mb'] = false;
	$site_set['utop_nm'] = $cours_d['name_'.$lang];
	$site_set['utop_bk'] = 'my/list.php';
	if (isset($_GET['back'])) $site_set['utop_bk'] = $_GET['back'];
	$css = ['education/cours', 'education/item'];
	$js = ['admin/cours'];

?>
<? include "../../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="uitem_c <?//=(mysqli_num_rows($cblock) == 0?'uitem_c2':'')?>">

				<? include "iheader.php"; ?>

				<div class="uitemc_l">
					<div class="uitemci_ck">
						<div class="uitemci_ckt">
							<div class="uitemci_cktl"><h1 class="uitemci_h"><?=$cours_d['name_'.$lang]?><?=($cours_d['add_name_'.$lang]?' ('.$cours_d['add_name_'.$lang].')':'')?></h1></div>
							<div class="uitemci_cktr"><div class="lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div></div>
						</div>
					</div>

					<? if (mysqli_num_rows($pack_all)): ?>

						<div class="uhwa_lp">
							<? $pack_all = db::query("select * from c_pack where cours_id = '$cours_id'"); ?>
							<? while($pack_d = mysqli_fetch_assoc($pack_all)): ?>
								<a class="uhwa_lpi <?=($pack_id == $pack_d['id']?'uhwa_lpi_act':'')?>" href="?id=<?=$cours_id?>&pack_id=<?=$pack_d['id']?>">
									<span>Пакет:</span>
									<p><?=$pack_d['name_'.$lang]?></p>
									<? if ($pack_d['price_sole']): ?> <span class="fr_price"><?=$pack_d['price_sole']?></span>
									<? else: ?> <span class="fr_price"><?=$pack_d['price']?></span> <? endif ?>
								</a>
							<? endwhile; ?>
							<div class="ucours_tm ucours_tm_btn">
								<button class="btn btn_cm add_user_btn">
									<i class="fal fa-plus"></i>
									<span>Пакет қосу</span>
								</button>
							</div>
						</div>

					<? else: ?>
						
					<? endif ?>


				</div>
				
				<div class="uc_list">
					<div class="">
						<? if (mysqli_num_rows($block) != 0): ?>
							<? while ($block_d = mysqli_fetch_assoc($block)): ?>
								<div class="cours_ls">
									<?	$block_id = $block_d['id']; ?>
									<?	$lesson = db::query("select * from c_lesson where block_id = '$block_id' order by number asc"); ?>

									<div class="coursls_i coursls_b" data-id="<?=$block_d['id']?>">
										<div class="coursls_ic">
											<div class="coursls_in"><?=$block_d['number']?> бөлім. <?=$block_d['name_'.$lang]?></div>
										</div>
										<div class="coursls_ilw">
											<div class="coursls_il2">
												<div class="coursls_il2m"><i class="fal fa-bars"></i></div>
												<div class="menu_c">
													<div class="menu_ci copy_block_b">
														<div class="menu_cin"><i class="fal fa-copy"></i></div>
														<div class="menu_cih">Копировать</div>
													</div>
													<div class="menu_ci ">
														<div class="menu_cin"><i class="fal fa-pen"></i></div>
														<div class="menu_cih">Изменить</div>
													</div>
													<div class="menu_ci ">
														<div class="menu_cin"><i class="fal fa-trash"></i></div>
														<div class="menu_cih">Удалить</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<? if (mysqli_num_rows($lesson) != 0): ?>
										<div class="coursls_c">
											<? while ($lesson_d = mysqli_fetch_assoc($lesson)): ?>
												<? if (fun::lesson_info($lesson_d['id'])) $lesson_d = array_merge($lesson_d, fun::lesson_info($lesson_d['id'])); ?>

												<div class="coursls_i">
													<a class="coursls_ic" href="../../lesson/?id=<?=$lesson_d['id']?>">
														<div class="coursls_in"><?=$lesson_d['number']?>. <?=$lesson_d['name_'.$lang]?></div>
													</a>
													<div class="coursls_il">
														<i class="fal fa-pen"></i>
													</div>
												</div>
											<? endwhile ?>
										</div>
									<? endif ?>

									<div class="coursls_i_rg">
										<div class="btn btn_k add_lesson_b" data-id="<?=$block_id?>">
											<i class="fal fa-plus"></i>
											<span>Cабақ қосу</span>
										</div>
									</div>

								</div>
							<? endwhile ?>

							<div coursls_i class="coursls_i_rg">
								<div class="btn btn_k ">
									<i class="fal fa-plus"></i>
									<span>Бөлім қосу</span>
								</div>
							</div>

						<? else: ?>

							<div class="coursls_i_rg">
								<div class="btn btn_k add_lesson_b">
									<i class="far fa-plus"></i>
									<span>Cабақ қосу</span>
								</div>
							</div>
						
						<? endif ?>
						
					</div>
				</div>

			</div>

		</div>
	</div>

<? include "../../block/footer.php"; ?>

	<!-- cours edit -->
	<div class="pop_bl pop_bl2 cours_edit_block">
		<div class="pop_bl_a cours_edit_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h5>Курс өзгерту</h5>
				<div class="btn btn_dd2 cours_edit_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl lazy_c">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Курстың атауы:</div>
                  <input type="text" class="form_txt cours_name" placeholder="Атауын жазыңыз" data-lenght="2" value="<?=$cours_d['name_kz']?>" />
						<i class="fal fa-text form_icon"></i>
               </div>
					<div class="form_im">
						<div class="form_span">Доступ уақыты:</div>
                  <input type="tel" class="form_txt fr_days cours_access" placeholder="60 күн" data-lenght="1" value="<?=$cours_d['access']?>" />
						<i class="fal fa-calendar-alt form_icon"></i>
               </div>
					<div class="form_im">
						<div class="form_span">Автор:</div>
						<input type="text" class="form_txt cours_autor" placeholder="Авторды жазыңыз" data-lenght="2" value="<?=$cours_d['autor']?>" />
						<i class="fal fa-user-graduate form_icon"></i>
					</div>

					<div class="form_im">
						<div class="form_span">Курс фотосы:</div>
						<input type="file" class="cours_img file dsp_n" accept=".png, .jpeg, .jpg">
						<div class="form_im_img cours_img_add <?=($cours_d['img']?'form_im_img2':'')?>" <?=($cours_d['img']?'style="background-image: url(/assets/img/cours/'.$cours_d['img'].')"':'')?> data-txt="Фотоны жаңарту">Құрылғыдан таңдау</div>
					</div>

					<div class="form_im">
						<div class="form_span">Бағасы:</div>
						<div class="form_imc">
							<input type="tel" class="form_txt fr_price cours_price" placeholder="10.000 тг" data-lenght="1" value="<?=$cours_d['price']?>" />
							<i class="fal fa-tenge form_icon"></i>
						</div>
					</div>
					<div class="form_im">
						<div class="form_span">Жіңілдетілген бағасы:</div>
						<div class="form_imc">
							<input type="tel" class="form_txt fr_price cours_price_sole" placeholder="10.000 тг" data-lenght="1" value="<?=$cours_d['price_sole']?>" />
							<i class="fal fa-tenge form_icon"></i>
						</div>
					</div>

					<div class="form_im form_im_bn"><div class="btn btn_cours_edit" data-cours-id="<?=$cours_id?>"><i class="far fa-check"></i><span>Сақтау</span></div></div>
				</div>
			</div>
		</div>
	</div>


	<!-- course copy -->
	<div class="pop_bl pop_bl2 cours_copy">
		<div class="pop_bl_a cours_copy_back"></div>
		<div class="pop_bl_c">
			<div class="head_c txt_c">
				<h5>Копировать модуль</h5>
				<div class="btn btn_dd2 cours_copy_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<? $course_all = db::query("select * from cours order by id asc"); ?>
					<? if (mysqli_num_rows($course_all)): ?>
						<div class="form_im form_sel">
							<div class="form_span">Выберите блок:</div>
							<div class="form_txt sel_clc course_cp_all" data-val="">Выбор:</div>
							<i class="fal fa-ballot-check form_icon"></i>
							<i class="fal fa-caret-down form_icon_sel"></i>
							<div class="form_im_sel sel_clc_i">
								<? while ($course_alld = mysqli_fetch_assoc($course_all)): ?>
									<div class="form_im_seli pack_each" data-val="<?=$course_alld['id']?>"><?=$course_alld['id']?>. <?=$course_alld['name_'.$lang]?></div>
								<? endwhile ?>
							</div>
						</div>
					<? endif ?>

					<br><br><br><br><br><br><br><br><br><br>

					<div class="form_im form_im_bn">
						<div class="btn btn_cours_copy" data-course="<?=$cours_id?>">
							<span>Добавить</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- block copy -->
	<div class="pop_bl pop_bl2 block_copy">
		<div class="pop_bl_a block_copy_back"></div>
		<div class="pop_bl_c">
			<div class="head_c txt_c">
				<h5>Копировать модуль</h5>
				<div class="btn btn_dd2 block_copy_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<? $block_all = db::query("select * from c_block order by id asc"); ?>
					<? if (mysqli_num_rows($block_all)): ?>
						<div class="form_im form_sel">
							<div class="form_span">Выберите блок:</div>
							<div class="form_txt sel_clc block_cp_all" data-val="">Выбор:</div>
							<i class="fal fa-ballot-check form_icon"></i>
							<i class="fal fa-caret-down form_icon_sel"></i>
							<div class="form_im_sel sel_clc_i">
								<? while ($block_alld = mysqli_fetch_assoc($block_all)): ?>
									<div class="form_im_seli pack_each" data-val="<?=$block_alld['id']?>"><?=$block_alld['id']?>. <?=$block_alld['name_'.$lang]?></div>
								<? endwhile ?>
							</div>
						</div>
					<? endif ?>

					<br><br><br><br><br><br><br><br><br><br>

					<div class="form_im form_im_bn">
						<div class="btn btn_block_copy" data-block="">
							<span>Добавить</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	


	<!-- block add -->
	<div class="pop_bl pop_bl2 block_add">
		<div class="pop_bl_a block_add_back"></div>
		<div class="pop_bl_c">
			<div class="head_c txt_c">
				<h5>Бөлім қосу</h5>
				<div class="btn btn_dd2 block_add_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Бөлімнің атауы:</div>
						<input type="text" class="form_txt block_name" placeholder="Атауын жазыңыз" data-lenght="2">
						<i class="far fa-text form_icon"></i>
					</div>

					<div class="form_im form_im_toggle">
						<div class="form_span">Информация жазу:</div>
						<input type="checkbox" class="info_inp" data-val="" />
						<div class="form_im_toggle_btn number1_clc"></div>
					</div>
					<div class="number1_block">
						<div class="form_im">
							<div class="form_span">Сабақ саны:</div>
							<input type="tel" class="form_im_txt fr_number block_item" placeholder="12" data-lenght="1" />
							<i class="fal fa-play form_icon"></i>
						</div>
						<div class="form_im">
							<div class="form_span">Тапсырма саны:</div>
							<input type="tel" class="form_im_txt fr_number block_assig" placeholder="3" data-lenght="1" />
							<i class="fal fa-scroll-old form_icon"></i>
						</div>
					</div>

					<div class="form_im form_im_bn">
						<div class="btn btn_block_add" data-cours-id="<?=$course_id?>">
							<span>Добавить</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	
	<!-- lesson add -->
	<div class="pop_bl pop_bl2 lesson_add">
		<div class="pop_bl_a lesson_add_back"></div>
		<div class="pop_bl_c">
			<div class="head_c txt_c">
				<h5>Сабақ қосу</h5>
				<div class="btn btn_dd2 lesson_add_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Сабақ атауы:</div>
						<input type="text" class="form_txt lesson_name" placeholder="Атын жазыңыз" data-lenght="2">
						<i class="far fa-text form_icon"></i>
					</div>
					<div class="form_im form_im_toggle">
						<div class="form_span">Сабақты ашып қою:</div>
						<input type="checkbox" class="lesson_open" data-val="1" />
						<div class="form_im_toggle_btn form_im_toggle_act"></div>
					</div>

					<div class="form_im">
						<div class="form_span">Видео: (Yotube)</div>
						<input type="url" class="form_txt fr_youtube lesson_youtube" placeholder="Сілтемесін қойыңыз" data-lenght="1" />
						<i class="fal fa-play form_icon"></i>
					</div>
					<!-- <div class="form_im">
						<div class="form_span">Текст:</div>
						<textarea type="text" class="form_im_comment_aut lesson_txt" rows="5" autocomplete="off" autocorrect="off" aria-label="Напишите текст .." placeholder="Мәтінді жазыңыз .." ></textarea>
						<script>autosize(document.querySelectorAll('.form_im_comment_aut'));</script>
					</div> -->

					<div class="form_im form_im_bn">
						<div class="btn btn_lesson_add" data-cours-id="<?=$cours_id?>" data-pack="<?=$pack_id?>">Қосу</div>
					</div>
				</div>
			</div>
		</div>
	</div>


