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

   $tk_test = db::query("select * from tk_test_b where user_id = '$user_id' and end_dt is not null");
   if (!mysqli_num_rows($tk_test)) header('location: /user/cours/tk/item331.php?id='.$lesson_id);


   // site setting
	$menu_name = 'lesson';
   $pod_menu_name = 'tk333';
	$site_set = [
		'header' => 'user',
		'footer' => 'false',
      'ublock' => 'true',
      'utop_nm' => '5-12 жасқа дейінгі балалардың дамуы мен психологиясының бағалау үшін ата-аналарға арналған тест ('.$lesson['number'].'. '.$lesson['name_'.$lang].')',
		'utop_bk' => 'cours/tk/item3.php?id='.$lesson_id,
	];
   $css = ['user', 'ulesson', 'cours/tk'];
   $js = ['user', 'cours/tk'];

?>
<?php include "../../../block/header.php"; ?>

   <div class="ulesson">
      <div class="ulesson_c">

         <?php include 'header_33.php' ?>

	   </div>
	</div>

<?php include "../../../block/footer.php"; ?>