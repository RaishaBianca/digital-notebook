<?php
session_start();
include('includes/config.php');

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM register where email ='$email' AND password ='$password'";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);

    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $_SESSION['alogin'] = $row['user_ID'];
            header("Refresh: 3; URL=notebook.php");
            include('load-screen.php');
            exit; 
        }
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="background">
<head>
  <meta charset="utf-8" />
  <title>Keeper</title>
  <link rel="stylesheet" href="css/index.css" type="text/css" />
</head>

<body>
  <section id="content" class="">
    <div class="container">
      <a class="title" href="login.php">Notebook</a>
      <section class="login">
        <header class="header">
          <strong>Login Form</strong>
          <br>
        </header>
        <form name="signin" method="post" class="">
          <div class="panel-body wrapper-lg">
          	<div class="form-group">
            <br>
            <label class="control-label">Email</label>
            <br>
            <input name="email" type="email" placeholder="test@example.com" class="form-control">
          </div>
          <div class="form-group">
            <br>
            <label class="control-label">Password</label>
            <br>
            <input name="password" type="password" id="inputPassword" placeholder="Password" class="form-control">
            <br>
          </div>
          <div class="line line-dashed"></div>
          <br>
          <br>
          <button name="signin" type="submit" class="login-button" align=center>Login</button>
          <br>
          <div class="line line-dashed"></div>
          <p class="create" align=center><small>Do not have an account?</small></p>
          <a href="signup.php" class="create" align=center>Create an account</a>
          </div>
        </form>
      </section>
    </div>
  </section>
  <footer id="footer">
  <div class="text-center padder">
    <p>
      <small>Notebook | Web Application by Teletubbies</small>
    </p>
    <p>
      <small class="bottom">&copy; 2023</small>
    </p>
  </div>
</footer>
  <!-- / footer -->
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>

</body>
</html>