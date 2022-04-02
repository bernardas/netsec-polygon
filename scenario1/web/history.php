<?php
  if (!isset($_POST['history-presubmit'])) {
    header("Location: index.php");
    exit();
  }
  require "header.php";
  $visitID = $_POST['visit_id'];
?>
    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1>Patient visit information</h1>
          <form class="form-history" action="includes/history.inc.php" method="post">
            <textarea name="description" rows="10"  placeholder="Description"></textarea>
            <textarea name="prescription" rows="4" placeholder="Prescription"></textarea>
            <input type="hidden" name="visit_id" value="<?php echo $visitID;?>">
            <button type="submit" name="history-submit">SAVE</button>
          </form>
        </section>
      </div>
    </main>

<?php
  require "footer.php";
?>
