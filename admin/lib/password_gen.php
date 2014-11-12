<?php

require_once("password.php");

echo password_hash($_GET['password'], PASSWORD_BCRYPT, array("cost" => 12));