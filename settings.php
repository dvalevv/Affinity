<!doctype html>
<?php session_start(); ?>
<!---
  <a href="https://www.facebook.com/milliomola">Abdelrahman Hamdy</a>
  Redesigned = Team Y8

-->
    <meta charset="utf-8">

    <title>Settings</title>


    <meta name="description" content="Affinity Settings">
    <meta name="author" content="Team Y8">

    <link rel="stylesheet" href="css/login.css">


<body>



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



</body>

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





</html>
