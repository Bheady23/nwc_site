<?php
session_start();

include("functions.php");
include("connection.php");

$query="SELECT user_name FROM users WHERE user_id = " . $_SESSION['user_id'] . ";";
$result=mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
$_SESSION['user_name'] = $row['user_name'];
?>

<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Now We're Cooking! - Pantry</title>
<link href="css/reset.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="foundation.css">
<link rel="stylesheet" href="pstyle.css">

</head>

<body>
    <div id="header">
          <div id="pic"><img src="pantrypic.jpg"></div>
           <div id="tag">
            <h1>Now We're Cooking!</h1> 
            <h3>Welcome to your pantry <?php echo $_SESSION['user_name']; ?></h3>
            <p>Get started by adding items to your pantry using the add items box to your left. <br>
            After you add an item it will appear in your pantry below. <br>
            Delete items from your pantry using the delete button next to that item. <br>
            Find a recipe by checking the "use in recipe" box next to items you wish to use<br>
            Next click the gather ingredients button on your right to get them ready.<br>
            Last click the recipe button to see your recipes, enjoy!</p>
           </div>
          <div id="pic2"><img src="pantrypic.jpg"></div>
    </div>

    <div id="container">

      <div id="addbox">
         <form action="pantry_add.php" method="POST">
            <div style="font-size: 20px;margin: 10px;color: white;">Add items</div>
            <input id="text" type="text" name="item_name" placeholder="Item"><br>
            <input id="text" type="text" name="quantity" placeholder="Quantity/description"><br>
            <input id="text" type="text" name="exp_date" placeholder="Expiration Date ex: 05/23/2024"><br>
    
            <input id="button" type="submit" value="Add"><br><br>

          </form>
      </div>
     
    
      <div id="display_table">
        <table>
          <tr>
            <th>Item</th>
            <th>Quantity/Description</th>
            <th>Expiration Date</th>
            <th>Delete</th>
            <th>Use in Recipe</th>

          </tr>
      
          <?php
              $query2="SELECT id, item_name, quantity, exp_date FROM pantry WHERE user_id = " . $_SESSION['user_id'] . ";";
              $result2  = mysqli_query($con,$query2);  
              if (mysqli_num_rows($result2) > 0)
               {
                   while($row2 = mysqli_fetch_assoc($result2))  
                         {
                          ?>
                            <tbody>
                                <tr>
                                  <th><?php echo $row2['item_name']; ?></th>
                                  <th><?php echo $row2['quantity']; ?></th>
                                  <th><?php echo $row2['exp_date']; ?></th>
                                  <form action="pantry_remove.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row2['id']; ?>">
                                    <th><input type="submit" name="delete" value="Delete"></th>
                                  </form> 
                                  <form action="recipe.php" method="POST">
                                    <input type="hidden" name="item" value="<?php echo $row2['item_name']; ?>">
                                    <th><input type="checkbox" name="checkbox" value="<?php echo $row2['item_name']; ?>"></th>
                                  </form>
                                </tr>
                            </tbody>     
                          <?php
                 }
                   echo"</table>";
                   }
                 else {
                 echo "0 results";
                 }
                ?>
                
        </table>
      </div>

      <div id="recipebox">
      <div style="font-size: 20px;margin: 10px;color: white;">Recipe Generator</div>
      <input type="submit" id="btn" value="Gather Ingredients"><br><br>
      
      <form action="recipe.php" method="POST"> 
            
            
            <input id="button" type="submit" name="recipe" value="Recipe"><br><br>
        
         <script>
           document.getElementById('btn').onclick = function() {
            var checkboxes =
                document.getElementsByName('checkbox');
 
            var result = "";
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    result += checkboxes[i].value
                        + " ";
                }
            }
            
            document.cookie = "result=" +result;
           
        }
                 
           
          </script>  
          
           
          </form>
      </div>
    </div> 

      <div id="logout">
        <form action="logout.php">
          <input id="button" type="submit" value ="Log out">
        </form>
      </div>
    
</body>