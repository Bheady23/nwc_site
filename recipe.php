<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$base = "recipe";
$search_url = "http://www.google.com/search?q=";



 if(isset($_POST['recipe']))
 {
    $recipie_items = $_COOKIE['result'];

    header("location: ".$search_url.$recipie_items.' '.$base);

 }

?>