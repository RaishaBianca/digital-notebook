<?php include('includes/session.php')?>
<?php include('includes/config.php')?>

<?php
if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $sql = "DELETE FROM list where List_ID = ".$delete;
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script type='text/javascript'> document.location = 'list.php'; </script>";
    
  }
}

if (isset($_GET['delete-list'])) {
  $delete = $_GET['delete-list'];
  $sql = "DELETE FROM list_each where list_each_id = ".$delete;
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script type='text/javascript'> document.location = 'list.php'; </script>";
    
  }
}

if (isset($_POST['item_id']) && isset($_POST['checked'])) {

  foreach ($_POST['item_id'] as $index => $itemId) {
    $item_id = mysqli_real_escape_string($conn, $itemId);
    $checked = mysqli_real_escape_string($conn, $_POST['checked'][$index]);
    
    $query = "UPDATE list_each SET checked = '$checked' WHERE list_each_id = '$item_id'";
    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Update successful');</script>";
    } else {
      echo "<script>alert('Update failed:');</script> " . mysqli_error($conn);
    }
  }
}



if (isset($_POST['list'])) {
  $list_id = mysqli_real_escape_string($conn, $_POST['list_id']);
  $title = mysqli_real_escape_string($conn, $_POST['list-title']);
  $checked = 0;

  if (empty($title)) {
    echo "<script>alert('Title cannot be empty');</script>";
  } else {
    date_default_timezone_set("Asia/Jakarta");
    $time_now = date("h:i:sa");

    $query = "INSERT INTO list_each(list_id, Title, checked) VALUES ('$list_id', '$title',$checked)";
    if(mysqli_query($conn, $query)){
      echo "<script>alert('List item added successfully');</script>";
    }else{
        echo 'Query error: '. mysqli_error($conn);
    }
  }
}

if (isset($_POST['submit'])) {
  $title = mysqli_real_escape_string($conn, $_POST['title']);

  if (empty($title)) {
    echo "<script>alert('Title cannot be empty');</script>";
  } else {
    date_default_timezone_set("Asia/Jakarta");
    $time_now = date("h:i:sa");

    $query = "INSERT INTO list(User_id, Title) VALUES ('$session_id', '$title')";
    if(mysqli_query($conn, $query)){
      echo "<script>alert('List added successfully');</script>";
    } else {
        echo 'Query error: '. mysqli_error($conn);
    }
  }
}

$query = "SELECT list_id, title FROM list WHERE user_id = \"$session_id\" ";

if(mysqli_query($conn, $query)){
    
    $result = mysqli_query($conn, $query);

    $listsArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo 'Query error: '. mysqli_error($conn);
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
        <section class="content">
          <aside class="sidebar">
            <div class="add-frame-account"><img src="photos/user.png" class="logo-profile">
              <?php
              $query = mysqli_query($conn, "SELECT * FROM register WHERE user_ID = '$session_id'") or die(mysqli_error());
              $row = mysqli_fetch_array($query);
              echo $row['fullName'];
              ?>
            </div>
            <div class="add-frame-logout"><img src="photos/exit.png"><a href="logout.php" data-toggle="ajaxModal" class="no-line">Logout</a></div>
            <div class="add-frame"><a href="notebook.php" class="no-line frame-text"><img src="photos/note2.png">Notes</a></div>
            <div class="add-frame"><a href="list.php" class="no-line frame-text"><img src="photos/list2.png">To Do Lists</a></div>
          </aside>
        </section>

      <div>
        <button class="add-note-btn" onclick="toggleAddNote()">+ add list</button>
        <div class="add-note-section" style="display: none;">
          <h4 class="add-note">Add List</h4>
          <form method="POST">
              <div class="form-group">
                <label>Title</label>
                <input name="title" type="text" placeholder="Title" size="100">
              </div><br>
              <div class="btn btn-sm btn-default">
              <button name="submit" type="submit" align="center">Add Lists</button>
            </div>
          </form>
        </div>

        <div>
  <h4 class="my-notes" align="center">My Lists</h4>
  <?php foreach($listsArray as $list): ?>
    <section>
      <div class="note-block">
      <div class="title-list">
      <div class="bold-title">
            <?php echo $list['title']; ?>
          </div>
        <div class="add-list-btn-container">
          <a href="list.php?delete=<?php echo $list['list_id'];?>" class="no-underline">-</a>
          <a class="btn-group pull-right add-list-btn no-underline" href="#">+</a>
        </div>
      </div>

        <?php
        $list_id = $list['list_id'];
        $itemQuery = "SELECT * FROM list_each WHERE list_id = '$list_id'";
        $itemResult = mysqli_query($conn, $itemQuery);
        $itemsArray = mysqli_fetch_all($itemResult, MYSQLI_ASSOC);
        ?>

        <div class="add-list-section" style="display: none;">
          <h4 class="add-list">Add Item</h4>
          <form method="POST">
            <input type="hidden" name="list_id" value="<?php echo $list['list_id']; ?>">
            <div class="form-group">
              <label>Item</label>
              <input name="list-title" type="text" placeholder="Add item" size="100">
            </div><br>
            <div class="btn btn-sm btn-default">
              <button name="list" type="submit" align="center">Add Item</button>
            </div>
          </form>
        </div>
      </div>
    </section>
    <?php foreach ($itemsArray as $item): ?>
                <form>
                  <label>
                  <div class="title-list">
                    <div>
                      <input type="checkbox" name="checked[]" value="<?php echo $item['list_each_id']; ?>" <?php if ($item['checked'] == 1) echo 'checked'; ?>>
                       <span class="<?php if(($item['checked'] == 1)) echo "crossed"?>"><?php echo $item['title']; ?></span>
                    </div>
                     <a href="list.php?delete-list=<?php echo $item['list_each_id'];?>" class="no-underline">x</a>
                  </div>
                  </label><br>
                </form>
              <?php endforeach; ?>
  <?php endforeach; ?>
</div>
        </div>
    </div>
  </section>

  <script src="js/notebook.js"></script>
  <script src="js/list.js"></script>
  <script>
  const addListBtns = document.querySelectorAll(".add-list-btn");
  const addListSections = document.querySelectorAll(".add-list-section");

  addListBtns.forEach((btn, index) => {
    btn.addEventListener("click", () => {
      const section = addListSections[index];
      if (section.style.display === "none") {
        section.style.display = "block";
      } else {
        section.style.display = "none";
      }
    });
  });

  const checkboxes = document.querySelectorAll("input[type='checkbox']");

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("click", function () {
      const itemId = this.value;
      const checked = this.checked ? 1 : 0;

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          console.log("Checkbox updated");
        }
      };
      xhr.send(
        "item_id[]=" +
          encodeURIComponent(itemId) +
          "&checked[]=" +
          encodeURIComponent(checked)
      );
      document.location = 'list.php'; 
    });
  });

  </script>
</body>
</html>
