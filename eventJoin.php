<?php session_start();

include 'php_queries.php';

if(isset($_GET["eventID"]))
  $eventID = $_GET["eventID"];
if(isset($_SESSION['username']))
  $username = $_SESSION['username'];

if(!empty($username))
{
   if(!isUserParticipating($username, $eventID))
      addANewParticipation($username, $eventID);
}


echo '<script language="javascript"> window.location.href = "index.php";</script>';

?>
