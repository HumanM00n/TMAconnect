<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/test-css.css">
    <link rel="icon" href="img/NLogo2.png" />
    <title>TC2 - Eval</title>
</head>
<?php include('includes/connexion.inc.php') ?>

<body>
    <!------------------------------------------
  |             BOUTON "RETOUR"              | 
  ------------------------------------------->
    <div class="btnretour">
        <button onClick=" history.back();">Retour</button>
    </div>
    <main>
        <section class="container" id="container">
            <h3><b>Evaluation</b></h3>
            <form class="row g-3" method="post">

                <div class="infosColumn">
                    <div class="col-md-4" id="divPar">
                        <label for="inputDate" class="form-label">Date d'Evaluation</label>
                        <input type="text" class="form-control" id="datepicker" name="inputEval"
                            pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="">
                    </div>

                    <div class="col-md-6" id="divDate">
                        <label for="selectUtil" class="form-label">Par</label>
                        <select id="selectUtil" name="selectUtil" class="form-select">
                            <option value=''></option>
                        </select>
                    </div>
                </div>

                <div class="infosColumn">
                    <div class="col-md-4" id="divCharge">
                        <label for="inputCharge" class="form-label">Charge</label>
                        <select id="inputCharge" name="inputCharge" class="form-select">
                            <option value=''></option>
                        </select>
                    </div>

                    <div class="col-md-6" id="divTarif">
                        <label for="inputTarif" class="form-label">Tarif</label>
                        <input type="text" class="form-control" id="datepicker" name="datepicker"
                            pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="">
                    </div>
                </div>

                <div class="infosColumn">
                    <div class="col-md-4" id="divCharge">
                        <label for="inputCharge" class="form-label">Charge</label>
                        <select id="inputCharge" name="inputCharge" class="form-select">
                            <option value=''></option>
                        </select>
                    </div>

                    <div class="col-md-6" id="divTarif">
                        <label for="inputTarif" class="form-label">Tarif</label>
                        <input type="text" class="form-control" id="datepicker" name="datepicker"
                            pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="">
                    </div>
                </div>
            </form>
        </section>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>