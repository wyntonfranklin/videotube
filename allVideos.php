<?php
require_once("includes/header.php");
require_once("includes/classes/AllVideosProvider.php");

$allVidsProvider = new AllVideosProvider($con, $userLoggedInObj);

$videos = $allVidsProvider->getVideos();

$videoGrid = new VideoGrid($con, $userLoggedInObj);
$gridDeleteStatus = User::isLoggedIn();
$videoGrid->setGridDeletable($gridDeleteStatus);
?>

    <div class="largeVideoGridContainer">
        <?php
        if(sizeof($videos) > 0) {
            echo $videoGrid->createLarge($videos, "All videos every uploaded", false);
        } else {
            echo "No videos to show";
        }
        ?>
    </div>

<?php
require_once("includes/footer.php");
?>