<?php

include 'php_queries.php';
include 'PHP_toRunIndra.php';

ini_set("precision", 3);
function matchNumber($username1, $username2)
{
    $data1 = getListOfLikeableObjectsForUser($username1);
    $data2 = getListOfLikeableObjectsForUser($username2);

    $likes1 = array();
    $likes2 = array();

    while($row = $data1->fetch_assoc())
      array_push($likes1, $row["Object"]);

    while($row = $data2->fetch_assoc())
      array_push($likes2, $row["Object"]);

    //at this point, likes1 and likes2 hold strings representing the objects user1 or user2 likes.
    
    if(sizeof($likes1) == 0 || sizeof($likes2) == 0)
    	return 0;

    //this algorithm takes the maximum on each iteration and adds it to the total result
  	$totalResult = 0;
  	for($indexLikes1 = 0; $indexLikes1 < sizeof($likes1); $indexLikes1++)
  	{
  		$localMaximum = 0;
  		for($indexLikes2 = 0; $indexLikes2 < sizeof($likes2); $indexLikes2++)
  		{
        	$result = perform_Calculation($likes1[$indexLikes1], 
        	                              $likes2[$indexLikes2]);
        	if($localMaximum < $result)
        		$localMaximum = $result;
  		}
  		$totalResult = $totalResult + $localMaximum;
  	}

  	return $totalResult / sizeof($likes1);
}

?>
