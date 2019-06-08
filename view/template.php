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

        <script type="text/javascript" src="public/js/tiny/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">tinyMCE.init({
            mode : "exact", 
            elements : "blockWriteEpisodeModif, blockWriteEpisode",
            theme : "advanced",

            plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
  
            // les outils à afficher
            theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
            theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
              
            // emplacement de la toolbar
            theme_advanced_toolbar_location : "top",
            // alignement de la toolbar
            theme_advanced_toolbar_align : "left",
            // positionnement de la barre de statut
            theme_advanced_statusbar_location : "bottom",
            // permet de redimensionner la zone de texte
            theme_advanced_resizing : true,
              
            // chemin vers le fichier css
            content_css : " ./design-tiny.css,",
            // taille disponible
            theme_advanced_font_sizes: "10px,11px,12px,13px,14px,15px,16px,17px,18px,19px,20px,21px,22px,23px,24px,25px",
            // couleur disponible dans la palette de couleur
            theme_advanced_text_colors : "33FFFF, 007fff, ff7f00",
            // balise html disponible
            theme_advanced_blockformats : "h1, h2,h3,h4,h5,h6",
            // class disponible
            theme_advanced_styles : "Tableau=textTab;TableauSansCadre=textTabSansCadre;",
            // possibilité de définir les class et leurs styles directement avec le code suivant
            
            style_formats : [
                {title : 'Bold text', inline : 'b'},
                {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                {title : 'Example 1', inline : 'span', classes : 'example1'},
                {title : 'Example 2', inline : 'span', classes : 'example2'},
                {title : 'Table styles'},
                {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
            ],}); </script>

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

