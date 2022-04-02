<?php
if (isset($_POST['signup-submit'])) {
  require "dbh.inc.php";

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $ssn = $_POST['ssn'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  if (empty($ssn) || empty($fname) || empty($lname) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../signup.php?error=emptyfields&fname=".$fname."&lname=".$lname."&ssn=".$ssn);
    exit();
  }
  else if (!(preg_match("/^[a-zA-Z]*$/", $fname)) && !(preg_match("/^[0-9]*$/", $ssn))) {
    header("Location: ../signup.php?error=invaliduidmail");
    exit();
  }
  else if (!preg_match("/^[a-zA-Z]*$/", $fname) && !(preg_match("/^[a-zA-Z]*$/", $lname))) {
    header("Location: ../signup.php?error=invaliduid&mail=".$ssn);
    exit();
  }
  else if ($password !== $passwordRepeat) {
    header("Location: ../signup.php?error=passwordcheck&uid=".$fname."&mail=".$ssn);
    exit();
  }
  else {
    $sql = "SELECT ssn FROM patients WHERE ssn=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "i", $ssn);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCount = mysqli_stmt_num_rows($stmt);
      mysqli_stmt_close($stmt);
      if ($resultCount > 0) {
        header("Location: ../signup.php?error=usertaken&mail=".$ssn);
        exit();
      }
      else {
        $sql = "INSERT INTO patients (ssn, fname, lname, password) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        else {
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

          mysqli_stmt_bind_param($stmt, "ssss", $ssn, $fname, $lname, $hashedPwd);
          mysqli_stmt_execute($stmt);
          header("Location: ../signup.php?signup=success");
          exit();

        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: ../signup.php");
  exit();
}
