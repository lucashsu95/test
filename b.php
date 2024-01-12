<?php
$db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
for ($i=1; $i<=10; $i++) {
    echo $i;
    echo "<br>";
}