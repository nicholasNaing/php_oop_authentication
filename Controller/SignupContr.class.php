<?php
include_once "UserContr.class.php";

class SignupContr extends UserContr{
    private $u_name;
    private $u_email;
    private $u_pwd;
    private $u_pwd_repeat;
    private $u_bd;
    public function __construct($u_name,$u_email,$u_pwd,$u_pwd_repeat,$u_bd){
        $this->u_name = $u_name;
        $this->u_email = $u_email;
        $this->u_pwd = $u_pwd;
        $this->u_pwd_repeat = $u_pwd_repeat;
        $this->u_bd = $u_bd;

        // calling the method 
        $this->final_verdict();
    }
    private function empty_or_not(){
        if(empty($this->u_name) || empty($this->u_email) || empty($this->u_pwd) || empty($this->u_pwd_repeat) || empty($this->u_bd)){
            echo "<div class='absolute w-screen text-center py-1 bg-slate-100 text-red-500 text-md font-bold'>Fields cannot be empty</div>";
            return false;
        }else{
            return true;
        }
    }
    private function confirm_pwd(){
        if($this->u_pwd == $this->u_pwd_repeat){
            return true;
        }else{
            echo "<div class='absolute w-screen text-center py-1 bg-slate-100 text-red-500 text-md font-bold'>Your passwords are not match</div>";
            return false;
        }
    }
    private function email_not_exist(){
        $email_exist = $this->showUser($this->u_email);
        if($email_exist){
            echo "<div class='absolute w-screen text-center py-1 bg-slate-100 text-red-500 text-md font-bold'>Your email is already used to create an account</div>";
            return false;
        }else {
            return true;
        }
    }
    private function email_pwd_regex(){
        $email_pattern = "/^[a-zA-Z0-9._-]+@gmail\.com$/";
        $pwd_pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^a-zA-Z\d]).{6,}$/';

        $check_mail = preg_match($email_pattern,$this->u_email);
        $check_pwd = preg_match($pwd_pattern,$this->u_pwd);
        if($check_mail){
            if($check_pwd){
                return true;
            }else{
                echo "<div class='absolute w-screen text-center py-1 bg-slate-100 text-red-500 text-md font-bold'>password must include one uppercase, one lowercase, one number, one special characters and should be at least 6 characters</div>";
                return false;
            }
        }else{
            echo "<div class='absolute w-screen text-center py-1 bg-slate-100 text-red-500 text-md font-bold'>Input a correct email</div>";
            return false;
        }
    }
    private function final_verdict(){
        if($this->empty_or_not() && $this->confirm_pwd() && $this->email_pwd_regex() && $this->email_not_exist()){
            $hashed_pwd = password_hash($this->u_pwd,PASSWORD_DEFAULT);
            echo "<div class='absolute w-screen text-center py-1 bg-green-500 text-white text-md font-bold'>Account registration is completed</div>";
            $this->createUser($this->u_name,$this->u_email,$hashed_pwd,$this->u_bd);
        }
    }   
}