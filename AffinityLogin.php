<!-- Designed to be run without actually calling the php page itself. Refer to the link below
for possible methods of implementation:
https://stackoverflow.com/questions/11958243/button-that-runs-a-php-script-without-changing-current-page
using hidden frames seems to be simplest method so consider using -->
<!--Information on the security of Sessions found at https://stackoverflow.com/questions/1181105/how-safe-are-php-session-variables, good enough as no data that necessarily needs to be highly secure is stored-->
<!--Information on ending sessions found at https://stackoverflow.com/questions/18705239/end-session-in-php and https://www.w3schools.com/php/php_sessions.asp-->
<?php
//ini_set('display_errors', 1); 
include 'php_queries.php'; // Vlad's query file is imported

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
if(logIn($username, $password) && $username != "" && $password != "")
{
  session_start();  // Initiating a 'Session' to allow the sending of data to subsequent pages
  $_SESSION['username'] = $username;    // Explanation for use of 'Session' at: https://stackoverflow.com/questions/871858/php-pass-variable-to-next-page
  // header("Location: profile.html");     // Replace html file names where appropriate. Explanation for use of 'header' at: https://my.bluehost.com/hosting/help/241 Removed to fix redirects
  echo '<script language="javascript"> window.location.href = "index.html"</script>'; // Javascript that when echoed will redirect page as appropriate
}
else
  echo '<script language="javascript"> window.location.href = "login.html"</script>';
exit;
?>
