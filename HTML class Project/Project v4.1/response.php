<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>>Patrick Pelayo Final Project Thank You!</title>
    <link href="Styles/layout.css" type="text/css" rel="stylesheet">
    <link href="Styles/standardPageStylesPatrickPelayo.css" type="text/css" rel="stylesheet">
    <link href="Styles/moreSpecificStyles/response.css" type="text/css" rel="stylesheet">
    <!-- Add a link to your own style sheet here  -->

    <?php require "PHP/objects.php";?>
    

    <!--
	Final Project by __________________________ (your name)-->

</head>

<body>
    <div id="mainBox">

        <header>
            <a href="index.html">
            <img src="Images/header/clickableHeader.jpg" alt="PatrickP.tech">
            </a>
        </header>

        <nav>

            <div class="navBarLinks">
                <h3 class="navBarHeader">Navigation</h3>
                <ul>
                    <li>
                        <a href="index.html"> Home</a>
                    </li>
                    <li>
                        <a href="favlinks.html">Favorite Links</a>
                    </li>
                    <li>
                        <a href="resume.html">Resume</a>
                    </li>
                    <li>
                        <a href="ILoveStarWars.html">I Love Star Wars</a>
                    </li>
                    <li>
                        <a href="feedback.html">Feedback</a>
                    </li>
                </ul>

            </div>



        </nav>

        <div id="main">
            <section id="responseMainContent">

                <?php $object->outPutMessage(); ?>
                
                <!--
                <h1 class="firstHeader">Thank You  ?>!</h1>
                <p>Your feedback means a great deal to me. It helps me perfect this site <br> <strong style="padding: 0 0 0 200px;"> FOR YOU!</strong>
                </p>
                
                <p></p>

                -->

            </section>

        </div>



        <footer>
            This area is where your copyright info goes.
        </footer>

    </div>


</body>

</html>
