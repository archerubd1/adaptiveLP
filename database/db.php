<?php
$host = "localhost";
$user = "root";
$pass = "root"; // UwAmp default is usually root
$db   = "astraal_lxp";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure session is started here so it's available everywhere
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>