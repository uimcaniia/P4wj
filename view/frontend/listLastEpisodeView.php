	 	 <?php $headTitle = 'Liste des derniers articles'; ?>
	 	 <?php $titleH1 = 'Les derniers articles'; ?>
	 	 <?php $metaDes = 'Retrouver tous les derniers épisodes de la saga \'Un billet simple pour l\'Alaska\' par Jean Forteroche'; ?>

	 	 <?php ob_start(); ?>


	 	<div id='containtExtract'>	
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
 	 				<p><?= strip_tags( html_entity_decode($aEpisodeExtract[$i]['episode']))?></p>
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
	 	 </div>
	 	 
	 	 <?php $content = ob_get_clean(); ?>
	 	 <?php require('view/template.php'); ?>