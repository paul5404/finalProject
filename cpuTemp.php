<!DOCTYPE html>
<html>
<body>

<h1>CPU Temperature Display</h1>

<?php

 $f = fopen("/sys/class/thermal/thermal_zone0/temp","r");

 $temp = fgets($f);

 echo 'SoC temperature is '.round($temp/1000);

 fclose($f);

?>
</body>
</html>

