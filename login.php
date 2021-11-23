<?php 
session_start();
include("con.php");
if(isset($_POST["submit"])){
  $username = mysqli_real_escape_string($con,$_POST["username"]);
  $password = mysqli_real_escape_string($con,$_POST["password"]);
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $res = mysqli_query($con,$sql);
  if (mysqli_num_rows($res) ==1) {
    $_SESSION["username"] = $username;
    header("location: index.php");
  }else{
    echo "<script>alert('Incorrect username or password!');</script>";
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" type="text/css" />
  <title>ToDo App | Login</title>
  <style type="text/css" media="all">
    body {
      display: grid;
      place-items: center;
      background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)), url(bg.jpg) no-repeat;
      background-position: center;
      background-size: cover;
    }
    .form {
      width: 320px;
      padding: 40px;
      background: #fff;
      border-radius: 5px;
      border: 1px solid #ddd;
    }
    .form p {
      text-align: center;
      font-size: 14px;
      padding-bottom: 10px;
    }
  </style>
</head>
<body>
  <form class="form" action="login.php" method="post">
    <h2>Login</h2>
    <p>
      Login with username and password
    </p>
    <div class="input">
      <input type="text" name="username" placeholder="Username" />
      <span>person</span>
    </div>
    <div class="input">
      <input type="password" name="password" placeholder="Password" />
      <span>lock</span>
    </div>
    <button type="submit" name="submit">Log in</button>
  </form>
</body>
</html>