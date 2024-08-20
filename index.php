<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Posts</title>
    <link rel="stylesheet" href="./css/index.css">

</head>
<body>
    <?php

    //CHECK IF THE DATABASE DOSENT EXISTS BEFORE CREATE IT
    require "classes.php";
    Database::satart_connection();
   
    $q = "SHOW DATABASES LIKE 'blog_db'";
    $result = mysqli_query(Database::$conn,$q);
    mysqli_close(Database::$conn);
   
    if (mysqli_num_rows($result) === 0) 
    {
        Database::create_Database(); 
    }
    ?>

    <div class="container">
        <!-- Show the validation message -->
        <?php
        session_start();
        if (isset($_SESSION["error"])) {
        ?>
        <div class="alert alert-warning">
            <?php echo "Validation Error:".$_SESSION["error"]; ?>
        </div>
        <?php
        unset($_SESSION["error"]);
        }
        ?>

        <!-- Show the successful message -->
        <?php
        if (isset($_SESSION["create"])) {
        ?>
        <div class="alert alert-success">
            <?php echo $_SESSION["create"]; ?>
        </div>
        <?php
        unset($_SESSION["create"]);
        }
        ?>

        <?php
        if (isset($_SESSION["update"])) {
        ?>
        <div class="alert alert-success">
            <?php echo $_SESSION["update"]; ?>
        </div>
        <?php
        unset($_SESSION["update"]);
        }
        ?>

        <?php
        if (isset($_SESSION["delete"])) {
        ?>
        <div class="alert alert-success">
            <?php echo $_SESSION["delete"]; ?>
        </div>
        <?php
        unset($_SESSION["delete"]);
        }
        ?>

        <!-- Table Header with Title and Add Post Link -->
        <div class="table-header">
            <div class="table-title">Posts</div>
            <a href="./create.php" class="btn btn-primary">Add Post</a>
        </div>

        <!-- Table of Posts -->
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1; // row number in the page
                $result = Posts::listAll();
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['content']; ?></td>
                        <td><?php echo $row['author']; ?></td>
                        <td>
                            <a href="update.php?id=<?php echo $row['id'] ;?>" class="btn btn-sm btn-warning">Update</a>
                            <a href="./delete.php?id=<?php echo $row['id'];?>" onclick='return confirmDelete()' class="btn btn-sm btn-danger">Delete</a>
                            <a href="./view.php?id=<?php echo $row['id'];?>"  class="btn btn-sm btn-success">Show</a>

                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function confirmDelete()
         {
            return confirm('Are you sure you want to delete this post?');
        }
    </script>
</body>
</html>
