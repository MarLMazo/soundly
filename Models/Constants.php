<?php

    class Constants {

        //available publically
        //static means you dont have to create an instance of the class

        //registration error messages
        public static $passwordCharacters = "Your password must be between 5 and 30 characters";
        public static $emailInvalid = "Your email must be a valid email.";
        public static $emailTaken = "This email is already in use. Choose another email.";
        public static $firstNameCharacters = "Your first name must be between 2 and 25 characters.";
        public static $lastNameCharacters = "Your last name must be between 2 and 25 characters.";
        public static $usernameCharacters = "Your username must be between 5 and 25 characters.";
        public static $usernameTaken = "This username is already in use. Choose another username.";

        //login error message
        public static $loginFailed = "Your username or password was incorrect";



    }

?>