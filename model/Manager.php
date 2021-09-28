<?php

require_once 'config.php';

class Manager
{
    // Connexion bdd
    protected function dbConnect()
    {
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
        
        return $db;
        
    }
}