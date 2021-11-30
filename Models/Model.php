<?php

    abstract  class  Model{
        private static $pdo;

        private static function setbdd(){
            self::$pdo=new PDO("mysql:host=localhost;dbname=biblio;charset=utf8",'root','');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }

        protected function getbdd(){
            if(self::$pdo===null){
                self::setbdd();
            }
            return self::$pdo;
        }

}