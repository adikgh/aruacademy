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

									<div class="coursls_c">
										<? if (mysqli_num_rows($lesson) != 0): ?>
											<? while ($lesson_d = mysqli_fetch_assoc($lesson)): ?>
												<? if (fun::lesson_info($lesson_d['id'])) $lesson_d = array_merge($lesson_d, fun::lesson_info($lesson_d['id'])); ?>

												<a class="coursls_i" href="../../lesson/?id=<?=$lesson_d['id']?>" >
													<div class="coursls_ic">
														<div class="coursls_in"><?=($lesson_d['number']!=0?$lesson_d['number'].'. ':'')?><?=$lesson_d['name_'.$lang]?></div>
														<? if ($lesson_d['video'] || $lesson_d['video_time']): ?>
															<div class="coursls_ip">
																<? if ($lesson_d['video']): ?>
																	<div class="coursls_ipi">
																		<i class="fal fa-play-circle"></i><?=$lesson_d['video']?> видео
																	</div>
																<? endif ?>
																<? if ($lesson_d['video_time']): ?>
																	<div class="coursls_ipi">
																		<i class="fal fa-stopwatch"></i><?=$lesson_d['video_time']?>
																	</div>
																<? endif ?>
															</div>
														<? endif ?>
													</div>
													<div class="coursls_il">
														<i class="far fa-play"></i>
													</div>
												</a>
											<? endwhile ?>
										<? endif ?>
									</div>

									<? if ($user_right): ?>
										<div class="coursls_i_rg">
											<div class="btn btn_k add_lesson_b">
												<i class="fal fa-plus"></i>
												<span>Cабақ қосу</span>
											</div>
										</div>
									<? endif ?>

								</div>
							<? endwhile ?>

							<? if ($user_right): ?>
								<div coursls_i class="coursls_i_rg">
									<div class="btn btn_k ">
										<i class="fal fa-plus"></i>
										<span>Бөлім қосу</span>
									</div>
								</div>
							<? endif ?>

						<? else: ?>

							<? if ($user_right): ?>
								<div class="coursls_i_rg">
									<div class="btn btn_k add_lesson_b">
										<i class="far fa-plus"></i>
										<span>Cабақ қосу</span>
									</div>
								</div>
							<? endif ?>
						
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
							<div class="form_txt sel_clc block_cp_all" data-val="">Выбор:</div>
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
						<div class="btn btn_cours_copy" data-course="">
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
	
	
	
	
