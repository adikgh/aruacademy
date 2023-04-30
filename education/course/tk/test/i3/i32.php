<?php include "../../../../../config/core_edu.php";

   // 
   if (!$user_id) header('location: /education/');

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
      } else header('location: /education/cours/');
   } else header('location: /education/cours/');

   $tk_test = db::query("select * from tk_test_b where user_id = '$user_id'");
   if (!mysqli_num_rows($tk_test)) header('location: /education/course/tk/item331.php?id='.$lesson_id);

   // site setting
	$menu_name = 'lesson';
   $pod_menu_name = 'tk332';
   $site_set['swiper'] = true;
	$site_set['ublock'] = true;
	$site_set['utop_nm'] = '5-10 жасқа дейінгі балалардың дамуын бағалау үшін ата-аналарға арналған тест ('.$lesson['number'].'. '.$lesson['name_'.$lang].')';
	$site_set['utop_bk'] = 'course/tk/test/?id='.$lesson_id;
   $css = ['education/lesson', 'education/cours/tk'];
   $js = ['education/cours/tk'];
?>
<?php include "../../../../block/header.php"; ?>

   <div class="ulesson">
      <div class="bl_c">

         <? include 'h3.php' ?>

         <div class="uc_list">
            <div class="cours_ls">
               <div class="coursls_cn">

                  <? $test = db::query("select * from test where name = 'tk3'"); ?>
                  <? while ($test_d = mysqli_fetch_assoc($test)): ?>
                     <?
                        $test_id = $test_d['id'];
                        $test_answer = db::query("select * from test_answer where test_id = '$test_id' and user_id = '$user_id'");
                     ?>
                     <? if (mysqli_num_rows($test_answer) || $test_d['number'] == 1): ?>
                        <a class="coursls_i" href="test.php?id=<?=$lesson_id?>&test_id=<?=$test_d['id']?>">
                           <div class="coursls_ic">
                              <div class="coursls_in"><?=$test_d['number']?>. <?=$test_d['name_kz']?></div>
                           </div>
                           <div class="coursls_il"><i class="far fa-play"></i></div>
                        </a>
                     <? else: ?>
                        <div class="coursls_i">
                           <div class="coursls_ic">
                              <div class="coursls_in"><?=$test_d['number']?>. <?=$test_d['name_kz']?></div>
                           </div>
                           <div class="coursls_il"><i class="far fa-lock"></i></div>
                        </div>
                     <? endif ?>
                  <? endwhile ?>
               
               </div>
            </div>
         </div>

      </div>
	</div>

<? include "../../../../block/footer.php"; ?>