<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Waifu Gallery</title>
    <style>
        /* Basic styling for the gallery */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
            padding: 20px;
        }
        .gallery img {
            width: 400px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Anime Waifu Gallery</h1>

    <!-- Search form -->
    <form method="GET">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search">
        <button type="submit">Submit</button>
    </form>

    <div class="gallery">
        <?php
        $image_folder = 'images/'; // Folder containing images
        
        if (isset($_GET['search'])) {
            $query = $_GET['search'];
            $search_result = shell_exec("ls $image_folder$query*.jpg 2>/dev/null"); // Assuming images are JPEG format

            if ($search_result !== null) {
                $image_files = explode("\n", trim($search_result));
            } else {
                $image_files = array();
            }
        } else {
            // Retrieve all images in the folder
            $image_files = glob($image_folder . '*.jpg');
        }

        // Display the images in the gallery
        foreach ($image_files as $image) {
            echo "<img src='$image' alt='Anime Waifu'>";
        }
        ?>
    </div>
</body>
</html>
