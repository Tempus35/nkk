<?php

require_once(dirname(dirname(dirname(__FILE__))) . '/config/db_config.php');

class DatabaseHandler{

    public function getConnection(){
        $dbh = new PDO("mysql:host=". SQLHOST . ";dbname=" . SQLDB ."", SQLUSER, SQLPASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }

}