<?php

	//variables
	$q = $_GET["q"];
	$strn = ''; //This string will hold the querry request
	$result = '';    //Results of the querry
	$obj;  	//This will be a returned json object

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

    
	    //Build an object of all results
	    while($row = $results->fetch_assoc())
	    {
	    	$obj[] = $row["Name"];
	    }
            
        //Connect and get name hints from the planet table
            
        //build the querry string
	    $strn = 'SELECT Name FROM Planets
	    			WHERE Name LIKE "' . $q . '%"';



	    //Connect and get results
	    $results = $con->query($strn);
            
        //Build an object of all results
	    while($row = $results->fetch_assoc())
	    {
	    	$obj[] = $row["Name"];
	    }

	    //encode the obj for JSON
	    $obj = json_encode($obj);


	    //return the result
	    echo $obj;
	    	

    
	}

	


?>