<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/login.css">
    <title>Events</title>
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

    <!-- Adding code for generating events and displaying their details on the page (Jason) -->
<?php
    // ini_set('display_errors', 1); // Useful code for displaying the cause of errors. Sourced from link: https://stackoverflow.com/questions/17693391/500-internal-server-error-for-php-file-not-for-html
    include "php_queries.php";
    $eventList = array();
    $eventQuery = getAllEventID(); // The getAllEventID function returns the query object, which we can then call in the loop below to push each ID in the database onto the eventList array

    while($row = $eventQuery->fetch_assoc())
    {
    	$pub = getEventData($row["Event_ID"]);
    	if($pub["Visibility"] == "1")
        	array_push($eventList, $row["Event_ID"]);
    }
    if(isset($_SESSION["username"]))
    {
    	$privateEvents = getListOfEventsForUser($_SESSION["username"]);
    	while($row = $privateEvents->fetch_assoc())
    	{
    		$pub = getEventData($row["Event_ID"]);
    		if($pub["Visibility"] == "0")
        		array_push($eventList, $row["Event_ID"]);
    	}
    }

    $noOfEvents = sizeof($eventList);

    if($noOfEvents == 0)
      echo "No events to display";
    else
    {
      echo '<div class="containers">';
      for($i = 0; $i < $noOfEvents; $i++)
      {
      	if($i % 3 == 0)
      	{
      	   if($i == 0)
      	     echo '<div class="containers">';
      	   else
      	     echo '</div><div class="containers">';
      	}
      	$event = getEventData($eventList[$i]);
        echo '<div class="box 1"><a href="joinevent.php?eventName='.$event["Name"].'&eventLocation='.$event["Location"].'&eventExpirationDate='.$event["Expiration_Date"] . '&eventID='.$eventList[$i].' "> '.$event["Name"].'</a></div>'; // Useful info on sending data to the next page via a hyperlink: https://stackoverflow.com/questions/9696194/how-to-send-a-data-to-php-page-when-clicking-on-a-link
      }
      echo '<div class="clear-both"></div></div>';
    }
?>

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
