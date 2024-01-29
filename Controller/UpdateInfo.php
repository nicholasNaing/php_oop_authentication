<?php
    include_once "UserContr.class.php";
    class UpdateInfo extends UserContr{
    private $u_name;
    private $u_email;
    private $u_pwd;
    private $u_pwd_repeat;
    private $u_bd;
    private $cur_email;
    public function __construct($u_name,$u_email,$u_pwd,$u_pwd_repeat,$u_bd,$cur_email){
        $this->u_name = $u_name;
        $this->u_email = $u_email;
        $this->u_pwd = $u_pwd;
        $this->u_pwd_repeat = $u_pwd_repeat;
        $this->u_bd = $u_bd;
        $this->cur_email = $cur_email;

        // calling the method 
        $this->final_verdict();
    }
    private function empty_or_not(){
        if(empty($this->u_name) || empty($this->u_email) || empty($this->u_pwd) || empty($this->u_pwd_repeat) || empty($this->u_bd)){
            return false;
        }else{
            return true;
        }
    }
    private function confirm_pwd(){
        if($this->u_pwd == $this->u_pwd_repeat){
            return true;
        }else{
            return false;
        }
    }
    private function email_pwd_regex(){
        $email_pattern = "/^[a-zA-Z0-9._-]+@gmail\.com$/";
        $pwd_pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^a-zA-Z\d]).{6,}$/';

        $check_mail = preg_match($email_pattern,$this->u_email);
        $check_pwd = preg_match($pwd_pattern,$this->u_pwd);
        if($check_mail && $check_pwd){
            return true;
        }else{
            return false;
        }
    }
    private function final_verdict(){
        if($this->empty_or_not() && $this->confirm_pwd() && $this->email_pwd_regex()){
            $this->updateUser($this->u_name,$this->u_email,$this->u_pwd,$this->u_bd,$this->cur_email);
        }
    }   
}
?>