<?php

function loadClass($class) {
    require 'model/' .$class . '.php'; // inclut la classe passée en paramètre
    }

    spl_autoload_register('loadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.


