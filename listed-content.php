<?php
include_once('includes/connection.php');
if (isset($_POST['search'])) {
    $sqlsearch = NULL;
    $sqlorder = NULL;
    $search = NULL;
    $duration = NULL;
    $calories = NULL;
    $rating = NULL;
    $difficulty = NULL;
    $alphabetical = NULL;

    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = $_POST['search'];
        $sqlsearch .= " AND title LIKE '%$search%' ";
    }
    if (isset($_POST['duration']) && !empty($_POST['duration'])) {
        $duration = $_POST['duration'];
        $sqlsearch .= " AND duration = '$duration' ";
    }
    if (isset($_POST['calories']) && !empty($_POST['calories'])) {
        $calories = $_POST['calories'];
        $sqlsearch .= " AND calories = '$calories' ";
    }
    if (isset($_POST['rating']) && !empty($_POST['rating'])) {
        $rating = $_POST['rating'];
        $sqlsearch .= " AND rating = '$rating' ";
    }
    if (isset($_POST['difficulty']) && !empty($_POST['difficulty'])) {
        $difficulty = $_POST['difficulty'];
        $sqlsearch .= " AND difficulty = '$difficulty' ";
    }
    if (isset($_POST['alphabetical']) && !empty($_POST['alphabetical'])) {
        $alphabetical = $_POST['alphabetical'];
        if ($alphabetical == 'a-z') $sqlorder .= " ORDER BY title";
        if ($alphabetical == 'z-a') $sqlorder .= " ORDER BY title DESC";
    } else {
        $sqlorder .= " ORDER BY RAND() ";
    }
} else {
    $sqlsearch = NULL;
    $sqlorder = " ORDER BY RAND() ";
    $search = NULL;
    $duration = NULL;
    $calories = NULL;
    $rating = NULL;
    $difficulty = NULL;
    $alphabetical = NULL;
    if (isset($_POST['up_search']) && !empty($_POST['up_search'])) {
        $search = $_POST['up_search'];
        $sqlsearch .= " AND title LIKE '%$search%' ";
    }
}


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
    <link rel="stylesheet" href="./assets/css/listed-content-css/listed-content.css">

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
                        <form action="" method="POST">
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
            <section>
                <div class="search-container">
                    <div class="search-sub-container">
                        <form action="" id="search_form" method="POST">
                            <div class="content">
                                <div class="sub-content">
                                    <div class="by-value">
                                        <p>Search by value;</p>
                                        <div class="elements">
                                            <div class="search">
                                                <label for="search">Search: </label>
                                                <input type="text" class="search-input" name="search" placeholder="Search for a recipe..." value="<?php echo $search; ?>" />
                                            </div>
                                            <div class="duration">
                                                <label for="duration">Duration: </label>
                                                <input type="number" id="duration" name="duration" min="0" max="500" step="5" value="<?php echo $duration; ?>"> min.
                                            </div>
                                            <div class="calories">
                                                <label for="calories">Calories: </label>
                                                <input type="number" id="calories" name="calories" min="0" value="<?php echo $calories; ?>"> cal.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="by-option">
                                        <p>Search by option;</p>
                                        <div class="elements">
                                            <div class="rating">
                                                <label for="rating">Rating: </label>
                                                <select name="rating" id="rating">
                                                    <?php
                                                    if ($rating == '') {
                                                        echo "<option value='' SELECTED >-</option>";
                                                    } else {
                                                        echo "<option value=''>-</option>";
                                                    }
                                                    if ($rating == '1') {
                                                        echo "<option value='1' SELECTED >1 to 5</option>";
                                                    } else {
                                                        echo "<option value='1'>1 to 5</option>";
                                                    }
                                                    if ($rating == '2') {
                                                        echo "<option value='2' SELECTED >2 to 5</option>";
                                                    } else {
                                                        echo "<option value='2'>2 to 5</option>";
                                                    }
                                                    if ($rating == '3') {
                                                        echo "<option value='3' SELECTED >3 to 5</option>";
                                                    } else {
                                                        echo "<option value='3'>3 to 5</option>";
                                                    }
                                                    if ($rating == '4') {
                                                        echo "<option value='4' SELECTED >4 to 5</option>";
                                                    } else {
                                                        echo "<option value='4'>4 to 5</option>";
                                                    }
                                                    if ($rating == '5') {
                                                        echo "<option value='5' SELECTED >5 to 5</option>";
                                                    } else {
                                                        echo "<option value='5'>5 to 5</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="difficulty">
                                                <label for="difficulty">Difficulty: </label>
                                                <select name="difficulty" id="difficulty">
                                                    <?php
                                                    if ($difficulty == '') {
                                                        echo "<option value='' SELECTED >-</option>";
                                                    } else {
                                                        echo "<option value=''>-</option>";
                                                    }
                                                    if ($difficulty == '1') {
                                                        echo "<option value='1' SELECTED >1 / 5</option>";
                                                    } else {
                                                        echo "<option value='1'>1 / 5</option>";
                                                    }
                                                    if ($difficulty == '2') {
                                                        echo "<option value='2' SELECTED >2 / 5</option>";
                                                    } else {
                                                        echo "<option value='2'>2 / 5</option>";
                                                    }
                                                    if ($difficulty == '3') {
                                                        echo "<option value='3' SELECTED >3 / 5</option>";
                                                    } else {
                                                        echo "<option value='3'>3 / 5</option>";
                                                    }
                                                    if ($difficulty == '4') {
                                                        echo "<option value='4' SELECTED >4 / 5</option>";
                                                    } else {
                                                        echo "<option value='4'>4 / 5</option>";
                                                    }
                                                    if ($difficulty == '5') {
                                                        echo "<option value='5' SELECTED >5 / 5</option>";
                                                    } else {
                                                        echo "<option value='5'>5 / 5</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="alphabetical">
                                                <label for="alphabetical">Alphabetical: </label>
                                                <select name="alphabetical" id="alphabetical">
                                                    <?php
                                                    if ($alphabetical == '') {
                                                        echo "<option value='' SELECTED >-</option>";
                                                    } else {
                                                        echo "<option value=''>-</option>";
                                                    }
                                                    if ($alphabetical == 'a-z') {
                                                        echo "<option value='a-z' SELECTED >A - Z</option>";
                                                    } else {
                                                        echo "<option value='a-z'>A - Z</option>";
                                                    }
                                                    if ($alphabetical == 'z-a') {
                                                        echo "<option value='z-a' SELECTED >Z - A</option>";
                                                    } else {
                                                        echo "<option value='z-a'>Z - A</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <div class="submit-btn">
                                        <button type="submit"><span>Search Your Recipe</span></button>
                                    </div>
                                    <div class="submit-btn clear-btn">
                                        <button type="reset" id="reset"><span>Clear</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container-bottom">
                    <div class="bottom-content">
                        <?php
                        $sql_stmt = "SELECT * FROM recipes WHERE id IS NOT NULL $sqlsearch $sqlorder";
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
                        } else {
                            echo "<div class='no-result'><p>No result founded!</p></div>";
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
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
    </div>
</body>
<script src="./assets/js/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {

        $('.link_recipe').click(function() {
            var id = $(this).data('id');
            $('#recipe_id').val(id);
            $('#link_recipe').submit();
            
        });

        $('#reset').click(function() {
            $('#search_form input').val('');
            $('#search_form select').val('').trigger('click');
            $('#search_form').submit();
            
        });
    });
</script>
</html>