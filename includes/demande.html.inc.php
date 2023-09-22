<?php 
// informations de connexion à la base de données MySQL
$servername = "localhost:3308"; // nom du serveur
$username = "root"; // nom d'utilisateur
$password = "XVsikn92"; // mot de passe
$dbname = "tmaconnect"; // nom de la base de données
// création d'une connexion à la base de données

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "La connexion a �chou� : " . $e->getMessage();
}

// R�cup�rer le nom d'utilisateur � partir de la variable de session
$username1 = $_SESSION['username'];
?>


<?php while ($row = $stmt->fetch(PDO::FETCH_BOTH)): ?>
    <tr>
    <section id="menuNouvelDmd">
        <form id="form_nvldemande" name="form_nvldemande" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <fieldset id="menuDmd">
                <div class="form-row">
                    <div class="form-group">
                        <label for="demCreePar">Domaine :</label>
                        <select name="selectDom" id="selectDom">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result0 as $row) {
                                $id_dom = $row['IdDomaine'];
                                $lib_dom = $row['libelle'];
                                echo "<option value=$id_dom>$lib_dom</option>";
                                // echo "<option>$lib_dom</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demCreePar">Qualification :</label>
                        <select name="selectQualif" id="selectQualif">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result1 as $row) {
                                $id_qual = $row['IdQual'];
                                $lib_qual = $row['libelle'];
                                echo "<option value=$id_qual>$lib_qual</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="demCreePar">Priorité :</label>
                        <select name="selectPrio" id="selectPrio">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result2 as $row) {
                                $id_prt = $row['IdPriorite'];
                                $lib_prt = $row['libelle'];
                                echo "<option value=$id_prt>$lib_prt</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="numDemande">N° demande :</label>
                        <input type="text" name="numDemande" id="numDemande" size="35" disabled pattern="[0-9]">
                    </div>

                </div>
            </fieldset>
            <!-- </form> -->
            <!-- </section> -->


            <!-- <section id="nvldemande"> -->
            <!-- <form id="form_nvldemande" name="form_nvldemande" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">  -->
            <fieldset id="coordo">
                <legend>Créer une demande</legend>

                <div class="libelleDemande">
                    <label for="demLibelle">Libellé demande :</label>
                    <input type="text" name="demLibelle" id="demLibelle" size="35"
                        pattern="^[a-zA-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ�?ÀÂÄÃÅÇÉÈÊË�?ÌÎ�?ÑÓÒÔÖÕÚÙÛÜ�?ŸÆŒ\s\-]+$" required
                        required oninput="convertToUppercase(this)">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="demCree">Demande créée le :</label>
                        <input type="date" name="demCree" id="demCree" required>
                    </div>
                    <div class="form-group">
                        <label for="demCreePar">Par :</label>
                        <select name="selectDemandePar" id="selectDemandePar">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result3 as $row) {
                                $id_util = $row['IdUtil'];
                                $nom = $row['nom'];
                                echo "<option value=$id_util>$nom</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demEmise">Demande émise le :</label>
                        <input type="date" name="demEmise" id="demEmise" required>
                    </div>
                    <div class="form-group">
                        <label for="demEmisePar">Par :</label>
                        <select name="selectDemandeEmisePar" id="selectDemandeEmisePar">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result3 as $row) {
                                $id_util = $row['IdUtil'];
                                $nom = $row['nom'];
                                echo "<option value=$id_util>$nom</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demRecu">Demande reçue le :</label>
                        <input type="date" name="demRecu" id="demRecu" required>
                    </div>
                    <div class="form-group">
                        <label for="beneficiaire">Bénéficiaire :</label>
                        <select name="selectBeneficiaire" id="selectBeneficiaire">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result7 as $row) {
                                $id_benef = $row['IdBenef'];
                                $lbl_benef = $row['lbl_benef'];
                                echo "<option value=$id_benef>$lbl_benef</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demCree">Etat de la demande :</label>
                        <input type="date" name="demEtat" id="demEtat" required>
                    </div>
                    <div class="form-group">
                        <label for="etat">Etat :</label>
                        <select name="selectDemandeEtat" id="selectDemandeEtat">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result6 as $row) {
                                $id_etat = $row['IdEtat'];
                                $etat = $row['libelle'];
                                echo "<option value=$id_etat>$etat</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="visaServEtude">Visa service étude :</label>
                        <input type="date" name="visaServEtude" id="visaServEtude" required>
                    </div>
                    <div class="form-group">
                        <label for="signataire">Signataire :</label>
                        <select name="selectSignataire" id="selectSignataire">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result4 as $row) {
                                $id_sign = $row['IdUtil'];
                                $lib_sign = $row['nom'];
                                echo "<option value=$id_sign>$lib_sign</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label for="affection">Affectation de la demande :</label>
                        <select name="selectAffectation" id="selectAffectation">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result4 as $row) {
                                $id_affect = $row['IdUtil'];
                                $lib_affect = $row['nom'];
                                echo "<option value=$id_affect>$lib_affect</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group2">
                        <label for="demEmise">Fin souhaitée le :</label>
                        <input type="date" name="demFs" id="demFs">
                    </div>
                    <div class="form-group2">
                        <label for="demEmise">Mise en recette prévue le (optionnel) :</label>
                        <input type="date" name="demRct" id="demRct">
                    </div>


                    <div class="form-group">
                        <label for="regroupement">Regroupement :</label>
                        <select name="selectRegroupement" id="selectRegroupement">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result5 as $row) {
                                $id_regroupe = $row['IdRegroupe'];
                                $lib_regroupe = $row['libelle'];
                                echo "<option value=$id_regroupe>$lib_regroupe</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demAmortis">Demande amortissable</label>
                        <input type="checkbox" name="demAmortis" id="demAmortis">
                    </div>

                    <div class="form-group">
                        <label for="demArchiv">Demande archivée le :</label>
                        <input type="date" name="demArchiv" id="demArchiv">
                    </div>
                </div>        
    </tr>
<?php endwhile; ?>