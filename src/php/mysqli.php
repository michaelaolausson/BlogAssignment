<?php
//
// CLASS WITH STATIC FUNKTION FOR CONNECTION TO MYSQL-DATABASE. 
//
class MySQLiHandler {

	function __construct() {

	}
	/*
	** connects to database
	*/
	public static function connect() {
		/*
		// LOCAL
		$ln = 'localhost'; 	// string - location
		$db = 'mo222tj';	// string - database
		$un = 'root';		// string - username
		$pw = 'root';		// string - password
		*/
		// LAB SERVER
		$ln = 'localhost'; 	// string - location
		$db = 'mo222tj';	// string - database
		$un = 'mo222tj';	// string - username
		$pw = 'nIJliQUX';	// string - password
		
		// creates connection
		$connection = mysqli_connect($ln, $un, $pw, $db);
		
		//checks connection
		if (!$connection) {
			die("Connection failed: " . mysqli_connect_error());
		}

		return $connection;
	}
}
?>