<?php
include_once('includes/connection.php');
if (isset($_POST['recipe_id'])) {
    $recipe_id = $_POST['recipe_id'];
    $sql_stmt = "SELECT * FROM recipes WHERE id='$recipe_id' LIMIT 1";
    $result = mysqli_query($recipe_db_mk2, $sql_stmt);
    $rows = mysqli_num_rows($result);

    if ($rows) {
        while ($row = mysqli_fetch_array($result)) {
            $title = $row['title'];
            $class = $row['classification'];
            $keywords = nl2br($row['keywords']);
            $ingredients = nl2br($row['ingredients']);
            $directions = nl2br($row['directions']);
            $calories = $row['calories'];
            $rating = $row['rating'];
            $difficulty = $row['difficulty'];
            $desc = htmlspecialchars_decode($row['description']);
            $duration = $row['duration'];
            $image = $row['image'];
            $stars = null;

            for ($star = 1; $star <= $rating; $star++) {
                $stars .= "<i class='fas fa-star'></i>";
            }
        }
    } else {
        //anasayfaya yönlendir
    }
} else {
    //anasayfaya yönlendir
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bört's Recipes</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="./assets/css/main-css/main.css">
    <link rel="stylesheet" href="./assets/css/card-detailed-css/card-detailed.css">

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
    <div class="container">
        <div class="content-wrap">
            <nav id="navbar">
                <div class="nav-container">
                    <div class="nav-elements">
                        <a class="main-header" href="index.php">
                            <h1>Bört's Recipes</h1>
                        </a>
                        <form action="./listed-content.php" method="POST">
                            <div class="search-bar">
                                <button class="filter-btn"><i class="fas fa-filter"></i></button>
                                <input type="text" class="search-input" name="up_search" id="up_search" placeholder="Search for a recipe..." />
                                <button class="search-btn"><i class="fas fa-search"></i></button>
                                <a class="login-btn" href="./admin-panel-login.php"><i class="fas fa-user"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
            <header>
                <div class="container">
                    <div class="card-detailed-container">
                        <div class="containers-part">
                            <div class="upper-section">
                                <div class="upper-left-section">
                                    <div class="main-img">
                                        <img src="<?php echo $image; ?>">
                                    </div>
                                    <!-- <div class="gallery-part">
                                        <div class="image">
                                            <img src="./assets/images/big-card.jpg">
                                        </div>
                                        <div class="image">
                                            <img src="./assets/images/big-card.jpg">
                                        </div>
                                        <div class="image img-right">
                                            <img src="./assets/images/big-card.jpg">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="upper-right-section">
                                    <div class="main-header">
                                        <p><?php echo $title; ?></p>
                                    </div>
                                    <div class="desc-part">
                                        <p>
                                            <?php echo $desc; ?>
                                        </p>
                                    </div>
                                    <div class="options-part">
                                        <div class="option">
                                            <p>Preperation</p>
                                            <p>Type: <span><?php echo $class; ?></span></p>
                                        </div>
                                        <div class="option">
                                            <p><span><i class="fas fa-stopwatch"></i></span></p>
                                            <p><span><?php echo $duration; ?> min</p>
                                        </div>
                                        <div class="option">
                                            <p>Difficulty:</p>
                                            <p><span><?php echo $difficulty; ?></span></p>
                                        </div>
                                        <div class="option">
                                            <p><span><?php echo $calories; ?></span></p>
                                            <p>Calories</p>
                                        </div>
                                        <div class="option">
                                            <p>Ranking:</p>
                                            <p><span><?php echo $stars; ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-section">
                                <div class="directions-part">
                                    <div class="directions-header">
                                        <p>Directions :</p>
                                    </div>
                                    <div class="directions-content">
                                        <ul>
                                            <?php echo $directions; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ingredients-part">
                                    <div class="ingredients-header">
                                        <p>Ingredients :</p>
                                    </div>
                                    <div class="ingredients-content">
                                        <ul>
                                            <?php echo $ingredients; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </section>
            </header>
        </div>
        <footer>
            <div class="footer-container">
                <div class="icons">
                    <a href="https://www.instagram.com/borte_avsaroglu/" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/borte.avsaroglu/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://twitter.com/borte_avsaroglu" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.youtube.com/channel/UC2qT2YL2FCXfnQWkGnQVm6g/featured" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://github.com/borte-avsaroglu" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/borte-avsaroglu/" target="_blank"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>