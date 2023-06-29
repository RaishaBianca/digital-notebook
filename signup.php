<?php
session_start();
include('includes/config.php');
if(isset($_POST['signup']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);

	$query = mysqli_query($conn,"select * from register where email = '$email'")or die(mysqli_error());
	$count = mysqli_num_rows($query);

	if ($count > 0){ ?>
	 <script>
	 alert('Data Already Exist');
	</script>
	<?php
      }else{
        mysqli_query($conn,"INSERT INTO register(fullName, email, password) VALUES('$name','$email','$password')         
		") or die(mysqli_error()); ?>
		<script>alert('Records Successfully  Added');</script>;
		<script>
		window.location = "index.php"; 
		</script>
		<?php   }

}

?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Notebook | Web Application</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/signup.css" type="text/css" />
</head>
<body>
  <section id="content" class="">
    <div class="container2">
      <a class="title" href="signup.php">Notebook</a>
      <section class="login ">
        <header class="header">
          <strong>Sign up</strong>
        </header>
        <form name="signup" method="POST">
          <div class="">
          	 <div class="">
              <br>
	            <label class="">Name</label>
              <br>
	            <input name="name" type="text" placeholder="eg. Your name or company" class="form-control">
	          </div>
	          <div class="">
              <br>
	            <label class="">Email</label>
              <br>
	            <input name="email" type="email" placeholder="test@example.com" class="form-control">
	          </div>
	          <div class="">
            <br>
	            <label class="">Password</label>
              <br>
	            <input name="password" type="password" id="inputPassword" placeholder="Type a password" class="form-control">
	          </div>
	          <div class=""></div>
            <br>
	          <button name="signup" type="submit" class="signup-button">Sign up</button>
	          <div class="line line-dashed"></div>
	          <p class="create" align=center><small>Already have an account?</small></p>
	          <a href="index.php" class="create" align=center>Log in</a>
          </div>
        </form>
      </section>
    </div>
  </section>

  <footer id="footer">
    <div class="">
      <p>
        <small>Notebook | Web Application by Teletubbies<br>&copy; 2023</small>
      </p>
    </div>
  </footer>

  <script src="js/jquery.min.js"></script>
  
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  
</body>
</html>