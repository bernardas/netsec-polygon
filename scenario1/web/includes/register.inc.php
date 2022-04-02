<?php
require 'dbh.inc.php';
if (isset($_POST['register-submit'])) {
    $docID = $_POST['doc_id'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $minute = $_POST['minute'];
    $ssn = $_POST['ssn'];

    $sql = "UPDATE appointments SET ssn=? WHERE doc_id=? AND date=? AND hour=? AND minute=?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else {

        mysqli_stmt_bind_param($stmt, "sisii", $ssn, $docID, $date, $hour, $minute);
        mysqli_stmt_execute($stmt);
        header("Location: ../register.php?register=success");
        exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
  header("Location: ../index.php");
  exit();
}
