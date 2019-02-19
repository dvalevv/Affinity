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
    ini_set('display_errors', 1); // Useful code for displaying the cause of errors. Sourced from link: https://stackoverflow.com/questions/17693391/500-internal-server-error-for-php-file-not-for-html
    include "php_queries.php";
    $eventList = getAllEventID(); // Need a function to get the eventID of every event in the database. This function for some reason does not currently return an array, making the code faulty
    $noOfEvents = sizeof($eventList);

    if($noOfEvents == 0)
      echo "No events to display";

    else if(($noOfEvents % 3) == 0)
    {
      for($i = 0; $i < $noOfEvents; $i+3)
      {
        $event1 = getEventData($eventList[$i]); $event2 = getEventData($eventList[$i+1]); $event3 = getEventData($eventList[$i+2]);
        // Useful info on sending data to the next page via a hyperlink: https://stackoverflow.com/questions/9696194/how-to-send-a-data-to-php-page-when-clicking-on-a-link
        echo "<div class=\"body\">
      <div class=\"col-3\">
        <div class=\"event\">
          <a href=\"joinevent.php?eventName=$event1[Name]&&eventLocation=$event1[Location]&&eventExpiration=$event1[Expiration_Date]\"><img src=\"img/event.png\" alt=\"$event1[Name]\"></a>
        </div>
        <div class=\"event\">
          <a href=\"joinevent.php?eventName=$event2[Name]&&eventLocation=$event2[Location]&&eventExpiration=$event2[Expiration_Date]\"><img src=\"img/event.png\" alt=\"$event2[Name]\"></a>
        </div>
        <div class=\"event\">
          <a href=\"joinevent.php?eventName=$event3[Name]&&eventLocation=$event3[Location]&&eventExpiration=$event3[Expiration_Date]\"><img src=\"img/event.png\" alt=\"$event3[Name]\"></a>
        </div>
      </div>
      <div class=\"clear-both\"></div>
    </div>";
     }
    }
    else
    {
      for($i = 0; $i < $noOfEvents; $i++)
      {
        // $event = getEventData($eventList[$i]); // requires modification to getEventData function to allow it to return an array. Currently returns a mysqli object.
        $event = getEventData(1);
        echo "<div class=\"body\">
      <div class=\"col-3\">
        <div class=\"event\">
          <a href=\"joinevent.php?eventName=$event[Name]&&eventLocation=$event[Location]&&eventExpiration=$event[Expiration_Date]\"><img src=\"img/event.png\" alt=\"$event[Name]\"></a>
        </div>
      <div class=\"clear-both\"></div>
    </div>";
     }
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
