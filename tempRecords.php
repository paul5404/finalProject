<!DOCTYPE html>
<html>
<body>

<h1>Display of csv file on Web page using php</h1>

<?php

$fp = fopen("cpu_temp.csv","r");

$arr = array();

while($row=fgetcsv($fp))
{
  $arr[] = $row;
}

print_r($arr);

?>

</body>
</html>
