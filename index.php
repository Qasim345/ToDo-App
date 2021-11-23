<?php
session_start();
if(!isset($_SESSION["username"])){
  header("location: login.php");
}
if (isset($_GET["logout"])) {
  session_destroy();
  unset($_SESSION["username"]);
  header("location: login.php");
}
include("con.php");
if (isset($_POST["add"])) {
  $title = mysqli_real_escape_string($con,$_POST["title"]);
  $description = mysqli_real_escape_string($con,$_POST["description"]);
  mysqli_query($con,"INSERT INTO data_tb(title,description) VALUES('$title','$description')");
}
$result = mysqli_query($con,"SELECT * FROM data_tb ORDER BY id DESC");

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=7,8,edge" />
  <meta name="theme-color" content="#5555f3" />
  <meta name="description" content="ToDo app, by Qasim Sarwari. PHP + SQLite + html, css & js" />
  <link rel="stylesheet" href="style.css" type="text/css" />
  <title>ToDo App | by Qasim</title>
</head>
<body>
  <!-- nav -->
  <nav class="navbar">
    <h2>ToDo</h2>
    <small><?php echo date("Y / M / d"); ?></small>
    <span id="btn">menu</span>
  </nav>
  <div class="menu" id="menu">
    <div class="menu-btn">
      <span id="mode">dark_mode</span>
      <span id="close-menu">close</span>
    </div>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="#" onclick="ab()">About</a></li>
      <li><a href="https://qa-sim.netlify.app" target="_blank">Portfolio</a></li>
      <li><a href="https://t.me/qasim_tech">Telegram channel</a></li>
      <li><a href="index.php?logout=true">Log out</a></li>
    </ul>
  </div>
  <!-- form -->
  <div class="container">
    <form class="form" action="index.php" method="POST">
      <h2>Add new task</h2>
      <div class="input">
        <input type="text" name="title" placeholder="Title" autocomplete="off" required />
        <span>comment</span>
      </div>
      <div class="input">
        <textarea name="description" placeholder="Description" required></textarea>
        <span>message</span>
      </div>
      <button type="submit" name="add">Add Task <span>save_alt</span></button>
    </form>
    <!-- data -->
    <div class="text">
      <?php while($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="box">
          <div class="top">
            <h3><?php echo $row["title"]; ?></h3>
            <?php echo "<a onclick='return del()' href='del.php?id=$row[id]'><span>delete</span></a>"; ?>
          </div>
          <p>
            <?php echo $row["description"]; ?>
          </p>
          <i style="color:#adadad;font-size:13px;padding-top:10px"><?php echo $row["ndate"]; ?></i>
        </div>
        <?php
      } ?>
    </div>
  </div>
  <script src="jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $("#btn").click(()=> {
      $(".menu").addClass("act");
    });
    $("#close-menu").click(()=> {
      $(".menu").removeClass("act")
    });
    var f = 0;
    $("#mode").click(()=> {
      if (f == 0) {
        f = 1;
        $("body,.navbar,.menu,.container,.form").addClass("dark");
        $("#mode").html("light_mode");
      } else {
        f = 0;
        $("body,.navbar,.menu,.container,.form").removeClass("dark");
        $("#mode").html("dark_mode");
      }
    });
    function ab() {
      alert("Created by Qasim Sarwari.")
    }
    $(".form").submit(()=> {
      $("button").html("<div class='loader'></div>")
    });
    function del() {
      return confirm("Are you sure want to Delete?");
    }
  </script>
</body>
</html>