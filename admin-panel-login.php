<?php
include_once('includes/connection.php');
include_once('includes/session.php');
if (logged_in()) {
    $location = 'admin-panel-menu.php';
    header("Location: {$location}");
}

$message = NULL;
if (isset($_POST['rc_username']) && isset($_POST['rc_password']) && !empty($_POST['rc_username']) && !empty($_POST['rc_password'])) {
    $username = $_POST['rc_username'];
    $password = $_POST['rc_password'];
    $salt = 'jsgp!l@3';
    $hashed = md5($salt . $password . $salt);

    $sql_stmt = "SELECT * FROM users WHERE username = '$username' AND password = '$hashed'";
    $result = mysqli_query($recipe_db_mk2, $sql_stmt);
    $rows = mysqli_num_rows($result);

    if ($rows) {
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION['title'] = $row['title'];
            $location = 'admin-panel-menu.php';
            header("Location: {$location}");
        }
    } else {
        $message = 'Please check your username and password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/admin-panel-login-css/admin-panel-login.css">

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
    <div class="login-background-img"></div>
    <div class="login-container">
        <form action="" method="POST">
            <div class="header">
                <h1>Bört's Recipes</h1>
            </div>
            <div class="form-group">
                <input type="text" name="rc_username" class="form-control" id="rc_username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" name="rc_password" class="form-control" id="rc_password" placeholder="Password">
            </div>
            <div class="php-message">
                <?php echo $message; ?>
            </div>
            <button type="submit" name="loginbtn" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>