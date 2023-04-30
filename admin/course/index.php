<? include "icore.php"; 


	$pod_menu_name = 'main';
?>
<? include "../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="uitem_c <?//=(mysqli_num_rows($cblock) == 0?'uitem_c2':'')?>">

				<? include "iheader.php"; ?>

				<div class="uitemc_l">
					<div class="uitemci_ck">
						<div class="uitemci_ckt">
							<div class="uitemci_cktl"><h1 class="uitemci_h"><?=$cours_d['name_'.$lang]?></h1></div>
							<div class="uitemci_cktr"><div class="lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div></div>
						</div>

						<div class="uitemci_ckb">
							<? if ($sub_i['view']) $precent = round(100 / ($cours_d['item'] / $sub_i['view'])); ?>
							<div class="uitemci_ckb2">
								<div class="itemci_ls">
									<? if ($cours_d['arh']): ?> <div class="itemci_lsi itemci_lsi_arh">Курс архивте</div> <? endif ?>
									<? if ($cours_d['item']): ?> <div class="itemci_lsi"><?=($sub_i['view']?$sub_i['view'].'/':'')?><?=$cours_d['item']?> сабақ</div> <? endif ?>
									<? if ($cours_d['test']): ?> <div class="itemci_lsi"><?=$cours_d['test']?> тест</div> <? endif ?>
									<? if ($cours_d['assig']): ?> <div class="itemci_lsi"><?=$cours_d['assig']?> тапсырма</div> <? endif ?>
								</div>
								<? if ($sub_i['view']): ?> <div class=""><?=$precent?>%</div> <? endif ?>
							</div>
							<? if ($sub_i['view']): ?>
								<div class="uitemci_time_b">
									<div class="uitemci_time_b2" style="width:<?=$precent?>%"></div>
								</div>
							<? endif ?>
						</div>
					</div>

					<!--  -->
					<div class="">
						
					</div>
				</div>
				
				<div class="uc_list">
					<div class="uhwa_lp">
						<? $pack_all = db::query("select * from c_pack where cours_id = '$cours_id'"); ?>
						<? while($pack_d = mysqli_fetch_assoc($pack_all)): ?>
							<a class="uhwa_lpi <?=($pack_d['number']==1?'uhwa_lpi_act':'')?>" href="?id=<?=$cours_id?>&pack_id=<?=$pack_d['id']?>">
								<span>Пакет:</span>
								<p><?=$pack_d['name_'.$lang]?></p>
							</a>
						<? endwhile; ?>
						<div class="ucours_tm ucours_tm_btn">
							<button class="btn btn_cm add_user_btn">
								<i class="fal fa-plus"></i>
								<span>Пакет қосу</span>
							</button>
						</div>
					</div>

					<!-- lessons -->
					<div class="">
						<?
							if ($buy == 1) {
								$pack_id = $buy_d['pack_id'];
								$pack = db::query("select * from c_pack where id = '$pack_id'");
							} else if ($buy == 2) $pack = db::query("select * from c_pack where cours_id = '$cours_id' order by number desc limit 1");
							else $pack = db::query("select * from c_pack where cours_id = '$cours_id' order by number asc limit 1");
						?>
						<? $pack_d = mysqli_fetch_assoc($pack); ?>
						<? $pack_id = $pack_d['id']; ?>

						<? include "list.php"; ?>
					</div>
				</div>

			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>

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