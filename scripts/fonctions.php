<?php

    //Dossier racine
    //$homedir = "http://restologue/";
    $homedir = "http://localhost:8888/RestologueFull/";

function showMeTheBar(){

    //recup de la liste des fichiers du dossier content
    $fichiers = scandir("./contents/");

    //Creation de la liste de fichiers sous la forme: nom du lien => lien
    $listeFichiers = array("Home" => $homedir);

    foreach($fichiers as $value){
        
        if($value !== "." AND $value !== ".." AND $value !== "administration.php"){     //Verifie si pas "." ou ".." ou admin
            
            //recup du nom du lien: nom du fichier sans .php
            $name = explode(".php", $value);

            //Ajout dans le tableau
            $listeFichiers[$name[0]] = $homedir."?page=".$name[0];
        }
    }

    //Si Admin ET password confirmé, ajout de la page Administration
    if($_SESSION['fonction'] === "admin" AND $_SESSION['checked'] === "true"){
        $listeFichiers['Administration'] = $homedir."?page=administration";
    }

    $message = '<div class="d-flex flex-row align-items-center">';

    //Boucle sur la liste des fichiers et affiche
    
    foreach($listeFichiers as $key => $value){

        //Ajoute class pageSelected si page active

        if($key === $_GET['page'] OR (isset($_GET['page']) === false AND $key === 'Home')){   //Si valeur get = key ou si page home (sans get)

            $message .= '<div class="p-2 pageSelected">';

        }else{

            $message .= '<div class="p-2">';

        }

        $message .= '<a href='.$value.'>';


        //Modif livredor pour faire joli
        if($key === "livredor"){
            $key = "Livre d'or";
        }

        $message .= $key.'</a></div>';
    }

    if($_SESSION){
        $message .= '
        <div class="ml-auto p-2">
            <h6 class="titreMiddle">'.$_SESSION['username'].'</h6>
        </div>
        <div class="p-2">
            <a href="'.$homedir.'login.php"><i class="fas fa-window-close"></i></a>
        </div>';

    }else{
        $message .= '
        <div class="ml-auto p-2">
            <form class="form-inline" action="'.$homedir.'login.php" role="form" method="post">
                <h6 class="titreMiddle">Username</h6>
                <input type="text" class="form-control form-control-sm" name="username" id="username"  placeholder="Enter your Username" value="administrateur"/>
                <button type="submit" class="btn btn-primary btn-sm">Login</button>
            </form>
        </div>';
    }

    $message .= '</div>';

    return $message;
}

function showMeTheLoginPage(){

    return '
    
    <!DOCTYPE html>
<html>

<head>
    <title>Le restologue</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="./favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row main">
            <div class="main-login main-center">
                <form action="'.$homedir.'login.php" role="form" method="post">
                    <div class="form-group">
                        <label for="username" class="cols-sm-2 control-label">Username</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-users fa" aria-hidden="true"></i>
                                </span>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter your Username" value="administrateur"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="cols-sm-2 control-label">Password</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock fa-lg" aria-hidden="true"></i>
                                </span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" value=""/>
                            </div>
                        </div>                    
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js "></script>
        <link href="./css/styleConnexion.css " rel="stylesheet ">
</html>
    
    ';
}