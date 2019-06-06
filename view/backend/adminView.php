<?php $headTitle = 'Espace Admin'; ?>
<?php $titleH1 = 'Espace Admin'; ?>

<?php ob_start(); ?>


<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>