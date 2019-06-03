<?php


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

		<div id='messageAdmin'>
			$containAdminMessage
		</div>

		<div id='containtAdmin'>
			$containAdminEpisode
		</div>
		<div id='containtAdminComment'>
			$containAdminComment
		</div>
		<div id='containtAdminMessage'>
		$containAdminMessagePlace
		</div>
		<div id="containtSpace">
			$containSpace
		</div>

	</div>
EOT;
