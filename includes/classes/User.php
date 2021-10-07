<?php
class User {

  private $con, $sqlData;

  public function __construct($con, $username) {
    $this->con = $con;

    $query = $this->con->prepare("SELECT * FROM users WHERE username = :un");
    $query->bindParam(":un", $username);
    $query->execute();

    // Get the results as an associative array
    $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
  }

  public static function isLoggedIn() {
    return isset($_SESSION["userLoggedIn"]);
  }

  public function getUserId(){
    return $this->sqlData["id"];
  }

  public function getUsername() {
    if(isset($this->sqlData["username"])){
      return $this->sqlData["username"];
    }
    return "NA";
  }

  public function getName() {
    if(isset($this->sqlData["firstName"])){
      return $this->sqlData["firstName"] . " " . $this->sqlData["lastName"];
    }
    return "NA";
  }

  public function getRole(){
    return $this->sqlData["role"];
  }

  public function getFirstName() {
    return $this->sqlData["firstName"];
  }

  public function getLastName() {
    return $this->sqlData["lastName"];
  }

  public function getEmail() {
    return $this->sqlData["email"];
  }

  public function getProfilePic() {
    return $this->sqlData["profilePic"];
  } 
  
  public function getSignUpDate() {
    return $this->sqlData["signUpDate"];
  }

  public function isSubscribedTo($userTo) {
    $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
    $query->bindParam(":userTo", $userTo);
    $query->bindParam(":userFrom", $username);
    $username = $this->getUsername();
    $query->execute();

    return $query->rowCount() > 0;
  }

  public function getSubscriberCount() {
    $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
    $query->bindParam(":userTo", $username);
    $username = $this->getUsername();
    $query->execute();

    return $query->rowCount();
  }

  public function getSubscriptions() {
    $query = $this->con->prepare("SELECT userTo FROM subscribers WHERE userFrom=:userFrom");
    $username = $this->getUsername();
    $query->bindParam(":userFrom", $username);
    $query->execute();

    $subs = array();
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $user = new User($this->con, $row["userTo"]);
      array_push($subs, $user);
    }
    return $subs;

  }

  public function updateDetails($userId, $firstname, $lastname, $email, $role, $password) {
    if($password){
      $query = $this->con->prepare("UPDATE users SET firstname=:firstname, 
                 lastname=:lastname, email=:email, role=:role, password=:password WHERE id=:userId");
    }else{
      $query = $this->con->prepare("UPDATE users SET firstname=:firstname, 
                 lastname=:lastname, email=:email, role=:role WHERE id=:userId");
    }
    $query->bindParam(":firstname", $firstname);
    $query->bindParam(":lastname", $lastname);
    $query->bindParam(":email", $email);
    $query->bindParam(":role", $role);
    if($password){
      $pw = hash("sha512", $password);
      $query->bindParam(":password", $pw);
    }
    $query->bindParam(":userId", $userId);
    return $query->execute();
  }

  public function removeUser() {
    $query = $this->con->prepare("DELETE FROM users WHERE username=:username");
    $query->bindParam(":username", $this->getUsername());
    return $query->execute();
  }


}
?> 