<?php
include_once('includes/connection.php');
include_once('includes/session.php');
confirm_logged_in();

if (isset($_POST['type'])) {

    $name = htmlspecialchars($_POST['title'],ENT_QUOTES);
    $class = $_POST['class'];
    $keywords = htmlspecialchars($_POST['keywords'],ENT_QUOTES);
    $ingredients = htmlspecialchars($_POST['ingredients'],ENT_QUOTES);
    $directions = htmlspecialchars($_POST['directions'],ENT_QUOTES);
    $calories = $_POST['calories'];
    $rating = $_POST['rating'];
    $difficulty = $_POST['difficulty'];
    $description = htmlentities($_POST['desc'],ENT_QUOTES);
    $duration = $_POST['duration'];

    if ($_POST['type'] == 'create') {
        $sql_stmt = "INSERT INTO recipes (title,classification,keywords,ingredients,directions,calories,rating,difficulty,description,duration)
                                       VALUES('$name','$class','$keywords','$ingredients','$directions','$calories','$rating','$difficulty','$description','$duration')";
        $result = mysqli_query($recipe_db_mk2, $sql_stmt);
        if ($result) {
            $id = mysqli_insert_id($recipe_db_mk2);

            $folder = "assets/images/$id";

            $path = $_SERVER['DOCUMENT_ROOT'] . "/recipe_project/$folder/";
            if (!is_dir($path)) mkdir($path, 0755, true);

            if ((!empty($_FILES['image'])) && ($_FILES['image']['error'] == 0)) {

                $file_info = pathinfo($_FILES['image']['name']);
                $ext = $file_info['extension'];

                // Generate random filename
                $tmp = str_replace(array('.', ' '), array('', ''), microtime());
                $newname = $tmp . '.' . $ext;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $path . $newname)) {
                    //Success
                    $sql_stmt = "UPDATE recipes SET image ='$folder/$newname' WHERE id = $id";
                    $result = mysqli_query($recipe_db_mk2, $sql_stmt);
                } else {
                    //hata mesaji buraya gelecek
                }
            } else {
                //hata mesaji gelecek
            }
        }
    }
    if ($_POST['type'] == 'update') {
        $id = $_POST['id'];
        $sql_stmt = "UPDATE recipes SET title='$name',
                                            classification='$class',
                                            keywords='$keywords',
                                            ingredients='$ingredients',
                                            directions='$directions',
                                            calories='$calories',
                                            rating='$rating',
                                            difficulty='$difficulty',
                                            description='$description',
                                            duration='$duration'
                                            WHERE id = '$id'";
        $result = mysqli_query($recipe_db_mk2, $sql_stmt);
        if ($result) {
            $id = mysqli_insert_id($recipe_db_mk2);

            $folder = "assets/images/$id";

            $path = $_SERVER['DOCUMENT_ROOT'] . "/recipe_project/$folder/";
            if (!is_dir($path)) mkdir($path, 0755, true);

            if ((!empty($_FILES['image'])) && ($_FILES['image']['error'] == 0)) {

                $file_info = pathinfo($_FILES['image']['name']);
                $ext = $file_info['extension'];

                // Generate random filename
                $tmp = str_replace(array('.', ' '), array('', ''), microtime());
                $newname = $tmp . '.' . $ext;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $path . $newname)) {
                    //Success
                    $sql_stmt = "UPDATE recipes SET image ='$folder/$newname' WHERE id = $id";
                    $result = mysqli_query($recipe_db_mk2, $sql_stmt);
                } else {
                    //hata mesaji buraya gelecek
                }
            } else {
                //hata mesaji gelecek
            }
        }
    }
}
if (isset($_POST['recipe_id'])) {
    $type = 'update';
    $button_title = 'Update Recipe';
    $recipe_id = $_POST['recipe_id'];
    $sql_stmt = "SELECT * FROM recipes WHERE id='$recipe_id' LIMIT 1";
    $result = mysqli_query($recipe_db_mk2, $sql_stmt);
    $rows = mysqli_num_rows($result);

    if ($rows) {
        while ($row = mysqli_fetch_array($result)) {
            $title = $row['title'];
            $class = $row['classification'];
            $keywords = $row['keywords'];
            $ingredients = $row['ingredients'];
            $directions = $row['directions'];
            $calories = $row['calories'];
            $rating = $row['rating'];
            $difficulty = $row['difficulty'];
            $desc = $row['description'];
            $duration = $row['duration'];
        }
    }
} else {
    $type = 'create';
    $button_title = 'Add Recipe';
    $recipe_id = null;
    $title = null;
    $class = null;
    $keywords = null;
    $ingredients = null;
    $directions = null;
    $calories = null;
    $rating = null;
    $difficulty = null;
    $desc = null;
    $duration = null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add recipe</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/admin-panel-add-recipe-css/admin-panel-add-recipe.css">
    <link href="./assets/summernote/summernote.min.css" rel="stylesheet">

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
    <div class="add-recipe-background-img"></div>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <a href="./admin-panel-menu.php">Back</a>
            <div class="form-elements">
                <div class="left-content">
                    <div class="title item">
                        <label for="title">Recipe Title: </label>
                        <input type="text" name="title" id="title" value='<?php echo $title; ?>'>
                    </div>
                    <div class="class item">
                        <label for="class">Classification: </label>
                        <select name="class" id="class">
                            <?php
                            if ($class == 'oven') {
                                echo "<option value='oven' SELECTED >Oven</option>";
                            } else {
                                echo "<option value='oven'>Oven</option>";
                            }
                            if ($class == 'fried') {
                                echo "<option value='fried' SELECTED >Fried</option>";
                            } else {
                                echo "<option value='fried'>Fried</option>";
                            }
                            if ($class == 'mixed') {
                                echo "<option value='mixed' SELECTED >Mixed</option>";
                            } else {
                                echo "<option value='mixed'>Mixed</option>";
                            }
                            if ($class == 'nocook') {
                                echo "<option value='nocook' SELECTED >No Cook</option>";
                            } else {
                                echo "<option value='nocook'>No Cook</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="keywords item">
                        <label for="keywords">Keywords: </label><br>
                        <textarea name="keywords" id="keywords" cols="30" rows="4"><?php echo $keywords; ?></textarea>
                    </div>
                    <div class="ingredients item">
                        <label for="ingredients">Ingredients: </label><br>
                        <textarea name="ingredients" id="ingredients" cols="30" rows="4"><?php echo $ingredients; ?></textarea>
                    </div>
                    <div class="directions item">
                        <label for="directions">Directions: </label><br>
                        <textarea name="directions" id="directions" cols="30" rows="4"><?php echo $directions; ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="right-content">
                    <div class="calories item">
                        <label for="calories">Calories: </label>
                        <input type="number" id="calories" name="calories" min="0" value='<?php echo $calories; ?>'> cal.
                    </div>
                    <div class="image item">
                        <label for="image">Image: </label>
                        <input type="file" name="image" id="image">
                    </div>
                    <div class="gallery item">
                        <label for="gallery">Gallery: </label>
                        <input type="file" name="gallery" id="gallery" multiple>
                    </div>
                    <div class="rating item">
                        <label for="rating">Rating: </label>
                        <select name="rating" id="rating">
                            <?php
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
                    <div class="difficulty item">
                        <label for="difficulty">Difficulty: </label>
                        <select name="difficulty" id="difficulty">
                        <?php
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
                    <div class="desc item">
                        <label for="desc">Description: </label><br>
                        <textarea id='desc' name='desc'><?php echo $desc; ?></textarea>
                    </div>
                    <div class="duration item">
                        <label for="duration">Duration: </label>
                        <input type="number" id="duration" name="duration" min="0" max="500" step="5" value='<?php echo $duration; ?>'> min.
                    </div>
                </div>
            </div>
            <div class="buttons">
                <input type="hidden" name="type" value="<?php echo $type; ?>">
                <input type="hidden" name="id" value="<?php echo $recipe_id; ?>">
                <button type="Submit"><?php echo $button_title; ?></button>
            </div>
        </form>
    </div>
</body>
<script src="./assets/js/jquery-3.5.1.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/summernote/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#desc').summernote({
            placeholder: 'Please enter your description!',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['font', ['bold', 'underline', 'italic', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
    });
</script>

</html>