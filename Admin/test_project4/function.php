<?php
session_start();

class Connection{
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $db_name = "organic";
    public $conn;

    public function __construct(){
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
    }
}

class Register extends Connection {
    public function registration($name, $email, $password, $confirmpassword, $mobile) {
        $validationResult = $this->validateRegistration($name, $email, $password, $confirmpassword, $mobile);
    
        if ($validationResult !== true) {
            return $validationResult;
        }
    
        $duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE Email = '$email'");
        if (mysqli_num_rows($duplicate) > 0) {
            return 10; //  email has already been taken
        } else {
            $ruleId = 3;
            $query = "INSERT INTO `users` (`Name`, `Email`, `Password`, `Mobile`, `rule`) VALUES ('$name','$email','$password','$mobile',$ruleId)";
            mysqli_query($this->conn, $query);
            return 1; // Registration successful
        }
        }
        private function validateRegistration($name, $email, $password, $confirmpassword, $mobile) {
            // Perform validation checks
            if (empty($name) || empty($email) || empty($password) || empty($confirmpassword) ||empty($mobile)) {
                return "Please fill in all the required fields.";
            }
        
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email format.";
            }
        
            if ($password !== $confirmpassword) {
                return "Password does not match.";
            }
        
            return true; // Validation passed
            }
    }
    
    class Login extends Connection{
    public $id;
    public function login($email, $password){
        $result = mysqli_query($this->conn, "SELECT * FROM users WHERE  Email = '$email'");
        $row = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) > 0){
        if($password == $row["Password"]){
            $this->id = $row["id"];
            return 1;
            // Login successful
        }
        else{
            return 10;
            // Wrong password
        }
        }
        else{
        return 100;
        // User not registered
        }
    }

    public function idUser(){
    return $this->id;
    }
}

//  retrieves a user record from the users table based on the provided $id. 
class Select extends Connection{
    public function selectUserById($id){
        $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id = $id");
        return mysqli_fetch_assoc($result);
    }
}