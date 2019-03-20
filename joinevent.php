<?php session_start(); ?>
<head>
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
          <?php } ?>
          <li><a href="./eventoptions.php">Events</a></li>

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

  <!--Some javascript for opening a pop up window. Refer to http://w3schools.invisionzone.com/topic/23862-how-to-open-a-popup-window-in-php-code/ for code-->
  <script type="text/javascript">function openRequestedPopup(){ window.open('contactMatch.php', 'ContactMatch', 'width=545,height=600,resizable=yes,scrollbars=yes,status=yes');}</script>
<?php
            include "matching.php";
            //ini_set('display_errors', 1);

            if(isset($_GET["eventName"]))
              $eventName = $_GET["eventName"];
            if(isset($_GET["eventLocation"]))
              $eventLocation = $_GET["eventLocation"];
            if(isset($_GET["eventExpirationDate"]))
              $eventExpirationDate = $_GET["eventExpirationDate"];
            if(isset($_GET["eventID"]))
              $eventID = $_GET["eventID"];

            if(isset($_POST['Search']) && isset($_GET["eventID"]) && isset($_SESSION['username']))
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
              
              //3 per user
              $likesMatched = array();

              //$var = perform_Calculation("Football", "Basketball");
              //echo $var[0];
                for($personNo = 0; $personNo < sizeof($nameArray); $personNo++)
                {
                  $highest1 = "";
                  $highest2 = "";
                  $highest3 = "";
                  $matchTotal = matchNumber($userLikesArray, $nameArray[$personNo],
                                            $highest1, $highest2, $highest3);

                  array_push($likesMatched, $highest1);
                  array_push($likesMatched, $highest2);
                  array_push($likesMatched, $highest3);

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

                echo '<div class="match1">';
                echo nl2br("You matched with " . $namesMatched[$keyOfMax] . " with a score of " . $highestMatchValue . "! (1) matched on: ". $likesMatched[3 * $keyOfMax]. " ". $likesMatched[3 * $keyOfMax + 1]. " ". $likesMatched[3 * $keyOfMax + 2]. "\n"); // nl2br() ensures new lines (\n) included in php echo's appear in the browser
                echo '<form action="" method="POST"><input type="submit" name="contact1" value="Contact First Match"></form><br>';
                echo '</div>';
                // echo '<a href="contactMatch.php" onClick="MyWindow=window.open(\'http://www.google.com\',\'MyWindow\',width=600,height=300); return false;">Click Here</a>'
                echo '<div class="match2">';
                echo nl2br("You matched with " . $namesMatched[$keyOf2ndMax] . " with a score of " . $secondHighestMatchValue . "! (2) matched on: ". $likesMatched[3 * $keyOf2ndMax]. " ". $likesMatched[3 * $keyOf2ndMax + 1]. " ". $likesMatched[3 * $keyOf2ndMax + 2]. "\n");
                echo '<form action="" method="POST"><input type="submit" name="contact2" value="Contact Second Match"></form><br>';
                echo '</div>';
                echo '<div class="match3">';
                echo "You matched with " . $namesMatched[$keyOf3rdMax] . " with a score of " . $thirdHighestMatchValue . "! (3) matched on: ". $likesMatched[3 * $keyOf3rdMax]. " ". $likesMatched[3 * $keyOf3rdMax + 1]. " ". $likesMatched[3 * $keyOf3rdMax + 2]. "\n";
                echo '<form action="" method="POST"><input type="submit" name="contact3" value="Contact Third Match"></form><br>';
                echo '</div>';

                // Added to allow the pop up window to access the emails of a given contact
                $_SESSION['contact1Email'] = getUserData($namesMatched[$keyOfMax])['Email'];
                $_SESSION['contact2Email'] = getUserData($namesMatched[$keyOf2ndMax])['Email'];
                $_SESSION['contact3Email'] = getUserData($namesMatched[$keyOf3rdMax])['Email'];
             }

            // If statements allow checks to be performed to determine which match the user is trying to contact, and sets a session variable appropriately. This session variable is then used to check which email session variable should be used for the recipient of the email
            if(isset($_POST['contact1']) && isset($_GET["eventID"]) && isset($_SESSION['username']))
            {
                $_SESSION['ContactID'] = "1";
                echo "<script type='text/javascript'>openRequestedPopup();</script>";
            }
             elseif(isset($_POST['contact2']) && isset($_GET["eventID"]) && isset($_SESSION['username']))
            {
                $_SESSION['ContactID'] = "2";
                echo "<script type='text/javascript'>openRequestedPopup();</script>";
            }
             elseif(isset($_POST['contact3']) && isset($_GET["eventID"]) && isset($_SESSION['username']))
            {
                $_SESSION['ContactID'] = "3";
                echo "<script type='textjavascript'>openRequestedPopup();</script>";
            }
/*
            echo "<div class=\"col-7\">
                <p>$eventName</p>
                <p>$eventLocation. $eventExpirationDate</p>
                <button>Click Here to Find a Match</button>
            </div>
            <div class=\"clear-both\"></div>";
*/
            echo '<div class="col-7"> <p>' . $eventName . '</p><p>' . $eventLocation . '. ' . $eventExpirationDate . '</p> <form action="" method="POST"><input type="submit" name="Search" value="Find a Match"></form></div><div class="clear-both">';
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
                  <?php } ?>
                  <li><a href="./eventoptions.php">Events</a></li>

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
