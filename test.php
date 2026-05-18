<?php
$c = mysqli_connect('localhost', 'root', '', 'skillmatch');
if (!$c) { die("Error: " . mysqli_connect_error()); }
$r = mysqli_query($c, 'SHOW TABLES');
while($row = mysqli_fetch_array($r)) {
    echo $row[0] . PHP_EOL;
}
?>
