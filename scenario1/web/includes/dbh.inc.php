<?php
$dBServername = "#dBServername#";
$dBUsername = "#dBUsername#";
$dBPassword = "#dBPassword#";
$dBName = "#dBName#";

$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
