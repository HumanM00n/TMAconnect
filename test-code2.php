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

<?php include('includes/connexion.inc.php') ?>
<?php include('includes/header.html.inc.php') ?>

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
                    <div class="containerRow">
                        <div class="infosRow">
                            <div class="infosDateEval">
                                <label for="libDate" class="form-label">Date d'Evaluation</label>
                                <input type="text" class="inputEval" id="date" name="inputEval"
                                    pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="jj/mm/aaaa">
                            </div>

                            <div class="infosParEval">
                                <label for="libSelect" class="form-label">Par</label>
                                <select id="selectUtil" name="selectUtil" class="form-select">
                                    <option value=''></option>
                                    <option value=''>GORLIEZ</option>
                                </select>
                            </div>
                        </div>

                        <div class="containerRow2">
                            <div class="infosRow2">
                                <div class="infosDateCharge">
                                    <label for="libCharge" class="form-label">Charge</label>
                                    <input type="date" class="inputCharge" id="inputCharge" name="inputCharge"
                                        pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="">
                                </div>

                                <div class="infosParTarif">
                                    <label for="libTarif" class="form-label">Tarif</label>
                                    <select id="selectTarif" name="selectTarif" class="form-select">
                                        <option value=''></option>
                                </div></select>
                            </div>
                        </div>
                    </div>

                    <div class="infosRow3">

                        <label for="libAccepte" class="form-check-label">Accepté </label>
                        <input type="checkbox" class="form-check-input" id="checkAccepte" value="checkAccepte">

                        <label for="accepteLe">le </label>
                        <input type="text" class="form-control" id="datepicker" name="inputDateLe"
                            pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="">

                        <label for="libTarif" class="form-label">Par</label>
                        <select id="selectTarif" name="selectTarif" class="form-select">
                            <option value=''></option>
                        </select>
                    </div>
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