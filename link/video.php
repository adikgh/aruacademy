<?php include "../config/core.php";

	// site setting
	$menu_name = 'link';
	$site_set['header'] = false;
	$site_set['footer'] = false;
	$site_set['plyr'] = true;
	$css = ['link'];
?>
<? include "../block/header.php"; ?>


	<div class="a2 a22">
		<div class="bl_c">
			<div class="a2_c">
				<div class="a2_t">Ана мен бала қарым-қатынасы<br>жөнінде пайдалы білімдер</div>
				<div class="a2_tm">
					<div class="a2_tmc">
						<div class="container">
							<div class="player_a1" data-plyr-provider="youtube" data-plyr-embed-id="g7R4Lkt5bX0"></div>
						</div>
						<script> const player_a1 = new Plyr(".player_a1", { fullscreen: {iosNative: true} }); </script>
					</div>
				</div>
				<div class="a2_tm">
					<div class="a2_tmc">
						<div class="container">
							<div class="player_a2" data-plyr-provider="youtube" data-plyr-embed-id="KI2EwopNG-U"></div>
						</div>
						<script> const player_a2 = new Plyr(".player_a2", { fullscreen: {iosNative: true} }); </script>
					</div>
				</div>

				<div class="a2_tm_b">
					<a class="btn btn_red" href="https://www.youtube.com/arusagi87">
						<i class="fab fa-youtube"></i>
						<span>YouTube арнама өту</span>
					</a>
				</div>

            <?php $video = db::query("select * from sours where type = 'video' ORDER BY number asc"); ?>
            <?php while($video_d = mysqli_fetch_assoc($video)): ?>
               <div class="a2_tm">
                  <div class="a2_tmc">
                     <div class="container">
                        <div class="player_<?=$video_d['id']?>" data-plyr-provider="youtube" data-plyr-embed-id="<?=$video_d['txt']?>"></div>
                     </div>
                     <script>
                        const player_<?=$video_d['id']?> = new Plyr(".player_<?=$video_d['id']?>", { fullscreen: {iosNative: true} });
                     </script>
                  </div>
               </div>
            <?php endwhile ?>

            <div class="a2_tm_b">
					<a class="btn btn_red" href="https://www.youtube.com/arusagi87">
						<i class="fab fa-youtube"></i>
						<span>YouTube арнама өту</span>
					</a>
				</div>

			</div>
		</div>
	</div>

	<? include "afoot.php"; ?>

<? include "../block/footer.php"; ?>