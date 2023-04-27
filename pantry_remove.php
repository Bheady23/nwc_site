<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if(isset($_POST['delete']))
{
  $id = $_POST['id'];

  $query = "DELETE FROM pantry WHERE id = '$id' ";
  mysqli_query($con,$query);
}

    echo "item successfully removed!";
    header("location: pantrysite.php");
    die;

?>