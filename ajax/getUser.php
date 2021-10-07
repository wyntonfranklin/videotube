<?php
require_once("../includes/config.php");
require_once("../includes/classes/Helper.php");
require_once("../includes/classes/Comment.php");
require_once("../includes/classes/User.php");

$userId = $_GET["id"];
$username = $_GET['username'];


$user = new User($con, $username);

Helper::jsonResponse("good","all good",[
    'username' => $user->getUsername(),
    'firstname' => $user->getFirstName(),
    'lastname' => $user->getLastName(),
    'email' => $user->getEmail(),
    'role' => $user->getRole(),
    'userid' => $user->getUserId()
]);