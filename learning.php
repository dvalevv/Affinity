<?php
include 'matching.php';
$data1 = getListOfLikeableObjectsForUser("Vlad.Iacob");

$likes1 = array();

while($row = $data1->fetch_assoc())
  array_push($likes1, $row["Object"]);

echo matchNumber($likes1, "Ben.Rimmer");
?>
