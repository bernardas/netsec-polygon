<?php
if (isset($_POST['history-submit'])) {
require 'dbh.inc.php';

$desc = $_POST['description'];
$presc = $_POST['prescription'];
$visitId = $_POST['visit_id'];

$sql = "INSERT INTO history (visit_id, doc_id, ssn, date, description, prescription)
SELECT visit_id, doc_id, ssn, date, ?, ? FROM appointments
WHERE visit_id=?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../panel.php?error=sqlerror");
    exit();
}
mysqli_stmt_bind_param($stmt, "ssi", $desc, $presc, $visitId);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$stmt = mysqli_stmt_init($conn);
$sql = "DELETE FROM appointments WHERE visit_id=?;";
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../panel.php?error=sqlerror");
    exit();
}
mysqli_stmt_bind_param($stmt, "i", $visitId);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
header("Location: ../panel.php?history=success");
exit();
}
else {
    header("Location: ../index.php");
    exit();
}
?>