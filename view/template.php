<!doctype html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui"> 
<!--         <meta $metaDescription>   -->

        <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link $headIcon />

        <script src="public/js/jquery.js"></script>
        <script src="public/js/frontend/anim.js"></script>
  <script src="https://cdn.tiny.cloud/1/srz41u49mvl7063mbtpqe2wb8l1hn1vvc2b6oo14kzrf96nq/tinymce/5/tinymce.min.js"></script>
  <script>tinymce.init({selector:'textarea'});</script>

        <link href="public/css/style.css" rel="stylesheet"/>
        <link href="public/css/tablette.css" rel="stylesheet"/>
        <link href="public/css/mobile.css" rel="stylesheet"/>

    	<title><?= $headTitle ?></title>
    </head>
    <body>
        <header>
            <div class="blackLine">
                <div>
                    <a href='$biographie' alt="Biographie de Jean Forteroche">Jean Forteroche</a>
                    <hr>
                </div>
                    <?php
                        if(isset($_SESSION['idUser']) && isset($_SESSION['pseudo']) && isset($_SESSION['admin']))
                        {
                            $iconConnexion = "fas fa-power-off";
                            $pConnect = 'index.php?action=disconnect';
                            $pseudoHome = $_SESSION['pseudo'];
                        }
                        else
                        {
                            $iconConnexion = "fas fa-user";
                            $pConnect = 'index.php?action=login';
                            $pseudoHome = '';
                        }
                    ?>
                <p id="bienvenuePseudo" class="<?= $pseudoHome ?>"></p>
                <div>
                    <nav id='btnSpanMenuHeader'>
                        <a href='index.php?action=listLastEpisode' alt="Accueil"><span class="fas fa-home"></span></a>
                        <a href='index.php?action=extractAllEpisode' alt="les épisodes"><span class="fas fa-book-open"></span></a>
                        <a href='<?= $pConnect?>' alt="Espace connexion"><span id="linkConnect" class="<?= $iconConnexion ?>"></span></a>
                    </nav>
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
                <img src="public/img/logo.png" alt="Logo de Jean Forteroche"/>
            </div>
            <div class="blackLine">
                <span class="fas fa-angle-double-down"></span>
            </div>
        </header>

        <div id="bckBody">
            <div id="titlePage">
                <h1><?= $titleH1 ?></h1>
                <img src="public/img/flocon.png" alt="petits flocon">
            </div>
            <div id="barre">
                <hr>
                <hr>
            </div>
            <?= $content ?>
            </div>

        <footer>
            <div class="blackLine">
            </div>
        </footer>

        <script src="public/js/frontend/animMenu.js"></script>
        <script src="public/js/frontend/signal.js"></script>
        <script src="public/js/frontend/comment.js"></script>
        <script src="public/js/backend/actualize.js"></script>
        <script src="public/js/backend/adminEpisode.js"></script>
        <script src="public/js/backend/adminComment.js"></script>
        <script src="public/js/backend/adminMessage.js"></script>

        
    </body>
</html>

