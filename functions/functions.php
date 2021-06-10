<?php
// Establish Connection to Database
function connect() {
    static $conn;
    if ($conn === NULL){ 
        $conn = mysqli_connect('remotemysql.com','iF0nI0tX1B','DbGYu5wcRW','iF0nI0tX1B');
    }
    return $conn;
}

?>
