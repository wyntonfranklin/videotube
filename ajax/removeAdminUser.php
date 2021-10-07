<?php
require_once("../includes/config.php");
require_once("../includes/classes/Helper.php");
require_once("../includes/classes/User.php");

$username = $_POST['username'];


if($username){
    $user = new User($con, $username);
    $user->removeUser();
}