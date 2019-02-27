<!-- Designed to be run without actually calling the php page itself. Refer to the link below
for possible methods of implementation:
https://stackoverflow.com/questions/11958243/button-that-runs-a-php-script-without-changing-current-page
using hidden frames seems to be simplest method so consider using -->
<?php
// ini_set('display_errors', 1); 
include 'php_queries.php'; // Vlad's query file is imported

if ($_SERVER["REQUEST_METHOD"] == "POST")       // The data is retrieved from the source and is treated for sq1
{                                                                                         // injection
  $username = test_input($_POST["username"]);
  $firstName = test_input($_POST["firstName"]);
  $lastName = test_input($_POST["lastName"]);
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["password"]);
  $cPassword = test_input($_POST["cPassword"]);
  $likes = explode(" ", test_input($_POST["likes"]));
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
if($password == $cPassword && !checkForExistingUsername($username) && $username != "" && $firstName != "" && $lastName != "" && $username != "" && $email != "" && $password != "" && $cPassword != "" && $likes != "" && preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email) && !isset($_SESSION['username']))
{
  createUser($username, $firstName." ".$lastName, $email, $password);

  for($l = 0; $l < sizeof($likes); $l++)
    addANewLikeableObject($username, $likes[$l]);

  session_start();  // Initiating a 'Session' to allow the sending of data to subsequent pages
  $_SESSION['username'] = $username;    // Explanation for use of 'Session' at: https://stackoverflow.com/questions/871858/php-pass-variable-to-next-page

  // header("Location: profile.html");     // Replace html file names where appropriate. Explanation for use of 'header' at: https://my.bluehost.com/hosting/help/241
  echo '<script language="javascript"> window.location.href = "index.html"</script>';
}
else
  echo '<script language="javascript"> window.location.href = "login.html"</script>';
exit;
?>
