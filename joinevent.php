<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Page2</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="events.html">Events</a></li>
                    <li><a href="settings.html">Settings</a></li>
                    <li><a href="login.html">Login</a></li>
                </ul>
            </div>
            <div class="clear-both"></div>
        </div>
        <div class="body">
            <div class="col-3 myevent">
                <h2>Your Event:</h2>
                <img src="images/eventshow.png" alt="EventShow">
            </div>
            <?php
            if(isset($_GET["eventData"]))
              $eventData = $_GET["eventData"];

            echo "<div class="col-7">
                <p>$eventData["Name"]</p>                    
                <p>$eventData["Location"] . " " . $eventData["Expiration_Date"]</p>
                <button>Click Here to Find a Match</button>
            </div>
            <div class="clear-both"></div>";
            ?>
<!--
            <div class="col-7">
                <p>Behemoth</p>                    
                <p>O2 Ritz, Manchester. Saturday, 09 Feb 2019 </p>
                <button>Click Here to Find a Match</button>
            </div>
            <div class="clear-both"></div>
-->
        </div>       
        
        <div class="footer">
            <p>© 2019 Affinity (UK). All rights reserved. </p>
        </div>
    </div>
</body>
</html>
