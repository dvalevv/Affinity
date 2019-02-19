<!DOCTYPE html>
<html lang="en">
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
        <img src="images/logo.png" alt="Logo">
      </div>
      <div class="menu">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="events.html">Events</a></li>
	  <li><a href="createevent.html">Create Event</a></li>
          <li><a href="settings.html">Settings</a></li>
          <li><a href="login.html">Login</a></li>
        </ul>
      </div>
      <div class="clear-both"></div>
    </div>

    <!-- Adding code for generating events and displaying their details on the page (Jason) -->    
    <?php
    include "php_queries.php";
    session_start();
    $eventList = getAllEventID(); // Need a function to get the eventID of every event in the database
    $noOfEvents = sizeof($eventList);
    
    if(noOfEvents == 0)
      break;

    else if((noOfEvents % 3) == 0)
    {
      for($i = 0; $i < noOfEvents; $i+3)
        $event1 = getEventData($eventList[$i]); $event2 = getEventData($eventList[$i+1]); $event3 = getEventData($eventList[$i+2]);
        // Useful info on sending data to the next page via a hyperlink: https://stackoverflow.com/questions/9696194/how-to-send-a-data-to-php-page-when-clicking-on-a-link
        echo "<div class="body">
      <div class="col-3">
        <div class="event">
          <a href="joinevent.php?eventData=$event1"> $event1["Name"] <img src="images/event.png" alt="$event1["Name"]"></a>
        </div>
        <div class="event">
          <a href="joinevent.php?eventData=$event2"> $event2["Name"] <img src="images/event.png" alt="$event2["Name"]"></a>
        </div>
        <div class="event">
          <a href="joinevent.php?eventData=$event3"> $event3["Name"] <img src="images/event.png" alt="$event3["Name"]"></a>
        </div>
      </div>
      <div class="clear-both"></div>
    </div>";
    }
    else
    {
      for($i = 0; $i < noOfEvents; $i++)
        $event = getEventData($eventList[$i]);
        echo "<div class="body">
      <div class="col-3">
        <div class="event">
          <a href="joinevent.php?eventData=$event"> $event["Name"] <img src="images/event.png" alt="$event["Name"]"></a>
        </div>
      <div class="clear-both"></div>
    </div>";
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
