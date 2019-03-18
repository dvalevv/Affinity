<?php session_start(); ?>
<html lang="en">
<head>
  <title>Affinity - What Do We Have In Common?</title>
  <meta charset="utf-8">
  <meta name="author" content="Team Y8">
  <meta name="description" content="Affinity - What Do We Have In Common?"/>

  <link rel="stylesheet" type="text/css" href="css/main.css">
  
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

    <div class="caption light">
      <h1>What Do We Have In Common?</h1>
      <p>Find Matches At Events Near You...</p>
      <hr>
    </div>
    <div class="container peopleImage"></div>

  </section><!--  End banner  -->

  <section class="events wrapper">
    <ul class="clearfix">
      <li class="event1 tableRow">
        <img class="event" src="img/event1.png" alt=""/>
        <span class="separator"></span>
        <h2>Concerts Near You</h2>
        <p>Find and connect with people at concerts near you, based on interests, hobbies etc...</p>
      </li>

      <li class="event2 tableRow">
        <img class="icon" src="img/event2.png" alt=""/>
        <span class="separator"></span>
        <h2>Conferences Near You</h2>
        <p>Find and connect with people at conferences near you, based on interests, hobbies etc...</p>
      </li>

      <li class="event3 tableRow">
        <img class="icon" src="img/event3.png" alt=""/>
        <span class="separator"></span>
        <h2>Socials Near You</h2>
        <p>Find and connect with people at socials near you, based on interests, hobbies etc...</p>
      </li>

      <li class="event4 tableRow">
        <img class="icon" src="img/event3.png" alt=""/>
        <span class="separator"></span>
        <h2>Socials Near You</h2>
        <p>Find and connect with people at socials near you, based on interests, hobbies etc...</p>
      </li>
      
    </ul>
  </section><!--  End Events  -->

  <section class="team wrapper">
    <div class="team title">
      <h2>Meet The Team</h2>
      <h3><font color="black">The members of our team are match making experts!</font></h3>
      <hr class="separator"/>
      <ul class="clearfix">
        <li class="member1 tableRow">
          <p><img src="img/quotes.png" alt="" class="quotes"/>Dolor sit amet consectetur isicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam quis nostrud laboris.
            <span class="triangle"></span>
          </p>
          <div class="member">
            <img src="img/member1.png" class="avatar"/>
            <div class="member_details">
              <h4>Ben Rimmer</h4>
            </div>
          </div>
        </li>

        <li class="member2 tableRow"  data-wow-delay=".2s">
          <p><img src="img/quotes.png" alt="" class="quotes"/>Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam sunt in culpa officia deserunt mollit anim laborum sint occaecat.
            <span class="triangle"></span>
          </p>
          <div class="member">
            <img src="img/member1.png" class="avatar"/>
            <div class="member_details">
              <h4>Denislav Valev</h4>
            </div>
          </div>
        </li>

        <li class="member3 tableRow">
          <p><img src="img/quotes.png" alt="" class="quotes"/>Aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit in voluptate velit esse slum dolore eu fugiat nulla pariatursint occaecat.
            <span class="triangle"></span>
          </p>
          <div class="member">
            <img src="img/member1.png" class="avatar"/>
            <div class="member_details">
              <h4>Jason Ozuzu</h4>
            </div>
          </div>
        </li>

        <li class="member4 tableRow">
          <p><img src="img/quotes.png" alt="" class="quotes"/>Aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit in voluptate velit esse slum dolore eu fugiat nulla pariatursint occaecat.
            <span class="triangle"></span>
          </p>
          <div class="member">
            <img src="img/member1.png" class="avatar"/>
            <div class="membert_details">
              <h4>Juan Garcia Giraldo</h4>
            </div>
          </div>
        </li>

        <li class="member5 tableRow">
          <p><img src="img/quotes.png" alt="" class="quotes"/>Aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit in voluptate velit esse slum dolore eu fugiat nulla pariatursint occaecat.
            <span class="triangle"></span>
          </p>
          <div class="member">
            <img src="img/member1.png" class="avatar"/>
            <div class="member_details">
              <h4>Michael Browne</h4>
            </div>
          </div>
        </li>

        <li class="member6 tableRow">
          <p><img src="img/quotes.png" alt="" class="quotes"/>Aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit in voluptate velit esse slum dolore eu fugiat nulla pariatursint occaecat.
            <span class="triangle"></span>
          </p>
          <div class="member">
            <img src="img/member1.png" class="avatar"/>
            <div class="member_details">
              <h4>Rumaan Nasir</h4>
            </div>
          </div>
        </li>

        <li class="member7 tableRow">
          <p><img src="img/quotes.png" alt="" class="quotes"/>Aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit in voluptate velit esse slum dolore eu fugiat nulla pariatursint occaecat.
          <span class="triangle"></span>
          </p>
          <div class="member">
            <img src="img/member1.png" class="avatar"/>
            <div class="member_details">
              <h4>Vlad Alexandru Iacob</h4>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section><!--  End Team  -->

 <section class="indra">
    <div class="wrapper">
      <div class="title">
        <h2 style="">Indra Explained</h2>
        <h3>Artificial Intelligent Match Making</h3>
        <hr class="separator">
        <ul class="clearfix">
        </ul>
      </div>
    </div>
    <div class="container indraImage">
      <div class="row">
        <div class="col-md-12"><img class="img-fluid d-block" src="../img/indra_explained.jpg" height="500px" ></div>
      </div>
    </div>
  </section><!--  End Indra  -->
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
  </footer><!--  End footer  -->
  <iframe src="Chat/indexv2.html" style = "position: sticky;
  bottom: 0px;
  right: 0px;
  width: 50%;
  height: 50%;
  border: 3px solid #73AD21;"></iframe>
</body>
</html>
