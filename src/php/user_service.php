<?php
require_once "mysqli.php";
//
// Class for User data and methods
//
class User {

	function __construct(){

		$this->check_post_data();
	}
	/*
	** checks for content in $_POST
	*
	*/ 
	private function check_post_data() {

		if(isset($_POST['username']) && isset($_POST['password'])) {
			
				$username = @$_POST['username'];
				$password = @$_POST['password'];
				$password = hash("ripemd128", "?tBm?" . $password . "*mo22tj");

        		$user = self::check_user_credentials($username, $password);
        				
        	}
	}
	/*
	** checks if username & password have a match in database
	*/
	private function check_user_credentials($username, $password) {

		$connection = MySQLiHandler::connect();

	    if (isset($connection) == TRUE) {

	        $query = "
	            SELECT 
	                *
	            FROM 
	                users 
	            WHERE 
	                username = '$username'
	            AND 
	                password = '$password'
	            LIMIT 
	                1
	        ";

	        $result  	= mysqli_query($connection, $query);
	        $user     	= mysqli_fetch_assoc($result);

	        if ($user != NULL) {self::log_in_user($user);}

        	if ($user == NULL) {echo "hittar ingen användare";}

	    }
	   
	    if (isset($connection) == FALSE) {

	    	echo "no connection";

		}
	}
	
	private function log_in_user($user) {

	    session_start();

	    $_SESSION['user_id'] = $user['id'];
	    $_SESSION['username'] = $user['username'];

	    header('location: edit.php');
	}
	/*
	** checks if user is allowed on page
	*/
	public static function authenticate_user() {
    		
    	session_start();

    	require_once "footer.php";

    	if (!isset($_SESSION['user_id'])) {

    		header("location: log_in_page.php");
    	}
    }

    public static function log_out() {

		session_start();

	    $_SESSION = array();
	    
	    session_destroy();
		    
		header("location:../../index.php");

	}
}
?>