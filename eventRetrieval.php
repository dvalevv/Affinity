<?php session_start();
include 'php_queries.php';
$username = ""; // Arbritrary username - passed from previous page
$userEvents = getListOfEventsForUser($username);

$eventDetails = array();

for($l = 0; $l < sizeof($userEvents); $l++)
  array_push($userEvents, getEventData($userEvents[$l]));
?>
