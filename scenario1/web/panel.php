<?php
  require "header.php";
  require "includes/dbh.inc.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <?php
          if (!isset($_SESSION['doctor'])) {
            echo '<p class="login-status">You do not have access to this page!</p>';
          }else {
              $docID = $_SESSION['id'];
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

              echo '<h1><i>'.$row['lname'].' '.$row['fname'].'</i> today\'s visits</h1>';
              $sql = "SELECT appointments.doc_id, appointments.visit_id, appointments.date, LPAD(appointments.hour,2,0), LPAD(appointments.minute,2,0), appointments.hour, appointments.minute, appointments.ssn, CURDATE(), patients.fname, patients.lname FROM appointments, patients WHERE appointments.doc_id=$docID AND appointments.ssn IS NOT NULL AND appointments.date=CURDATE() and patients.ssn=appointments.ssn ORDER BY appointments.hour ASC, appointments.minute ASC;";
              $res=$conn->query($sql);
              echo '<table>';
              while($row=$res->fetch_assoc()){
                  echo '
                  <tr>
                    <th>'.$row['lname'].' '.$row['fname'].'</th>
                    <th>'.$row['LPAD(appointments.hour,2,0)'].':'.$row['LPAD(appointments.minute,2,0)'].'</th>
                    <th>
                      <form action="history.php" method="post">
                        <input type="hidden" name="visit_id" value="'.$row['visit_id'].'">
                        <input type="submit" name="history-presubmit" value="FILL PATIENT CARD" />
                      </form>
                    </th>
                    <th>
                      <form action="includes/cancel.inc.php" method="post">
                        <input type="hidden" name="doc_id" value="'.$row['doc_id'].'">
                        <input type="hidden" name="date" value="'.$row['date'].'">
                        <input type="hidden" name="hour" value="'.$row['hour'].'">
                        <input type="hidden" name="minute" value="'.$row['minute'].'">
                        <input type="submit" name="cancel-submit" value="CANCEL" />
                      </form>
                    </th>
                  </tr>';
                  }
              echo '</table><br>';
              echo '<h1>Declare future work schedule</h1>
              <form class="form-signup" action="includes/timeslots.inc.php" method="post">
              <label for="dateFrom">From:</label>
              <input type="date" id="dateFrom"  name="dateFrom"><br>
              <label for="dateTo">To:</label>
              <input type="date" id="dateTo" name="dateTo">
              <button type="submit" name="declaration-submit">Declare</button>
              </form>';
          }
          ?>
        </section>
      </div>
    </main>

<?php
  require "footer.php";
?>
