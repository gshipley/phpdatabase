<?php
$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$dbuser = getenv("MYSQL_USER");
$dbpwd = getenv("MYSQL_PASSWORD");
$dbname = getenv("MYSQL_DATABASE");
$connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
} else {
    echo "Host: "$dbhost;
    echo "Port: "$dbport;
    echo "user: "$dbuser;
    echo "pwd: "$dbpwd;
    echo "dbname: "$dbname;
    printf("Connected to the database");
}
$connection->close();
?>
