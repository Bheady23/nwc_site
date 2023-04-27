<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
   //something was posted
  $item = $_POST['item_name']; 
  $quantity =  $_POST['quantity'];
  $exp =  $_POST['exp_date'];
  $user_id = $_SESSION['user_id'];
  
  
  if(!empty($item) && !empty($quantity) && !empty($exp))
  {
    //save to database
    $query = "Insert into pantry (user_id,item_name,quantity,exp_date) values ('$user_id','$item','$quantity','$exp')";
    
    mysqli_query($con,$query);
  
   
    echo "item successfully added!";
    header("location: pantrysite.php");
    die;
  }
  else
  {
        echo "Please enter valid information!";
  }
}
