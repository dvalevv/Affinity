<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/login.css">
    <title>Page2</title>
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
<?php
            //include "matching.php";
            //ini_set('display_errors', 1);

            if(isset($_GET["eventName"]))
              $eventName = $_GET["eventName"];
            if(isset($_GET["eventLocation"]))
              $eventLocation = $_GET["eventLocation"];
            if(isset($_GET["eventExpirationDate"]))
              $eventExpirationDate = $_GET["eventExpirationDate"];
            if(isset($_GET["eventID"]))
              $eventID = $_GET["eventID"];
            
            echo '<div class="user-card round5">
	            <div class="login-box">
                    ' . $eventName . '
                      Add user:
                      <form class="login-form" name="addUser" method="post" action="">
			<input type="text" name="user" class="user" placeholder="username">
			<input type="submit" name="addUser" value="Add User" class="login">
                      </form>
                      Remove user
                      <form class="login-form" name="removeUser" method="post" action="">
			<input type="text" name="user" class="user" placeholder="username">
			<input type="submit" name="removeUser" value="Remove User" class="login">
                      </form>
                    </div>
                  </div>'
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
