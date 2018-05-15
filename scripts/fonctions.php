<?php
require('./folder.php');
function showMeTheBar(){
   
    //recup de la liste des fichiers du dossier content
    $fichiers = scandir("./contents/");

    //Creation de la liste de fichiers sous la forme: nom du lien => lien
    $listeFichiers = array("Home" => $GLOBALS['racine']);

    foreach($fichiers as $value){

        //Pour les fichiers:
        if(is_file("./contents/".$value) AND $value !== "gestionCartes.php" AND $value !== "gestionUsers.php"){     //Verifie si fichier et pas admin
            
            //recup du nom du lien: nom du fichier sans .php
            $name = explode(".php", $value);

            //Ajout dans le tableau
            $listeFichiers[$name[0]] = $GLOBALS['racine']."?page=".$name[0];
        
        }else if(is_dir("./contents/".$value) AND $value !== "." AND $value !== ".."){ //Verifie si dossier et pas . ou ..

            $sousDossier = scandir("./contents/".$value."/");

            $sousDossierKeep;

            foreach($sousDossier as $item){
                if($item !== "." AND $item !== ".."){
                    //recup du nom du lien: nom du fichier sans .php
                    $name2 = explode(".php", $item);

                    //Ajout dans le tableau
                    $sousDossierKeep[$name2[0]] = $GLOBALS['racine']."?page=".$name2[0];
                }
            }

            //Ajout de sousDossierKeep dans $listeFichiers

            $listeFichiers[$value] = $sousDossierKeep;

        }
    }

    //Si Admin ET password confirmé, ajout de la page Administration
    if($_SESSION){
        if($_SESSION['fonction'] === "admin" AND $_SESSION['checked'] === "true"){
            $listeFichiers['Gestion cartes'] = $GLOBALS['racine']."?page=gestionCartes";
            $listeFichiers['Gestion users'] = $GLOBALS['racine']."?page=gestionUsers";
        }
    }

    $message = '<div class="d-flex flex-row align-items-center">';

    //Boucle sur la liste des fichiers et dossiers et affiche
    
    foreach($listeFichiers as $key => $value){

        //Check si fichier ou dossier

        if(is_array($value)){ //Si array = dossier

            $message .= '<div class="dropdown">
            <a class="dropdown-toggle" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
            .$key.'</a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

            foreach($value as $sousNom => $sousFichier){
                $message .= '<a class="dropdown-item" href="'.$sousFichier.'">'.$sousNom.'</a>';  
            }
            $message .= '</div></div>';

        }else{

            //Ajoute class pageSelected si page active

        if((($_GET) AND $key === $_GET['page']) OR (isset($_GET['page']) === false AND $key === 'Home')){   //Si valeur get = key ou si page home (sans get)

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
    }

    if($_SESSION){
        $message .= '
        <div class="ml-auto p-2">
            <h6 class="titreMiddle">'.$_SESSION['username'].'</h6>
        </div>
        <div class="p-2">
            <a href="'.$GLOBALS['racine'].'login.php"><i class="fas fa-window-close"></i></a>
        </div>';

    }else{
        $message .= '
        <div class="ml-auto p-2">
            <form class="form-inline" action="'.$GLOBALS['racine'].'login.php" role="form" method="post">
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
                <form action="'.$GLOBALS['racine'].'login.php" role="form" method="post">
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

?>