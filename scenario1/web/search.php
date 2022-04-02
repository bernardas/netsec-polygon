<?php
  require "header.php";
?>
    <main>
      <div class="wrapper-main">
          <section class="section-default">
            <form class="form-signup" method="post" action="search.php">
              <h1>Doctor search</h1>
              <input type="text" name="search" required/>
              <button type="submit">Search</button>
            </form>

    <?php
    if (isset($_POST['search'])) {
      require "includes/search.inc.php";

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