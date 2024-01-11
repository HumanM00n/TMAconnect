<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/csshome.css"> -->
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
            <form class="grid-container" method="post">
                <div class="row">
                    <div class="inputGroup col-md-8" id="divDate">
                        <div class="col-md-4">
                            <label for="inputDate" class="form-label">Date d'évaluation</label>
                            <input type="text" class="form-control" id="datepicker" name="datepicker"
                            pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="">
                        </div>

                        <div class="col-md-4" id="divPar">
                            <label for="inputUtil" class="form-label">Par</label>
                            <select id="inputUtil" name="inputUtil" class="form-select">
                                <option value=''>KevinOcarré</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label for="validationCustom04" class="form-label">Carge</label>
                        <select id="inputDate" name="inputUtil" class="form-select">
                            <option value='Tarif'></option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label for="validationCustom04" class="form-label">Tarif</label>
                        <input type="date" class="form-control" id="validationDefault01" required>
                    </div>


                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Tarif</label>
                        <input type="date" class="form-control" id="validationDefault01" required>
                    </div>
                </div>
            </form>
        </section>
    </main>

</body>

</html>