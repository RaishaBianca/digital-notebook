<?php include('includes/session.php')?>
<?php include('includes/config.php')?>
<?php $get_id = $_GET['edit']; ?>
<?php

 
    if(isset($_POST['update'])){

        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $note=mysqli_real_escape_string($conn,$_POST['note']);

        
        $query = "UPDATE notes SET title=\"$title\",note=\"$note\",last_updated_at=CURRENT_TIMESTAMP WHERE note_id = \"$get_id\" ";

        if(mysqli_query($conn, $query)){
        	echo "<script>alert('Note Updated Successfully');</script>";
      		echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
        }else{
            
            echo 'query error: '. mysqli_error($conn);
        }

    }

    
     $query = "SELECT note_id,title,note,time_in FROM notes WHERE note_id = \"$get_id\" ";

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
  <title>Notebook | Web Application</title>
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
        <div>
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
        </div>
        <div class="kanan">
          <h4 class="edit-note" align="center">Edit List</h4>
            <form method="POST">
              <?php
                    $query = mysqli_query($conn,"select * from notes where note_id = '$get_id' ")or die(mysqli_error());
                    $row = mysqli_fetch_array($query);
                      ?>
               <div class="form-group">
                  <label>Title</label><br>
                  <input name="title" type="text" placeholder="Title" class="input-sm form-control" value="<?php echo $row['title']; ?>" size="100"> <br><br>
                </div>
                <div class="form-group">
                  <label>Note</label><br>
                  <textarea name="note" class="form-control" rows="8" data-minwords="8" data-required="true" placeholder="Take a Note ......" style="width: 750px;"><?php echo $row['note']; ?></textarea>
                </div><br>
                <div class="btn btn-sm btn-default"><button name="update" type="submit" align="center">Update Note</button></div>
            </form>
                </div>
          </div>
          </section>

          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>
</body>
</html>