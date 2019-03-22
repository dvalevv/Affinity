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
          <li><a href="./eventoptions.php">Events</a></li>

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
    ini_set('display_errors', 0);
    include 'php_queries.php'; // Vlad's query file is imported
    //session_start();

   //Handling sql injection
   function test_input($data)
   {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
   }
    if(isset($_SESSION['username']) && isset($_POST['password']))
    {
      $userpass = getUserPassword($_SESSION['username']); // Variable for storing the users password. Used for checking if the password entered by the user is correct before letting them make changes. Currently initialised to my password until the encryption code is implemented
      $userpass = $userpass["Password"];
    }

   // Must check if the person is logged in, their passwords match and are correct for their account
    if((isset($_SESSION['username']) && password_verify($_POST['password'], $userpass) && $_POST['cPassword'] == $_POST['password']))  // Not possible to decrypt hashed values, so must use an in-build function to check if an entered password matches a hashed one stored in the database (details at https://stackoverflow.com/questions/24024702/how-can-i-decrypt-a-password-hash-in-php)
    {
      $username = $_SESSION['username'];
      // Must also that they haven't filled in both the add likes and update likes fields at the same time for obvious reasons
      if ($_POST['addLikes'] != "" && $_POST['updateLikes'] == "")
      {
           $likesAdded = explode(", ", test_input($_POST["addLikes"]));
           for($l = 0; $l < sizeof($likesAdded); $l++)
             addANewLikeableObject($username, $likesAdded[$l]);
      }
      elseif ($_POST['updateLikes'] != "" && $_POST['addLikes'] == "")
      {
           // First retrieve all of the users likes so that they can be deleted from the database.
           $likesArray = array();
           $userLikeQuery = getListOfLikeableObjectsForUser($username);

           while($row = $userLikeQuery->fetch_assoc())
              array_push($likesArray, $row["Object"]);

           for($l = 0; $l < sizeof($likesArray); $l++)
              deleteObjectFromLikes($username, $likesArray[$l]);

           // Now that the users likes have been wiped, must then add all of the likes they wish to replace them with to the database
           $replacementLikes = explode(", ", test_input($_POST["updateLikes"]));
           for($l = 0; $l < sizeof($replacementLikes); $l++)
              addANewLikeableObject($username, $replacementLikes[$l]);
      }
    }
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
        <form name="settings" method="post" action="">
          Password:
          <input type="password" name="password"> <br>
          Confirm password:
          <input type="password" name="cPassword"> <br>
          Add Likes (separated by commas):
          <input type="text" name="addLikes"> <br>
          Update Likes (separated by commas):
          <input type="text" name="updateLikes"> <br>
          <input type="submit" name="saveChanges" value="Save Changes">
        </form>
        <h3>Delete account:</h3>
        <form name="account" method="post" action="deleteAccount.php">
          Confirm:
          <input type="checkbox" name="cDeleteAcc" value="confirm">
          <input type="submit" name="deleteAccount" value="Delete Account">
        </form>
      </section>';
     }
    else
    {
    echo "<h1>Profile</h1>
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
          <li><a href="./eventoptions.php">Events</a></li>

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
