
<?php session_start();
// ini_set('display_errors', 1); 
include 'php_queries.php'; // Vlad's query file is imported
  // Initiating a 'Session' to allow the sending of data to subsequent pages

if ($_SERVER["REQUEST_METHOD"] == "POST")       // The data is retrieved from the source and is treated for sq1
{                                                                                         // injection
  $username = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["password"]);
  $cPassword = test_input($_POST["confirm-password"]);
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
if($password == $cPassword && !checkForExistingUsername($username) && $username != "" && $email != "" && $password != "" && $cPassword != "" && preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email) && !isset($_SESSION['username']))
{
  createUser($username, $email, $password);
  $_SESSION['username'] = $username;    // Explanation for use of 'Session' at: https://stackoverflow.com/questions/871858/php-pass-variable-to-next-page

  // header("Location: profile.php");     // Replace html file names where appropriate. Explanation for use of 'header' at: https://my.bluehost.com/hosting/help/241
  echo '<script language="javascript"> window.location.href = "index.php";</script>';
}
else
  echo '<script language="javascript"> window.location.href = "login.php";</script>';
exit;
?>
