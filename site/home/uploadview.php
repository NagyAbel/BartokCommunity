<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/background.css"/>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Staatliches&display=swap');
        body {
            background: #2C3034;
        }
        .general {
            width: 400px;
            height: 550px;
            background: #2C2B2B;
            border-radius: 20px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -200px;
            margin-top: -275px;
            font-family: 'Staatliches', cursive;
            letter-spacing: 0.5px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

        }
        .img {
            max-width: 300px;
            max-height: 300px;
            position: absolute;
            left: 50%;
            bottom: 50%;
            margin-bottom: -150px;
            margin-left: -150px;
        }
        .button {
            position: absolute;
            bottom: 9%;
            left: 50%;
            width: 120px;
            height: 50px;
            margin-bottom: -25px;
            margin-left: -60px;
            color: white;
            border-radius: 30px;
            background: #5c5c5c;
            border: none;
            cursor: pointer;
            font-family: 'Staatliches', cursive;
            letter-spacing: 0.5px;

        }
        .text {
            color: white;
            position: absolute;
            left: 50%;
            width: 150px;
            margin-left: -75px;
            background: #5c5c5c;
            top: 5%;
            border-radius: 20px;
            cursor: pointer;
            font-family: 'Staatliches', cursive;
            letter-spacing: 0.5px;
        }

        .atter {
            text-align: center;
            cursor: pointer;
            font-family: 'Staatliches', cursive;
            letter-spacing: 0.5px;
        }

        .back {
            color: white;
            position: absolute;
            left: 50%;
            width: 100px;
            margin-left: -50px;
            background: #5c5c5c;
            bottom: 5%;
            border-radius: 20px;
            cursor: pointer;
            padding: 5px;
            text-align: center;
            font-size: 20px;
            text-decoration: none;
            font-family: 'Staatliches', cursive;
            letter-spacing: 0.5px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

        }

        @media only screen and (max-width: 1200px) {
            body {
            background: #2C3034;
        }
        .general {
            width: 320px;
            height: 440px;
            background: #2C2B2B;
            border-radius: 20px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -160px;
            margin-top: -220px;
            font-family: 'Staatliches', cursive;
            letter-spacing: 0.5px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

        }
        .img {
            max-width: 150px;
            max-height: 150px;
            position: absolute;
            left: 50%;
            bottom: 50%;
            margin-bottom: -75px;
            margin-left: -75px;
        }
        .button {
            position: absolute;
            bottom: 9%;
            left: 50%;
            width: 80px;
            height: 25px;
            margin-bottom: -12.5px;
            margin-left: -40px;
            color: white;
            border-radius: 30px;
            background: #5c5c5c;
            border: none;
            cursor: pointer;
            font-family: 'Staatliches', cursive;
            letter-spacing: 0.5px;
        }
        .text {
            color: white;
            position: absolute;
            left: 50%;
            width: 150px;
            margin-left: -75px;
            background: #5c5c5c;
            top: 5%;
            border-radius: 20px;
            cursor: pointer;
            font-family: 'Staatliches', cursive;
            letter-spacing: 0.5px;
        }

        .atter {
            text-align: center;
            cursor: pointer;
            font-family: 'Staatliches', cursive;
            letter-spacing: 0.5px;
        }

        .back {
            color: white;
            position: absolute;
            left: 50%;
            width: 100px;
            margin-left: -50px;
            background: #5c5c5c;

            bottom: 5%;
            border-radius: 20px;
            cursor: pointer;
            padding: 2px;
            text-align: center;
            font-size: 20px;
            text-decoration: none;
            font-family: 'Staatliches', cursive;
            letter-spacing: 0.5px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

        }
        }
    </style>
</head>
<body>
    <div class="general">
        <form action = "../utils/upload.php" , method  = "post" , enctype="multipart/form-data">


        <label for="file-upload" class="text"><p class="atter">kép kiválasztása</p></label>
            <input id="file-upload" style="display: none;" accept="image/*" onchange="loadFile(event)" type="file", name="my_image">
            <img id="output" class="img"/>
                <script>
                var loadFile = function(event) {
                    var output = document.getElementById('output');
                    output.src = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                    URL.revokeObjectURL(output.src)
                    }
                };
                </script>
           
            <input class="button" type="submit" name="submit"  value="Feltöltés" />
            
        </form>
    </div>
    <?php include('background.html'); ?>

    <a class="back" href="home.php">Vissza</a>
</body>
</html>