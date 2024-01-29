<?php 
    include_once "../includeClass.php";
    class User extends Db {
        
        // Method to insert a new user into the Users table
        protected function setUser($username, $email, $pwd, $bd) {
            $sql = "INSERT INTO Users(Username, Email, Password, Birthday) VALUES (?, ?, ?, ?)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $email, $pwd, $bd]);
        }

        // Method to retrieve all users from the Users table
        protected function getAllUsers() {
            $sql = "SELECT * FROM Users";
            $query = $this->connection()->query($sql);
            $result = $query->fetchAll();
            return $result;
        }

        // Method to retrieve a user by email from the Users table
        protected function getUser($email) {
            $sql = "SELECT * FROM Users WHERE Email = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            return $user;
        }

        // Method to update a user in the Users table
        protected function modifyUser($username, $email, $pwd, $bd, $cur_email) {
            $sql = "UPDATE Users SET Username = ?, Email = ?, Password = ?, Birthday = ? WHERE Email = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $email, $pwd, $bd, $cur_email]);
        }

        // Method to delete a user from the Users table
        protected function deleteUser($email) {
            $sql = "DELETE FROM Users WHERE Email = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$email]);
        }
    }
?>
