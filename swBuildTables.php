<?php
    //Purpose of this class is to build the  tables

    class swBuildTables {
        
        function __construct(){
            //variables
            //variables
			$this->hostname = "mysql.patrickp.tech"; // the hostname you created when creating the database
			$this->username = "patpel4";      // the username specified when setting up the database
			$this->password = "iLikePopCorn";      // the password specified when setting up the database
			$this->database = "patrickp_feedback";      // the database name chosen when setting up the database 
            $this->database = "starwarsapi";      // the database name chosen when setting up the database 
            
            
            
            //build the tables
              $this->buildPlanets();
              $this->buildPeople();
              
            
            
        }
        
        //functions
        protected function buildPlanets() {
             //goal is to extract all planet records into a single array holding JSON data
             //It will be passed into the database so that it could later be recalled

             //variables
             $planets = file_get_contents("https://swapi.co/api/planets/?format=json&page=1");
             $url     = "https://swapi.co/api/planets/?format=json&page="; 
             $addMeOn;


             $planets = json_decode($planets);
             $addMeOn = $planets;
            
            //make the connection
            $link = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
                




             //loop thru and collect all values
             while($planets->next != null){
                $planets = file_get_contents($planets->next);

                //decode the new json object
                $planets = json_decode($planets);

                //merge the planet arrays
                $addMeOn->results = array_merge($addMeOn->results,$planets->results);

             }

            
            //Now pass my desired information into the database for star wars



                    //variables                    
                    $table    = "planets";

                    //build the table
                    $string = "CREATE TABLE " . $table . "(ID INT NOT NULL AUTO_INCREMENT, Name VARCHAR(255) NOT NULL, rotation_period TEXT NOT NULL, orbital_period TEXT NOT NULL, diameter TEXT NOT NULL, climate TEXT NOT NULL, gravity TEXT NOT NULL, terrain TEXT NOT NULL, surface_water TEXT NOT NULL, population TEXT NOT NULL, PRIMARY KEY (ID), UNIQUE (Name));";
                    
                    

                    //build the records
                    for($i = 0; $i < count($addMeOn->results);$i++){

                        $string .=  "INSERT INTO " . $table . " (Name, rotation_period, orbital_period, diameter, climate, gravity, terrain , surface_water, population) VALUES ('". $addMeOn->results[$i]->name . "', '" .                     $addMeOn->results[$i]->rotation_period . "', '" .$addMeOn->results[$i]->orbital_period . "', '" . $addMeOn->results[$i]->diameter . "', '" . $addMeOn->results[$i]->climate . "', '" . $addMeOn->results[$i]->gravity . "', '" . $addMeOn->results[$i]->terrain ."', '" . $addMeOn->results[$i]->surface_water . "', '" . $addMeOn->results[$i]->population  . "');";

                    }      
            
                    

                    //now update to the dataBase
                    mysqli_multi_query($link,$string);    
        }
        
        protected function buildPeople () {
         //goal is to extract all planet records into a single array holding JSON data
         //It will be passed into the database so that it could later be recalled

         //variables
         $people = file_get_contents("https://swapi.co/api/people/?format=json&page=1"); 
         $addMeOn;

         $people = json_decode($people);
         $addMeOn = $people;
            
        //make the connection
         $link = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
             if (mysqli_connect_errno()) {        
                 die("Connect failed: %s\n" + mysqli_connect_error());
                 exit();
             }; 



         //loop thru and collect all values
         while($people->next != null){
            $people = file_get_contents($people->next);

            //decode the new json object
            $people = json_decode($people);

            //merge the planet arrays
            $addMeOn->results = array_merge($addMeOn->results,$people->results);

         }        

        //Now pass my desired information into the database for star wars



                //The Table string for querry
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

                //Build table 
                $string = "CREATE TABLE People (ID INT NOT NULL AUTO_INCREMENT,Name VARCHAR(255) NOT NULL,Mass TEXT NOT NULL,Hair_color TEXT NOT NULL,Skin_color TEXT NOT NULL,Eye_color TEXT NOT NULL,Birth_year TEXT NOT NULL,Gender TEXT NOT NULL,HomeWorld TEXT NOT NULL,Species TEXT NOT NULL,Height TEXT NOT NULL,PRIMARY KEY (ID), UNIQUE(Name));";



                //Add the records to the table
                for($i = 0; $i < count($addMeOn->results);$i++){

                    //build the string
                    $string .=  "INSERT INTO " . $table . " (Name, Mass, Hair_color, Skin_color, Eye_color, Birth_year, Gender , Homeworld, Species, Height) VALUES ('". $addMeOn->results[$i]->name . "', '" . kiloToP($addMeOn->results[$i]->mass) . "', '" . $addMeOn->results[$i]->hair_color . "', '" . $addMeOn->results[$i]->skin_color . "', '" . $addMeOn->results[$i]->eye_color . "', '" . $addMeOn->results[$i]->birth_year ."', '" . $addMeOn->results[$i]->gender . "', '" . $addMeOn->results[$i]->homeworld  . "', '" . (count($addMeOn->results[$i]->species) > 0 ? $addMeOn->results[$i]->species[0] : "unknown") . "', '" . meterToFt($addMeOn->results[$i]->height) . "');";

                }







                


                

                //now update to the dataBase
                mysqli_multi_query($link,$string);       






                }
        
        
    }

    //build the object
    $obj = new swBuildTables;

?>