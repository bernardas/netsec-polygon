<?php
  require "header.php";
  require "includes/dbh.inc.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <?php
            if (isset($_GET["signup"])) {
              if ($_GET["signup"] == "success") {
                echo '<p class="signupsuccess">Sign up successful!</p>';
              }
            }
            if (!isset($_SESSION['id'])) {
              echo '<p class="login-status">Welcome to the Hospital website!</p>';
            }
            else if (isset($_SESSION['doctor'])) {
              echo '<p class="login-status">You are logged in as a Doctor!</p>';
            }
            if (isset($_GET["logout"]) && $_GET["logout"] == "success") {
                echo '<p class="signupsuccess">You have successfully logged out!</p>';
            }
            else if (isset($_SESSION['user'])) {
              $ssn = $_SESSION['ssn'];
              $stmt = mysqli_stmt_init($conn);
              $sql = "SELECT fname, lname FROM patients WHERE ssn=?";
              mysqli_stmt_prepare($stmt, $sql);
              mysqli_stmt_bind_param($stmt, "i", $ssn);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              $row = mysqli_fetch_assoc($result);
              echo '<p>Name: <b>'.$row['fname'].'</b></p>';
              echo '<p>Surname: <b>'.$row['lname'].'</b></p>';
              echo '<p>SSN: <b>'.$ssn.'</b></p>';
              echo '<h1>Upcoming visits</h1>';
                $sql = "SELECT appointments.doc_id, appointments.date, LPAD(appointments.hour,2,0), LPAD(appointments.minute,2,0), appointments.hour, appointments.minute, appointments.ssn, CURDATE(), doctors.fname, doctors.lname FROM appointments, doctors WHERE appointments.ssn=$ssn AND appointments.date>=CURDATE() AND appointments.doc_id=doctors.doc_id ORDER BY appointments.hour ASC, appointments.minute ASC;";
                $res=$conn->query($sql);
                echo '<table>';
                while($row=$res->fetch_assoc()){
                    echo '
                    <tr>
                      <th>'.$row['lname'].' '.$row['fname'].'</th>
                      <th>'.$row['date'].'</th>
                      <th>'.$row['LPAD(appointments.hour,2,0)'].':'.$row['LPAD(appointments.minute,2,0)'].'</th>
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

            echo '<h1>Medical history</h1>';
                $sql = "SELECT history.*, doctors.fname, doctors.lname, doctors.profession FROM history, doctors WHERE history.ssn=$ssn AND history.doc_id=doctors.doc_id ORDER BY history.date DESC;";
                $res=$conn->query($sql);
                echo '<table>
                      <tr>
                        <th>Date</th>
                        <th>Doctor</th>
                        <th>Description</th>
                        <th>Prescribed mediaction</th>
                      </tr>';
                while($row=$res->fetch_assoc()){
                    echo '
                    <tr>
                      <th>'.$row['date'].'</th>
                      <th>'.$row['lname'].' '.$row['fname'].', '.$row['profession'].'</th>
                      <th><p style="text-align: left;font-size:9pt;">'.$row['description'].'</p></th>
                      <th><p style="text-align: left;font-size:9pt;">'.$row['prescription'].'</p></th>
                    </tr>';
                    }
                echo '</table><br>';
            }
          ?>
        </section>
      </div>
    </main>

<?php
  require "footer.php";
?>
