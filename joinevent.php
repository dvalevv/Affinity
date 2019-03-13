<!-- <!DOCTYPE php>
<html lang="en">
-->
<head>
  <?php session_start(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/login.css">
    <title>Page2</title>
</head>
<body>
  <section class="banner light">
    <header class="wrapper light">
      <a href="#"><img class="logo" src="img/logoSmall.png" alt="Affinity"/></a>
      <nav>
        <ul>
	  <li><a href="./index.php">Home</a></li>

          <?php if (isset($_SESSION['username'])) { ?>
            <li><a href="./profile.php">Profile</a></li>
            <li><a href="./settings.php">Settings</a></li>
          <?php } ?>
          <li><a href="./events.php">Events</a></li>

          <?php if (!isset($_SESSION['username'])) { ?>
            <li><a href="./login.php">Login/Register</a></li>
          <?php } else { ?>
	    <li><a href="./AffinityLogout.php">Logout</a></li>
          <?php } ?>

          <li><a href="./help.php">Help</a></li>
        </ul>
      </nav>
    </header>
    <br>
  </section>

<?php
            include "matching.php";
            //ini_set('display_errors', 1);

            //function perform_Calculation($like1, $like2) {
            //exec("python Indra.py $like1 $like2 2>&1", $output, $ret_code);
            //return $output; }

            if(isset($_GET["eventName"]))
              $eventName = $_GET["eventName"];
            if(isset($_GET["eventLocation"]))
              $eventLocation = $_GET["eventLocation"];
            if(isset($_GET["eventExpirationDate"]))
              $eventExpirationDate = $_GET["eventExpirationDate"];
            if(isset($_GET["eventID"]))
              $eventID = $_GET["eventID"];

            if(isset($_POST['S_Search']) && isset($_GET["eventID"]) && isset($_SESSION['username']))
            {
              $username = $_SESSION['username'];
              $usersInEventQuery = getListOfUsersForEvent($eventID); // Function creates query for getting the list of users that are part of an event
              $nameArray = array();
              while($row = $usersInEventQuery->fetch_assoc())  // First fill an array with the names of users relevant to the event
              {
                if ($row['Username'] == $username)
                  continue;
                array_push($nameArray, $row['Username']);
              }
              // Having problems removing the currently logged in users name from the array of names. May be easier to create a function that gets all the users names from an event excluding a specific name
              // loops are also iterating for the wrong number of times
           
              $userLikesQuery = getListOfLikeableObjectsForUser($username);
              $userLikesArray = array();
              
              while($row = $userLikesQuery->fetch_assoc()) //  Next fill an array with all of the likes of the currently logged in users
                array_push($userLikesArray, $row['Object']);
            
              $matchValues = array();
              $namesMatched = array();

              //$var = perform_Calculation("Football", "Basketball");
              //echo $var[0];
                for($personNo = 0; $personNo < sizeof($nameArray); $personNo++)
                {
                  $matchTotal = matchNumber($userLikesArray, $nameArray[$personNo]);
                 // echo $matchTotal . " ";
                 // echo $matchTotal/sizeof($userLikesArray) . " ";
                 array_push($matchValues, $matchTotal);
                 array_push($namesMatched, $nameArray[$personNo]);
                }
                $highestMatchValue = max($matchValues);
                $keyOfMax = array_search($highestMatchValue, $matchValues);  // array_search finds the index of an item in the array - if it cant be found it returns false

                unset($matchValues[$keyOfMax]); // must remove the current max value in the array, so that we can call the 'max' function again to get the next highest value
                $secondHighestMatchValue = max($matchValues);
                $keyOf2ndMax = array_search($secondHighestMatchValue, $matchValues);  // array_search finds the index of an item in the array - if it cant be found it returns false
                
                unset($matchValues[$keyOf2ndMax]); 
                $thirdHighestMatchValue = max($matchValues);
                $keyOf3rdMax = array_search($thirdHighestMatchValue, $matchValues); 
              
                echo nl2br("You matched with " . $namesMatched[$keyOfMax] . " with a score of " . $highestMatchValue . "! (1)\n"); // nl2br() ensures new lines (\n) included in php echo's appear in the browser
                echo nl2br("You matched with " . $namesMatched[$keyOf2ndMax] . " with a score of " . $secondHighestMatchValue . "! (2)\n");
                echo "You matched with " . $namesMatched[$keyOf3rdMax] . " with a score of " . $thirdHighestMatchValue . "! (3)";
              
             }
/*
            echo "<div class=\"col-7\">
                <p>$eventName</p>                    
                <p>$eventLocation. $eventExpirationDate</p>
                <button>Click Here to Find a Match</button>
            </div>
            <div class=\"clear-both\"></div>";
*/
            echo '<div class="col-7"> <p>' . $eventName . '</p><p>' . $eventLocation . '. ' . $eventExpirationDate . '</p> <form action="" method="POST"><input type="submit" name="S_Search" value="Slow Search (More Accurate)"></form></div> <form action="" method="POST"><input type="submit" name="F_Search" value="Fast Search"></form></div> <div class="clear-both"></div><div class="clear-both">';
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
        <footer>
          <div class="wrapper">
              <div class="rights">
                <img src="img/logofooter.png" alt="" class="footer_logo"/>
                <p>© Affinity. All Rights Reserved 2019 </p>
              </div>

              <nav>
                <ul>
                  <li><a href="./index.php">Home</a></li>

                  <?php if (isset($_SESSION['username'])) { ?>
                    <li><a href="./profile.php">Profile</a></li>
                    <li><a href="./settings.php">Settings</a></li>
                  <?php } ?>
                  <li><a href="./events.php">Events</a></li>

                  <?php if (!isset($_SESSION['username'])) { ?>
                    <li><a href="./login.php">Login/Register</a></li>
                  <?php } else { ?>
                     <li><a href="./AffinityLogout.php">Logout</a></li>
                   <?php } ?>

                   <li><a href="./help.php">Help</a></li>
                 </ul>
               </nav>
             </div>
           </footer>

</body>
</html>
