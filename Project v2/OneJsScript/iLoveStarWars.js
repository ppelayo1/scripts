//These are the functions for the iLoveStarWars html file

//functions are seperated by nameSpaces

//star wars namespace
var starWarsNS = {
  
    
    
    
};

//autoStart Functions
        (function() {

            //create eventhandler to provide hints as input provided
            document.getElementById("searchBox").addEventListener("keyup", function() {


                //variables
                var xhttp = new XMLHttpRequest();
                var searchVal = document.getElementById("searchBox").value;
                var query;
                var searchObj = document.getElementById("searchHints");

                //get length of current search obj children
                var sLength = searchObj.children.length;

                //delete old child nodes
                if (sLength > 0) {
                    for (var i = 0; i < sLength; i++) {
                        searchObj.removeChild(searchObj.children[0]);
                    }
                }




                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        //get the result as a json object
                        var response = this.responseText;

                        //convert it
                        response = JSON.parse(response);





                        //set variable with # of children
                        var nChild = response.length;


                        //create and attach the nodes to the list
                        for (var i = 0; i < nChild; i++) {
                            var cElem = document.createElement("li");
                            var aChild = document.createTextNode(response[i]);

                            //fill out the search bar if a hint clicked
                            cElem.addEventListener("click", function() {
                                document.getElementById("searchBox").value = this.innerHTML;
                            });

                            //some styling                                    
                            cElem.style.listStyle = 'none';


                            //append                                        
                            cElem.appendChild(aChild);
                            searchObj.appendChild(cElem);

                        }



                    }
                };

                xhttp.open("GET", "PHP/searchDB.php?q=" + searchVal, true);
                xhttp.send();
            });


            //create eventhandler for clicking search this is when the user is starting a search for a planet/person
            document.getElementById("submitForm").addEventListener("click", function() {


                //variables
                var xhttp = new XMLHttpRequest();
                var searchVal = document.getElementById("searchBox").value;
                var pTag = document.getElementById("searchResults");



                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        //check if response existed
                        if (this.responseText.length) {

                            //clear the hints
                            var searchObj = document.getElementById("searchHints");

                            //get length of current search obj children
                            var sLength = searchObj.children.length;

                            //delete old child nodes
                            if (sLength > 0) {
                                for (var i = 0; i < sLength; i++) {
                                    searchObj.removeChild(searchObj.children[0]);
                                }
                            }

                            //decode the JSON response
                            var response = JSON.parse(this.responseText);

                            //paragraph string
                            var strn = "Below is some information on that person you searched for.<br> <br> <span style='font-size: 25px;'>Name: " + response.Name + "<br>Weight: " + response.Mass + "lb<br>Hair Color: " + response.Hair_color + "<br>Skin Color: " + response.Skin_color + "<br>Eye Color: " + response.Eye_color + "<br>Birth Year: " + response.Birth_year + "<br>Gender: " + response.Gender + "<br>Height: " + response.Height + "</span>";

                            

                            //Assign the string
                            pTag.innerHTML = strn;
                        }                     


                    }
                };

                xhttp.open("GET", "PHP/searchDBnoHint.php?q=" + searchVal, true);
                xhttp.send();
            });
        })();




        (function() {

            //var
            var event = document.getElementById("submitForm");

            //event listener for click
            event.addEventListener("click", function() {

                var v = document.getElementById("choosenOption").value;
                // document.getElementById("tester").innerHTML = v;

            });



        })()