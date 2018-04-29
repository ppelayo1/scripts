<?php


 //goal is to extract all planet records into a single array holding JSON data
 //It will be passed into the database so that it could later be recalled

 //variables
 $people = file_get_contents("https://swapi.co/api/people/?format=json&page=1"); 
 $addMeOn;

 $people = json_decode($people);
 $addMeOn = $people;



 //loop thru and collect all values
 while($people->next != null){
 	$people = file_get_contents($people->next);

 	//decode the new json object
 	$people = json_decode($people);

 	//merge the planet arrays
 	$addMeOn->results = array_merge($addMeOn->results,$people->results);

 }



// echo count($addMeOn->results);

//foreach ($addMeOn->results as $x)
//	echo $x->name . "<br>";

//Now pass my desired information into the database for star wars

	

		//variables
        $hostname = "localhost"; // the hostname you created when creating the database
        $username = "root";      // the username specified when setting up the database
        $password = "";      // the password specified when setting up the database
        $database = "starwarsapi";      // the database name chosen when setting up the database 
        $table    = "people";

         
        //functions to convert from metric to imperial for the height, and weight
        function kiloToP($kilo) {
        	//variables
        	$kilo = (float) $kilo;
        	$pounds = ($kilo * 2.2046);

        	//type cast it into an int
        	$pounds = (int) $pounds;

        	//return value of pounds
        	return $pounds;


        }

        function meterToFt ($meters) {
        	//variables
        	$meters = (float) $meters;
        	$feet = ($meters/30.48);     //Convert to feet
        	$feetInt = (int) $feet;      //Truncate off inches and assign it
        	$inches = $feet - $feetInt;  //Remove the feet, leave inches
        	$inches = 12*$inches;        //Determine the inches
        	$inches = (int) $inches;     //Truncate the decimals
        	$feet   = (int) $feet;       //Truncate the feet

        	//return the value as a string
        	return $feet . "ft " . $inches . "inches";
        }





        //Add the first column for the table
        $string =  "INSERT INTO " . $table . " (Name, Mass, Hair_color, Skin_color, Eye_color, Birth_year, Gender , Homeworld, Species, Height) VALUES ('". $addMeOn->results[0]->name . "', '" . kiloToP($addMeOn->results[0]->mass) . "', '" . $addMeOn->results[0]->hair_color . "', '" . $addMeOn->results[0]->skin_color . "', '" . $addMeOn->results[0]->eye_color . "', '" . $addMeOn->results[0]->birth_year ."', '" . $addMeOn->results[0]->gender . "', '" . $addMeOn->results[0]->homeworld  . "', '" . $addMeOn->results[0]->species[0] . "', '" . meterToFt($addMeOn->results[0]->height) . "');";


        
        



        for($i = 1; $i < count($addMeOn->results);$i++){
        	
        	//build the string
        	$string .=  "INSERT INTO " . $table . " (Name, Mass, Hair_color, Skin_color, Eye_color, Birth_year, Gender , Homeworld, Species, Height) VALUES ('". $addMeOn->results[$i]->name . "', '" . kiloToP($addMeOn->results[$i]->mass) . "', '" . $addMeOn->results[$i]->hair_color . "', '" . $addMeOn->results[$i]->skin_color . "', '" . $addMeOn->results[$i]->eye_color . "', '" . $addMeOn->results[$i]->birth_year ."', '" . $addMeOn->results[$i]->gender . "', '" . $addMeOn->results[$i]->homeworld  . "', '" . (count($addMeOn->results[$i]->species) > 0 ? $addMeOn->results[$i]->species[0] : "unknown") . "', '" . meterToFt($addMeOn->results[$i]->height) . "');";

        }


        $link = mysqli_connect($hostname, $username, $password, $database);
        if (mysqli_connect_errno()) {        
            die("Connect failed: %s\n" + mysqli_connect_error());
            exit();
        }       
        
        //now update to the dataBase
        mysqli_multi_query($link,$string);       
    

    



?>
