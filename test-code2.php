<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                                <input type="date" class="inputEval" id="inputEval" name="inputEval"
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
                                <input type="date" class="inputCharge" id="inputCharge" name="inputCharge"
                                    pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="">
                            </div>

                            <div class="col mt-2">
                                <label for="libTarif" id="libTarif" class="form-label">Tarif :</label>
                                <select id="selectTarif" name="selectTarif" class="form-select">
                                    <option value=''></option>
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
                                <input type="date" class="form-control" id="inputDateLe" name="datepicker"
                                    pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="">
                            </div>

                            <div class="col" id="TarifPar">
                                <label for="libTarifPar" id="libTarifPar" class="form-label">Par :</label>
                                <select id="selectUtilTarif" name="selectUtilTarif" class="form-select">
                                    <option value=''></option>
                                </select>
                            </div>
                        </div>

                    <!---------------------------------
                    |       NbrJoursPassé / RAP        |
                    ----------------------------------->

                        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 d-flex mt-5">
                            <div class="col d-inline-flex">
                                <label for="" class="form-label">Nombre de jours passés :</label>
                                <input type="text" class="form-control" id="NbrJpasse" name="NbrJpasse" value="">
                            </div>

                            <div class="col d-inline-flex">
                                <label for="" class="form-label">Reste à Passer : </label>
                                <input type="text" class="form-control" id="ResteApasser" name="ResteApasser" value="">
                            </div>
                        </div>

                    <!-------------------------------------------
                    |       ImpressionDevis / DétailTâche        |
                    --------------------------------------------->

                        <!-- <div class="row row-cols-sm-2 row-cols-lg-2 display-flex mt-5"> -->
                            <!-- <div class="col col-2">
                                <button type="button" class="btn btn-outline-success" id="btnImpression">Impression
                                    Devis</button>
                            </div>

                            <div class="col">
                                <button type="button" class="btn btn-outline-success" id="btnDetail">Détail de la
                                    tâche</button>
                            </div>
                        </div> -->

                    </div>
                </fieldset>
            </form>
        </section>
    </main>

    <!-- LIEN BOOTSTRAP POPPERS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <!-- LIEN BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- LIEN JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="js/date.js"></script>
</body>

</html>