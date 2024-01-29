<?php
include_once "../includeClass.php";
// UpdateInfo class extending User Controller
class UpdateInfo extends UserContr {
    // Private properties
    private $u_name;
    private $u_email;
    private $u_pwd;
    private $u_pwd_repeat;
    private $u_bd;
    private $cur_email;

    // Constructor
    public function __construct($u_name, $u_email, $u_pwd, $u_pwd_repeat, $u_bd, $cur_email) {
        // Initialize properties
        $this->u_name = $u_name;
        $this->u_email = $u_email;
        $this->u_pwd = $u_pwd;
        $this->u_pwd_repeat = $u_pwd_repeat;
        $this->u_bd = $u_bd;
        $this->cur_email = $cur_email;

        // Call the method for processing and validation
        $this->final_verdict();
    }

    // Private method to check if fields are not empty
    private function empty_or_not() {
        if (empty($this->u_name) || empty($this->u_email) || empty($this->u_pwd) || empty($this->u_pwd_repeat) || empty($this->u_bd)) {
            return false;
        } else {
            return true;
        }
    }

    // Private method to check if passwords match
    private function confirm_pwd() {
        if ($this->u_pwd == $this->u_pwd_repeat) {
            return true;
        } else {
            return false;
        }
    }

    // Private method to check email and password against regex patterns
    private function email_pwd_regex() {
        $email_pattern = "/^[a-zA-Z0-9._-]+@gmail\.com$/";
        $pwd_pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^a-zA-Z\d]).{6,}$/';

        $check_mail = preg_match($email_pattern, $this->u_email);
        $check_pwd = preg_match($pwd_pattern, $this->u_pwd);

        if ($check_mail && $check_pwd) {
            return true;
        } else {
            return false;
        }
    }

    // Private method for the final validation and user update
    private function final_verdict() {
        // Check all conditions
        if ($this->empty_or_not() && $this->confirm_pwd() && $this->email_pwd_regex()) {
            // Update the user
            $this->updateUser($this->u_name, $this->u_email, $this->u_pwd, $this->u_bd, $this->cur_email);
        }
    }
}
?>
