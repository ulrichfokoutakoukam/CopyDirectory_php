<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Webpage Title -->
     <title>copy directory</title>

     <link rel="stylesheet" href="/css/bootstrap.css">
</head>
<body>

    <div class="container">
    <div class="row">
    <form action="copyDirectory.php" method="post">
        source directory: <input type="text" name="sourcePath"><br>
        destination directory: <input type="text" name="destinationPath"><br>
        excluded directory: <input type="text" name="excludedPath"><br>

        <input type="submit">
    </form>

    </div>
    </div>
</body>
</html>