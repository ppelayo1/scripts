//auto start functions
(function () {

    //class for handling nav bar
    function navBarHandler() {
        //variables
        this.navOption = "select"; //element ID of nav select option
        this.homeURL = "index.html";
        this.shopURL = "shop.html";
        this.cartURL = "cart.html";
        this.chkOutURL = "checkout.html";

        //Private Functions

        //This function creates the events
        this._pageChg = function () {
            //variables
            var navOption = this.navOption; //This does not work inside the event handler
            var homeURL   = this.homeURL;
            var shopURL   = this.shopURL;
            var cartURL   = this.cartURL;
            var chkOutURL = this.chkOutURL;
            
            //set an eventHandler to change pages
            document.getElementById("form1").addEventListener("change", function () {
                //variables
                var elemV = document.getElementById(navOption).value;

                //detect changes and swap to those pages as needed
                if (elemV === homeURL)
                    location.assign(homeURL);
                
                if (elemV === shopURL)
                    location.assign(shopURL);
                
                if (elemV === cartURL)
                    location.assign(cartURL);
                
                if (elemV === chkOutURL)
                    location.assign(chkOutURL);
                

            });
        }

        
        
        //Displays current page
        this._curPage = function () {
            //variables
            var curP = (location.pathname).split('/'); //Truncate everything left of file name
            var elemV = document.getElementById(this.navOption);

            //get last string value
            curP = curP[curP.length - 1];

            //check what page is current
            if (curP == this.homeURL) {
                elemV.value = this.homeURL;
            } else {
                if (curP == this.shopURL) {
                    elemV.value = this.shopURL;
                }if(curP == this.cartURL)
                    elemV.value = this.cartURL;
                else{
                    if(curP == this.chkOutURL)
                        elemV.value = this.chkOutURL;
                }
            }

        }
        
        //run the functions
        this._curPage();
        this._pageChg();
        
    }
    
    //instantiate the object
    var obj = new navBarHandler;


})();


