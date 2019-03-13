<html>
<?php session_start(); ?>
<body>

Welcome <?php 


$incomingMessage =  $_GET["message"];
if(isset($_SESSION['username']))
	$username = $_SESSION['username'];
else
	$username = "Guest";
echo $incomingMessage;

$fp = fopen("chat.html", 'a');
fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$username."</b>: ".stripslashes(htmlspecialchars($incomingMessage))."<br></div>");
fclose($fp);



?><br>


</body>
</html>
