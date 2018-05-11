<?php
session_start();
if($_POST){
    $_SESSION['username'] = $_POST['username'];

    //Verif si admin

    if ($stream = fopen('https://whispering-anchorage-52809.herokuapp.com/use/'.$_POST['username'], 'r')) {
        
        $fonction = stream_get_contents($stream, -1, 0);

        fclose($stream);
        
        $_SESSION['fonction'] = $fonction;

        if($fonction === "admin"){  //Si admin affichage de la page login

        ?>
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
            <link href="./css/styleConnexion.css" rel="stylesheet">
        </head>
            <body>
            <div class="container-fluid">

        <?php
            include "./template/navigation.php";
            include "./template/connexion.html";
            include "./template/footer.html";
        }
    }
}else{
    session_destroy();
    header("location:".$_SERVER['HTTP_REFERER']);
}
