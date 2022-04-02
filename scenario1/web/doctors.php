<?php
  require "header.php";
  require "includes/dbh.inc.php";
?>
    <main>
      <div class="wrapper-main">
          <section class="section-default">
              <h1>Doctors</h1>

    <?php
    if (isset($_SESSION['user'])) {

        $sql = "SELECT doc_id, lname, fname, profession FROM doctors;";

        $res=$conn->query($sql);

        while($row=$res->fetch_assoc()){
            echo '
            <table>
            <tr>
            <th>'.$row['lname'].'</th>
            <th>'.$row['fname'].'</th>
            <th>'.$row['profession'].'</th>
            <th>
                <form action="register.php" method="post">
                <input type="hidden" name="doc_id" value="'.$row['doc_id'].'">
                <input type="submit" name="register" value="Register" />
                </form>
            </th>
            </tr>
            </table>';
        } 
    }
    ?>
          </section>
      </div>
    </main>

<?php
  require "footer.php";
?>