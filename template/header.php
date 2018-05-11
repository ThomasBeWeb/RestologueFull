<!DOCTYPE html>
<html>

    <head>
        <title>Le restologue</title>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="./favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <link href="./css/style.css" rel="stylesheet">
        <?php
            if($_GET['page'] === "administration"){
       ?>
        <link href="./css/backStyle.css" rel="stylesheet">
        <?php
            }else if($_GET['page'] === "login"){
        ?>
        <link href="./css/styleConnexion.css" rel="stylesheet">
        <?php
            }
        ?>
    </head>
        <body>
        <div class="container-fluid">