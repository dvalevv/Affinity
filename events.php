<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Events</title>
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
          <li><a href="events.php">Events</a></li>
	  <li><a href="createevent.html">Create Event</a></li>
          <li><a href="settings.html">Settings</a></li>
          <li><a href="login.html">Login</a></li>
        </ul>
      </div>
      <div class="clear-both"></div>
    </div>

    <!-- Adding code for generating events and displaying their details on the page (Jason) -->    
<?php
    // ini_set('display_errors', 1); // Useful code for displaying the cause of errors. Sourced from link: https://stackoverflow.com/questions/17693391/500-internal-server-error-for-php-file-not-for-html
    include "php_queries.php";
    $eventList = array();
    $eventQuery = getAllEventID(); // The getAllEventID function returns the query object, which we can then call in the loop below to push each ID in the database onto the eventList array
    
    while($row = $eventQuery->fetch_assoc())
      array_push($eventList, $row["Event_ID"]);

    $noOfEvents = sizeof($eventList);

    if($noOfEvents == 0)
      echo "No events to display";
    else
    {
      echo '<div class="body">';
      for($i = 0; $i < $noOfEvents; $i++)
      {
      	if($i % 3 == 0)
      	{
      	   if($i == 0)
      	     echo '<div class="col-3">';
      	   else
      	     echo '</div><div class="col-3">';
      	}
      	$event = getEventData($eventList[$i]);
        echo '<div class="event"><a href="joinevent.php?eventName='.$event["Name"].'&eventLocation='.$event["Location"].'&eventExpirationDate='.$event["Expiration_Date"].'"> '.$event["Name"].' <img src="img/event.png" alt="'.$event["Name"].'"></a></div>'; // Useful info on sending data to the next page via a hyperlink: https://stackoverflow.com/questions/9696194/how-to-send-a-data-to-php-page-when-clicking-on-a-link
      }
      echo '<div class="clear-both"></div></div>';
    }
?>

<!--
    <div class="body">
      <div class="col-3">
        <div class="event">
          <a href="joinevent.html"><img src="images/event.png" alt="Event"></a>
        </div>
        <div class="event">
          <a href="joinevent.html"><img src="images/event.png" alt="Event"></a>
        </div>
        <div class="event">
          <a href="joinevent.html"><img src="images/event.png" alt="Event"></a>
        </div>
      </div>
      <div class="col-3">
        <div class="event">
          <a href="joinevent.html"><img src="images/event.png" alt="Event"></a>
        </div>
        <div class="event">
          <a href="joinevent.html"><img src="images/event.png" alt="Event"></a>
        </div>
        <div class="event">
          <a href="joinevent.html"><img src="images/event.png" alt="Event"></a>
        </div>
      </div>
      <div class="col-3">
        <div class="event">
          <a href="joinevent.html"><img src="images/event.png" alt="Event"></a>
        </div>
        <div class="event">
          <a href="joinevent.html"><img src="images/event.png" alt="Event"></a>
        </div>
        <div class="event">
          <a href="joinevent.html"><img src="images/event.png" alt="Event"></a>
        </div>
      </div>
      <div class="clear-both"></div>
    </div>
-->
    <div class="footer">
      <p>© 2019 Affinity (UK). All rights reserved. </p>
    </div>
  </div>
</body>
</html>
