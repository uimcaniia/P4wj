<?php

# Lecture du fichier de configuration commune
require_once("../mainConfig.php");

echo <<<EOT
	
	<div id="bckBody">

		<div id="titlePage">
			<h1>$titleH1</h1>
			<img src="$imgTitle" alt="petits flocon">
		</div>
		<div id="barre">
			<hr>
			<hr>
		</div>

		<div id="containtChapitre">
			$chapitre
		</div>
		<div id="containtComment">
			$comments
		</div>


	</div>
EOT;
