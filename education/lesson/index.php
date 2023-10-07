<? include "../../config/core_edu.php";

   if (!$user_id) header('location: /education/');

   // 
   if (isset($_GET['id']) || $_GET['id'] != '') {
      $lesson_id = $_GET['id'];
      $lesson = db::query("select * from c_lesson where id = '$lesson_id'");
      if (mysqli_num_rows($lesson)) {
         $lesson_d = mysqli_fetch_assoc($lesson);
         $block_id = $lesson_d['block_id'];
         $pack_id = fun::pack_block($block_id);
         $pack = fun::pack($pack_id);
         $cours_id = fun::cours_pack($pack_id);

         $cours_d = fun::cours($cours_id);
         if ($pack['private_link']) {
            if ($lesson_d['site']) header('location: /education/course/'.$lesson_d['site'].'?id='.$lesson_id);
            else header('location: /education/course/'.$pack['private_link'].'/lesson.php?id='.$lesson_id);
         } else { if ($lesson_d['site']) header('location: /education/course/lesson/all/'.$lesson_d['site'].'?id='.$lesson_id); }

         $autor = fun::autor($cours_d['autor_id']);
         
         $sub = db::query("select * from c_buy where cours_id = '$cours_id' and user_id = '$user_id'");
         if (mysqli_num_rows($sub) == 1) $sub_i = mysqli_fetch_array($sub);
         else $sub_i = 0;

         // $sub = db::query("select * from cours_sub where pack_id = '$pack_id' and user_id = '$user_id'");
         // if (!mysqli_num_rows($sub)) { header('location: /u/c/'); }

         // 
         $sub_info = db::query("select * from c_buy_lesson where lesson_id = '$lesson_id' and user_id = '$user_id'");
         if (mysqli_num_rows($sub_info) != 0) {
            $sub_info_d = mysqli_fetch_array($sub_info);
            db::query("UPDATE `c_buy_lesson` SET `upd_dt` = '$datetime', `lesson_view` = 1 where lesson_id = '$lesson_id' and user_id = '$user_id'");
            if (!$sub_info_d['lesson_stage']) $sub_info_d['lesson_stage'] = 1;
         } else { 
            db::query("INSERT INTO `c_buy_lesson`(`lesson_id`, `user_id`, `lesson_view`) VALUES ('$lesson_id', '$user_id', 1)");
            $sub_info_d['lesson_stage'] = 1;
         }

      } else header('location: /education/');
   } else header('location: /education/');


   // site setting
	$menu_name = 'lesson';
   $site_set['ublock'] = true;
   $site_set['utop_nm'] = ($lesson_d['number']!=0?$lesson_d['number'].'. ':'').$lesson_d['name_'.$lang];
   $site_set['utop_bk'] = ' ';
   $site_set['utop_bk'] = 'course/?id='.$cours_id;
   $site_set['plyr'] = true;
   $css = ['education/lesson'];
   // $js = [''];
?>
<? include "../block/header.php"; ?>

   <div class="ulesson">
      <div class="bl_c">

         <div class="nvg">
            <div class="nvg_c">
               <div class="nvg_bk clc_back"><i class="fal fa-long-arrow-left"></i></div>
               <a class="nvg_i" href="/education/my">Курсы</a>
               <a class="nvg_i" href="/education/course/?id=<?=$cours_id?>"><?=$cours_d['name_kz']?></a>
               <span><?=$site_set['utop_nm']?></span>
            </div>
         </div>
         
         <div class="ulesson_c">
            <div class="head_c">
               <h3><?=$site_set['utop_nm']?></h3>
            </div>
         
            <? $info = db::query("select * from c_lesson_item where lesson_id = '$lesson_id' order by number asc"); ?>
            <? if (mysqli_num_rows($info)): ?>
               <div class="lsb">
                  <div class="lsb_c lsb_it1" data-lesson-id="<?=$lesson_id?>">
                     <? while ($sql = mysqli_fetch_assoc($info)): ?>
                        <? if ($sql['number'] == 1 && $sql['type'] != 'video'): ?>  <div class="head_name"><?=$site_set['utop_nm']?></div> <? endif ?>
                        <? if ($sql['type'] == 'video'): include "video.php"; ?>
                        <? elseif ($sql['type'] == 'txt'): include "txt.php"; ?>
                        <? elseif ($sql['type'] == 'txt_warning'): include "txt.php"; ?>
                        <? elseif ($sql['type'] == 'mat'): include "file.php"; ?>
                        <? elseif ($sql['type'] == 'link'): include "link.php"; ?>
                        <? elseif ($sql['type'] == 'test'): include "test.php"; endif ?>
                        <? $data_number = $sql['number']; ?>
                     <? endwhile ?>
                  </div>

                  <? if ($lesson_d['home_work']) include "work.php"; ?>
                  <? if ($lesson_d['ques']) include "ques.php"; ?>
               </div>
            <? else: ?>
               <div class="cup_cc">
                  <div class="cup_ccname"> Сабақ әлі шыққан жоқ</div>
               </div>
            <? endif ?>
         
            <div class="ulesson_btn">
               <div class="ulesson_btn_c">
                  <?
                     $ls = db::query("select * from c_lesson where block_id = '$block_id'");
                     $number_prev = $lesson_d['number'] - 1;
                     $number_next = $lesson_d['number'] + 1;
                     while ($ls_d = mysqli_fetch_assoc($ls)) {
                        $result = (strtotime(date("d.m.Y")) - strtotime($sub_i['ins_date'])) / (60*60*24*7);
                        $weeks = floor($result);
                        if ($ls_d['number']==$number_prev && $ls_d['open'] == 1) $lesson_prev_id = $ls_d['id'];
                        if ($ls_d['number']==$number_next && $ls_d['open'] == 1 && $weeks >= $number_next) $lesson_next_id = $ls_d['id'];
                     }
                  ?>
                  <div class="">
                     <? if ($lesson_prev_id): ?>
                        <a class="ulesson_btn_i btn_prev" href="/education/lesson/?id=<?=$lesson_prev_id?>" >
                           <div class=""><i class="fal fa-long-arrow-left"></i></div>
                           <span>Алдыңғы сабаққа</span>
                        </a>
                     <? endif ?>
                  </div>
                  <div class="">
                     <? if ($lesson_next_id): ?>
                        <a class="ulesson_btn_i btn_next" href="/education/lesson/?id=<?=$lesson_next_id?>" >
                           <span>Келесі сабаққа</span>
                           <div class=""><i class="fal fa-long-arrow-right"></i></div>
                        </a>
                     <? endif ?>
                  </div>
               </div>
            </div>

         </div>

      </div>
	</div>

<? include "../block/footer.php"; ?>