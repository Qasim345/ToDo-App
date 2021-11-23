<?php
include("con.php");
$id;
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $del = mysqli_query($con,"DELETE FROM data_tb WHERE id =$id");
  if ($del) {
    header("location: index.php");
  }
}

?>