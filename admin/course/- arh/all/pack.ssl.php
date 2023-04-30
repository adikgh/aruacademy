<div class="uc_dio" href="/user/cours/item/pack/?id=<?=$pack_d['id']?>">
									<div class="uc_dic">
										<div class="uc_dih"><?=$pack_d['name_'.$lang]?></div>
										<div class="uc_din">
											<div class="uc_did">
												<? if ($pack_d['price_sole'] != null): ?>
													<div class="uc_did_s"><?=$pack_d['price']?> тг</div>
													<div class="uc_did_p"><?=$pack_d['price_sole']?> тг</div>
												<? else: ?><div class="uc_did_p"><?=$pack_d['price']?> тг</div><? endif ?>
											</div>
										</div>
									</div>
								</div>
								<div class="btn btn_cm btn_dd uc_di_btn"><i class="fal fa-ellipsis-h"></i></div>