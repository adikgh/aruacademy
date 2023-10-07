<? include "../../config/core_edu.php";

	// Қолданушыны тексеру
	if (!$user_right) header('location: /education/');

	// course 
	$cours = db::query("select * from cours where arh is null ORDER BY ins_dt DESC");
	
	$course_arh = db::query("select * from cours where arh = 1 ORDER BY ins_dt DESC");


	// Сайттың баптаулары
	$menu_name = 'list';
	$site_set['utop_nm'] = 'Курстар';
	$site_set['pmenu'] = true;
	// $css = ['education/main', 'education/cours'];
	// $js = ['education/main', 'education/admin'];

	// $pod_menu_name = 'all';
	// $site_set['utop_nm'] = 'Курстар';
	// $site_set['um_menu'] = true;
	// $site_set['utop'] = false;
	// // $site_set['ut_l'] = false;

	$css = ['education/cours'];
	$js = ['admin/cours'];
?>
<? include "../block/header.php"; ?>

	<div class="ucours">
		<div class="bl_c">

			<div class="">
				<div class="head_c">
					<h4>Курстар</h4>
				</div>

				<div class="uc_d">

					<div class="uc_di uc_do cours_add_pop">
						<i class="fal fa-plus"></i>
						<span>Курс қосу</span>
					</div>

					<? while($cours_d = mysqli_fetch_array($cours)): ?>
						<? $cours_id = $cours_d['id']; ?>
						<? $pack_d = fun::pack_one($cours_d['id']); ?>

						<div class="uc_di">
							<a class="uc_dio" href="../course/admin/?id=<?=$cours_d['id']?>">
								<div class="uc_di_img">
									<div class="uc_di_imgc lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div>
									<div class="uc_dip">
										<div class="uc_dipi"><?=fun::category_name($cours_d['category_id'], $lang)?></div>
									</div>
								</div>
								<div class="uc_dic">
									<div class="uc_dih"><?=$cours_d['name_'.$lang]?><?=($cours_d['add_name_'.$lang]?' ('.$cours_d['add_name_'.$lang].')':'')?></div>
									<div class="uc_din">
										<? if ($pack_d && ($pack_d['price'] || $pack_d['price_sole'])): ?>
											<div class="uc_did">
												<? if ($pack_d['price_sole']): ?>
													<div class="uc_did_s fr_price"><?=$pack_d['price']?></div>
													<div class="uc_did_p fr_price"><?=$pack_d['price_sole']?></div>
												<? else: ?> <div class="uc_did_p fr_price"><?=$pack_d['price']?></div> <? endif ?>
											</div>
										<? elseif ($cours_d['price'] || $cours_d['price_sole']): ?>
											<div class="uc_did">
												<? if ($cours_d['price_sole']): ?>
													<div class="uc_did_s fr_price"><?=$cours_d['price']?></div>
													<div class="uc_did_p fr_price"><?=$cours_d['price_sole']?></div>
												<? else: ?> <div class="uc_did_p fr_price"><?=$cours_d['price']?></div> <? endif ?>
											</div>
										<? endif ?>
									</div>
								</div>
							</a>
							<div class="btn btn_cm btn_dd2 uc_di_btn"><i class="far fa-ellipsis-v"></i></div>
						</div>
					<? endwhile ?>
				
				</div>
			</div>
			
			<div class="">
				<div class="head_c">
					<h5>Архив курстар</h5>
				</div>

				<div class="uc_d">

					<? while($cours_d = mysqli_fetch_array($course_arh)): ?>
						<div class="uc_di">
							<a class="uc_dio" href="../course/admin/?id=<?=$cours_d['id']?>">
								<div class="uc_di_img">
									<div class="uc_di_imgc lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div>
									<div class="uc_dip">
										<div class="uc_dipi">Архив</div>
									</div>
								</div>
								<div class="uc_dic">
									<div class="uc_dih"><?=$cours_d['name_'.$lang]?></div>
								</div>
							</a>
						</div>
					<? endwhile ?>
				
				</div>
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>

	<!-- cours add -->
	<div class="pop_bl pop_bl2 cours_add_block">
		<div class="pop_bl_a cours_add_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h5>Cабақты қосу</h5>
				<div class="btn btn_dd2 cours_add_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Курстың атауы:</div>
						<div class="form_imc">
							<input type="text" class="form_txt cours_name" placeholder="Атауын жазыңыз" data-lenght="2" />
							<i class="fal fa-text form_icon"></i>
						</div>
					</div>
					<div class="form_im">
						<div class="form_span">Доступ уақыты:</div>
						<div class="form_imc">
							<input type="tel" class="form_txt fr_days cours_access" placeholder="60 күн" data-lenght="1" />
							<i class="fal fa-calendar-alt form_icon"></i>
						</div>
					</div>
					<div class="form_im form_sel">
						<div class="form_span">Доступ түрі:</div>
						<div class="form_txt sel_clc pack" data-val="0">Қарапайым</div>
						<i class="fal fa-calendar-alt form_icon"></i>
						<i class="fal fa-caret-down form_icon_sel"></i>
						<div class="form_im_sel sel_clc_i">
							<div class="form_im_seli pack_each" data-val="0">Қарапайым</div>
							<div class="form_im_seli pack_each" data-val="1">Уақытпен</div>
							<div class="form_im_seli pack_each" data-val="2">Үй жұмысы арқылы</div>
						</div>
					</div>
					<div class="form_im">
						<div class="form_span">Курс фотосы:</div>
						<input type="file" class="cours_img file dsp_n" accept=".png, .jpeg, .jpg">
						<div class="form_im_img lazy_img cours_img_add" data-txt="Фотоны жаңарту">Құрылғыдан таңдау</div>
					</div>
				</div>

				<div class="form_c">
					<div class="prs_block">
						<div class="form_im form_im_toggle">
							<div class="form_span">Бағасын жазу:</div>
							<input type="checkbox" class="price_inp" data-val="" />
							<div class="form_im_toggle_btn prs_clc"></div>
						</div>
						<div class="prs_blockc">
							<div class="form_im">
								<div class="form_span">Бағасы:</div>
								<div class="form_imc">
									<input type="tel" class="form_txt fr_price cours_price" placeholder="10.000 тг" data-lenght="1" />
									<i class="fal fa-tenge form_icon"></i>
								</div>
							</div>
							<div class="form_im">
								<div class="form_span">Жіңілдетілген бағасы:</div>
								<div class="form_imc">
									<input type="tel" class="form_txt fr_price cours_price_sole" placeholder="10.000 тг" data-lenght="1" />
									<i class="fal fa-tenge form_icon"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="prs_block">
						<div class="form_im form_im_toggle">
							<div class="form_span">Информация жазу:</div>
							<input type="checkbox" class="info_inp" data-val="" />
							<div class="form_im_toggle_btn prs_clc"></div>
						</div>
						<div class="prs_blockc">
							<div class="form_im form_sel">
								<div class="form_span">Бағыты:</div>
								<div class="form_txt sel_clc pack" data-val="1">Курс</div>
								<i class="fal fa-ballot-check form_icon"></i>
								<i class="fal fa-caret-down form_icon_sel"></i>
								<div class="form_im_sel sel_clc_i">
									<? $cat = db::query("select * from category"); ?>
									<? while ($cat_d = mysqli_fetch_assoc($cat)): ?>
										<div class="form_im_seli pack_each" data-val="<?=$cat_d['id']?>"><?=$cat_d['name_'.$lang]?></div>
									<? endwhile ?>
								</div>
							</div>
							<div class="form_im">
								<div class="form_span">Автор:</div>
								<div class="form_imc">
									<input type="text" class="form_txt cours_autor" placeholder="Авторды жазыңыз" data-lenght="2" />
									<i class="fal fa-user-graduate form_icon"></i>
								</div>
							</div>
							<div class="form_im form_im_toggle">
								<div class="form_span">Жаңа белгісін қою:</div>
								<input type="checkbox" class="info_inp" data-val="" />
								<div class="form_im_toggle_btn"></div>
							</div>
							<div class="form_im form_im_toggle">
								<div class="form_span">Жуырда белгісін қою:</div>
								<input type="checkbox" class="info_inp" data-val="" />
								<div class="form_im_toggle_btn"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="form_c">
					<div class="prs_block">
						<div class="form_im form_im_toggle">
							<div class="form_span">Сатылымға шығару:</div>
							<input type="checkbox" class="info_inp" data-val="" />
							<div class="form_im_toggle_btn prs_clc"></div>
						</div>
						<div class="prs_blockc">
							<div class="form_im">
								<div class="form_span">Сатылым сайты:</div>
								<div class="form_imc">
									<input type="text" class="form_txt cours_name" placeholder="Сілтемесін жазыңыз" data-lenght="2" />
									<i class="fal fa-text form_icon"></i>
								</div>
							</div>
							<div class="form_im form_im_toggle">
								<div class="form_span">Басты бетке шығару:</div>
								<input type="checkbox" class="info_inp" data-val="" />
								<div class="form_im_toggle_btn"></div>
							</div>
						</div>
					</div>

					<div class="prs_block">
						<div class="form_im form_im_toggle">
							<div class="form_span">Басқада:</div>
							<input type="checkbox" class="info_inp" data-val="" />
							<div class="form_im_toggle_btn prs_clc"></div>
						</div>
						<div class="prs_blockc">
							<div class="form_im">
								<div class="form_span">Сабақ саны:</div>
								<div class="form_imc">
									<input type="tel" class="form_txt fr_number cours_item" placeholder="12" data-lenght="1" />
									<i class="fal fa-play form_icon"></i>
								</div>
							</div>
							<div class="form_im">
								<div class="form_span">Тапсырма саны:</div>
								<div class="form_imc">
									<input type="tel" class="form_txt fr_number cours_assig" placeholder="3" data-lenght="1" />
									<i class="fal fa-scroll-old form_icon"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form_c">
					<div class="form_im form_im_bn">
						<div class="btn btn_cm btn_item_add">
							<i class="far fa-check"></i>
							<span>Сақтау</span>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>













		<!-- cours add -->
	<!-- <div class="pop_bl pop_bl2 cours_add_block">
		<div class="pop_bl_a cours_add_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h5>Cабақты қосу</h5>
				<div class="btn btn_dd2 cours_add_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Курстың атауы:</div>
						<input type="text" class="form_txt cours_name" placeholder="Атауын жазыңыз" data-lenght="2" />
						<i class="fal fa-text form_icon"></i>
					</div>
					<div class="form_im">
						<div class="form_span">Доступ уақыты:</div>
						<input type="tel" class="form_txt fr_days cours_access" placeholder="60 күн" data-lenght="1" />
						<i class="fal fa-calendar-alt form_icon"></i>
					</div>
					<div class="form_im">
						<div class="form_span">Автор:</div>
						<input type="text" class="form_txt cours_autor" placeholder="Авторды жазыңыз" data-lenght="2" />
						<i class="fal fa-user-graduate form_icon"></i>
					</div>

					<div class="form_im">
						<div class="form_span">Курс фотосы:</div>
						<input type="file" class="cours_img file dsp_n" accept=".png, .jpeg, .jpg">
						<div class="form_im_img lazy_img cours_img_add" data-txt="Фотоны жаңарту">Құрылғыдан таңдау</div>
					</div>

					<div class="form_im form_im_toggle">
						<div class="form_span">Бағасын жазу:</div>
						<input type="checkbox" class="price_inp" data-val="" />
						<div class="form_im_toggle_btn price1_clc"></div>
					</div>
					<div class="price1_block">
						<div class="form_im">
							<div class="form_span">Бағасы:</div>
							<input type="tel" class="form_im_txt fr_price cours_price" placeholder="10.000 тг" data-lenght="1" />
							<i class="fal fa-tenge form_icon"></i>
						</div>
						<div class="form_im">
							<div class="form_span">Жіңілдік бағасы:</div>
							<input type="tel" class="form_im_txt fr_price cours_price_sole" placeholder="10.000 тг" data-lenght="1" />
							<i class="fal fa-tenge form_icon"></i>
						</div>
					</div>

					<div class="form_im form_im_toggle">
						<div class="form_span">Информация жазу:</div>
						<input type="checkbox" class="info_inp" data-val="" />
						<div class="form_im_toggle_btn number1_clc"></div>
					</div>
					<div class="number1_block">
						<div class="form_im">
							<div class="form_span">Сабақ саны:</div>
							<input type="tel" class="form_im_txt fr_number cours_item" placeholder="12" data-lenght="1" />
							<i class="fal fa-play form_icon"></i>
						</div>
						<div class="form_im">
							<div class="form_span">Тапсырма саны:</div>
							<input type="tel" class="form_im_txt fr_number cours_assig" placeholder="3" data-lenght="1" />
							<i class="fal fa-scroll-old form_icon"></i>
						</div>
					</div>

					<div class="form_im form_im_bn">
						<div class="btn btn_item_add"><i class="far fa-check"></i><span>Сақтау</span></div>
					</div>
				</div>
			</div>
		</div>
	</div> -->