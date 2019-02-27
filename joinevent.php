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
                <img src="img/logo.png" alt="Logo">
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
                <img src="img/eventshow.png" alt="EventShow">
            </div>

<?php
            include "php_queries.php";

            function leven($s1,$s2){
	$l1 = strlen($s1);                    // Länge des $s1 Strings
	$l2 = strlen($s2);                    // Länge des $s2 Strings
	$dis = range(0,$l2);                  // Erste Zeile mit (0,1,2,...,n) erzeugen
                                              // $dis stellt die vorrangeganene Zeile da.
	for($x=1;$x<=$l1;$x++){
		$dis_new[0]=$x;               // Das erste element der darauffolgenden Zeile ist $x, $dis_new ist damit die aktuelle Zeile mit der gearbeitet wird
		for($y=1;$y<=$l2;$y++){
			$c = ($s1[$x-1] == $s2[$y-1])?0:1;
			$dis_new[$y] = min($dis[$y]+1,$dis_new[$y-1]+1,$dis[$y-1]+$c);
		}
		$dis = $dis_new;
	}

	return $dis[$l2];
}

            if(isset($_GET["eventName"]))
              $eventName = $_GET["eventName"];
            if(isset($_GET["eventLocation"]))
              $eventLocation = $_GET["eventLocation"];
            if(isset($_GET["eventExpirationDate"]))
              $eventExpirationDate = $_GET["eventExpirationDate"];
            if(isset($_GET["eventID"]))
              $eventID = $_GET["eventID"];

            session_start();
            if(isset($_POST['Find Match']) && isset($_GET["eventID"]) && isset($_SESSION['username']))
            {
              $username = $_SESSION['username'];
              $usersInEventQuery = getListOfUsersForEvent($eventID);
              $nameArray = array();

              while($row = $usersInEventQuery->fetch_assoc())
                array_push($nameArray, $row['Username'])
              // Need way of removing the user from the array of names to make iteration easier
            }
              
/*
            echo "<div class=\"col-7\">
                <p>$eventName</p>                    
                <p>$eventLocation. $eventExpirationDate</p>
                <button>Click Here to Find a Match</button>
            </div>
            <div class=\"clear-both\"></div>";
*/
            echo "<div class=\"col-7\">
                <p>$eventName</p>                    
                <p>$eventLocation. $eventExpirationDate</p>
                <form action='' method='POST'>
                <input type='submit' name='Find Match'>
                </form>
                </div>
                <div class=\"clear-both\"></div>";
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
