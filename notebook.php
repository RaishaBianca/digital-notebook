<?php include('includes/session.php')?>
<?php include('includes/config.php')?>

<?php
if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $sql = "DELETE FROM notes where note_id = ".$delete;
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script>alert('Note removed Successfully');</script>";
      echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
    
  }
}

 if(isset($_POST['submit'])){
        
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $note=mysqli_real_escape_string($conn,$_POST['note']);

        date_default_timezone_set("Asia/Jakarta");
        $time_now = date("h:i:sa");
        $query = "INSERT INTO notes(user_id,title,note,time_in) VALUES('$session_id','$title','$note','$time_now')";
      
        if(mysqli_query($conn, $query)){
          echo "<script>alert('Note Added Successfully');</script>";

        }else{
            echo 'query error: '. mysqli_error($conn);
        }

    }

     $query = "SELECT note_id,title,note,time_in FROM notes WHERE user_id = \"$session_id\" ";

    if(mysqli_query($conn, $query)){

        $result = mysqli_query($conn, $query);

        $notesArray= mysqli_fetch_all($result , MYSQLI_ASSOC);

    }else{
        echo 'query error: '. mysqli_error($conn);
    }
?>

<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title >Notebook | Web Application</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/notebook.css" type="text/css" />

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
          <div class="add-frame-account"><img src="photos/user.png" class="logo-profile">
            <?php $query= mysqli_query($conn,"select * from register where user_ID = '$session_id'")or die(mysqli_error());
                      $row = mysqli_fetch_array($query);
            ?>
            <?php echo $row['fullName']; ?>
          </div>
          <div class="add-frame-logout"><img src="photos/exit.png"><a href="logout.php" data-toggle="ajaxModal" class="no-line">Logout</a></div>
          <div class="add-frame"><a href="notebook.php" class="no-line frame-text"><img src="photos/note2.png">Notes</a></div>
          <div class="add-frame"><a href="list.php" class="no-line frame-text"><img src="photos/list2.png">To Do Lists</a></div>
        </aside>
      </section>

    <div class="kanan">
        <button class="add-note-btn" onclick="toggleAddNote()">+ Add Note</button>
        <div class="add-note-section" style="display: none;">
          <h4 class="add-note">Add Note</h4>
          <form method="POST">
            <div class="form-group">
              <label>Title</label><br>
              <input name="title" type="text" placeholder="Title" size="100">
            </div><br>
            <div class="form-group">
              <label>Note</label><br>
              <textarea name="note" class="form-control" rows="8" data-minwords="8" data-required="true" placeholder="Take a Note ......" style="width: 750px;"></textarea>
            </div><br>
            <div class="btn btn-sm btn-default">
              <button name="submit" type="submit" align="center">Add Note</button>
            </div>
          </form>
        </div>
    
        <!-- munculin hasil note -->
        <div  >
          <h4 class="my-notes" align="center">My Notes</h4>
          <?php foreach($notesArray as $note): ?>
            <section>
              <div class="note-block">
              <div class="btn-group pull-right">
                                    <a href="edit_note.php?edit=<?php echo $note['note_id'];?>"><button type="button" class="" title="Show"><img src="photos/edit.png" class="trash-edit"><i class=""></i></button></a>
                                    <a href="notebook.php?delete=<?php echo $note['note_id'];?>"><button type="button" class="" title="Remove"> <img src="photos/trash.png" class="trash-edit"><i class=""></i></button></a>
                </div>
                <div class="bold-title">
                  <?php echo $note['title']; ?>
                </div>
                
                <p> <?php echo $note['note']; ?> </p>

                <!-- jam -->
                <small class="clock-info"><i class="fa fa-clock-o"></i> <?php echo $note['time_in'] ?></small>

              </div>
            </section>
          <?php endforeach; ?>
        </div>
    </div>
      <!-- munculin hasil note -->
    </div>

</section> 
  <script src="js/notebook.js"></script>
</body>
</html>