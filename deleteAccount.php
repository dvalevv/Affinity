<?php session_start();

include 'php_queries.php';

if($_POST['cDeleteAcc'] == 'confirm')
{
   $username = $_SESSION['username'];
   $events = array();

   $data = getListOfEventsForUser($username);

   while($row = $data->fetch_assoc())
      array_push($events, $row["Event_ID"]);

   for($i = 0; $i < count($events); $i++)
      deleteEvent($events[$i]);

   deleteAllObjectsFromLikes($username);
   
   deleteUser($username);
}

?>
