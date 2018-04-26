<?php


 //goal is to extract all planet records into a single array holding JSON data
 //It will be passed into the database so that it could later be recalled

 //variables
 $planets = file_get_contents("https://swapi.co/api/planets/?format=json&page=1");
 $url     = "https://swapi.co/api/planets/?format=json&page="; 
 $addMeOn;


 $planets = json_decode($planets);
 $addMeOn = $planets;

 


 //loop thru and collect all values
 while($planets->next != null){
 	$planets = file_get_contents($planets->next);

 	//decode the new json object
 	$planets = json_decode($planets);

 	//merge the planet arrays
 	$addMeOn->results = array_merge($addMeOn->results,$planets->results);

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
        $table    = "planets";




        $string =  "INSERT INTO " . $table . " (Name, rotation_period, orbital_period, diameter, climate, gravity, terrain , surface_water, population) VALUES ('". $addMeOn->results[0]->name . "', '" .                     $addMeOn->results[0]->rotation_period . "', '" .$addMeOn->results[0]->orbital_period . "', '" . $addMeOn->results[0]->diameter . "', '" . $addMeOn->results[0]->climate . "', '" . $addMeOn->results[0]->gravity . "', '" . $addMeOn->results[0]->terrain ."', '" . $addMeOn->results[0]->surface_water . "', '" . $addMeOn->results[0]->population  . "');";


        
        



        for($i = 1; $i < count($addMeOn->results);$i++){

        	$string .=  "INSERT INTO " . $table . " (Name, rotation_period, orbital_period, diameter, climate, gravity, terrain , surface_water, population) VALUES ('". $addMeOn->results[$i]->name . "', '" .                     $addMeOn->results[$i]->rotation_period . "', '" .$addMeOn->results[$i]->orbital_period . "', '" . $addMeOn->results[$i]->diameter . "', '" . $addMeOn->results[$i]->climate . "', '" . $addMeOn->results[$i]->gravity . "', '" . $addMeOn->results[$i]->terrain ."', '" . $addMeOn->results[$i]->surface_water . "', '" . $addMeOn->results[$i]->population  . "');";

        }


        $link = mysqli_connect($hostname, $username, $password, $database);
        if (mysqli_connect_errno()) {        
            die("Connect failed: %s\n" + mysqli_connect_error());
            exit();
        }       
        
        //now update to the dataBase
        mysqli_multi_query($link,$string);       
    

    



?>