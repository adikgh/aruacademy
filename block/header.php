<!DOCTYPE html>
<html lang="<?=$lang?>" id="html" class="html">
<head>

	<? $menu = mysqli_fetch_array(db::query("select * from `site_menu` where name = '$menu_name' and type = 'main'")); ?>
	<? include 'head.php' ?>
	<? include 'link.php'; ?>

</head>
<body id="body" class="body">

	<? // if ($site_set['preloader'] == true) include "preloader.php"; ?>
	<? include "menu.php"; ?>