<!DOCTYPE html>
<html>
<head>
  <title>Loading Screen</title>
  <link rel="stylesheet" type="text/css" href="css/load-screen.css">
</head>
<body>
  <div id="loading-screen">
    <div>
      <img class="sparkle-gif" src="./photos/sparkle.gif" alt="Sparkle" />
    </div>
    <div class="center-wrapper">
        <br>
      <h1>Notebook</h1>
      <p>Write now, remember later.</p>
      <br>
    </div>
    <div>
        <?php?>
        <h2>Welcome, <?php echo $row['fullName'];?>!</h2>
    </div>
  <div>
      <img class="sparkle-gif2" src="./photos/sparkle.gif" alt="Sparkle" />
    </div>
</div>
</body>
</html>
