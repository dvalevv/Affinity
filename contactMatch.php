<?php session_start(); ?>
<html>
<!---
  <a href="https://www.facebook.com/milliomola">Abdelrahman Hamdy</a>
  Redesigned = Team Y8

-->
    <meta charset="utf-8">

    <title>Contact Match</title>

    <meta name="description" content="Affinity Help">
    <meta name="author" content="Team Y8">

    <link rel="stylesheet" href="css/faq.css">


<body>

  <section class="banner light">
    <header class="wrapper light">
      <a href="#"><img class="logo" src="img/logoSmall.png" alt="Affinity"/></a>
    </header>
    <br>
  </section>

    <?php
  // To work locally must install specific package. See first response on https://stackoverflow.com/questions/14802606/mail-function-is-not-working-in-localhost-server (# apt-get install sendmail)
  if(isset($_GET['email']) && isset($_GET['detail']) && preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $_GET['email']))
  {
  if ($_SESSION['ContactID'] == "1")
     $to = $_SESSION['contact1Email'];
  elseif ($_SESSION['ContactID'] == "2")
     $to = $_SESSION['contact2Email'];
  elseif ($_SESSION['ContactID'] == "3")
     $to = $_SESSION['contact3Email'];

  $subject = "A match wants to meet!";
  $message = $_GET['detail'];
  $from = $_GET['email'];
  $headers = "From:" . $from;
  mail($to,$subject,$message,$headers);
  echo "Mail Sent.";
  }
  ?>
  <div class="user-card">
    <div class="login-box">
      <h2>Contact match</h2>
      <form class="login-form" name="contactMatch" action="">
        <form method="post" action=""> 
	  <input type="text" name="email" class="email" placeholder="your email (sender)" />
	  <input type="textarea" name="detail" class="detail" placeholder="Where do you want to meet?" />
          <input type="submit" name="contactMatch" value="Contact Match" class="contact" />
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
     </div>
   </footer>

<!--  End footer  -->
<!-- Footer -->

</html>
