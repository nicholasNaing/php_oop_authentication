<?php
    include_once "../Model/User.class.php";
    class UserContr extends User{
        protected function createUser($username,$email,$pwd,$bd){
            $this->setUser($username,$email,$pwd,$bd);
        }
        public function updateUser($username,$email,$pwd,$bd,$cur_email){
            $this->modifyUser($username,$email,$pwd,$bd,$cur_email);
        }
        public function getAllUsers(){
            return parent::getAllUsers();
        }
        public function showUser($email){
            return $this->getUser($email);
        }
        public function removeUser($email){
            return $this->deleteUser($email);
        }
    }
?>