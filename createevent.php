<?php session_start(); ?>
<html>
    <meta charset="utf-8">

    <title>Create Event</title>

    <meta name="description" content="Affinity Create Event">
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



  <h1>Create Event</h1>
  <!-- Create event section: takes username/email and password -->
  <div id="createEvent">
    <h2>Create your own event:</h2>
    <!-- Form should validate user on this site. -->
    <form method="post" action = 'eventCreation.php'>
      Event name:<br>
      <input type="text" name="name"> <br>
      Event location:<br>
<input type="text" name="location"> <br>
      Event description:<br>
      <textarea name="description" rows="4" cols="30"></textarea> <br>
      Event publicity: <br>
      private:
      <input type="radio" name="publicity" value="0">
      public:
      <input type="radio" name="publicity" value="1"> <br><br>
Event expiration date:<br>
<input type="text" name="expirationDate"> <br>
      <input type="submit" value="Submit Event">
      <!-- This will submit to the events table-->
    </form>
  </div>
  <!--
  Maybe something here to browse events that relate to the one they
  are creating/are nearby, so they can automatically join that event.
  -->

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





</html>
