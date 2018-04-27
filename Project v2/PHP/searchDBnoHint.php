<?php

	

	//variables
	$q = $_GET["q"];
	$strn = ''; //This string will hold the querry request
	$result = '';    //Results of the querry
	$obj;  	//This will be a returned json object
    $flag = false;
	

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
	    $strn = 'SELECT * FROM People
	    			WHERE Name = "' . $q . '"';
            
        $strn2 = 'SELECT * FROM Planets
	                WHERE Name = "' . $q . '"';



	    //Connect and get results
	    $results = $con->query($strn);
    
    	//check if empty set
    	if($results->num_rows > 0){

    	//Assign all rows into an array for conversion into a json object
    	while($row = $results->fetch_assoc()){
    		$obj = $row;
    	}        
            
    	$flag = true;

    }else{ 
            
            //try the planet
            //Connect and get results
	       $results = $con->query($strn2);
            
            if($results->num_rows > 0){             
                //Assign all rows into an array for conversion into a json object
                   while($row = $results->fetch_assoc()){
                      $obj = $row;
                   }
                   $flag = true;

             }else{  //returns empty string
            echo "";
        }

    }

    //output the result only if somthing is assigned
    if($flag === true)
    	echo json_encode($obj);
            
    }


?>