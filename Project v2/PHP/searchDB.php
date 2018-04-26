<?php

	//variables
	$q = $_REQUEST["q"];
	$strn = ''; //This string will hold the querry request
	$result = '';    //Results of the querry

		//only perform the steps if a value exists
		if($q != ""){

		//Login information
	    $hostname = "localhost"; // the hostname you created when creating the database
	    $username = "root";      // the username specified when setting up the database
	    $password = "";      // the password specified when setting up the database
	    $database = "starwarsapi";      // the database name chosen when setting up the database 
	    

	    //connect to the database
	    $con = new mysqli($hostname,$username,$password,$database);

	    
	    //build the querry string
	    $strn = 'SELECT Name FROM People
	    			WHERE Name LIKE "' . $q . '%"';



	    //Connect and get results
	    $results = $con->query($strn);

	    


	    //print out the matches
	    while($row = $results->fetch_assoc())
	    	echo $row["Name"] . "<br>";
	    	

    
	}

	


?>