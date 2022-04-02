<?php
  require "header.php";
  require "includes/dbh.inc.php";
?>
    <main>
      <div class="wrapper-main">
          <section class="section-default">
            <?php
            if (isset($_GET["register"])) {
              if ($_GET["register"] == "success") {
                echo '<p class="signupsuccess">Registration successful!</p>';
              }
            } else{
            $docID = $_POST['doc_id'];
            $ssn = $_SESSION['ssn'];
            $stmt = mysqli_stmt_init($conn);
            $sql = "SELECT fname, lname FROM doctors WHERE doc_id=?";
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("Location: ../register.php?error=sqlerror");
              exit();
            }
            mysqli_stmt_bind_param($stmt, "i", $docID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);

            echo '<h1>'.$row['lname'].' '.$row['fname'].'</h1>';
            echo '<h4 style="text-align: center;"">Available Times</h4>';

            $sql = "SELECT doc_id, date, LPAD(hour,2,0), LPAD(minute,2,0), CURDATE() FROM appointments WHERE doc_id=$docID AND ssn IS NULL AND date>=CURDATE() ORDER BY date ASC, hour ASC, minute ASC;";
            
            $res=$conn->query($sql);
            echo '<table>';
            if (isset($_POST['register'])) {
            while($row=$res->fetch_assoc()){
                echo '
                <tr>
                  <th>'.$row['date'].'</th>
                  <th>'.$row['LPAD(hour,2,0)'].':'.$row['LPAD(minute,2,0)'].'</th>
                  <th>
                    <form action="includes/register.inc.php" method="post">
                      <input type="hidden" name="doc_id" value="'.$row['doc_id'].'">
                      <input type="hidden" name="date" value="'.$row['date'].'">
                      <input type="hidden" name="hour" value="'.$row['LPAD(hour,2,0)'].'">
                      <input type="hidden" name="minute" value="'.$row['LPAD(minute,2,0)'].'">
                      <input type="hidden" name="ssn" value="'.$ssn.'">
                      <input type="submit" name="register-submit" value="Register" />
                    </form>
                  </th>
                </tr>';
                }
            }
            echo '</table>';
            }?>
          </section>
      </div>
    </main>

<?php
  require "footer.php";
?>