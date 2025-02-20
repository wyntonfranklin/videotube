<?php

error_reporting(E_ALL & ~E_NOTICE);

require_once("includes/config.php"); 
require_once("includes/classes/ButtonProvider.php"); 
require_once("includes/classes/User.php"); 
require_once("includes/classes/Video.php");
require_once("includes/classes/VideoGrid.php");
require_once("includes/classes/VideoGridItem.php");
require_once("includes/classes/SubscriptionsProvider.php");
require_once("includes/classes/NavigationMenuProvider.php");

$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "John Doe";
$userLoggedInObj = new User($con, $usernameLoggedIn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>VideoTube</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/commonActions.js"></script>
<script src="assets/js/userActions.js"></script>
</head>
<body>

<div id="pageContainer">
  <div id="mastHeadContainer">
    <button class="navShowHide">
      <img src="assets/images/icons/menu.png">
    </button>
    <a class="logoContainer" href="index.php">
      <img src="assets/images/icons/VideoTubeLogo.png" title="Logo" alt="Site logo">
    </a>

    <div class="searchBarContainer">
      <form action="search.php" method="GET">
        <input type="text" class="searchBar" name="term" placeholder="Search">
        <button class="searchButton">
        <img src="assets/images/icons/search.png">
        </button>
      </form>
    </div>
    <div class="rightIcons">
        <?php if(ANONYMOUS_POSTING== true || User::isLoggedIn()  ):?>
          <a href="upload.php">
            <img class="upload" src="assets/images/icons/upload.png">
          </a>
        <?php endif;?>
      <?php 
        echo ButtonProvider::createUserProfileNavigationButton($con, $userLoggedInObj->getUsername());
      ?>
    </div>

  </div>
  <div id="sideNavContainer" style="display:none;">
    <?php 
    $navigationProvider = new NavigationMenuProvider($con, $userLoggedInObj);

    echo $navigationProvider->create();
    ?>
  </div>
  <div id="mainSectionContainer">
    <div id="mainContentContainer">
    