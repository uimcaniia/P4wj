	 	 <?php $headTitle = 'La saga complète'; ?>
	 	 <?php $titleH1 = htmlspecialchars($aEpisode[0]['title']); ?>

	 	 <?php ob_start(); ?>

	 	 	<section id="containtChapitre">
		 	 	<div id='bkgEpisode'>
		 	 		<div class='scotch'> 
		 	 			<img src="public/img/scotch.png" alt="un morceau de scotch qui tient l'épisode">
		 	 		</div>
	 	 			<hr>
	 	 			<div id='episode'>
	 	 				<p><?= htmlspecialchars($aEpisode[0]['episode']); ?></p>
	 	 			</div>

	 	 			<div class='datePublication'>
	 	 				<div>
			<?php 
			if($linkEpisodePrev != '')
			{
			?> 	
	 	 					<a href='index.php?action=ShowEpisode&amp;idEpisode=<?= $linkEpisodePrev ?>'>Précédent</a>
			<?php 
			}
			?>
						</div>
						<div>
	 	 					<p>Publié le <?= $aEpisode[0]['publication'] ?></p>
	 	 					<span class='fas fa-thumbtack'></span>
	 	 				</div>
	 	 				<div>
			<?php 
			if($linkEpisodeNext != '')
			{
			?>
	 	 					<a href='index.php?action=ShowEpisode&amp;idEpisode=<?= $linkEpisodeNext ?>'>Suivant</a>
	 	 				

	 	 	<?php
			}
			?>

						</div>
				 	</div>
		 	 	</div>
		 	 </section>
		 	 <section id='containtComment'>
		 <?php include ('commentView.php'); ?>
		</section>
	 	 <?php $content = ob_get_clean(); ?>
	 	 <?php require('view/template.php'); ?>