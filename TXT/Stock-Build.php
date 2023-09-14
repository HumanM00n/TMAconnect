<!----------------------------------------------------------------------------------------- FILTRES RECHERCHE DEMANDE ------------------------------------------------------------------------------------------------------->
<section id="modif">
    <form class="formmodif" name="formmodif" action="" method="POST">
        <fieldset id="infos">
            <legend>Filtres</legend>
            <div>
                <label for="accesDemande">Accès Direct à la Demande</label>
                <input type="text" size="35">
            </div>
            <!-- Nouveaux champs de texte -->
            <div>
                <label for="">Contenant du texte</label>
                <input type="text" size="35">
            </div>

            <!-- Nouvelles listes déroulantes -->
            <div>
                <label for="select_departement">Domaine</label>
                <select>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
            </div>
            <div>
                <label for="select_poste">Demandes du groupe</label>
                <select name="select_poste" id="select_poste">
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
            </div>
        </fieldset>
    </form>
</section>
<!----------------------------------------------------------------------------------------- BOUTON SOUMETTRE ------------------------------------------------------------------------------------------------------->
<section id="modif">
    <form class="formmodif" name="formmodif" action="" method="POST">
        <!-- Votre formulaire -->
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</section>
<!----------------------------------------------------------------------------------------- PAGINATION BOOTSTRAP ------------------------------------------------------------------------------------------------------->
<nav aria-label="..." style="display: flex; justify-content: center; align-items: flex-end;">
    <ul class="pagination">
        <li class="page-item disabled">
            <a class="page-link">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active" aria-current="page">
            <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>
<!----------------------------------------------------------------------------------------- AFFICHAGE NBRE DMD ------------------------------------------------------------------------------------------------------->

<!-- Affichage du nombre de demandes en titre de tableau -->
<?php
        // Cr�ation du tableau HTML
        echo "<table id='idTable' name='idTable'>";
        // Affichage du nombre d'employ�s en titre de tableau
        if ($count <= 1) {
            echo "<div id='tableau'>$count demande enregistré</div>";
        } else {
            echo "<div id='tableau'>$count demandes enregistrés</div>";
        }
        ?>