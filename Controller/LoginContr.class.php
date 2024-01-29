<?php 
    include_once "../includeClass.php";
    // Login Controller extending User Controller
    class LoginContr extends UserContr {
        // Public properties
        public $user_info;

        // Private properties
        private $u_email;
        private $u_pwd;
        private $all_users_data;

        // Constructor
        public function __construct($email, $pwd) {
            // Initialize properties
            $this->u_email = $email;
            $this->u_pwd = $pwd;
            $this->all_users_data = $this->getAllUsers();
            $this->user_info = $this->showUser($email);
        }

        // Private method for user authentication
        private function userAuth() {
            // Check if user info is available
            if ($this->user_info) {
                // Retrieve hashed password from the database
                $db_pwd = $this->user_info['Password'];
                
                // Verify the provided password with the hashed password
                if (password_verify($this->u_pwd, $db_pwd)) {
                    return true; // Authentication successful
                } else {
                    return false; // Authentication failed
                }
            } else {
                return false; // User not found
            }
        }

        // Public method to get the user info if authentication is successful
        public function passedUser() {
            // Check user authentication
            if ($this->userAuth()) {
                return $this->user_info; // Return user info if authentication is successful
            }
        }
    }
?>
