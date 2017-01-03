<?php
$dbhost = getenv("127.0.0.1");
$dbport = getenv("3306");
$dbuser = getenv("Admin");
$dbpwd = getenv("root");
$dbname = getenv("sampledb");

$connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
} else {
    printf("Connected to the database");
}
$connection->close();
?>
