<? include "../../../config/core_edu.php";

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
         $autor = fun::autor($cours['autor_id']);
         if ($lesson['site']) header('location: /education/course/'.$lesson['site']);
         
         $sub = db::query("select * from c_buy where cours_id = '$cours_id' and user_id = '$user_id'");
         if (mysqli_num_rows($sub) == 1) $sub_i = mysqli_fetch_array($sub);
         else $sub_i = 0;

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

      } else header('location: /education/my/');
   } else header('location: /education/my/');


   // site setting
	$menu_name = 'lesson';
	// $site_set['header'] = user;
	// $site_set['footer'] = false;
	// $site_set['ublock'] = true;
	$site_set['utop_nm'] = ($lesson['number']!=0?$lesson['number'].'. ':'').$lesson['name_'.$lang];
	$site_set['utop_bk'] = 'course/?id='.$cours_id;
	$site_set['plyr'] = true;
   $css = ['education/lesson'];
   // $js = [];
?>
<? include "../../block/header.php"; ?>

   <div class="ulesson">
      <div class="bl_c">

         <div class="nvg">
            <div class="nvg_c">
               <div class="nvg_bk clc_back"><i class="fal fa-long-arrow-left"></i></div>
               <a class="nvg_i" href="/education/my">Курсы</a>
               <a class="nvg_i" href="/education/course/?id=<?=$cours_id?>"><?=$cours['name_kz']?></a>
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
                        <? if ($sql['type'] == 'video'): include "all/video.php"; ?>
                        <? elseif ($sql['type'] == 'txt'): include "all/txt.php"; ?>
                        <? elseif ($sql['type'] == 'txt_warning'): include "all/txt.php"; ?>
                        <? elseif ($sql['type'] == 'mat'): include "all/file.php"; ?>
                        <? elseif ($sql['type'] == 'link'): include "all/link.php"; ?>
                        <? elseif ($sql['type'] == 'test'): include "all/test.php"; endif ?>
                        <? $data_number = $sql['number']; ?>
                     <? endwhile ?>
                  </div>

                  <? if ($lesson['home_work']) include "all/work.php"; ?>
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
                     $number_prev = $lesson['number'] - 1;
                     $number_next = $lesson['number'] + 1;
                     while ($ls_d = mysqli_fetch_assoc($ls)) {
                        if ($pack['open_days']) {
                           $result = intval((strtotime(date("d.m.Y")) - strtotime($sub_i['ins_dt'])) / (60*60*24));
                           $days = floor(($result + $pack['open_days']) / $pack['open_days']);
                           if (!$pack['open_days'] || ($ls_d['open'] == 1 && $days >= $ls_d['number'])) $open = 1; else $open = 0;
                        } else if ($ls_d['open'] == 1) $open = 1;
                        else $open = 0;

                        if ($ls_d['number']==$number_prev && $ls_d['open'] == 1 && $open) $lesson_prev_id = $ls_d['id'];
                        if ($ls_d['number']==$number_next && $ls_d['open'] == 1 && $open) $lesson_next_id = $ls_d['id'];
                     }
                  ?>
                  <div class="">
                     <? if ($lesson_prev_id): ?>
                        <a class="ulesson_btn_i btn_prev" href="/education/course/tk/lesson.php?id=<?=$lesson_prev_id?>" >
                           <div class=""><i class="fal fa-long-arrow-left"></i></div>
                           <span>Алдыңғы сабаққа</span>
                        </a>
                     <? endif ?>
                  </div>
                  <div class="">
                     <? if ($lesson_next_id): ?>
                        <a class="ulesson_btn_i btn_next" href="/education/course/tk/lesson.php?id=<?=$lesson_next_id?>" >
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

<? include "../../block/footer.php"; ?>