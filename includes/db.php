<?php

$conn = mysqli_connect('localhost', 'root', '', 'myproject');

if(!$conn) {
    die ("Connection failed: " . mysqli_connect_error());
}

?>