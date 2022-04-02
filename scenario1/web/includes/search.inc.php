<?php
require "dbh.inc.php";
$keyword = $_POST['search'];

$sql = "SELECT * FROM doctors WHERE fname LIKE '%$keyword%' OR lname LIKE '%$keyword%' OR profession LIKE '%$keyword%'";

$res=$conn->query($sql);
?>