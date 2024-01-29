<?php
    include_once "../includeClass.php";
// UserContr class extending User model
class UserContr extends User {
    // Protected method to create a new user
    protected function createUser($username, $email, $pwd, $bd) {
        // Call the setUser method from the parent User class
        $this->setUser($username, $email, $pwd, $bd);
    }

    // Public method to update an existing user
    public function updateUser($username, $email, $pwd, $bd, $cur_email) {
        // Call the modifyUser method from the parent User class
        $this->modifyUser($username, $email, $pwd, $bd, $cur_email);
    }

    // Public method to get all users
    public function getAllUsers() {
        // Call the getAllUsers method from the parent User class
        return parent::getAllUsers();
    }

    // Public method to get user details by email
    public function showUser($email) {
        // Call the getUser method from the parent User class
        return $this->getUser($email);
    }

    // Public method to remove a user by email
    public function removeUser($email) {
        // Call the deleteUser method from the parent User class
        return $this->deleteUser($email);
    }
}
?>
