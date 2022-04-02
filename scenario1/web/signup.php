<?php
  require "header.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1>Sign up</h1>
          <?php

          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyfields") {
              echo '<p class="signuperror">Fill in all fields!</p>';
            }
            else if ($_GET["error"] == "invaliduidmail") {
              echo '<p class="signuperror">Invalid username and e-mail!</p>';
            }
            else if ($_GET["error"] == "invaliduid") {
              echo '<p class="signuperror">Invalid username!</p>';
            }
            else if ($_GET["error"] == "invalidmail") {
              echo '<p class="signuperror">Invalid e-mail!</p>';
            }
            else if ($_GET["error"] == "passwordcheck") {
              echo '<p class="signuperror">Your passwords do not match!</p>';
            }
            else if ($_GET["error"] == "usertaken") {
              echo '<p class="signuperror">Username is already taken!</p>';
            }
          }
          else if (isset($_GET["signup"])) {
            if ($_GET["signup"] == "success") {
              echo '<p class="signupsuccess">Signup successful!</p>';
            }
          }
          ?>
          <form class="form-signup" action="includes/signup.inc.php" method="post">
            <?php

            if (!empty($_GET["fname"])) {
              echo '<input type="text" name="fname" placeholder="First Name" value="'.$_GET["fname"].'">';
            }
            else {
              echo '<input type="text" name="fname" placeholder="First Name">';
            }
            if (!empty($_GET["lname"])) {
              echo '<input type="text" name="lname" placeholder="Last Name" value="'.$_GET["lname"].'">';
            }
            else {
              echo '<input type="text" name="lname" placeholder="Last Name">';
            }
            if (!empty($_GET["ssn"])) {
              echo '<input type="text" class="form-control" name="ssn" placeholder="SSN" maxlength="11" value="'.$_GET["ssn"].'">';
            }
            else {
              echo '<input type="number" class="form-control" name="ssn" placeholder="SSN" maxlength="11">';
            }


            ?>
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-repeat" placeholder="Repeat password">
            <button type="submit" name="signup-submit">Sign up</button>
          </form>
        </section>
      </div>
    </main>

<?php
  require "footer.php";
?>
