<div class="row justify-content-center">
        <h1>Notre carte du moment</h1>
</div>
<hr>
<!-- Import de la carte -->

<div class="row justify-content-center">
        <h2 id="titreCarte"></h2>
</div>
<div class="d-flex flex-column" id="listeMenus">

        

</div>

<script>

        var lastCard;

        $.ajax({
                type: "GET",
                url: "https://whispering-anchorage-52809.herokuapp.com/cartes/1/get",
                async: false,
                success: function (data) {
                        lastCard = data;
                },
                error: function () {
                        alert("erreur resup carte");
                }
        });

        $("#titreCarte").text(lastCard.nom);

        //Creation d'une ligne par menu

        var listeDesMenus = lastCard.menu;

        for (var i = 0; i < listeDesMenus.length; i++) {

                $("#listeMenus").append($("<div>")
                        .addClass("d-flex flex-column petiteCarte")
                        .append($("<div>")
                                .addClass("p-2")
                                .append($("<h3>").text(listeDesMenus[i].nom))
                        .append($("<div>")
                                .addClass("p-2 d-flex flex-row justify-content-around")
                                .append($("<div>")
                                        .addClass("p-2")
                                        .append($("<h4>").text("Entrée:"))
                                        .append($("<h4>").text(listeDesMenus[i].entree.nom))
                                        )
                                .append($("<div>")
                                        .addClass("p-2")
                                        .append($("<h4>").text("Plat:"))
                                        .append($("<h4>").text(listeDesMenus[i].plat.nom))
                                        )
                                .append($("<div>")
                                        .addClass("p-2")
                                        .append($("<h4>").text("Entrée:"))
                                        .append($("<h4>").text(listeDesMenus[i].dessert.nom))
                                        )
                                )
                        )
                );
                        
        }

</script>