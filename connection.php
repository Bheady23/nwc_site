<?php

$dbhost = "localhost";
$dbuser = "cmb";
$dbpass = "lastdance!";
$dbname = "nwc_db";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{

    die("failed to connect!");
}



?>