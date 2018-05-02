//auto start functions


//regular functions

//input validation for checkout form
function inputValidate() {
        //variables
        var noError = true;
        var inputToCheck = document.getElementsByClassName("validateInput");
        var invalidInputX = document.getElementsByClassName("invalidInput");
        var len = inputToCheck.length;     //NOTE invalidInputX has one element more than inputTocheck (KEEP IT ONE MORE OR LOWER SCRIPTS BREAK)
    
        //these two are for checking fields that cannot be empty
        var checkIfEmpty = document.getElementsByClassName("checkIfEmpty");
        var invalidInputEmpty = document.getElementsByClassName("invalidInputEmpty");
        var lenEmpty = checkIfEmpty.length; //Both have same length
    
        var regExp = /[^0-9]/; //To ensure numbers as only valid input

        //loop thru all number elements
        for(var i = 0; i < len;i++){
            
            //check for invalid input()
            if (regExp.test(inputToCheck[i].value) || inputToCheck[i].value.length == 0){
                invalidInputX[i].style.display = 'inline';
                noError = false;
            }else{
                invalidInputX[i].style.display = 'none';
            }
                
            
        }
    
    //check for fields that have no input
    //loop thru fields for being empty
        for(var i = 0; i < lenEmpty;i++){
            
            //check for invalid input()
            if (checkIfEmpty[i].value.length == 0){
                invalidInputEmpty[i].style.display = 'inline';
                noError = false;
            }else{
                invalidInputEmpty[i].style.display = 'none';
            }
                
            
        }
    
    
    //if error exists display the error message next to submit button
    if(noError){
       invalidInputX[len].style.display = 'none';
    }else{
        invalidInputX[len].style.display = 'inline';
    }
    
        
    
    return noError;
}