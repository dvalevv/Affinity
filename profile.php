<?php session_start(); ?>
<html>
  <head>
    <title>Your Profile</title>
    <meta charset="utf-8">
    <meta name="author" content="Team Y8">
    <meta name="description" content="Affinity - What Do We Have In Common?"/>

    <link rel="stylesheet" type="text/css" href="css/login.css">
  </head>

  <body>
    <section class="banner light">
      <header class="wrapper light">
        <a href="#"><img class="logo" src="img/logoSmall.png" alt="Affinity"/></a>
        <nav>
          <ul>
  	  <li><a href="./index.php">Home</a></li>

            <?php if (isset($_SESSION['username'])) { 
            echo '<li><a href="./profile.php">Profile</a></li>';
          }?>
          <li><a href="./events.php">Events</a></li>
   
          <?php if (!isset($_SESSION['username'])) { 
            echo '<li><a href="./login.php">Login/Register</a></li>';
          } else { 
            echo '<li><a href="./AffinityLogout.php">Logout</a></li>';
          } ?>

            <li><a href="./help.php">Help</a></li>
          </ul>
        </nav>
      </header>
      <br>
    </section>

    <?php
    //ini_set('display_errors', 1);
    include 'php_queries.php'; // Vlad's query file is imported
    //session_start();
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

      echo '<h1>Profile</h1>
      <h2>Name:</h2>
      <p>' . $username . '</p>
      <h2>Likes:</h2>
      <p>' . $likeString . '</p>
      <section class="settings">
        <h1>Settings</h1>
        <form name="settings" method="post" action="UpdateProfile.php">
          Email:
          <input type="text" name="email"> <br>
          Password:
          <input type="password" name="password"> <br>
          Confirm password:
          <input type="password" name="cPassword"> <br>
          Add Likes:
          <input type="text" name="addLikes"> <br>
          Update Likes:
          <input type="text" name="updateLikes"> <br>
          <input type="submit" name="saveChanges" value="Save Changes">
        </form>
      </section>';
     }
    else
    {
    echo "<h1>Profile</h1>
    <h2>Profile picture:</h2>
    <img src='' alt='Profile picture'>
    <h2>Name:</h2>
    <p>Name goes here...</p>
    <h2>Likes:</h2>
    <p>Likes go here...</p> <br>";
    }
    ?>
<!--
  <section class="settings">
    <h1>Settings</h1>
    <form name="settings" method="post" action="UpdateProfile.php">
      Email:
      <input type="text" name="email"> <br>
      Password:
      <input type="password" name="password"> <br>
      Confirm password:
      <input type="password" name="cPassword"> <br>
      Add Likes:
      <input type="text" name="addLikes"> <br>
      Update Likes:
      <input type="text" name="updateLikes"> <br>
      <input type="submit" name="saveChanges" value="Save Changes">
    </form>
  </section>
-->
<footer>
  <div class="wrapper">
      <div class="rights">
        <img src="img/logofooter.png" alt="" class="footer_logo"/>
        <p>© Affinity. All Rights Reserved 2019 </p>
      </div>

      <nav>
        <ul>
          <li><a href="./index.php">Home</a></li>

          <?php if (isset($_SESSION['username'])) { 
            echo '<li><a href="./profile.php">Profile</a></li>';
          }?>
          <li><a href="./events.php">Events</a></li>
   
          <?php if (!isset($_SESSION['username'])) { 
            echo '<li><a href="./login.php">Login/Register</a></li>';
          } else { 
            echo '<li><a href="./AffinityLogout.php">Logout</a></li>';
          } ?>

           <li><a href="./help.php">Help</a></li>
         </ul>
       </nav>
     </div>
   </footer>
  </body>
</html>
