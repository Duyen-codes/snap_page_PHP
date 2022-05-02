<?php
$host = 'db';
// Database user name
$dbname = 'snapdb';
$dbuser = 'root';
//database user password
$dbpass = 'lionPass';
// check the MySQL connection status
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
