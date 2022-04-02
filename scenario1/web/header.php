<?php
  session_start();
  require "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <nav class="nav-header-main">
        <a class="header-logo" href="index.php">
          <img src="img/logo.png">
        </a>
        <ul>
          <li><a href="index.php">Home</a></li>
          <?php
          if (isset($_SESSION['doctor'])) {
            echo '<li><a href="panel.php">Panel</a></li>';
            echo '<li><a href="calendar.php">Calendar</a></li>';
          }
          elseif (isset($_SESSION['user'])) {
            echo '<li><a href="search.php">Find a doctor</a></li>';
            echo '<li><a href="doctors.php">All doctors</a></li>';
          }
          ?>
        </ul>
      </nav>
      <div class="header-login">
        <?php
        if (!isset($_SESSION['id'])) {
          echo '<form action="includes/login.inc.php" method="post">
            <input type="text" name="ssn" placeholder="SSN">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="login-submit">Login</button>
          </form>
          <a href="signup.php" class="header-signup">Sign up</a>
          <a href="doclogin.php" class="header-signup">Doctor</a>';
        }
        else if (isset($_SESSION['id'])) {
          echo '<form action="includes/logout.inc.php" method="post">
            <button type="submit" name="login-submit">Log out</button>
          </form>';
        }
        ?>
      </div>
    </header>
