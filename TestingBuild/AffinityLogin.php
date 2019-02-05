<!-- Designed to be run without actually calling the php page itself. Refer to the link below
for possible methods of implementation:
https://stackoverflow.com/questions/11958243/button-that-runs-a-php-script-without-changing-current-page
using hidden frames seems to be simplest method so consider using -->
<?php
include 'php_queries'; // Vlad's query file is imported
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")       // The data is retrieved from the source and is treated for sq1
{                                               // injection
  $username = test_input($_POST["username"]);
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
// Successful login means the users data will sent to the next page before redirection. Failed login means the user should
// be redirected to the failed login page (which will likely just be the original login page with a note saying that
// the login had failed and that they should try again)
if(logIn($username, $password))
{
  $_SESSION['userdata'] = getListOfLikableObjectsForUser($username);                // Explanation for use of 'Session' at: https://stackoverflow.com/questions/871858/php-pass-variable-to-next-page
  // echo "OPENED";
  header("Location: profile.html");     // Replace html file names where appropriate. Explanation for use of 'header' at: https://my.bluehost.com/hosting/help/241
}
else
  // echo "OPENED";
  header("Location: profile.html"); 
exit;
?>
