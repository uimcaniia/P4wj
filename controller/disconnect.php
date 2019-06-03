<?php
# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');

echo 'Vous êtes déconnecté';
$_SESSION = array();
session_destroy();
header ( 'Location: home.php');

