<?php session_start();
//ini_set('display_errors', 1); 
include 'php_queries.php'; // Vlad's query file is imported  
// Initiating a 'Session' to allow the sending of data to subsequent pages

if ($_SERVER["REQUEST_METHOD"] == "POST")       // The data is retrieved from the source and is treated for sql
{                                                                                         // injection
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
if(!empty($username) && !empty($password) && logIn($username, $password) && !isset($_SESSION['username']))
{
  $_SESSION['username'] = $username;    // Explanation for use of 'Session' at: https://stackoverflow.com/questions/871858/php-pass-variable-to-next-page
  // header("Location: profile.php");     // Replace html file names where appropriate. Explanation for use of 'header' at: https://my.bluehost.com/hosting/help/241 Removed to fix redirects
  echo '<script language="javascript"> window.location.href = "index.php";</script>'; // Javascript that when echoed will redirect page as appropriate
}
else
{
  echo '<script language="javascript"> window.location.href = "login.php";</script>';
}
exit;
?>
