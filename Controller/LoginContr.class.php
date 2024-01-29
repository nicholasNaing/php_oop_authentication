<?php 
    include_once "UserContr.class.php";
    class LoginContr extends UserContr{
        public $user_info;
        private $u_email;
        private $u_pwd;
        private $all_users_data;

        public function __construct($email,$pwd){
            $this->u_email = $email;
            $this->u_pwd = $pwd;
            $this->all_users_data = $this->getAllUsers();
            $this->user_info = $this->showUser($email);
        }

        private function userAuth(){
            if($this->user_info){
                $db_pwd = $this->user_info['Password'];
                if(password_verify($this->u_pwd,$db_pwd)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        public function passedUser(){
            if($this->userAuth()){
                return $this->user_info;
            }
        }
    }