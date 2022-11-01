<?php
include_once('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="recipe, food, dinner, breakfast, lunch, preperation">
    <meta name="description" content="Bört's Recipes - rec">
    <title>Bört's Recipes</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="./assets/css/main-css/main.css">

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
            <div class='left-content'>
                <?php
                $existing = array();
                $sql_stmt = "SELECT * FROM recipes WHERE rating = 5 ORDER BY RAND() LIMIT 1";
                $result = mysqli_query($recipe_db_mk2, $sql_stmt);
                $rows = mysqli_num_rows($result);

                if ($rows) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        array_push($existing, $id);
                        $image = $row['image'];
                        $title = $row['title'];
                        $desc = htmlspecialchars_decode($row['description']);
                        $class = $row['classification'];
                        $cal = $row['calories'];
                        $duration = $row['duration'];
                        $difficulty = $row['difficulty'];
                        $rating = $row['rating'];
                        $stars = null;

                        for ($star = 1; $star <= $rating; $star++) {
                            $stars .= "<i class='fas fa-star'></i>";
                        }
                        echo "
                        <div class='big-card link_recipe' data-id='$id'>
                            <div class='big-card-image'>
                            <img src='$image'>
                            </div>
                            <div class='big-card-content'>
                                <div class='big-card-header'>
                                    <h1>$title</h1>
                                </div>
                                <div class='big-card-paragraph'>
                                    <p>$desc</p>
                                </div>
                                <div class='big-card-footer'>
                                    <div class='big-card-option'>
                                        <p>Preperation</p>
                                        <p>Type: <span>$class</span></p>
                                    </div>
                                    <div class='big-card-option'>
                                        <p><span>$cal</span></p>
                                        <p>Calories</p>
                                    </div>
                                    <div class='big-card-option'>
                                        <p><span><i class='fas fa-stopwatch'></i></span></p>
                                        <p>$duration min</p>
                                    </div>
                                    <div class='big-card-option'>
                                        <p>Difficulty:</p>
                                        <p><span>$difficulty</span></p>
                                    </div>
                                    <div class='big-card-option'>
                                        <p>Rating:</p>
                                        <p><span>$stars</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                    }
                }
                ?>
            </div>
            <hr class="header-hr">
            <div class="right-content">
                <?php
                $sql_stmt = "SELECT * FROM recipes WHERE rating = 4 ORDER BY RAND () LIMIT 4";
                $result = mysqli_query($recipe_db_mk2, $sql_stmt);
                $rows = mysqli_num_rows($result);

                if ($rows) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        array_push($existing, $id);
                        $image = $row['image'];
                        $title = $row['title'];
                        $duration = $row['duration'];
                        $rating = $row['rating'];
                        $stars = null;

                        for ($star = 1; $star <= $rating; $star++) {
                            $stars .= "<i class='fas fa-star'></i>";
                        }
                        echo "
                        <div class='food-card link_recipe' data-id='$id'>
                            <img src='$image'>
                            <div class='food-descr'>
                                <div class='food-header'>
                                    $title
                                </div>
                                <div class='food-footer'>
                                    <div class='food-duration'>
                                        <span><i class='fas fa-stopwatch'></i></span> $duration min
                                    </div>
                                    <div class='food-ranking'>
                                        <span>$stars</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                    }
                }
                ?>
            </div>
    </header>
    <hr class="body-hr">
    <section>
        <div class="container-bottom">
            <div class="bottom-content">
                <?php
                $existing_id = implode(',', $existing);
                $sql_stmt = "SELECT * FROM recipes WHERE id NOT IN ($existing_id) LIMIT 10";
                $result = mysqli_query($recipe_db_mk2, $sql_stmt);
                $rows = mysqli_num_rows($result);

                if ($rows) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $image = $row['image'];
                        $title = $row['title'];
                        $desc = $row['description'];
                        $class = $row['classification'];
                        $cal = $row['calories'];
                        $duration = $row['duration'];
                        $difficulty = $row['difficulty'];
                        $rating = $row['rating'];
                        $stars = null;

                        for ($star = 1; $star <= $rating; $star++) {
                            $stars .= "<i class='fas fa-star'></i>";
                        }

                        echo "
                        <div class='food-card link_recipe' data-id='$id'>
                            <img src='$image'>
                            <div class='food-descr'>
                                <div class='food-header'>
                                    $title
                                </div>
                                <div class='food-footer'>
                                    <div class='food-duration'>
                                        <span><i class='fas fa-stopwatch'></i></span> $duration min
                                    </div>
                                    <div class='food-ranking'>
                                        <span>$stars</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <form action='./card-detailed.php' id='link_recipe' method='POST'>
        <input type='hidden' value='' id='recipe_id' name='recipe_id' />
    </form>
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
</body>
<script src="./assets/js/jquery-3.5.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        $('.link_recipe').click(function() {
            var id = $(this).data('id');
            $('#recipe_id').val(id);
            $('#link_recipe').submit();
            
        });

    });
</script>

</html>