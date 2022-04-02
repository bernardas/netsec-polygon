<?php
require '../header.php';
require 'dbh.inc.php';
if (isset($_POST['cancel-submit'])) {
    $docID = $_POST['doc_id'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $minute = $_POST['minute'];

    $sql = "UPDATE appointments SET ssn=NULL WHERE doc_id=? AND date=? AND hour=? AND minute=?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else {

        mysqli_stmt_bind_param($stmt, "isii", $docID, $date, $hour, $minute);
        mysqli_stmt_execute($stmt);
        if (isset($_SESSION['doctor']))
            header("Location: ../panel.php?cancel=success");
        else if (isset($_SESSION['user']))
            header("Location: ../index.php?cancel=success");
        exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
  header("Location: ../index.php");
  exit();
}
