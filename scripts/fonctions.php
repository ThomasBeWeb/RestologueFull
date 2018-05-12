<?php

function showMeTheBar(){

    //Dossier racine
    //$homedir = "http://restologue/";
    $homedir = "http://localhost:8888/RestologueFull/";


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

    //Si Admin, ajout de la page Administration
    if($_SESSION['fonction'] === "admin"){
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
            <form class="form-inline" action="'.$homedir.'/login.php" role="form" method="post">
                <h6 class="titreMiddle">Username</h6>
                <input type="text" class="form-control form-control-sm" name="username" id="username"  placeholder="Enter your Username" value="administrateur"/>
                <button type="submit" class="btn btn-primary btn-sm">Login</button>
            </form>
        </div>';
    }

    $message .= '</div>';

    return $message;
}