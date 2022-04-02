<?php

if (isset($_POST['login-submit'])) {
  require 'dbh.inc.php';
  $id = $_POST['docId'];
  $password = $_POST['pwd'];

  if (empty($id) || empty($password)) {
    header("Location: ../doclogin.php?error=emptyfields&id=".$id);
    exit();
  }
  else {
    $sql = "SELECT * FROM doctors WHERE doc_id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../doclogin.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "s", $id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['password']);
        if ($pwdCheck == false) {
          header("Location: ../doclogin.php?error=wrongpwd");
          exit();
        }
        else if ($pwdCheck == true) {

          session_start();
          $_SESSION['id'] = $row['doc_id'];
          $_SESSION['doctor'] = "true";
          header("Location: ../panel.php?login=success");
          exit();
        }
      }
      else {
        header("Location: ../doclogin.php?login=wronguidpwd");
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
