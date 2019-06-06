<?php

$logo = IMGLOGO;
$alt = IMGLOGOALT;
$pseudoWelcome = '';
if(isset($_SESSION['idUser']) && isset($_SESSION['pseudo']) && isset($_SESSION['admin']))
{
    $pseudoWelcome = $_SESSION['pseudo'];
}
echo <<<EOT

<header>
    <div class="blackLine">
    	<div>
    		<a href='$biographie' alt="Biographie de Jean Forteroche">Jean Forteroche</a>
    		<hr>
    	</div>
        <p id="bienvenuePseudo" class="$pseudoHome"></p>
    	<div>
    		<div id='btnSpanMenuHeader'>
    			<a href='$pHome' alt="Accueil"><span class="$iconHome"></span></a>
    			<a href='$pEpisode' alt="les épisodes"><span class="$iconBook"></span></a>
    			<a href='$pConnect' alt="Espace connexion"><span id="linkConnect" class="$iconConnexion"></span></a>
    		</div>
    		<div id='titleMenuHeader'>
    			<p id="one">Accueil</p>
    			<p id="two">Episode</p>
    			<p id="three">login</p>
    		</div>
    		<div id="barreMenuHeader">
    			<div id="four"></div>
    			<div id="five"></div>
    			<div id="six"></div>
    		</div>
    	</div>
    </div>
    <div id="logo">
    	<img src="$logo" alt="$alt"/>
    </div>
	<div class="blackLine">
		<span class="$iconDown"></span>
	</div>
</header>
EOT;
