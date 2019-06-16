	 	 <?php $headTitle = 'La saga complète'; ?>
	 	 <?php $titleH1 = 'La saga complète'; ?>

	 	 <?php ob_start(); ?>


	 	<section id='containtExtract'>	
	 	 	<?php for ($i = 0 ; $i < count($aEpisodeExtract) ; $i++)
			{
			?>
	 	 	<article class='bkgEpisodeExtrait'>

	 	 		<div class='scotch'> 
	 	 			<img src="public/img/scotch.png" alt="un morceau de scotch qui tient l'épisode">
	 	 		</div>

 	 			<div class="titleEpisodeExtract">
 	 				<h2><?= $aEpisodeExtract[$i]['title'] ?></h2>
 	 			</div>
 	 			<hr>
 	 			<div class='episodeExtract'>
 	 				<p><?= $aEpisodeExtract[$i]['episode'] ?></p>
 	 			</div>

 	 			<div class='datePublication'>
 	 				<div>
 	 					<p>Publié le <?= $aEpisodeExtract[$i]['publication']; ?></p>
 	 					<span class="fas fa-thumbtack"></span>
 	 				</div>
 	 				<div class='readMore'>
 	 					<a href= "index.php?action=ShowEpisode&amp;idEpisode=<?= $aEpisodeExtract[$i]['id'] ?>" >Lire la suite ...</a>
 	 				</div>
 	 			</div>
	 	 	</article>
	 	 	<?php 
	 	 	}
	 	 	?>
	 	 </section>
	 	 <?php $content = ob_get_clean(); ?>
	 	 <?php require('view/template.php'); ?>