<?php

	class BuildDivEpisode{

		
		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
	  	 private $_extractEpisode;
	  	 private $_episode;
		 private $_title;
	  	 private $_publication;
	 	 private $_linkEpisode;
	 	 private $_linkEpisodePrev;
	 	 private $_linkEpisodeNext;

		// **************************************************
		// Methode
		// **************************************************

	 	 public function __construct($aData){
	 	 	foreach ($aData as $key => $value){
	 	 		$method = 'set'.ucfirst($key);
	 	 		if(method_exists($this, $method)){
	 	 			$this->$method($value);
	 	 		}
	 	 	}
	 	 	//self::build($aIcon, $img, '');
	 	 }

	 	 public function buildThumbnail($icon, $img, $link){
	 	 	$div = <<<EOT
	 	 	<div id='bkgEpisodeExtrait'>

	 	 		<div id='scotch'> 
	 	 			<img src="$img" alt="">
	 	 		</div>

 	 			<div id="titleEpisodeExtract">
 	 				<h2>$this->_title</h2>
 	 			</div>
 	 			<hr>
 	 			<div id='episodeExtract'>
 	 				<p>$this->_extractEpisode</p>
 	 			</div>

 	 			<div id='datePublication'>
 	 				<div>
 	 					<p>Publié le $this->_publication</p>
 	 					<span class='$icon'>
 	 				</div>
 	 				<div id='readMore'>
 	 					<a href='$link'>Lire la suite ...</a>
 	 				</div>
 	 			</div>
	 	 	</div>
EOT;

			return $div;
	 	}

	 	public function build($icon, $img){
	 	 	$div = <<<EOT
	 	 	<div id="globalEpisode">
		 	 	<div id='bkgEpisode'>

		 	 		<div id='scotch'> 
		 	 			<img src="$img" alt="">
		 	 		</div>
	 	 			<hr>
	 	 			<div id='episode'>
	 	 				<p>$this->_episode</p>
	 	 			</div>

	 	 			<div id='datePublication'>

EOT;
			if($this->_linkEpisodePrev != '')
			{
				$div .=<<<EOT
	 	 			 	<div>
	 	 					<a href='episode.php?id=$this->_linkEpisodePrev'>Précédent</a>
	 	 				</div>

EOT;
			}else
			{
				$div .=<<<EOT
						<div>
						</div>
EOT;
			}
			$div .= <<<EOT
						<div>
	 	 					<p>Publié le $this->_publication</p>
	 	 					<span class='$icon'></span>
	 	 				</div>

EOT;
			if($this->_linkEpisodeNext != '')
			{
				$div .=<<<EOT
	 	 				<div>
	 	 					<a href='episode.php?id=$this->_linkEpisodeNext'>Suivant</a>
	 	 				</div>

EOT;
			}else
			{
				$div .= <<<EOT
						<div>
						</div>
EOT;
			}
			$div .= <<<EOT
				 	</div>
		 	 	</div>
		 	 </div>
EOT;

			return $div;
	 	}



		// **************************************************
		// SETTERS
		// **************************************************
		
		/** Extrait de l'épisode */
		public function setExtractEpisode($extractEpisode)
		{
			$this->_extractEpisode = $extractEpisode;
		}

				/** Extrait de l'épisode */
		public function setEpisode($episode)
		{
			$this->_episode = $episode;
		}
		
		/** Titre de l'épisode */
		public function setTitle($title)
		{
			$this->_title = $title;
		}
		
		/** Dat de le publication */
		public function setPublication($publication)
		{
			$this->_publication = $publication;
		}
		
		/** lien de l'épisode au complet*/
		public function setLinkEpisode($linkEpisode) {
			$this->_linkEpisode = $linkEpisode;
		}
				/** lien de l'épisode au complet*/
		public function setLinkEpisodePrev($linkEpisodePrev) {
			$this->_linkEpisodePrev = $linkEpisodePrev;
		}
				/** lien de l'épisode au complet*/
		public function setLinkEpisodeNext($linkEpisodeNext) {
			$this->_linkEpisodeNext = $linkEpisodeNext;
		}
	}
	