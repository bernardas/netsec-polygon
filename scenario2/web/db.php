<?php
$dBServername = "#dBServername#";
$dBUsername = "#dBUsername#";
$dBPassword = "#dBPassword#";
$dBName = "#dBName#";

$con = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>