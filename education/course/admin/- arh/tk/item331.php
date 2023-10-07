<?php include "../../../config/core.php";

   // 
   if (!$user_id) header('location: /user/');

   // 
   if (isset($_GET['id']) || $_GET['id'] != '') {
      $lesson_id = $_GET['id'];
      $lesson = db::query("select * from c_lesson where id = '$lesson_id'");
      if (mysqli_num_rows($lesson)) {
         $lesson = mysqli_fetch_assoc($lesson);
         $block_id = $lesson['block_id'];
         $pack_id = fun::pack_block($block_id);
         $pack = fun::pack($pack_id);
         $cours_id = fun::cours_pack($pack_id);
         $cours = fun::cours($cours_id);
      } else { header('location: /user/cours/'); }
   } else { header('location: /user/cours/'); }

   $tk_test = db::query("select * from tk_test_b where user_id = '$user_id' and end_dt is null");
   if (mysqli_num_rows($tk_test)) header('location: /user/cours/tk/item332.php?id='.$lesson_id);


   // site setting
	$menu_name = 'lesson';
	$pod_menu_name = 'tk331';
	$site_set = [
		'header' => 'user',
		'footer' => 'false',
      'ublock' => 'true',
      'utop_nm' => '5-10 жасқа дейінгі балалардың дамуын бағалау үшін ата-аналарға арналған тест ('.$lesson['number'].'. '.$lesson['name_'.$lang].')',
		'utop_bk' => 'cours/tk/item3.php?id='.$lesson_id,
	];
   $css = ['user', 'ulesson', 'cours/tk'];
   $js = ['user', 'cours/tk'];

?>
<?php include "../../../block/header.php"; ?>

   <div class="ulesson">
      <div class="ulesson_с">

         <?php include 'header_33.php' ?>

         <div class="ktbl2">
            <div class="ktbl2_l">
               <div class="lazy_img" data-src="/assets/img/icons/woman-raising-hand-light-skin-tone_1f64b-1f3fb-200d-2640-fe0f.png"></div>
            </div>
            <div class="ktbl2_r">
               <p>Бұл тестте сіздің балаңыздың әртүрлі салада дамуы мен мінез-құлқын анықтау үшін сұрақтар қойылады. Балаңыз туралы толық ақпарат алғыңыз келсе, барлық тапсырманы орындаңыз.</p>
               <p>Балалар әр жаста өздерін әртүрлі ұстайды. Өз балаңызды басқа дәл осы жастағы баламен салыстырыңыз.</p>
            </div>
         </div>

         <div class="">
            <div class="sw_tih">Балаңыз жайлы қысқаша сипаттаңыз:</div>
            <div class="">
               <div class="form_im">
                  <input type="text" class="form_im_txt kt_inp child_name" placeholder="Балаңыздың аты-жөні .." data-lenght="2">
                  <i class="far fa-child form_icon"></i>
               </div>
               <div class="form_im">
                  <input type="tel" class="form_im_txt fr_age child_age" placeholder="Балаңыздың жасы">
                  <i class="far fa-calendar-alt form_icon"></i>
               </div>
               <div class="form_im">
                  <input type="text" class="form_im_txt kt_inp name" placeholder="Тестті кім толтыруда (аты-жөніңіз)" value="<?=$user['name']?> <?=$user['surname']?>" data-val="<?=$user['name']?> <?=$user['surname']?>" data-lenght="2" data-sel="1">
                  <i class="far fa-user form_icon"></i>
               </div>
               <div class="form_im">
                  <div class="btn tk_t2_start">Тестті бастау</div>
               </div>
            </div>
         </div>

      </div>
	</div>

<?php include "../../../block/footer.php"; ?>