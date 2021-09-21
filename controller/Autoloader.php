<?php

class Autoloader{

    // Enregistre notre autoloader

    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    // Inclue le fichier correspondant à notre classe @param $class string Le nom de la classe à charger
    
    static function autoload($class){
        if (file_exists('controller/' . $class . '.php')) {
            require 'controller/' . $class . '.php';
        }
        elseif (file_exists('model/' . $class . '.php')) {
            require 'model/' . $class . '.php';
        }
        
    }

}
