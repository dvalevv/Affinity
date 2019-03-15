<!doctype php>
<?php session_start(); ?>
<html>
<!---
  <a href="https://www.facebook.com/milliomola">Abdelrahman Hamdy</a>
  Redesigned = Team Y8

-->
    <meta charset="utf-8">

    <title>Help</title>

    <meta name="description" content="Affinity Help">
    <meta name="author" content="Team Y8">

    <link rel="stylesheet" href="css/help.css">


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

  <div class="user-card left">
    <div class="login-box">
      <h2>FAQ</h2>
      <h3>What is Affinity?</h3>
      <p>Affinity is blah blah blah.</p>
      <h3>What is Indra?</h3>
      <p>Indra is blah blah blah.</p>
    </div>
  </div>

  <div class="user-card right">
    <div class="login-box">
      <h2>Contact us</h2>
      <form class="login-form" name="contact" action="">
        <form method="post" action=""> <!-- Action needed -->
	  <input type="text" name="email" class="email" placeholder="email" />
	  <input type="text" name="question" class="question" placeholder="question" />
	  <input type="text" name="detail" class="detail" placeholder="details..." />
          <input type="submit" name="contact" value="Contact" class="contact" />
        </form>
      </form>
    </div>
  </div>
</div>
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
