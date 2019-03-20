<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/login.css">
    <title> Event Management </title>
</head>
<body>
  <section class="banner light">
    <header class="wrapper light">
      <a href="#"><img class="logo" src="img/logoSmall.png" alt="Affinity"/></a>
      <nav>
        <ul>
	  <li><a href="./index.php">Home</a></li>

          <?php if (isset($_SESSION['username'])) { ?>
            <li><a href="./profile.php">Profile</a></li>
          <?php } ?>
          <li><a href="./eventoptions.php">Events</a></li>

          <?php if (!isset($_SESSION['username'])) { ?>
            <li><a href="./login.php">Login/Register</a></li>
          <?php } else { ?>
	    <li><a href="./AffinityLogout.php">Logout</a></li>
          <?php } ?>

          <li><a href="./help.php">Help</a></li>
        </ul>
      </nav>
    </header>
    <br>
  </section>

  <!--Some javascript for opening a pop up window. Refer to http://w3schools.invisionzone.com/topic/23862-how-to-open-a-popup-window-in-php-code/ for code-->
  <script type="text/javascript">function openRequestedPopup(){ window.open('contactMatch.php', 'ContactMatch', 'width=545,height=600,resizable=yes,scrollbars=yes,status=yes');}</script>
<?php  //Added functionality to event management page and fixed typo in php_queries
            //include "matching.php";
            //ini_set('display_errors', 1);
            include "php_queries.php";

            //Handling sql injection
            function test_input($data)
            {
               $data = trim($data);
               $data = stripslashes($data);
               $data = htmlspecialchars($data);
               return $data;
            }

            if(isset($_GET["eventName"]))
              $eventName = $_GET["eventName"];
            if(isset($_GET["eventLocation"]))
              $eventLocation = $_GET["eventLocation"];
            if(isset($_GET["eventExpirationDate"]))
              $eventExpirationDate = $_GET["eventExpirationDate"];
            if(isset($_GET["eventID"]))
              $eventID = $_GET["eventID"];
              
            echo '<div class="groupBox">
                  <div class="user-card big left">
	            <div class="login-box">
                      <h2>Users in event:<h2>
                      <ul>';
                      
            $usersInEventQuery = getListOfUsersForEvent($eventID);
            
            while($row = $usersInEventQuery->fetch_assoc())
            {
                if($row['Username'] != $_SESSION['username'])
                   echo "<li>". $row['Username'] . "</li>";
            }
            
            echo     '</ul>
                    </div>
                  </div>';
            
            echo '<div class="user-card big right">
	            <div class="login-box">
                      <h1>' . $eventName . '</h1>
                      Add user(s):
                      <form class="login-form" name="addUser" method="post" action="">
			<input type="text" name="user" class="user" placeholder="username">
			<input type="submit" name="addUser" value="Add User(s)" class="login">
                      </form>
                      Remove user(s):
                      <form class="login-form" name="removeUser" method="post" action="">
			<input type="text" name="user" class="user" placeholder="username">
			<input type="submit" name="removeUser" value="Remove User(s)" class="login">
                      </form>
                      <div class="or"></div>
                      <form class="login-form" name="deleteEvent" method="post" action="">
                        Password:
                        <input type="password" name="password"> <br>
                        Confirm password:
                        <input type="password" name="cPassword"> <br>                        
			<input type="submit" name="deleteEvent" value="Delete Event" class="login">
                      </form>
                    </div>
                  </div>
                  </div>';

            if(isset($_SESSION['username']) && isset($_POST['deleteEvent']) && password_verify($_POST['password'], $userpass) && $_POST['cPassword'] == $_POST['password'])
               deleteEvent($eventID);
            
            elseif (isset($_SESSION['username']) && isset($_POST['addUser']))
            {
               $usersToAdd = explode(", ", test_input($_POST["addUser"]));
               for($i = 0; $i < sizeof($usersToAdd); $i++)
               {
                  if (checkForExistingUsername($usersToAdd[$i]) && ($usersToAdd[$i] != $_SESSION['username'])
                     addANewParticipation($usersToAdd[$i], $eventID);
               }
            }
            elseif (isset($_SESSION['username']) && isset($_POST['removeUser']))
            {
               $usersToRemove = explode(", ", test_input($_POST["addUser"]));
               for($i = 0; $i < sizeof($usersToRemove); $i++)
               {
                  if (checkForExistingUsername($usersToRemove[$i]) && $usersToRemove[$i] != $_SESSION['username'])
                     removeAParticipation($usersToRemove[$i], $eventID);
               }
            }
?>

<!--
            <div class="col-7">
                <p>Behemoth</p>
                <p>O2 Ritz, Manchester. Saturday, 09 Feb 2019 </p>
                <button>Click Here to Find a Match</button>
            </div>
            <div class="clear-both"></div>
-->
        </div>
        <footer>
          <div class="wrapper">
              <div class="rights">
                <img src="img/logofooter.png" alt="" class="footer_logo"/>
                <p>© Affinity. All Rights Reserved 2019 </p>
              </div>

              <nav>
                <ul>
                  <li><a href="./index.php">Home</a></li>

                  <?php if (isset($_SESSION['username'])) { ?>
                    <li><a href="./profile.php">Profile</a></li>
                  <?php } ?>
                  <li><a href="./eventoptions.php">Events</a></li>

                  <?php if (!isset($_SESSION['username'])) { ?>
                    <li><a href="./login.php">Login/Register</a></li>
                  <?php } else { ?>
                     <li><a href="./AffinityLogout.php">Logout</a></li>
                   <?php } ?>

                   <li><a href="./help.php">Help</a></li>
                 </ul>
               </nav>
             </div>
           </footer>

</body>
</html>
