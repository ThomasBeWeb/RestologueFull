<div class="row head">
    <h2>Gestion des administrateurs</h2>
</div>
<br>

<!-- Recuperation de la liste des users et l'affiche dans une table-->
<div class="row">
    <div class="col-4 offset-1 elementCol">
    <h4>Liste des administrateurs</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Mot de passe</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

<?php
//Recup de la liste des Users

if ($stream = fopen('https://whispering-anchorage-52809.herokuapp.com/users/get', 'r')) {
        
    $listeUsersJson = stream_get_contents($stream, -1, 0);

    //Conversion en tableau
    $listeUsers = json_decode($listeUsersJson, true);

    fclose($stream);
}

//Boucle dans la liste et affiche les lignes du tableau

foreach($listeUsers as $value){
?>

<tr>
    <td scope="col"><?=$value['username'];?></th>
    <td scope="col"><?=$value['password'];?></th>
    <td scope="col"></th>
</tr>
<?php
}
?>

</tbody>
</table>
</div>


<!--Ajout d'un user-->

<div class="col-4 offset-1 elementCol">
    <h4>Ajouter un administrateur</h4>

    <form class="form" action="'.$homedir.'login.php" role="form" method="post">

        <div class="col">
            <label for="username">Pseudo</label>
            <input class="form-control" name="username" id="username" type="text" width="10px">
        </div>
        <br>
        <div class="col-xs-4">
            <label for="password">Mot de passe</label>
            <input class="form-control" name="password" id="password" type="text">
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>
    </form>
</div>

</div>