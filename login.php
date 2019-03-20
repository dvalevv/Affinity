<?php session_start(); ?>
<!---
  <a href="https://www.facebook.com/milliomola">Abdelrahman Hamdy</a>
  Redesigned = Team Y8

-->
<head>
    <meta charset="utf-8">

    <title>Login/Register</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="toggle.js"></script>
    <meta name="description" content="Affinity Login/Register">
    <meta name="author" content="Team Y8">

    <link rel="stylesheet" href="css/login.css">

</head>
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



  <div class="user-card round5">
	  <div class="login-box">
        <form class="login-form" name="login" method="post" action="AffinityLogin.php">
			  <input type="text" name="username" class="username" placeholder="username">
			  <input type="password" name="password" class="password" placeholder="password">
			  <input type="submit" name="login" value="Login" class="login">
    </form>

		<div class="or"></div>
        <div class="fb-login-button" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" 
          data-use-continue-as="false" scope="public_profile, email" onlogin="checkLoginState();"></div>

		<a href="https://www.linkedin.com/oauth/v2/authorization?prompt=consent&response_type=code&redirect_uri=https://web.cs.manchester.ac.uk/y67040br/Affinity/linkedin.php&scope=r_liteprofile%20r_emailaddress&state=4hEX1BqPHFNjHEmGALnbOXeNzUO-Lobo&client_id=776mscfj8swxp4"
		   class="login-with-google">
			<span class="icon fa fa-google-plus"></span>
			Login with Linkedin
		</a>

	</div>
	<div class="signup-box">
      <form class="signup-form" name="signup" method="post" action="AffinityRegistration.php">
			<input type="text" name="username" class="username" placeholder="username">
			<input type="text" name="email" class="email" placeholder="email">
			<input type="password" name="password" class="password" placeholder="password">
			<input type="password" name="confirm-password" class="confirm-password" placeholder="confirm-password">
			<input type="submit" name="signup" value="Signup" class="signup">
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
