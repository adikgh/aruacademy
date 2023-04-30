<?php include "../../../../config/core.php";

   // 
   if (!$user_id) header('location: /user/');

   // 
   if (isset($_GET['id']) || $_GET['id'] != '') {
      $pack_id = $_GET['id'];
      $pack = db::query("select * from c_pack where id = '$pack_id'");
      if (mysqli_num_rows($pack)) {
         $pack_d = mysqli_fetch_assoc($pack);
         $cours = fun::cours($pack_d['cours_id']);
         $cours_id = $cours['id'];
         $category = fun::category($cours['category_id']);
         
      } else header('location: /user/cours/');
   } else header('location: /user/cours/');


   // site setting
	$menu_name = 'pack';
	$site_set = [
		'header' => 'user',
		'footer' => 'false',
      'ublock' => 'true',
		'utop_nm' => $cours['name_'.$lang].' - '.$pack_d['name'],
		'utop_bk' => 'item/?id='.$cours_id,
	];
	$css = ['user','uitem'];
	$js = ['user'];
	
?>
<?php include "../../../../block/header.php"; ?>

	<div class="uitem">

      <!-- item header -->
      <?php include "../i_header.php"; ?>

      <!--  -->
      <?php include "../list.php"; ?>

   </div>

<?php include "../../../../block/footer.php"; ?>