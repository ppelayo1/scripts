<?php 
    
    //This class provides output and updates the database with the feedback
    class feedBackUpdate {

        /*
        private $name ="";
        private $phone ="";           
        private $eMail ="";
        private $callOK ="";
        private $textOK ="";
        private $emailOK ="";
        private $comment ="";
        private $feedbType ="";
        */

        //constructor
        function __construct(){
            
            //variables
            $this->name = $_POST["userName"];
            $this->phone = $_POST["phoneN"];                
            $this->eMail = $_POST["emailAd"];
            $this->callOK = empty($_POST["byPhone"]) ? "" : $_POST["byPhone"];
            $this->textOK = empty($_POST["byText"]) ? "" : $_POST["byText"];
            $this->emailOK = empty($_POST["byEmail"]) ? "" : $_POST["byEmail"];
            $this->comment = $_POST["comments"];
            $this->feedbType = $_POST["feedBackList"];
            
            //Connection variables
            $this->hostname = "localhost"; // the hostname you created when creating the database
            $this->username = "root";      // the username specified when setting up the database
            $this->password = "";      // the password specified when setting up the database
            $this->database = "feedback";      // the database name chosen when setting up the database 
            $this->table    = "feedBack";
            
            //update the database with the feedback
            $this->insertFeedback();
            
            
            
        }

        //Login and add the comment to the database
        protected function insertFeedback(){        

            //variables
            
            $table    = "feedBack";
            $string =  "INSERT INTO " . $table . " (Name, Comment, CallOK, TextOK, EmailOK, Phone, Email , FeedBtype) VALUES ('". $this->name . "', '" .                     $this->comment . "', '" .$this->callOK . "', '" . $this->textOK . "', '" . $this->emailOK . "', '" . $this->phone . "', '" . $this->eMail ."', '" . $this->feedbType . "')";



            $link = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
                 

            //now update to the dataBase
            mysqli_query($link,$string);       
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
        
      $object = new feedBackUpdate;       
        
    
    ?>