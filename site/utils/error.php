<?php include('../home/background.html'); ?>
<link rel="stylesheet" type="text/css" href="../../static/css/background.css"/>

<?php 
    session_start();
    $error = $_SESSION["em"];


?>
<body>
<style>
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
</style>
<p style="text-align:center; font-size:60px; color:white; padding:150px; font-family: 'Staatliches', cursive;"><?=$error?><p>
<a class="back" href="../home/home.php">Vissza</a>

</body>
