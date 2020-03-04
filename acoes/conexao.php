<?php
class Conexao{
    private static $instance;

    public static function conecta(){

        if(!isset(self::$instance)){
            self::$instance = new PDO('mysql:host=localhost;dbname=sistema', 'root', '');

        }
        return self::$instance;
    }
}