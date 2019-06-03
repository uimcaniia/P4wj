<!doctype html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="description" content="VéLyon, ça ne marche pas, ça roule! On vous aide à la réservation de votre vélo dans toutes les stations de Lyon! Pratique, facile à utiliser, cette application vous facilite vos locations et vous permet de repérer les vélos disponible en temps réel!"> 

        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        <link rel="icon" href="img/notice/img1.png" />
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/tablette.css"/>
        <link rel="stylesheet" href="css/mobile.css"/>	

    	<title>Jean Forteroche</title>
    </head>

    <body>

    	<?php

if (!isset($_POST['mot_de_passe']) OR $_POST['mot_de_passe'] != "kangourou"){
	?>
	        <form method="post" action="formulaire.php">
            <input type="text" name="mdp">
            <input type='submit' value="valider"/>
            <p>Mot de passe incorrect</p>

        </form>
        <?php
}else{
	?>
	        <h1>Voici les codes d'accès :</h1>
        <p><strong>CRD5-GTFT-CK65-JOPM-V29N-24G1-HH28-LLFV</strong></p>  
        <?php
}

        

    ?>





    </body>
</html>



