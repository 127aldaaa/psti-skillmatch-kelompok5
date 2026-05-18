<?php
$c = mysqli_connect('localhost', 'root', '');
$r = mysqli_query($c, 'SHOW TABLES IN peminatan_db');
if($r) {
    while($row = mysqli_fetch_array($r)) echo $row[0] . PHP_EOL;
} else {
    echo "Error: " . mysqli_error($c);
}
?>
