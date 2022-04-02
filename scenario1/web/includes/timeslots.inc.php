<?php
if (isset($_POST['declaration-submit'])) {
require '../header.php';
require 'dbh.inc.php';

$startTime = $_POST['dateFrom'];
$endTime = $_POST['dateTo'];

$sql = "INSERT INTO appointments (doc_id, date, hour, minute) VALUES (?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../panel.php?error=sqlerror");
    exit();
}
    $startTime    = strtotime ($startTime);
    $endTime      = strtotime ($endTime);
    $duration = 20;
    $addMins  = $duration * 60;
    while ($startTime <= $endTime) 
    {
        if(date('H', $startTime) > 8 &&  date('H', $startTime) < 18){
            $date = date ("Y-m-d", $startTime);
            $hour = date ("G", $startTime);
            $minute = date ("i", $startTime);
            mysqli_stmt_bind_param($stmt, "isii", $_SESSION['id'], $date, $hour, $minute);
            mysqli_stmt_execute($stmt);
        }
        $startTime += $addMins;
    }
mysqli_stmt_close($stmt);
mysqli_close($conn);
header("Location: ../panel.php?declare=success");
exit();
}
else {
    header("Location: ../index.php");
    exit();
}
?>