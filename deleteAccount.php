<?php session_start();

include 'php_queries.php';

if($_POST['cDeleteAcc'] == 'confirm')
{
   $username = $_SESSION['username'];
   $events = array();
   $eventsP = array();

   $data = getListOfEventsForUser($username);

   while($row = $data->fetch_assoc())
   {
      $eData = getEventData($row);
      if($eData['Master'] == $username)
         array_push($events, $row["Event_ID"]);
      else
         array_push($eventsP, $row["Event_ID"])
   }
  
   for($i = 0; $i < count($eventsP); $i++)
      removeAParticipation($username, $eventsP[$i]);

   for($i = 0; $i < count($events); $i++)
      deleteEvent($events[$i]);

   deleteAllObjectsFromLikes($username);
   
   deleteUser($username);
}
echo '<script language="javascript"> window.location.href = "index.php";</script>';
?>
