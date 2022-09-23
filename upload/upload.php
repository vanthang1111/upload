<?php
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
        echo "Success";
    } else {
        print_r($errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        #upload {
            opacity: 0;
        }

        #upload-label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
        }

        .image-area {
            border: 2px dashed rgba(255, 255, 255, 0.7);
            padding: 1rem;
            position: relative;
        }

        .image-area::before {
            content: 'Uploaded image result';
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.8rem;
            z-index: 1;
        }

        .image-area img {
            z-index: 2;
            position: relative;
        }
        .inputs{
            border: 1px solid #757f9a;
            padding: 10px;
            border-radius: 20px;
            justify-content: space-around;
            text-align: center;
        }

        /*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/
        body {
            min-height: 100vh;
            background-color: #757f9a;
            background-image: linear-gradient(147deg, #757f9a 0%, #d7dde8 100%);
        }
    </style>
    <script type="text/javascript">
        function preview() {
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</head>

<body>
    <div class="container py-5">

        <!-- For demo purpose -->
        <header class="text-white text-center">
            <h1 class="display-4">Image upload</h1>
            <img id="thumb" src="" width="150px" />
        </header>


        <div class="row py-4">
            <div class="col-lg-6 mx-auto">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="inputs">
                    <input type="file" name="image" onchange="preview()"/>
                    <input type="submit"/>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</body>

</html>