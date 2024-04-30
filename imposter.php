<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waifu Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, rgba(199, 169, 233, 0.5), rgba(161, 196, 253, 0.5));
        }
        h1 {
            text-align: center;
            margin-top: 40px; /* Increased margin for better spacing */
            font-size: 3em; /* Larger font size for emphasis */
            color: #b03060; /* Lighter pink color for a delicate look */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5), 0 0 10px rgba(176, 48, 96, 0.5); /* Added subtle text shadow */
            letter-spacing: 2px; /* Added letter spacing for readability */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold; /* Added bold font weight for emphasis */
        }
        a {
            color: inherit; /* Set anchor color to inherit from parent (h1) */
            text-decoration: none; /* Remove underline from anchor */
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="file"] {
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
    <h1>Waifu Gallery</h1>

    <form id="uploadForm" enctype="multipart/form-data" method="POST">
        <label for="fileInput">Choose an image:</label>
        <input type="file" id="fileInput" name="image" accept=".png, .jpg, .jpeg">
        <button type="submit" name="submit">Upload</button>
    </form>

    <div id="result">
        <?php
        if(isset($_POST['submit'])){
            $uploadDir = 'images/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

            if($imageFileType == 'jpg' || $imageFileType == 'jpeg' || $imageFileType == 'png'){
                if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)){
                    echo 'Image uploaded successfully.';
                } else {
                    echo 'Failed to upload image.';
                }
            } else {
                echo 'Only PNG, JPG, and JPEG files are allowed.';
            }
        }
        ?>
    </div>
</body>
</html>
