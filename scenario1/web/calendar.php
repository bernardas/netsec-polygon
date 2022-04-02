<?php
require "header.php";
require "includes/dbh.inc.php";
if (!isset($_SESSION['doctor'])) {
    echo '<main>
        <div class="wrapper-main">
        <section class="section-default">
        <p class="login-status">You do not have access to this page!</p>
        </section>
        </div>
      </main>';
}
else {
    date_default_timezone_set('Europe/Vilnius');

if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

$today = date('Y-m-j', time());

// H3 title
$html_title = date('Y / m', $timestamp);

$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));

$day_count = date('t', $timestamp);
 
$str = date('N', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str - 1);
$stmt = mysqli_stmt_init($conn);
$sql = "SELECT visit_id, LPAD(MIN(hour),2,0), LPAD(MAX(hour),2,0), LPAD(MIN(minute),2,0), LPAD(MAX(minute),2,0) FROM appointments WHERE doc_id=? and date=?";
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../calendar.php?error=sqlerror");
    exit();
  }
for ( $day = 1; $day <= $day_count; $day++, $str++) {
    $ifTodaysDate = $ym . '-' . $day;
    if($day<10)
        $date = $ym . '-' . '0' . $day;
    else
        $date = $ym . '-' . $day;
    mysqli_stmt_bind_param($stmt, "is", $_SESSION['id'], $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if ($today == $ifTodaysDate) {
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
    if(!empty($row['visit_id'])){
    $week .= '<br><a>'.$row['LPAD(MIN(hour),2,0)'].':'.$row['LPAD(MIN(minute),2,0)'].' - '.$row['LPAD(MAX(hour),2,0)'].':'.$row['LPAD(MAX(minute),2,0)'].'</a></div></td>';
    }
    else
    $week .= '<br></td>';
    // End of the week OR End of the month
    if ($str % 7 == 0 || $day == $day_count) {

        if ($day == $day_count) {
            // Add empty cell
            if((7 - ($str % 7))==7)
                $week .= str_repeat('<td></td>', 0);
            else
                $week .= str_repeat('<td></td>', 7 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        $week = '';
    }

}
?>
<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Work schedule calendar</h1>
            <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
            <table>
                <tr>
                    <th>M</th>
                    <th>T</th>
                    <th>W</th>
                    <th>T</th>
                    <th>F</th>
                    <th>S</th>
                    <th>S</th>
                </tr>
                <?php
                    foreach ($weeks as $week) {
                        echo $week;
                    }
                ?>
            </table>
        </section>
    </div>
</main>
<?php
}
require "footer.php";
?>