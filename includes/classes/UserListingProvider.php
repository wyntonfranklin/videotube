<?php

class UserListingProvider
{
    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getUsersAsArray() {
        $users = array();

        $query = $this->con->prepare("SELECT * FROM users ORDER BY id");

        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = $row;
            array_push($users, $row);
        }

        return $users;
    }
}