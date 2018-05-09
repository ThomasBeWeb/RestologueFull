<br>
<br>
<div class="row">
    <div class="col-5">
<?php
//Si session, affichage du module insertion de message sinon message demandant connexion

if($_SESSION){
?> 
    <h4><b>Ajouter un commentaire</b></h4>
    <form class="form" action="http://restologue/?page=livredor" role="form" method="post">
        <div class="form-row">
            <div class="form-group col">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Message</span>
                    </div>
                    <input type="text" class="form-control text-center" id="message" name="message" aria-label="pwd" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <button type="submit" class="btn btn-outline-success">Publier</button>
            </div>
        </div>
    </form>
<?php
}else{
?>
    <div style="text-align:center;">
        <h4 style="color: red;">Vous devez être connecté pour publier sur le livre d'or</h4>
    </div>
<?php
}?>
</div>
<?php

if(isset($_POST['message'])){ //Si message envoye
    
    //Recup des messages precedents
    $json_source = file_get_contents('./sources/messages.json');
    $listeMessages = json_decode($json_source, true);

    //Recup des infos
    $dateMessage = date("d/m/Y H:i");
    $user = $_SESSION['username'];
    $message = $_POST['message'];

    //Determiner le nouvel ID
    $newID = end($listeMessages)['id'] + 1;

    //Creation du post au format tableau
    $postTableau = ['id' => $newID, 'user' => $user, 'date' => $dateMessage, 'message' => $message];

    //Integration au tableau en cours
    array_push($listeMessages, $postTableau);

    //Conversion au format JSON
    $listePostsJson = json_encode($listeMessages, JSON_PRETTY_PRINT); //This parameter will format our JSON object and store it in json file
    
    //Recup du fichier d'origine
    $file = "./sources/messages.json";
    
    //Ecrire la nouvelle liste dans le fichier messages.json
    file_put_contents($file, $listePostsJson);

};
?>

<div class="col-7">
<h4><b>Derniers commentaires</b></h4>
<?php
//Affichage de la liste des messages

$json_source = file_get_contents('./sources/messages.json');
$listeMessages = json_decode($json_source, true);
?>

<!-- Affichage des messages-->
<div class="d-flex flex-column-reverse">
<?php
foreach($listeMessages as $object){
    ?>
        <div class="p-2">
            <h4><?= $object['user']; ?> </h4>
            <h6><i><?= $object['date']; ?></i></h6>
            <h5><?= $object['message']; ?> </h5>
        </div>
    <?php
};
?>
</div>
</div>
