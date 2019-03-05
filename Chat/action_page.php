<html>
<body>

Welcome <?php 


$incomingMessage =  $_GET["message"];
$userName1 = "MikeJBrowne123";
$userName2 = "DenislavValev321";

echo $incomingMessage;

$fp = fopen($userName1.$userName2.".html", 'a');
fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>[USERNAME]</b>: ".stripslashes(htmlspecialchars($incomingMessage))."<br></div>");
fclose($fp);



?><br>


</body>
</html>
