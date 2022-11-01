<?php
  include_once('includes/connection.php');
  include_once('includes/session.php');
  confirm_logged_in();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="./assets/css/admin-panel-menu-css/admin-panel-menu.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Over+the+Rainbow&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    
    <!-- Page Icon -->
    <link rel="icon" href="">
    
</head>
<body>
    <div class="menu-background-img"></div>
    <div class="container">
        <div class="elements">
            <div class="headers-part">
                <div class="php-title">
                    <p>Welcome <br><span><?php echo $_SESSION['title']; ?></span></p>
                </div>
                <hr>
                <div class="header">
                    <p>Bört's Recipes Admin Panel</p>
                </div>
            </div>
            <hr>
            <div class="links">
                <div class="addrecipe">
                    <a href="./admin-panel-add-recipe.php"><p>Add New Recipe</p></a>
                </div>
                <div class="listrecipe">
                    <a href="./admin-panel-list-recipe.php"><p>List All Recipes</p></a>
                </div>
                <form action="admin-panel-logout.php" method="POST">
                    <div class="logout">
                        <button type="submit">Logout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>