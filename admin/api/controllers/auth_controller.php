<?php

require_once('database_handler.php');
require_once('utils.php');

class AuthController {

    private $app;

    function __construct($app){
        $this->app = $app;
    }

    public function login($email, $password){
        if(empty($email) ||  empty($password)){
            return json_encode(array(
               "error" => true,
               "message" => "Missing data"
            ));
        }

        //Check database for email
        $dbh = new DatabaseHandler();
        $db = $dbh->getConnection();
        $query = $db->prepare("");
        $query->execute(array());

        if($query->rowCount() > 0){
           $user = $query->fetch();

            if(password_verify($email, $user['hash'])){
                $uid = uniqid();
                $_SESSION['uid'] = $uid;
                $info = array(
                    "uid" => $uid,
                    "email" => $email
                );

                //Save uid to user in db
                //$this->app->setCookie('nkk', json_encode($info));

                $util = new Utils();
                return $util->returnValidMessage("User Logged In");
            }
        }



    }

}