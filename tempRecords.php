
<?php

print("Display of csv file on Web using php);

header("Content-Type: text/plain");

$fp = fopen("cpu_temp.csv","r");

$arr = array();

while($row=fgetcsv($fp))
{
  $arr[] = $row;
}

print_r($arr);

?>

