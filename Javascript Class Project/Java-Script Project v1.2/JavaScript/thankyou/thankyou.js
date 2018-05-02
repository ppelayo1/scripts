//auto start functions


(function () {
    //variables
    var varName = "guestName";
    var elem = document.getElementById("outThank");
    var guestName = localStorage.getItem(varName); 
    
    //Check and set the user name if needed
    if(guestName != null)
        elem.innerHTML = "Thank you, " + guestName +".";
    
    //empty the cart
    clearCart();
})();