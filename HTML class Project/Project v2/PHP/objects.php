<?php 
    
    //Used to log into the mySql Server
    function mySQL_connect(){        
    
        //variables
        $hostname = "localhost"; // the hostname you created when creating the database
        $username = "root";      // the username specified when setting up the database
        $password = "";      // the password specified when setting up the database
        $database = "feedback";      // the database name chosen when setting up the database 
        $table    = "feedBack";
        
        $name = $_POST["userName"];
        $phone = $_POST["phoneN"];                
        $eMail = $_POST["emailAd"];
        $callOK = empty($_POST["byPhone"]) ? "" : $_POST["byPhone"];
        $textOK = empty($_POST["byText"]) ? "" : $_POST["byText"];
        $emailOK = empty($_POST["byEmail"]) ? "" : $_POST["byEmail"];
        $comment = $_POST["comments"];
        $feedbType = $_POST["feedBackList"];
        
        $string =  "INSERT INTO " . $table . " (Name, Comment, CallOK, TextOK, EmailOK, Phone, Email , FeedBtype) VALUES ('". $name . "', '" .                     $comment . "', '" .$callOK . "', '" . $textOK . "', '" . $emailOK . "', '" . $phone . "', '" . $eMail ."', '" . $feedbType . "')";

        
        
        $link = mysqli_connect($hostname, $username, $password, $database);
        if (mysqli_connect_errno()) {        
            die("Connect failed: %s\n" + mysqli_connect_error());
            exit();
        }       
        
        //now update to the dataBase
        mysqli_query($link,$string);       
    }

    //connect to the database
    mySQL_connect();


    class Output {

        private $name ="";
        private $phone ="";           
        private $eMail ="";
        private $callOK ="";
        private $textOK ="";
        private $emailOK ="";
        private $comment ="";
        private $feedbType ="";

        //assign the values
        function __construct(){
            $this->name = $_POST["userName"];
            $this->phone = $_POST["phoneN"];                
            $this->eMail = $_POST["emailAd"];
            $this->callOK = empty($_POST["byPhone"]) ? "" : $_POST["byPhone"];
            $this->textOK = empty($_POST["byText"]) ? "" : $_POST["byText"];
            $this->emailOK = empty($_POST["byEmail"]) ? "" : $_POST["byEmail"];
            
        }

        function __destruct(){

        }
        
          
                     
            
          public function outPutMessage(){
              echo "<h1 class='firstHeader'>Thank You " . $this->name . "!</h1>";
              echo " <p>Your feedback means a great deal to me. It helps me perfect this site <br> <strong> FOR YOU!</strong> </p>";
                
              if($this->callOK == "true"  && !(empty($this->phone)))   {             
                  echo "<p> If I have any questions I will contact you by a phone call to the number you provided.</p>";     
              }else{
                  if($this->textOK == "true" && !(empty($this->phone))){
                      echo "<p> If I have any questions I will contact you by text to the number you provided.</p>";            
                  }else{
                      if($this->emailOK == "true" && !(empty($this->eMail))){
                          echo "<p> If I have any questions I will contact you by email to the address you provided.</p>"; 
                      }
                  }
                  
              }
              
          }

      }
        
      $object = new Output;       
        
    
    ?>