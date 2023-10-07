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


   // site setting
	$menu_name = 'lesson';
   $pod_menu_name = 'tk332';
	$site_set = [
		'header' => 'user',
		'footer' => 'false',
      'ublock' => 'true',
      'utop_nm' => 'Баланың эмоциональдық, әлеуметтік жағдайын анықтауға арналған анкете ('.$lesson['number'].'. '.$lesson['name_'.$lang].')',
		'utop_bk' => 'cours/tk/item3.php?id='.$lesson_id,
	];
   $css = ['user', 'ulesson', 'cours/tk'];
   $js = ['user', 'cours/tk'];

?>
<?php include "../../../block/header.php"; ?>

   <div class="ulesson">
      <div class="ulesson_c">

      <!-- <div class="ut_l">
         <a class="ut_li" href="/user/cours/">Курстар</a>
         <a class="ut_li" href="/user/item/?id=<?=$cours['id']?>"><?=$cours['name']?></a>
         <a class="ut_li" href="/user/tk/item3.php?id=<?=$lesson_id?>"><?=$lesson['number']?>. <?=$lesson['name']?></a>
         <span>Баланың эмоциональдық, әлеуметтік жағдайын анықтауға арналған анкете</span>
      </div> -->

      <div class="uc_list">
         <div class="cours_ls">
            <div class="coursls_cn">

               <?php $test = db::query("select * from test where name = 'tk4'"); ?>
               <?php while ($test_d = mysqli_fetch_assoc($test)): ?>
                  <?php
                     $test_id = $test_d['id'];
                     $test_answer = db::query("select * from test_answer where test_id = '$test_id' and user_id = '$user_id'");
                  ?>
                  <a class="coursls_i" href="item34t.php?id=<?=$lesson_id?>&test_id=<?=$test_d['id']?>">
                     <div class="coursls_ic">
                        <div class="coursls_in"><?=$test_d['number']?>. <?=$test_d['name_kz']?></div>
                     </div>
                     <div class="coursls_il"><i class="far fa-play"></i></div>
                  </a>
               <?php endwhile ?>
            
            </div>
         </div>
      </div>

      <div class="lsb_i">
         <div class="lsb_ic">
            <div class="prd_txt">Сұрақтарға жауап берген соң  өзіңіз үшін түйген қорытындыны жазыңыз!</div>
         </div>
      </div>

      <div class="">
         <div class="lsb_i lsb_i_home <?=(($data_number>$sub_info_d['lesson_stage'] && $lesson['type']==1)?'dsp_n':'')?>" data-number="<?=$data_number?>" data-type="home_work">
            <div class="lsb_ic">
               <div class="lsb_ih">Үй жұмысын орындау:</div>
               <div class="form_im">
                  <i class="fal fa-comment-lines form_icon"></i>
                  <textarea class="form_im_txt inp_hm"></textarea>
               </div>
               <div class="form_im">
                  <div class="btn btn_cl btn_hw" data-cours-id="<?=$cours_id?>" data-pack-id="<?=$pack_id?>" data-lesson-id="<?=$lesson_id?>">Жіберу</div>
               </div>
            </div>
         </div>
         
         <?php if ($lesson['home_work']): ?>
            <?php $home_work = db::query("select * from home_work where lesson_id = '$lesson_id' and user_id = $user_id"); ?>
            <?php if (!mysqli_num_rows($home_work)): ?>
            <?php else: ?>
               <div class="lsb_i_home">
                  <div class="lsb_ic">
                     <div class="lsb_ih">Cіздің үй жұмыстарыңыз:</div>
                     <?php while ($home_work_d = mysqli_fetch_array($home_work)): ?>
                        <div class="lsb_i_home_i">
                           <p><?=$home_work_d['txt']?></p>
                        </div>
                     <?php endwhile ?>
                  </div>
               </div>
            <?php endif ?>
         <?php endif ?>
      </div>

	</div>

<?php include "../../../block/footer.php"; ?>