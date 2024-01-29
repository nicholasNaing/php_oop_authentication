<?php 
    include_once "Db.class.php";

    class User extends Db{
        protected function setUser($username,$email,$pwd,$bd){
            
            $sql = "INSERT INTO Users(Username,Email,Password,Birthday) VALUES (?,?,?,?)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username,$email,$pwd,$bd]);
        }
        protected function getAllUsers(){
            $sql = "SELECT * FROM Users";
            $query = $this->connection()->query($sql);
            $result = $query->fetchAll();
            return $result;
        }
        protected function getUser($email){
            $sql = "SELECT * FROM Users WHERE Email = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            return $user;
        }
        protected function modifyUser($username,$email,$pwd,$bd,$cur_email,){
            $sql = "UPDATE Users SET Username = ?, Email = ?, Password = ?, Birthday = ? WHERE Email = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username,$email,$pwd,$bd,$cur_email]);
        }
        protected function deleteUser($email){
            $sql = "DELETE FROM Users WHERE Email = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$email]);
        }
    }
?>