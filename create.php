<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="./css/create.css">
</head>
<body>

    <div class="container">
      
        <!-- Text above the form -->
        <p class="create-post-title">Create Post</p>

        <!-- Form starts here -->
        <form action="processing.php" method="post">

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea><br>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required><br>

            <input type="hidden" name="id" value="">

            <!-- Text above the submit button -->
            <p>Make sure all fields are filled out correctly before creating your post.</p>

            <input type="submit" name="create" value="Create Post">
        </form>
    </div>

</body>
</html>
