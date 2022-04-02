<?php
  require "header.php";
?>
    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <?php
        if (!isset($_SESSION['id'])) {
          echo '<h1>Doctor Log in</h1></br>
          <form class="form-doclogin" action="includes/doclogin.inc.php" method="post">
            <input type="text" name="docId" placeholder="Doctor ID">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="login-submit">Log in</button>
          </form>';
        }
        else if (isset($_SESSION['id'])) {
          header('Location: panel.php');
        }
        ?>
        </section>
      </div>
    </main>

<?php
  require "footer.php";
?>
