<?php
require_once("../includes/config.php");
require_once("../includes/classes/Helper.php");
require_once("../includes/classes/User.php");
require_once("../includes/classes/Account.php");


$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$role = $_POST['role'];
$id = $_POST["userid"];
$password = isset($_POST['password']) ? $_POST["password"] : null;


if($id){
    $user = new User($con, $username);
    $user->updateDetails($id, $firstname, $lastname,$email,$role, $password);
}else{
    $account = new Account($con);
    $pw = hash("sha512", $password);
    if($username && $firstname && $lastname && $email && $password){
        $wasSuccessful = $account->insertUserDetails($firstname, $lastname, $username, $email,  $pw);
    }
}