// JavaScript Document

//classes
function Login(){
    //variables(constructed)
    this.varName = "guestName"; //Variable to hold storage variable name
    this.guestName = localStorage.getItem(this.varName);
    this.signedOn = false; //sign on flag
    this.firstRun = true; //flag for first run
    
    //private functions have _
    
    //private functions
    
    //Resets the guest name to guest
    this._setGuest = function () {
        
        
        //check if a guestName already exists
        if(this.guestName != null && this.guestName.length){
            //variables
            var elem=document.getElementById("userName");
            
            //Hide the textbox
            elem.style.display = "none";
            
            //change value of the button
            elem = document.getElementById("signIn");
            elem.value = "sign out";
            
            //set flag
            this.signedOn = true;
            
            //Update the eventHandler
            
            
        }else{
            //set default guestName
            this.guestName = "Guest";
            
            //setFlag
            this.signedOn = false;            
            
        }
        
        //set the name now
        document.getElementById("loginName").innerHTML = this.guestName;
    };       
        
    
    //clear guest name and reset by calling setGuest()
    this._clearName = function (){
        //variables
        elem = document.getElementById("userName");
        
        
        
        //reset the button,reinable the text field, and reset name       
        elem.style.display = "inline-block";
        elem.value = "";
        document.getElementById("signIn").value = "sign in";
        
        //Clear local storage and set guestname null
        this.guestName = null;
        localStorage.clear();
        
        //reset the name        
        this._setGuest();
        
        //reset the # in the cart
        document.getElementById("cartN").innerHTML = 0;
        
        
    };
    
    
    
    
    
    //updates the name display and storage
    this._updateName = function (){
        //variables
        var elem = document.getElementById("userName"); //get the elem
        
        //Update the guestName class variable
        this.guestName = elem.value;
        
        //update local storage
        localStorage.setItem(this.varName,this.guestName);
        
        //Call set guest function
        this._setGuest();
        
    };
    
    //public functions
    
    //Controls functions from event call
    this.eventControler = function () {
        
        //variables
        var butVal = document.getElementById("signIn").value;
        
        //check if signed on or off by button value
        if(butVal == "sign in"){
            //updateName
            this._updateName();
        }else{
            //clear the name, and reset
            this._clearName();
        }
        
    };
    
    
    
    
    
    
    //call functions
    this._setGuest();      //Sets the user name
    
}

//autoStart functions
//handles the name/button fields
(function () {
    //variables
    
    
    //declare the object for handling login
    var obj = new Login;
    
    //set an eventHandler for the button
    document.getElementById("signIn").addEventListener('click',function() {obj.eventControler()});
    
    
    
    
    
    
})();
