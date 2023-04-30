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
	$site_set['utop_nm'] = '4 жасқа дейінгі баланың даму деңгейін анықтайтын тест ('.$lesson['number'].'. '.$lesson['name_'.$lang].')';
	$site_set['utop_bk'] = 'course/tk/test/?id='.$lesson_id;
   $css = ['education/lesson', 'education/cours/tk'];
   $js = ['education/cours/tk'];
?>
<?php include "../../../block/header.php"; ?>

   <div class="ulesson">
      <div class="bl_c">

      <!--  -->

      <div class="lsb">
         <div class="">

            <?php $info = db::query("select * from c_lesson_item where lesson_id = '$lesson_id'"); ?>
            <?php while ($sql = mysqli_fetch_assoc($info)): ?>
               <div class="lsb_i" data-type="<?=$sql['type']?>">
                  <div class="lsb_ic">
                     <div class="lsb_i2">
                        <!-- <div class="lsb_i2_l"><?=$sql['icon']?></div> -->
                        <div class="lsb_i2_r">
                           <div class="lsb_ih2"><span><?=$sql['type_name']?>:</span></div>
                           <div class="lsb_ih3"><?=$sql['txt']?></div>
                        </div>
                     </div>
                     <div class="lsb_i3">
                        <a class="btn btn_cl" href="/assets/uploads/<?=$sql['txt']?>" target="_blank"><i class="fal fa-folder-open"></i><span>Ашу</span></a>
                        <a class="btn btn_cl" href="/assets/uploads/<?=$sql['txt']?>" download><i class="fal fa-cloud-download"></i><span>Жүктеп алу</span></a>
                     </div>
                  </div>
               </div>
            <?php endwhile ?>

            <div class="lsb_i">
               <div class="lsb_ic">
                  <div class="prd_txt">Докумументтерді жүктеп, балаңызға жасатқан соң, көрсеткен қорытытындыны төменге жазыңыз!</div>
               </div>
            </div>

            <?php $home_work = db::query("select * from home_work where lesson_id = '$lesson_id' and user_id = $user_id"); ?>
            <?php if (!mysqli_num_rows($home_work)): ?>
               <div class="lsb_i lsb_i_home" data-type="home_work">
                  <div class="lsb_ic">
                     <div class="lsb_ih">Үй жұмысын орындау:</div>
                     <div class="form_im">
                        <i class="fal fa-comment-lines form_icon"></i>
                        <textarea class="form_txt inp_hm"></textarea>
                     </div>
                     <div class="form_im">
                        <div class="btn btn_cl btn_hw" data-cours-id="<?=$cours_id?>" data-pack-id="<?=$pack_id?>" data-lesson-id="<?=$lesson_id?>">Жіберу</div>
                     </div>
                  </div>
               </div>
            <?php else: ?>
               <div class="lsb_i_home">
                  <div class="lsb_ic">
                     <div class="lsb_ih">Cіздің үй жұмыстарыңыз:</div>
                     <?php while ($home_work_d = mysqli_fetch_array($home_work)): ?>
                        <?php $w_id = $home_work_d['id']; ?>
                        <div class="lsb_i_home_i">
                           <div class="lsb_i_home_id"><div><?=date("m-d-Y", strtotime($home_work_d['ins_dt']))?></div><div><?=date("H:i", strtotime($home_work_d['ins_dt']))?></div></div>
                           <p><?=$home_work_d['txt']?></p>
                           
                           <?php $work_o = db::query("select * from home_work where homework_id = '$w_id'"); ?>
                           <?php if (mysqli_num_rows($work_o)): ?>
                              <?php $work_od = mysqli_fetch_array($work_o) ?>
                              <div class="lsb_i_home_b"><?=$work_od['txt']?></div>
                           <?php endif ?>
                        </div>
                     <?php endwhile ?>
                  </div>
               </div>
            <?php endif ?>

         </div>
      </div>


	   </div>
	</div>

<? include "../../../block/footer.php"; ?>