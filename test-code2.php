<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINK BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- LINK BOOTSTRAP DATEPICKER CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">

    <!-- Autres liens CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/csshome.css">
    <link rel="stylesheet" href="css/test2.css">
    <link rel="icon" href="img/NLogo2.png" />
    <title>TC2 - Eval</title>
</head>


<?php include ('includes/connexion.inc.php') ?>
<?php include ('includes/header.html.inc.php') ?>

<body>
    <!------------------------------------------
  |             BOUTON "RETOUR"              | 
  ------------------------------------------->
    <div class="btnretour">
        <button onClick=" history.back();">Retour</button>
    </div>
    <main>
        <section id="modif">
            <form class="formmodif" name="formmodif" action="" method="POST">
                <fieldset id="infos">
                    <legend>Evaluation</legend>
                    <div class="container">

                        <!-----------------------------
                    |       DateEval / PAR        |
                    ------------------------------>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mt-5">
                            <div class="col">
                                <label for="libDate" class="form-label">Date d'Evaluation :</label>
                                <input type="text" class="inputEval" id="datepickerEval" name="inputEval"
                                    pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="jj/mm/aaaa">
                            </div>

                            <div class="col">
                                <label for="libSelect" class="form-label">Par :</label>
                                <select id="selectUtil" name="selectUtil" class="form-select">
                                    <option value=''></option>
                                    <option value=''>GORLIEZ</option>
                                </select>
                            </div>
                        </div>

                        <!-----------------------------
                    |       Charge / Tarif        |
                    ------------------------------>

                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mt-4">
                            <div class="col mt-2">
                                <label for="libCharge" class="form-label">Charge :</label>
                                <input type="text" class="inputCharge" id="datepickerCharge" name="inputCharge"
                                    pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="jj/mm/aaaa">
                            </div>

                            <div class="col mt-2">
                                <label for="libTarif" id="libTarif" class="form-label">Tarif :</label>
                                <select id="selectTarif" name="selectTarif" class="form-select">
                                    <option value=''></option>
                                    <option value=''>Tarif Octobre 2019</option>
                                </select>
                            </div>
                        </div>

                        <!--------------------------------
                    |       AccepteDate / PAR        |
                    --------------------------------->

                        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 mt-5">
                            <div class="col">
                                <label for="libAccepte" class="form-check-label">Accepté :</label>
                                <input type="checkbox" class="form-check-input" id="checkAccepte" value="checkAccepte">
                            </div>

                            <div class="col" id="accepteLe">
                                <label for="accepteLe">le :</label>
                                <input type="text" class="inputDateLe" id="datepickerLe" name="datepicker"
                                    pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="jj/mm/aaaa">
                            </div>

                            <div class="col" id="TarifPar">
                                <label for="libTarifPar" id="libTarifPar" class="form-label">Par :</label>
                                <select id="selectUtilTarif" name="selectUtilTarif" class="form-select">
                                    <option value=''></option>
                                    <option value=''>ROUY</option>
                                </select>
                            </div>
                        </div>

                        <!---------------------------------
                    |       NbrJoursPassé / RAP        |
                    ----------------------------------->

                        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 d-flex mt-5 text-center"
                            id="RAP-NBJ-content">

                            <label for="" class="form-label">Nombre de jours passés :</label>
                            <input type="text" class="form-control" id="NbrJpasse" name="NbrJpasse" value="">

                            <label for="" class="form-label" id="libRAP">Reste à Passer : </label>
                            <input type="text" class="form-control" id="ResteApasser" name="ResteApasser" value="">
                        </div>

                        <!-------------------------------------------
                    |       ImpressionDevis / DétailTâche        |
                    --------------------------------------------->
                        <div class="containerBtn">
                            <div class="GroupBtn">
                                <div class="devisBtn">
                                    <button type="button" class="btn btn-outline-success" id="btnImpression">Impression
                                        Devis</button>
                                </div>
                                <div class="detailBtn">
                                    <button type="button" class="btn btn-outline-success" id="btnDetail">Détail de la
                                        tâche</button>
                                </div>
                            </div>
                        </div>
                        <!-------------------------------------------
                    |       DEMANDE FACTURE / ACCES FACTUR      |
                    -------------------------------------------->
                        <div class="containerFacture">
                            <div class="facture-content">
                                <label for="libFacture" class="form-check-label">Demande Facturée</label>
                                <input type="checkbox" class="form-check-input" id="checkFacture" value="">
                                <input type="text" class="form-control" id="" name="" value="">
                                <button type="button" class="btn btn-primary" id="btnFacture">Accès Facture</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
    </main>

    <!-- Autres scripts JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker//1.4.1/locales/bootstrap-datepicker.fr.min.js"
        integrity="sha512-ucy8JggPcTxFRqY6Sqz4lV6CBEmX4sLY7Pj7OBRXMCQnZW1XlMQLuGWd9UyTbkmW/A70lZ3nCfAdlWq1mFTrzA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>




    <!-- Votre script pour initialiser le datepicker -->
    <script>
        $(function () {
            (function ($) { $.fn.datepicker.dates['fr'] = { days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"], daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."], daysMin: ["di", "lu", "ma", "me", "je", "ve", "sa"], months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"], monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."], today: "Aujourd'hui", monthsTitle: "Mois", clear: "Effacer", weekStart: 1, format: "dd/mm/yyyy" }; }(jQuery));
            $('#datepickerEval').datepicker({
                autoclose: true,
                todayHighlight: true,
                language: 'fr',
                format: 'dd/mm/yyyy',
            });

            $('#datepickerCharge').datepicker({
                autoclose: true,
                todayHighlight: true,
                language: 'fr',
                format: 'dd/mm/yyyy',
            });

            $('#datepickerCharge').datepicker({
                autoclose: true,
                todayHighlight: true,
                language: 'fr',
                format: 'dd/mm/yyyy',
            });

            $('#datepickerLe').datepicker({
                autoclose: true,
                todayHighlight: true,
                language: 'fr',
                format: 'dd/mm/aaaa'
            });
        });
    </script>

</body>

</html>