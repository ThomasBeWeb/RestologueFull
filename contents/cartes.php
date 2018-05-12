<div class="row justify-content-center">
        <h1>Notre carte du moment</h1>
</div>
<hr>
<!-- Import de la carte -->
<?php
if ($stream = fopen('https://whispering-anchorage-52809.herokuapp.com/cartes/1/get', 'r')) {
            
        $lastCarteJson = stream_get_contents($stream, -1, 0);

        fclose($stream);

        //Conversion en tableau
        $lastCarte = json_decode($lastCarteJson, true);
}
?>

<div class="row justify-content-center">
        <h2 id=<?=$lastCarte['nom>'];?></h2>
</div>
<div class="d-flex flex-column">
</div>

<?php
foreach($lastCarte['menu'] as $value){
?>
<div class="d-flex flex-column petiteCarte">
        <div class="p-2">
                <h3>menu enfant</h3>
                <div class="p-2 d-flex flex-row justify-content-around">
                        <div class="p-2">
                                <h4>Entrée:</h4>
                                <h4>Salade</h4>
                        </div>
                        <div class="p-2">
                                <h4>Plat:</h4>
                                <h4>Steak frites</h4>
                        </div>
                        <div class="p-2">
                                <h4>Entrée:</h4>
                                <h4>Crême brulée</h4>
                        </div>
                </div>
        </div>
</div>

<?php
}
?>