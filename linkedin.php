<?php session_start();
include "php_queries.php";
ini_set("display_errors", 0);
if(isset($_GET["code"]))
{
  $code = $_GET["code"];
  $state = $_GET["state"];
  if($state == "4hEX1BqPHFNjHEmGALnbOXeNzUO-Lobo")
  {
    $ch = curl_init();
    $URL = 'https://www.linkedin.com/oauth/v2/accessToken?grant_type=authorization_code&code='.$code.'&redirect_uri=https://web.cs.manchester.ac.uk/y67040br/Affinity/linkedin.php&client_id=776mscfj8swxp4&client_secret=D8DfEZONw2i08r2x ';
    $URL = preg_replace('/\\0/', "", $URL);
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $token = curl_exec($ch);
    $json = json_decode($token, true);
    $realtoken = $json['access_token'];
    //echo $realtoken;
    if (curl_errno($ch))
    {
      echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $ch2 = curl_init();
    $URL2 = 'https://api.linkedin.com/v2/me?oauth2_access_token='.$realtoken;
    $URL2 = preg_replace('/\\0/', "", $URL2);
    curl_setopt($ch2, CURLOPT_URL, $URL2);
    curl_setopt($ch2, CURLOPT_HEADER, 0);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

    $namesJson = curl_exec($ch2);
    $namesDecoded = json_decode($namesJson, true);
    $lastName = $namesDecoded['lastName']['localized']['en_US'];
    $firstName = $namesDecoded['firstName']['localized']['en_US'];
    $name = $firstName.' '.$lastName;
    //echo $name;
    curl_close($ch2);

    $ch1 = curl_init();
    $URL1 = 'https://api.linkedin.com/v1/people/~:(email-address) ?oauth2_access_token='.$realtoken;
    $URL1 = preg_replace('/\\0/', "", $URL1);
    curl_setopt($ch1, CURLOPT_URL, $URL1);
    curl_setopt($ch1, CURLOPT_HEADER, 0);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

    $email = curl_exec($ch1);
    //echo $email;
    curl_close($ch1);

    if (!checkForExistingUsername($name))
    {
      echo "shit0"
      createUser($name, $email, $realtoken);
    }
    createUser($name, $email, $realtoken);
    echo "shit00"
    echo "shit1";
    echo $name;
    echo "shit2";
    //$_SESSION['username'] = $name;    // Explanation for use of 'Session' at: https://stackoverflow.com/questions/871858/php-pass-variable-to-next-page
    // header("Location: profile.php");     // Replace html file names where appropriate. Explanation for use of 'header' at: https://my.bluehost.com/hosting/help/241
    //echo '<script language="javascript"> window.location.href = "index.php";</script>';
  }
  else
  {
    echo 'Unautorized, wrong state';
  }
}
else if(isset($_GET["error"]))
{
  echo 'Unautorized, user not logged';
}
?>
