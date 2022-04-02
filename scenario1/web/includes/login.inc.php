<?php
if (isset($_POST['login-submit'])) {
  require "dbh.inc.php";

  $ssn = $_POST['ssn'];
  $password = $_POST['pwd'];

  if (empty($ssn) || empty($password)) {
    header("Location: ../index.php?error=emptyfields&ssn=".$ssn);
    exit();
  }
  else {

    $sql = "SELECT * FROM patients WHERE ssn=?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $ssn);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['password']);
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        else if ($pwdCheck == true) {

          session_start();
          $_SESSION['id'] = $row['id'];
          $_SESSION['ssn'] = $row['ssn'];
          $_SESSION['user'] = "true";
          header("Location: ../index.php?login=success");
          exit();
        }
      }
      else {
        header("Location: ../index.php?login=wronguidpwd");
        exit();
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
