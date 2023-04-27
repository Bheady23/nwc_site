<?php
session_start();

    include("connection.php");
    include("functions.php");


    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
       //something was posted
      $user_name = $_POST['user_name']; 
      $password =  $_POST['password'];
      
      if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
      {
        //readto database
        $user_id = random_num(20);
        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con,$query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password)
                {
                  $_SESSION['user_id'] = $user_data['user_id'];  
                  header("location: pantrysite.php");
                  die;  
                }
            }
        }

        echo "Wrong username or password!";
    
       
      }
      else
      {
            echo "Wrong username or password!";
      }
    }

?>