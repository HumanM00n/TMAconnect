<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
    <head>
        <title>Création demande</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="../css/creationDemande.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="../img/NLogo2.png"/>
    </head>
    <body>
        <?php
        include ('../includes/header.html.inc.php');

// Informations de connexion � la base de donn�es MySQL
        $servername = "localhost:3308"; // nom du serveur
        $username = "root"; // nom d'utilisateur
        $password = "XVsikn92"; // mot de passe
        $dbname = "tmaconnect"; // nom de la base de donn�es
        // Cr�ation d'une connexion � la base de donn�es avec PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Configuration des attributs de PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requ�tes SQL pour r�cup�rer les donn�es des tables tc_service, tc_poste et tc_droit
        $sql0 = "SELECT matricule, nom, prenom FROM tc_utilisateur";
        $stmt0 = $pdo->query($sql0);
        $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);

        $sql1 = "SELECT s_libelle FROM tc_service";
        $stmt1 = $pdo->query($sql1);
        $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        $sql2 = "SELECT libelle FROM tc_etat";
        $stmt2 = $pdo->query($sql2);
        $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <section id="menuNouvelDmd">
            <form id="form_menuNvlDmd" name="form_menuNvlDmd" action="" method="POST">
                <fieldset id="menuDmd">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="demCreePar">Domaine :</label>
                            <select name="selectDemandePar" id="selectDemandePar">
                                <?php
                                echo "<option value='' disabled selected hidden></option>";
                                foreach ($result0 as $row) {
                                    $matricule = $row['matricule'];
                                    $nom = $row['nom'];
                                    $prenom = $row['prenom'];
                                    echo "<option>$nom $prenom ($matricule)</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="demCreePar">Qualification :</label>
                            <select name="selectDemandePar" id="selectDemandePar">
                                <?php
                                echo "<option value='' disabled selected hidden></option>";
                                foreach ($result0 as $row) {
                                    $matricule = $row['matricule'];
                                    $nom = $row['nom'];
                                    $prenom = $row['prenom'];
                                    echo "<option>$nom $prenom ($matricule)</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="demCreePar">Priorité :</label>
                            <select name="selectDemandePar" id="selectDemandePar">
                                <?php
                                echo "<option value='' disabled selected hidden></option>";
                                foreach ($result0 as $row) {
                                    $matricule = $row['matricule'];
                                    $nom = $row['nom'];
                                    $prenom = $row['prenom'];
                                    echo "<option>$nom $prenom ($matricule)</option>";
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
            </form>






        </section>

        <section id="nvldemande">
            <form id="form_nvldemande" name="form_nvldemande" action="" method="POST">
                <fieldset id="coordo">
                    <legend>Créer une demande</legend>

                    <div class="libelleDemande">
                        <label for="demLibelle">Libellé demande :</label>
                        <input type="text" name="demLibelle" id="demLibelle" size="35" pattern="^[a-zA-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ�?ÀÂÄÃÅÇÉÈÊË�?ÌÎ�?ÑÓÒÔÖÕÚÙÛÜ�?ŸÆŒ\s\-]+$" required required oninput="convertToUppercase(this)">
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
                                foreach ($result0 as $row) {
                                    $matricule = $row['matricule'];
                                    $nom = $row['nom'];
                                    $prenom = $row['prenom'];
                                    echo "<option>$nom $prenom ($matricule)</option>";
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
                                foreach ($result0 as $row) {
                                    $matricule = $row['matricule'];
                                    $nom = $row['nom'];
                                    $prenom = $row['prenom'];
                                    echo "<option>$nom $prenom ($matricule)</option>";
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
                                foreach ($result1 as $row) {
                                    $service = $row['s_libelle'];
                                    echo "<option>$service</option>";
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
                                foreach ($result2 as $row) {
                                    $etat = $row['libelle'];
                                    echo "<option>$etat</option>";
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
                                foreach ($result0 as $row) {
                                    $matricule = $row['matricule'];
                                    $nom = $row['nom'];
                                    $prenom = $row['prenom'];
                                    echo "<option>$nom $prenom ($matricule)</option>";
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
                                foreach ($result0 as $row) {
                                    $matricule = $row['matricule'];
                                    $nom = $row['nom'];
                                    $prenom = $row['prenom'];
                                    echo "<option>$nom $prenom ($matricule)</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group2">
                            <label for="demEmise">Fin souhaitée le :</label>
                            <input type="date" name="demEmise" id="demEmise" required>
                        </div>
                        <div class="form-group2">
                            <label for="demEmise">Mise en recette prévue le (optionnel) :</label>
                            <input type="date" name="demEmise" id="demEmise">
                        </div>


                        <div class="form-group">
                            <label for="regroupement">Regroupement :</label>
                            <select name="selectRegroupement" id="selectRegroupement">
                                <?php
                                echo "<option value='' disabled selected hidden></option>";
                                foreach ($result0 as $row) {
                                    $matricule = $row['matricule'];
                                    $nom = $row['nom'];
                                    $prenom = $row['prenom'];
                                    echo "<option>$nom $prenom ($matricule)</option>";
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
                            <input type="date" name="demArchiv" id="demArchiv" required>
                        </div>
                    </div>


                    <div class="btnajout">
                        <button type="submit" name="btnajout">CR&Eacute;ER</button>
                    </div>
                </fieldset>
            </form>


        </section>


    </body>
</html>

