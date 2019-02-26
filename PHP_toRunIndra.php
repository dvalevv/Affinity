<!-- We are running a python program which is in a file directory (in this
case it is in my local Dropbox file directory) -we need to chande this- and
then you pass the arguments you want to send to the python program -->

<!-- Create a function that calls the python program with only two strings
and send it to the python program (which is then send to Indra) and we save
the output -->

<?php
function perform_Calculation($like1, $like2) {
  exec("python  ~/Dropbox/University/Course/Year\ 1/Semester\ 2/First\ Year\ Team\ Project/Indra.py $like1 $like2 2>&1", $output, $ret_code);
  return $output;
}

$var1 = perform_Calculation("computer", "robotics");
$var2 = perform_Calculation("classical music", "Mozart");
echo ((double)$var1[0]);
echo ((double)$var2[0]);
?>
