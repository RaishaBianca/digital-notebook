<?php
if (isset($_POST['submit'])) {
  foreach ($_POST as $key => $value) {
    if (strpos($key, 'schedule') === 0) {
      $schedule = mysqli_real_escape_string($conn, $value);
      
      $query = "REPLACE INTO schedules (schedule, user_id) VALUES ('$schedule', $session_id)";
      mysqli_query($conn, $query);
    }
  }
}

$query = "SELECT schedule FROM schedules WHERE user_id = $session_id";
$result = mysqli_query($conn, $query);
$schedules = array();
while ($row = mysqli_fetch_assoc($result)) {
  $schedules[] = $row['schedule'];
}
?>

<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Notebook | Web Application</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/planner.css" type="text/css" />
</head>
<body>
<section>
  <header class="header">
    <div class="">
      <a href="#" class="logo">Notebook</a>
    </div>
  </header>
  <div class="side">
    <section class="content">
      <aside class="sidebar">
        <div class="add-frame-account">
          <img src="photos/user.png" class="logo-profile">
          <?php
          $query = mysqli_query($conn, "SELECT * FROM register WHERE user_ID = '$session_id'") or die(mysqli_error());
          $row = mysqli_fetch_array($query);
          ?>
          <?php echo $row['fullName']; ?>
        </div>
        <div class="add-frame-logout">
          <img src="photos/exit.png">
          <a href="logout.php" data-toggle="ajaxModal" class="no-line">Logout</a>
        </div>
        <div class="add-frame">
          <a href="notebook.php" class="no-line frame-text">
            <img src="photos/note2.png">Notes</a>
        </div>
        <div class="add-frame">
          <a href="list.php" class="no-line frame-text">
            <img src="photos/list2.png">To Do Lists</a>
        </div>
        <div class="add-frame">
          <a href="planner.php" class="no-line frame-text">
            <img src="photos/calendar2.png">Weekly Planner</a>
        </div>
      </aside>
    </section>

    <div class="kanan">
      <div>
        <form method="POST" action="">
          <h4 class="my-notes" align="center">My Weekly Planner</h4>
          <section class="planner-block">
            <table class="planner-block" cellspacing="10" align="center">
              <thead>
                <tr>
                  <th></th>
                  <th>Monday</th>
                  <th>Tuesday</th>
                  <th>Wednesday</th>
                  <th>Thursday</th>
                  <th>Friday</th>
                  <th>Saturday</th>
                  <th>Sunday</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = 6; $i <= 12; $i++) { ?>
                  <tr>
                    <td><?php echo $i ?>.00</td>
                    <?php for ($j = 1; $j <= 7; $j++) { ?>
                      <td>
                        <textarea name="schedule_<?php echo $i ?>_<?php echo $j ?>" class="form-control" rows="5" data-minwords="8" data-required="true" style="width: 80px;"><?php echo isset($schedules[$i][$j]) ? $schedules[$i][$j] : ''; ?></textarea>
                      </td>
                    <?php } ?>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <button type="submit" name="submit">Save</button>
          </section>
        </form>
      </div>
    </div>
  </div>
</section> 
<script src="js/notebook.js"></script>
<script src="js/jquery.min.js"></script>
<!-- App -->
<script src="js/app.js"></script>
<script src="js/app.plugin.js"></script>
<script src="js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/libs/underscore-min.js"></script>
<script src="js/libs/backbone-min.js"></script>
<script src="js/libs/backbone.localStorage-min.js"></script>  
<script src="js/libs/moment.min.js"></script>
<!-- Notes -->
<script src="js/apps/notes.js"></script>
</body>
</html>
