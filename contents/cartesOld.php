<div class="row justify-content-center">
        <h1>Notre carte du moment</h1>
</div>
<hr>
<!-- Import de la carte -->
<?php
//Recuperation de la liste des ID des cartes Online

if ($stream = fopen('https://whispering-anchorage-52809.herokuapp.com/cartes/getonline', 'r')) {
            
        $listeIDsJson = stream_get_contents($stream, -1, 0);

        //Conversion en tableau
        $listeIDs = json_decode($listeIDsJson, true);

        fclose($stream);
}

//Pour chaque carte, recup des infos et affichage

foreach($listeIDs as $idCarte){

        if ($stream = fopen('https://whispering-anchorage-52809.herokuapp.com/cartes/'.$idCarte.'/get', 'r')) {
            
                $myCardJson = stream_get_contents($stream, -1, 0);
        
                fclose($stream);
        
                //Conversion en tableau
                $myCard = json_decode($myCardJson, true);
        }
        ?>
        
        <div class="row justify-content-center">
                <h2><?= $myCard['nom'];?></h2>
        </div>
        <div class="d-flex flex-column">
        </div>
        
        <?php
        foreach($myCard['menu'] as $value){
        ?>
        <div class="d-flex flex-column petiteCarte">
                <div class="p-2">
                        <h3><?= $value['nom']; ?></h3>
                        <div class="p-2 d-flex flex-row justify-content-around">
                                <div class="p-2">
                                        <h4>Entrée:</h4>
                                        <h4><?= $value['entree']['nom']; ?></h4>
                                </div>
                                <div class="p-2">
                                        <h4>Plat:</h4>
                                        <h4><?= $value['plat']['nom']; ?></h4>
                                </div>
                                <div class="p-2">
                                        <h4>Dessert:</h4>
                                        <h4><?= $value['dessert']['nom']; ?></h4>
                                </div>
                        </div>
                </div>
        </div>
        <?php
        }

}

?>