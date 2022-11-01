<?php
include_once('includes/connection.php');
include_once('includes/session.php');
confirm_logged_in();

if (isset($_POST['recipe_id'])) {
  $id = $_POST['recipe_id'];
  $sql_stmt = " DELETE FROM recipes WHERE id=$id ";
  $result = mysqli_query($recipe_db_mk2, $sql_stmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- CSS Files -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/admin-panel-list-css/admin-panel-list.css">

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
  <div class="list-recipe-background-img"></div>
  <div class="list-container">
    <table class="table">
      <thead class="thead-light">
        <tr class="table-nav">
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Classification</th>
          <th scope="col">Keywords</th>
          <th scope="col">Ingredients</th>
          <th scope="col">Directions</th>
          <th scope="col">Calories</th>
          <th scope="col">Rating</th>
          <th scope="col">Difficulty</th>
          <th scope="col">Description</th>
          <th scope="col">Duration</th>
          <th><a href="./admin-panel-menu.php" class="btn btn-warning">Back</a></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql_stmt = "SELECT * FROM recipes ORDER BY id DESC";
        $result = mysqli_query($recipe_db_mk2, $sql_stmt);
        $rows = mysqli_num_rows($result);

        if ($rows) {
          while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            echo
            "
              <tr>
                <td scope='row'>$id</td>
                <td>{$row['title']}</td>
                <td>{$row['classification']}</td>
                <td>{$row['keywords']}</td>
                <td>" . substr($row['ingredients'], 0, 80) . "...</td>
                <td>" . substr($row['directions'], 0, 80) . "...</td>
                <td>{$row['calories']}</td>
                <td>{$row['rating']}</td>
                <td>{$row['difficulty']}</td>
                <td>" . substr($row['description'], 0, 80) . "...</td>
                <td>{$row['duration']}</td>
                <td>
                    <form action='admin-panel-add-recipe.php' method='POST' id='edit_recipe_$id'>
                      <button class='btn btn-primary edit-btn' data-id='$id' type='button'>Edit</button>
                      <input type='hidden' name='recipe_id' value='$id'/>
                    </form>
                    <form action='' method='POST' id='delete_recipe_$id'>
                      <button class='btn btn-danger delete-btn' data-id='$id' type='button'>Delete</button>
                      <input type='hidden' name='recipe_id' value='$id'/>
                    </form>
                </td>
              </tr>
            ";
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
<script src="./assets/js/jquery-3.5.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function() {

    $('.edit-btn').click(function() {
      
      var id = $(this).data('id');
      Swal.fire({
        title: 'Do you want to edit recipe?',
        showCancelButton: true,
        confirmButtonText: `Edit`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $('#edit_recipe_' + id).submit();
        }
      })
    });


    $('.delete-btn').click(function() {
      var id = $(this).data('id');
      Swal.fire({
        title: 'Do you want to delete recipe?',
        showCancelButton: true,
        confirmButtonText: `Delete`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $('#delete_recipe_' + id).submit();
        }
      })
    });
  });
</script>

</html>