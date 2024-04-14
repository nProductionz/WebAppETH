<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Waifu Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Adjusted to fixed 3 columns */
            grid-gap: 20px;
            padding: 20px;
            justify-content: center;
            align-items: center;
        }
        .gallery img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .gallery img:hover {
            transform: scale(1.05);
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        button[type="submit"] {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        #result {
            text-align: center;
            margin-bottom: 20px;
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

    <div id="result">
        <?php
        $image_folder = 'images/'; // Folder containing images 
        if (isset($_GET['search'])) {
            $query = $_GET['search'];
            $search_result = shell_exec("ls $image_folder$query*.jpg"); // Assuming images are JPEG format

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
        $counter = 0;
        $answer = $search_result;
        if (strpos($search_result, ".jpg") !== false) {
          $answer = str_replace(".jpg", "", $search_result);
          $answer = str_replace("images/", "", $answer);
        }

        if($search_result !== null) {  
            echo "You have searched for: <b>".$answer."</b><br/>";
        }
        ?>
    </div>

    <div class="gallery">
        <?php
        foreach ($image_files as $image) {

            echo "<img src='$image' alt='Anime Waifu'>";
            $counter++;
            // Break loop after 9 images
            if ($counter >= 9) break;
        }
        ?>
    </div>
</body>
</html>
