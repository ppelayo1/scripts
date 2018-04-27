<?php
    
    class Search{
        
        function __construct(){
            
            //Login info
            $hostname = "localhost"; // the hostname you created when creating the database
            $username = "root";      // the username specified when setting up the database
            $password = "";      // the password specified when setting up the database
            $database = "starwarsapi";      // the database name chosen when setting up the database 


            //connect to the database
            $this->con = new mysqli($hostname,$username,$password,$database);
            
            //check if it is a dbHint search or a full search
            if(empty($_GET["q"])){
                $this->searchDbHint();
            }else{
                $this->searchDBnoHint();
            }
        }
        
        protected function searchDbHint (){
           //variables
           $hint = $_GET["h"];         
           $strn = ''; //This string will hold the querry request
           $result = '';    //Results of the querry
           $obj;  	//This will be a returned json object

            //only perform the steps if a value exists
            if($hint != ""){   


            //build the querry string
            $strn = 'SELECT Name FROM People
                        WHERE Name LIKE "' . $hint . '%"';

            //Connect and get results
            $results = $this->con->query($strn);


            //Build an object of all results
            while($row = $results->fetch_assoc())
            {
                $obj[] = $row["Name"];
            }

            //Connect and get name hints from the planet table

            //build the querry string
            $strn = 'SELECT Name FROM Planets
                        WHERE Name LIKE "' . $hint . '%"';



            //Connect and get results
            $results = $this->con->query($strn);

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

        }
        
        protected function searchDBnoHint(){
            //variables
            $q = $_GET["q"];
            $strn = ''; //This string will hold the querry request
            $result = '';    //Results of the querry
            $obj;  	//This will be a returned json object
            $flag = false;


                //only perform the steps if a value exists
                if($q != ""){               


                //build the querry string
                $strn = 'SELECT * FROM People
                            WHERE Name = "' . $q . '"';

                $strn2 = 'SELECT * FROM Planets
                            WHERE Name = "' . $q . '"';



                //Connect and get results
                $results = $this->con->query($strn);

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
                   $results = $this->con->query($strn2);

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
                
        }
    }

    //create the object
    $obj = new Search;
    
    

?>