<!doctype html>
<?php session_start(); ?>
<!---
  <a href="https://www.facebook.com/milliomola">Abdelrahman Hamdy</a>
  Redesigned = Team Y8

-->
    <meta charset="utf-8">

    <title>Login/Register</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="toggle.js"></script>
    <meta name="description" content="Affinity Login/Register">
    <meta name="author" content="Team Y8">

    <link rel="stylesheet" href="css/login.css">


<body>

  <div id="fb-root"></div>
  <script async defer src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2&appId=401356637298458&autoLogAppEvents=1"></script>
  <script src="FacebookLoginScript.js"></script>

  <section class="banner light">
    <header class="wrapper light">
      <a href="#"><img class="logo" src="img/logoSmall.png" alt="Affinity"/></a>
      <nav>
        <ul>
	  <li><a href="./index.php">Home</a></li>

          <?php if (isset($_SESSION['username'])) { 
            echo '<li><a href="./profile.php">Profile</a></li>
            <li><a href="./settings.php">Settings</a></li>';
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



  <h1>Settings</h1>
  <form method="post">
    Photo:
    <img src="" alt="Profile picture">
    <p>(Some way to change profile picture goes here)</p>
    First name:
    <input type="text" name="firstName"> <br>
    Last name:
    <input type="text" name="lastName"> <br>
    Email:
    <input type="text" name="email"> <br>
    Password:
    <input type="password" name="password"> <br>
    Confirm password:
    <input type="password" name="cPassword"> <br>
    Likes:
    <input type="text" name="likes"> <br>
    <input type="submit" value="Save Changes">
  </form>

	</div>

  <div class="footerb">
		<span>or </span><a class="toggle-link" href="#">Sign Up</a>
	</div>
</div>
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

          <?php if (isset($_SESSION['username'])) { 
            echo '<li><a href="./profile.php">Profile</a></li>
            <li><a href="./settings.php">Settings</a></li>';
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

  <!--  End footer  -->
	<!-- Footer -->




    </body>
</html>
