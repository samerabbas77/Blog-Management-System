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

    <div class="container">    
        <!-- Table Header with Title and Add Post Link -->
        <div class="table-header">
            <div class="table-title">Posts</div>
           
        </div>

        <!-- Table of Posts -->
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  require "classes.php";
                $id = $_GET['id'];
                $result = Posts::read($id);
                 
                ?>
                    <tr>
                        <td><?php echo $result['title']; ?></td>
                        <td><?php echo $result['content']; ?></td>
                        <td><?php echo $result['author']; ?></td>
                        <td>

                        </td>
                    </tr>
 
                </tbody>
            </table>

        </div>
    </div>
    <a href="./index.php?"  class="btn btn-sm btn-success">Back</a>

</body>
</html>
