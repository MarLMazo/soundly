<?php
	class CAccount {

		private $con;
        private $errorArray;
        

        //run as soon as the class is initialized
		public function __construct(/*$con*/) {
			//$this->con = $con;
			$this->errorArray = array();
        }
        

/*
		public function login($username, $password) {

			$password = md5($password);

			$query = mysqli_query($this->con, "SELECT * FROM user_accounts WHERE username='$username' AND password='$password'");

			if(mysqli_num_rows($query) == 1) {
				return true;
			}
			else {
				array_push($this->errorArray, Constants::$loginFailed);
				return false;
			}

        }
        
*/

		public function register($username, $firstname, $lastname, $email, $password) {
			$this->validateUsername($username);
			$this->validateFirstName($firstname);
			$this->validateLastName($lastname);
			$this->validateEmail($email);
			$this->validatePassword($password);

            //if theres no errors in the array then...
			if(empty($this->errorArray) == true) {

				//Insert the info into the database
                return $this->insertUserDetails($username, $firstname, $lastname, $email, $password);
                //addUserInfo($firstname, $lastname, $email, $username, $password, $db);

            }
            
			else {

                return false;
                
			}

        }
        


		public function getError($error) {

			if(!in_array($error, $this->errorArray)) {

                $error = "";
                
            }
            
            return $error;
            
        }
        


		private function insertUserDetails($username, $firstname, $lastname, $email, $password) {

            $encryptedPw = md5($password);

            //con is the database connection
			$result = mysqli_query($this->con, "INSERT INTO user_accounts VALUES ($username', '$firstname', '$lastname', '$email', '$password')");

            return $result;
            
        }
        


		private function validateUsername($username) {

			if(strlen($username) > 25 || strlen($username) < 5) {
				array_push($this->errorArray, Constants::$usernameCharacters);
				return;
			}

			// $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM user_accounts WHERE username='$username'");
			// if(mysqli_num_rows($checkUsernameQuery) != 0) {
			//	array_push($this->errorArray, Constants::$usernameTaken);
			//	return;
			// }

        }
        


		private function validateFirstName($firstname) {

			if(strlen($firstname) > 25 || strlen($firstname) < 2) {
				array_push($this->errorArray, Constants::$firstNameCharacters);
				return;
            }
            
        }
        


		private function validateLastName($lastname) {

			if(strlen($lastname) > 25 || strlen($lastname) < 2) {

				array_push($this->errorArray, Constants::$lastNameCharacters);
				return;
            }
            
        }
        


		private function validateEmail($email) {

			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$emailInvalid);
				return;
            }
            
            

			// $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$email'");
			// if(mysqli_num_rows($checkEmailQuery) != 0) {
			//	array_push($this->errorArray, Constants::$emailTaken);
			//	return;
            // }
            
            

        }
        


		private function validatePassword($password) {
			

			if(strlen($password) > 30 || strlen($password) < 5) {
				array_push($this->errorArray, Constants::$passwordCharacters);
				return;
			}

		}





	}
?>





















<?php

class Ac {

   /* 

    
    private $dbconn;
    private $errorArray;


    //called as soon as the Account class is initialized
    //constuctors are called as soon as the class is initialized/object is created ex: new Account
    //VERY FIRST THING THAT WILL HAPPEN
    public function __construct($dbconn) {
        
      //this error array = array
        $this->errorArray = array();
        //$this->dbconn = $dbconn;
        
    }



    //accessible from outside the class
    //we manually can call this register function
    public function register($firstname, $lastname, $email, $username, $password, $db) {

        //call functions that are private below since we cant access them directly
        //says $this-> instance of the class for this function -- when we call it
        $this->validateUsername($username);
        $this->validateFirstName($firstname);
        $this->validateLastName($lastname);
        $this->validateEmail($email);


        if(empty($this->errorArray) == true ) {

            //insert the information into the database
            return $this->addUserInfo($firstname, $lastname, $email, $username, $password, $db);

        } else {

            return false;

        }


    }

 
    //we can call it from outside the class
    public function getError($error) {

        //checks the error array to see if the error message we pass in exists
        //checks if this parameter exisits in an array. 
        //if IT DOESN'T exist in this array.
        if(!in_array($error, $this->errorArray)) {
            $error = "";
        }

        return "<span class='errorMessage'>$error</span>";

    } 
      









    private $data;
    private $errors = [];
    private static $fields = ['firstname, lastname, email, username, password'];


    public function __construct($post_data) {

        $this->data = $post_data;
        
    }




    public function validateForm() {


        foreach(self::$fields as $field) {

               //if it doesnt exists, return true. we only want to do something is it DOESNT exist.  
            if(!array_key_exists($field, $this->data)) {
            trigger_error("This field does not exist in the data.");
            return;
        }

    }

        $this->validateFirstName();
        $this->validateLastName();
        $this->validateEmail();
        $this->validateUsername();
        $this->validatePassword();
        return $this->errors;

    }




    private function addError($key, $val) {


        $this->errors[$key] = $val;


    }




    private function validateFirstName($firstname) {


        //if length of the string is greater than 25 or less than 2
       // if (strlen($firstname) > 25 || strlen($firstname) < 2) {

            //array_push($this->errorArray, Constants::$firstnameinvalid);
            //return;
        //}


    }



    private function validateLastName($lastname) {

        //if length of the string is greater than 25 or less than 2
       // if (strlen($lastname) > 25 || strlen($lastname) < 2) {

            //array_push($this->errorArray, Constants::$lastnameinvalid);
            //return;
        //}


    }



    private function validateEmail($email) {

        //check if the email is in a correct format
        //if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            //array_push($this->errorArray, Constants::$emailinvalid);
            //return

       // }

        //TO: Check that email hasnt already been used.



        $val = $this->data['email'];

        if(empty($val)) {

            $this->addError('email', 'Email is empty. Please put something.');

        } else {

            if(!filter_var($val, FILTER_VALIDATE_EMAIL)) {

                $this->addError('email', 'Email is not valid. Try again.');

            }


        }

    


    }

    


    //private allows them to only be called from within the class
    private function validateUsername($username) {

        //if length of the string is greater than 20 or less than 5
        //if (strlen($username) > 15 || strlen($username) < 5) {

            //array_push($this->errorArray, Constants::$usernameinvalid);
            //return;


        //}

        $val = $this->data['username'];

        if(empty($val)) {

            $this->addError('username', 'Username is emply. Please put something.');

        } else {

            if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)) {

                $this->addError('username', 'Username must be btween 6-12 charachets and only letters and numbers.');

            }


        }



    }




    //private allows them to only be called from within the class
    private function validatePassword($username) {

        //if length of the string is greater than 20 or less than 5
        //if (strlen($username) > 15 || strlen($username) < 5) {

            //array_push($this->errorArray, Constants::$usernameinvalid);
            //return;


        //}

        //TO DO: Check if username already exists...set up user table

    }




    public function addUserInfo($firstname, $lastname, $email, $username, $password, $db) {

        $sql = "INSERT INTO user_accounts (first_name, last_name, email, username, password )
                VALUES (:firstname, :lastname, :email, :username, :password) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':firstname', $firstname);
        $pst->bindParam(':lastname', $lastname);
        $pst->bindParam(':email', $email);
        $pst->bindParam(':username', $username);
        $pst->bindParam(':password', $password);


        $conMsg = $pst->execute();
        return $conMsg;

    }






}

*/

}
?>