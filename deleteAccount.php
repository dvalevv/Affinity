<?php session_start();

include 'php_queries.php';

if($_POST['cDeleteAcc'] == 'confirm')
{
   $username = $_SESSION['username'];
   $events = array();

   for($i = 0; $i < count($events); $i++)
      deleteEvent($events[$i]);

   deleteObjectFromLikes($username);
   
   deleteUser($username);
}

?>
