<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <link rel="stylesheet" href="./css/create.css">
</head>
<body>
    <div class="container">

        <!-- Text above the form -->
        <p class="create-post-title">Update Post</p>
        <?php
        require_once 'classes.php';
        $id = $_GET['id'];
        $old_data = Posts::read($id);
       
        ?>

        <!-- Form starts here -->
        <form action="processing.php" method="post">

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $old_data['title']?>" required><br>

            <label for="content">Content:</label>
            <textarea id="content" name="content" placeholder="post Content"  required><?php echo $old_data['content']?></textarea><br>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author"  value="<?php echo $old_data['author']?>" required><br>

            <input type="hidden" name="id" value="<?php echo $id;?>">

            <!-- Text above the submit button -->
            <p>Make sure all fields are filled out correctly before updating your post.</p>

            <input type="submit" name="update" value="Create Post">
        </form>
    </div>
    
</body>
</html>
