<?php
//Barre de navigation

//Dossier racine
$homedir = "http://restologue/";

//recup de la liste des fichiers du dossier content
$fichiers = scandir("./contents/");

//Creation de la liste de fichiers sous la forme: nom du lien => lien
$listeFichiers = array("home" => $homedir);

foreach($fichiers as $value){
    
      if($value !== "." AND $value !== ".."){     //Verifie si pas "." ou ".."
          
        //recup du nom du lien: nom du fichier sans .php
        $name = explode(".php", $value);
        $nameSansPhp = $name[0];
    
        //Modif livredor pour faire joli
        if($nameSansPhp === "livredor"){
            $nameSansPhp = "Livre d'or";
        }

        //Ajout dans le tableau
        $listeFichiers[$nameSansPhp] = $homedir."?page=".$name[0];
      }
}
?>

<div class="d-flex flex-row align-items-center">
    <?php
    //Boucle sur la liste des fichiers et affiche
    
    foreach($listeFichiers as $key => $value){
        ?>
            <div class="p-2">
                <a href=<?=$value;?>><?=$key;?></a>
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