<!-- Web page for profile -->
<!--Info on sessions https://stackoverflow.com/questions/4015729/php-session-start-->
<!DOCTYPE html>
<html>
  <head>
    <title>Your Profile</title>
    <meta charset="utf-8">
    <meta name="author" content="Team Y8">
    <meta name="description" content="Affinity - What Do We Have In Common?"/>

    <link rel="stylesheet" type="text/css" href="css/login.css">
  </head>

  <body>
    <!-- What profile needs:
    NavBar? SHOULD HAVE LOG OUT ON IT.
    Profile picture
    - decide on size later
    Name
    Likes
    -->
    <section class="banner light">
      <header class="wrapper light">
        <a href="#"><img class="logo" src="img/logoSmall.png" alt="Affinity"/></a>
        <nav>
          <ul>
  	  <li><a href="./index.html">Home</a></li>

            <?php if (isset($_SESSION['username'])) { ?>
              <li><a href="./profile.php">Profile</a></li>
              <li><a href="./settings.html">Settings</a></li>
            <?php } ?>
            <li><a href="./events.php">Events</a></li>

            <?php if (!isset($_SESSION['username'])) { ?>
              <li><a href="./login.html">Login/Register</a></li>
            <?php } else { ?>
  	    <li><a href="./AffinityLogout.php">Logout</a></li>
            <?php } ?>

            <li><a href="./help.html">Help</a></li>
          </ul>
        </nav>
      </header>
      <br>
    </section>

    <?php
    ini_set('display_errors', 1);
    session_start();
    include 'php_queries.php'; // Vlad's query file is imported

    if(isset($_SESSION['username'])) // Checking if the session variable for username has been set when this page is reached - allows there to be default values when the user visits this page for the first time.
    {
      $username = $_SESSION['username'];
      $userdata = getUserData($username);
      $likesArray = array();
      $userLikeQuery = getListOfLikeableObjectsForUser($username);
      $likeString = "";

      while($row = $userLikeQuery->fetch_assoc())
        array_push($likesArray, $row["Object"]);

      for($likeIndex = 0; $likeIndex < sizeof($likesArray); $likeIndex++)
      if($likeIndex == (sizeof($likesArray) - 1))
        $likeString = $likeString . $likesArray[$likeIndex];
      else
        $likeString = $likeString . $likesArray[$likeIndex] . ", ";

      echo "<h1>Profile</h1>
      <h2>Profile picture:</h2>
      <img src='' alt='Profile picture'>
      <h2>Name:</h2>
      <p>$userdata[Name]</p>
      <h2>Likes:</h2>
      <p>" . $likeString . "</p>";
     }
    else
    {
    echo "<h1>Profile</h1>
    <h2>Profile picture:</h2>
    <img src='' alt='Profile picture'>
    <h2>Name:</h2>
    <p>Name goes here...</p>
    <h2>Likes:</h2>
    <p>Likes go here...</p>";
    }
    ?>
<!--
    <h1>Profile</h1>
    <h2>Profile picture:</h2>
    <img src="" alt="Profile picture">
    <h2>Name:</h2>
    <p>Name goes here...</p>
    <h2>Likes:</h2>
    <p>Likes go here...</p>
-->

<footer>
  <div class="wrapper">
      <div class="rights">
        <img src="img/logofooter.png" alt="" class="footer_logo"/>
        <p>© Affinity. All Rights Reserved 2019 </p>
      </div>

      <nav>
        <ul>
          <li><a href="./index.html">Home</a></li>

          <?php if (isset($_SESSION['username'])) { ?>
            <li><a href="./profile.php">Profile</a></li>
            <li><a href="./settings.html">Settings</a></li>
          <?php } ?>
          <li><a href="./events.php">Events</a></li>

          <?php if (!isset($_SESSION['username'])) { ?>
            <li><a href="./login.html">Login/Register</a></li>
          <?php } else { ?>
             <li><a href="./AffinityLogout.php">Logout</a></li>
           <?php } ?>

           <li><a href="./help.html">Help</a></li>
         </ul>
       </nav>
     </div>
   </footer>
  </body>
</html>
