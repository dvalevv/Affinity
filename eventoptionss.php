
<!doctype html>
<!---
  <a href="https://www.facebook.com/milliomola">Abdelrahman Hamdy</a>
  Redesigned = Team Y8
-->
    <meta charset="utf-8">

    <title>Events</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="toggle.js"></script>
    <meta name="description" content="Affinity Help">
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

  <div style="display:flex">
       <div style="flex:0;padding-right:5px; margin-left:160px; margin-top:60px;">
            <a href="createevent.php"><img src="img/manageevents.png">
       </div>
       <div style="flex:1;padding-left:50px; margin-top:60px;">
            <a href="events.php"><img src="img/createevent.png">
       </div>
       <div style="flex:2;padding-left:50px; margin-top:60px;">
            <a href="events.php"><img src="img/joinevent.png">
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

<!--  End footer  -->
<!-- Footer -->
</body>
</html>
