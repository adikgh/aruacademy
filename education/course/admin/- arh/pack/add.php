<?php include "../../config/core.php";
	
	// Қолданушыны тексеру
	if ($user_id || !$user_right) {
		if (isset($_GET['id']) || $_GET['id'] != '') {
			$cours_id = $_GET['id'];
			$cours = db::query("select * from cours where id = '$cours_id'");
			if (mysqli_num_rows($cours)) {
				
				$cours = mysqli_fetch_assoc($cours);
				$category = fun::category($cours['category_id']);
				$autor = fun::autor($cours['autor_id']);
				$bookmark = fun::bookmark($cours['id'], $user_id);
				$pack = db::query("select * from cours_pack where cours_id = '$cours_id'");
				$sub = db::query("select * from cours_sub where cours_id = '$cours_id' and user_id = '$user_id'");
				if (mysqli_num_rows($sub) == 1) $sub_i = mysqli_fetch_array($sub); else $sub_i = 0;
				
			} else { header('location: /u/c/'); }
		} else { header('location: /u/c/'); }
	} else { header('location: /u/'); }

	
	// Беттің баптаулары
	$menu_name = 'item';
	$pod_menu_name = 'pack_add';
	$site_set = [
		'header' => 'full',
		'footer' => 'false',
		'ublock' => 'true',
		'utop_nm' => 'Пакет қосу',
		'utop_bk' => 'i/?id='.$cours_id,
      'uitemc_um' => 'false',
	];
	$css = ['user', 'uitem'];
	$js = ['user', 'admin'];
	
?>
<?php include "../../block/header.php"; ?>




   <div class="uitem">
      <div class="uitem_c">

         <!-- item header -->
         <?php include "../item_header.php"; ?>

         <div class="uacc">
            <div class="bl_c">
               <div class="head_c">
                  <h3>Пакет қосу</h3>
               </div>
               <div class="uacc_c">
                  <div class="uacc_i">
                     <div class="uacc_in">Атауы:</div>
                     <div class="uacc_ic">
                        <div class="form_im">
                           <input type="text" class="form_im_txt name" placeholder="Мысалы: Standart" data-lenght="3" data-sel="0" />
                        </div>
                     </div>
                  </div>
                  <div class="uacc_i">
                     <div class="uacc_in">Бағасы:</div>
                     <div class="uacc_ic">
                        <div class="form_im">
                           <input type="tel" class="form_im_txt fr_price price" placeholder="10.000 тг" data-lenght="1" data-val="<?=$cours['price']?>" value="<?=$cours['price']?>" />
                        </div>
                     </div>
                  </div>
                  <div class="uacc_i">
                     <div class="uacc_in">Жіңілдік бағасы:</div>
                     <div class="uacc_ic">
                        <div class="form_im">
                           <input type="tel" class="form_im_txt fr_price price_sole" placeholder="10.000 тг" data-lenght="1" data-val="<?=$cours['price_sole']?>" value="<?=$cours['price_sole']?>" />
                        </div>
                     </div>
                  </div>
                  <div class="uacc_i">
                     <div class="uacc_in">Үй жұмысы:</div>
                     <div class="uacc_ic">
                        <div class="form_im form_im_toggle toggle_homework">
                           <input type="checkbox" class="homework" />
                           <div class="form_im_toggle_btn"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="uacc_b">
                  <div class="btn btn_cl btn_pack_add" data-cours-id="<?=$cours_id?>">
                     <i class="far fa-check"></i>
                     <span>Сақтау</span>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>

<?php include "../../block/footer.php"; ?>