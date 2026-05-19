<?php
$host = "localhost";
$user = "root";
$password = ""; // pune parola MySQL dacă există
$dbname = "21GYM";

$conn = new mysqli($host, $user, $password, $dbname);

$conn->autocommit(true); // Make sure auto-commit is enabled

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}

// Setare charset pentru suport diacritice
$conn->set_charset("utf8");
?>
