<?php



echo <<<EOT
<!doctype html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8">
        <meta $metaViewport> 
        <meta $metaDescription>  

        <link $headFont >
        <link $headFontAwesome >
        <link $headIcon />
        <link href="$css" rel="stylesheet"/>
        <link $headStyleCssTablette />
        <link $headStyleCssMobile />

        <script src="$jquery"></script>
        <script src="$anim"></script>
        <script src="$editeur"></script>
    	<title>$headTitle</title>
    </head>
EOT;


