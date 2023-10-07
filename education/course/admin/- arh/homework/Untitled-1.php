<div class="uhwa_ib">
									<? if (!$work_d['accept'] && !$work_d['refusal']): ?>
										<div class="uhwa_ibc">
											<div class="btn btn_back3">Жауап беру</div>
											<div class="uhwa_ibcs">
												<div class="form_im">
													<i class="fal fa-comment-lines form_icon"></i>
													<textarea class="form_im_txt inp_txt"></textarea>
												</div>
												<div class="uhwa_ib2" data-id="<?=$w_id?>">
													<div class="btn btn_cl btn_work_yes"><i class="fal fa-check"></i><span>Қабылдау</span></div>
													<div class="btn btn_red_cl btn_work_none"><i class="fal fa-times"></i><span>Қабылдамау</span></div>		
												</div>
											</div>
										</div>
									<? elseif ($work_d['accept']): ?>
										<div class="uhwa_iby"><i class="fal fa-check"></i><span>Қабылданған</span></div>
									<? elseif ($work_d['refusal']): ?>
										<div class="uhwa_ibx"><i class="fal fa-times"></i><span>Қабылданбады</span></div>
									<? endif ?>
	
									<? $work_o = db::query("select * from home_work where homework_id = '$w_id'"); ?>
									<? if (mysqli_num_rows($work_o)): ?>
										<? $work_od = mysqli_fetch_array($work_o) ?>
										<div class="uhwa_ib3"><?=$work_od['txt']?></div>
									<? endif ?>
								</div>