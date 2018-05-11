<?php
//Barre de navigation

//Dossier racine
$homedir = "http://restologue/";

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
?>

<div class="d-flex flex-row align-items-center">
    <?php
    //Boucle sur la liste des fichiers et affiche
    
    foreach($listeFichiers as $key => $value){

        //Ajoute class pageSelected si page active

        if($key === $_GET['page'] OR (isset($_GET['page']) === false AND $key === 'Home')){   //Si valeur get = key ou si page home (sans get)
        ?>
             <div class="p-2 pageSelected">
        <?php
        }else{
        ?>
            <div class="p-2">
        <?php
        }
        ?>
           <a href=<?=$value;?>>
        <?php

        //Modif livredor pour faire joli
        if($key === "livredor"){
            $key = "Livre d'or";
        }
        ?>
            <?=$key;?></a>
            </div>
         <?php
    }

    if($_SESSION){
    ?>
        <div class="ml-auto p-2">
            <h6 class="titreMiddle"><?=$_SESSION['username']?></h6>
        </div>
        <div class="p-2">
            <a href="http://restologue/login.php"><i class="fas fa-window-close"></i></a>
        </div>
    <?php
    }else{
    ?>
    <div class="ml-auto p-2">
        <form class="form-inline" action="http://restologue/login.php" role="form" method="post">
            <h6 class="titreMiddle">Username</h6>
            <input type="text" class="form-control form-control-sm" name="username" id="username"  placeholder="Enter your Username" value="administrateur"/>
            <button type="submit" class="btn btn-primary btn-sm">Login</button>
        </form>
    </div>

    <?php
    }
    ?>
    

</div>