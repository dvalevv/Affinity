<!-- Designed to be run without actually calling the php page itself. Refer to the link below
for possible methods of implementation:
https://stackoverflow.com/questions/11958243/button-that-runs-a-php-script-without-changing-current-page
using hidden frames seems to be simplest method so consider using -->
<?php
include '/home/h51205jo/Affinity/SQL_Scripts/php_queries'; // Vlad's query file is imported
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")       // The data is retrieved from the source and is treated for sq1
{                                               // injection
  $username = test_input($_POST["username"]);
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["password"]);
}
	
//Handling sql injection
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data; 
}
// If the username entered isn't already in the database, then everything proceeds as normal and an entry for them is created in the database.
// If not, then the user should be redirected to an appropriate page (which will likely be the original registration page but with a message
// indicating a failed registration
if(!checkForExistingUsername($username))
{
  createUser($username, $name, $email, $password);
  // Code for entering the users likes/dislikes to the database will be here. Will be written later.
  header("Location: /home/h51205jo/Affinity/Homepage.html");     // Replace html file names where appropriate. Explanation for use of 'header' at: https://my.bluehost.com/hosting/help/241
}
else
  header("Location: /home/h51205jo/Affinity/FailedRegPage.html"); 
exit;
?>
