<!-- Need some code to pass relevant variables. Will likely be some implementation involving sessions i.e. sending data using sessions to a page then using sessions again to send to a subsequent page (see previous code)-->
<?php
include 'php_queries.php';
session_start();
$username = ""; // Arbritrary username - passed from previous page
$userEvents = getListOfEventsForUser($username);

$eventDetails = array();

for($l = 0; $l < sizeof($userEvents); $l++)
  array_push($userEvents, getEventData($userEvents[$l]));
?>
