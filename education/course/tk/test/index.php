<?php include "../../../../config/core_edu.php";

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
      } else header('location: /education/my/');
   } else header('location: /education/my/');


   // site setting
	$menu_name = 'lesson';
	$site_set['swiper'] = true;
	$site_set['ublock'] = true;
	$site_set['utop_nm'] = $lesson['number'].'. '.$lesson['name_'.$lang];
	$site_set['utop_bk'] = 'course/?id='.$cours_id;
   $css = ['education/lesson', 'education/cours/tk'];
   $js = ['education/cours/tk'];
?>
<?php include "../../../block/header.php"; ?>

   <div class="ulesson">
      <div class="bl_c">

         <!--  -->

         <div class="tks">

            <a class="tks_i" href="i1.php?id=<?=$lesson_id?>">
               <?
                  $test_answer = db::query("select * from test_answer where test_id = 1 and user_id = '$user_id'");
                  if (mysqli_num_rows($test_answer)) $test_answer_d = mysqli_fetch_array($test_answer);
                  $test = db::query("select * from test where id = 1");
                  if (mysqli_num_rows($test)) $test_d = mysqli_fetch_array($test);
               ?>
               <div class="bq_ci_img">
                  <div class="lazy_img" data-src="/assets/uploads/course/IMG_0591.jpg"></div>
               </div>
               <div class="tks_f">
                  <div class="tks_h">Қорқыныш деңгейін анықтайтын тест</div>
               </div>
               <div class="tks_b">
                  <div class="tks_bs">
                     <div class="tks_bsl">
                        <span>Тест</span>
                        <div><?=$test_answer_d['n']?>/<?=$test_d['n']?></div>
                     </div>
                     <div class="tks_bsc"><div style="width:<?=100/($test_d['n']/$test_answer_d['n'])?>%"></div></div>
                  </div>
                  <div class="btn btn_cm btn_dd">
                     <i class="fal fa-long-arrow-right"></i>
                  </div>
               </div>
            </a>

            <a class="tks_i" href="i2.php?id=<?=$lesson_id?>">
               <? $home_work = db::query("select * from home_work where lesson_id = '$lesson_id' and user_id = $user_id"); ?>
               <div class="bq_ci_img">
                  <div class="lazy_img" data-src="/assets/uploads/course/IMG_0521.jpg"></div>
               </div>
               <div class="tks_f">
                  <div class="tks_h">4 жасқа дейінгі баланың даму деңгейін анықтайтын тест</div>
               </div>
               <div class="tks_b">
                  <div class="tks_bs">
                     <div class="tks_bsl">
                        <span>Үй жұмысы</span>
                        <div><?=(mysqli_num_rows($home_work)?'1':'0')?>/1</div>
                     </div>
                     <div class="tks_bsc"><div style="width:<?=(mysqli_num_rows($home_work)?'100':'0')?>%"></div></div>
                  </div>
                  <div class="btn btn_cm btn_dd">
                     <i class="fal fa-long-arrow-right"></i>
                  </div>
               </div>
            </a>

            <a class="tks_i" href="i3/?id=<?=$lesson_id?>">
               <?php
                  $test = db::query("select * from test where name = 'tk3'");
                  $tk_test = db::query("select * from tk_test_b where user_id = '$user_id'");
                  if (mysqli_num_rows($tk_test)) $tk_test_b = mysqli_fetch_array($tk_test);
               ?>

               <div class="bq_ci_img">
                  <div class="lazy_img" data-src="/assets/uploads/course/IMG_0413.jpg"></div>
               </div>
               <div class="tks_f">
                  <div class="tks_h">5-10 жасқа дейінгі балалардың дамуын бағалау үшін ата-аналарға арналған тест</div>
               </div>
               <div class="tks_b">
                  <div class="tks_bs">
                     <div class="tks_bsl">
                        <span>Тест</span>
                        <div><?=$tk_test_b['n']?>/<?=mysqli_num_rows($test)?></div>
                     </div>
                     <div class="tks_bsc"><div style="width:<?=100/(mysqli_num_rows($test)/$tk_test_b['n'])?>%"></div></div>
                  </div>
                  <div class="btn btn_cm btn_dd">
                     <i class="fal fa-long-arrow-right"></i>
                  </div>
               </div>
            </a>

            <a class="tks_i" href="i4/?id=<?=$lesson_id?>">
               <?php $home_work = db::query("select * from home_work where lesson_id = '$lesson_id' and user_id = $user_id"); ?>
               <div class="bq_ci_img">
                  <div class="lazy_img" data-src="/assets/uploads/course/IMG_0572.jpg"></div>
               </div>
               <div class="tks_f">
                  <div class="tks_h">Баланың эмоциональдық, әлеуметтік жағдайын анықтауға арналған анкете</div>
               </div>
               <div class="tks_b">
                  <div class="tks_bs">
                     <div class="tks_bsl">
                        <span>Анкета</span>
                        <div><?=(mysqli_num_rows($home_work)?'1':'0')?>/1</div>
                     </div>
                     <div class="tks_bsc"><div style="width:<?=(mysqli_num_rows($home_work)?'100':'0')?>%"></div></div>
                  </div>
                  <div class="btn btn_cm btn_dd">
                     <i class="fal fa-long-arrow-right"></i>
                  </div>
               </div>
            </a>

         </div>
      </div>

	</div>

<? include "../../../block/footer.php"; ?>