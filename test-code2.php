<!DOCTYPE html>
<html>

<head>
    <title>TC2</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/test.css">
</head>

<body>

    <?php
    // include('includes/header.html.inc.php');
// include('includes/connexion.inc.php'); 
    
    // $id_demande =$_GET['id_demande']; 
// echo $id_demande
    ?>

    <section id="menuNouvelDmd">
        <form id="form_nvldemande" name="form_nvldemande" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <fieldset id="menuDmd">
                <div class="form-row">
                    <div class="form-group">
                        <label for="demCreePar">Domaine :</label>
                        <input name="selectDom" id="selectDom" class="inputInfos">
                        <?php

                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demCreePar">Qualification :</label>
                        <input name="selectQualif" id="selectQualif" class="inputInfos">
                        <?php

                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="demCreePar">Priorité :</label>
                        <input name="selectPrio" id="selectPrio" class="inputInfos">
                        <?php

                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="numDemande">N° demande :</label>
                        <input type="text" name="numDemande" id="numDemande" size="35" disabled pattern="[0-9]">
                    </div>

                </div>
            </fieldset>

            <fieldset id="coordo">
                <div class="libelleDemande">
                    <label for="demLibelle">Libellé demande :</label>
                    <input type="text" name="demLibelle" id="demLibelle" size="35"
                        pattern="^[a-zA-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ�?ÀÂÄÃÅÇÉÈÊË�?ÌÎ�?ÑÓÒÔÖÕÚÙÛÜ�?ŸÆŒ\s\-]+$" required
                        required oninput="convertToUppercase(this)">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="demCree">Demande créée le :</label>
                        <input type="text" name="demCree" id="demCree">
                    </div>
                    <div class="form-group">
                        <label for="demCreePar">Par :</label>
                        <input name="selectDemandePar" id="selectDemandePar" class="inputInfos">
                        <?php

                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demEmise">Demande émise le :</label>
                        <input type="text" name="demEmise" id="demEmise" class="infosDate">
                    </div>
                    <div class="form-group">
                        <label for="demEmisePar">Par :</label>
                        <input name="selectDemandeEmisePar" id="selectDemandeEmisePar" class="inputInfos">
                        <?php

                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demRecu">Demande reçue le :</label>
                        <input type="text" name="demRecu" id="demRecu" class="infosDate">
                    </div>
                    <div class="form-group">
                        <label for="beneficiaire">Bénéficiaire :</label>
                        <input name="selectBeneficiaire" id="selectBeneficiaire" class="inputInfos">
                        <?php

                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demCree">Etat de la demande au :</label>
                        <input type="text" name="demEtat" id="demEtat" class="infosDate">
                    </div>
                    <div class="form-group">
                        <label for="etat">Etat :</label>
                        <input name="selectDemandeEtat" id="selectDemandeEtat" class="inputInfos">
                        <?php

                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="visaServEtude">Visa service étude au :</label>
                        <input type="text" name="visaServEtude" id="visaServEtude" class="infosDate">
                    </div>
                    <div class="form-group">
                        <label for="signataire">Signataire :</label>
                        <input name="selectSignataire" id="selectSignataire" class="inputInfos">
                        <?php

                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label for="affection">Affectation de la demande :</label>
                        <input name="selectAffectation" id="selectAffectation" class="inputInfos">
                        <?php

                        ?>
                        </select>
                    </div>


                    <div class="form-group2">
                        <label for="demEmise">Fin souhaitée le :</label>
                        <input type="text" name="demFs" id="demFs" class="infosDate">
                    </div>
                    <div class="form-group2">
                        <label for="demEmise">Mise en recette prévue le (optionnel) :</label>
                        <input type="text" name="demRct" id="demRct" class="infosDate">
                    </div>


                    <div class="form-group">
                        <label for="regroupement">Regroupement :</label>
                        <input name="selectRegroupement" id="selectRegroupement" class="inputInfos">
                        <?php

                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demAmortis">Demande amortissable</label>
                        <input type="checkbox" name="demAmortis" id="demAmortis">
                    </div>

                    <div class="form-group">
                        <label for="demArchiv">Demande archivée le :</label>
                        <input type="text" name="demArchiv" id="demArchiv" class="infosDate">
                    </div>
                </div>
            </fieldset>
        </form>
    </section>

</body>

<html>