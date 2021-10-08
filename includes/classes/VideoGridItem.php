<?php
class VideoGridItem {

  private $video, $largeMode;
  private $canDelete = false;

  public function __construct($video, $largeMode) {
    $this->video = $video;
    $this->largeMode = $largeMode;
  }

  public function setItemAsDeletable($val){
        $this->canDelete = $val;
  }


  public function create() {
    $thumbnail = $this->createThumbnail();
    $details = $this->createDetails();
    $url = "watch.php?id=" . $this->video->getId();

    $o = "<a href='$url'>
              <div class='videoGridItem'>
                $thumbnail
                $details";
    if($this->canDelete && User::isUserAdmin()){
        $o .= "<div style='float: right'>Delete</div>";
    }
    $o .= "</div></a>";
    return $o;
  }

  private function createThumbnail() {
    $thumbnail = $this->video->getThumbnail();
    $duration = $this->video->getDuration();

    return "<div class='thumbnail'>
              <img src='$thumbnail'>
              <div class='duration'>
                <span>$duration</span>
              </div>
            </div>";
  }

  private function createDetails() {
    $title = $this->video->getTitle();
    $username = $this->video->getUploadedBy();
    $views = $this->video->getViews();
    $description = $this->createDescription();
    $timestamp = $this->video->getTimeStamp();

    return "<div class='details'>
              <h3 class='title'>$title</h3>
              <span class='username'>$username</span>
              <div class='stats'>
                <span class='viewCount'>$views views - </span>
                <span class='timeStamp'>$timestamp</span>
              </div>
              $description
            </div>";
  }

  private function createDescription() {
    if(!$this->largeMode) {
      return "";
    }
    else {
      $description = $this->video->getDescription();
      $description = (strlen($description) > 350) ? substr($description, 0, 347) . "..." : $description;
      return "<span class='description'>$description</span>";
    }
  }
}
?>