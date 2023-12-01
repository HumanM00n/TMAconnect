<!DOCTYPE html>
<html>

<head>
  <title>TMATest1</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="css/test-css.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="img/NLogo2.png" />
</head>

<body>
  <?php include('includes/connexion.inc.php'); ?>

  <!------------------------------------------
  |             BOUTON "RETOUR"              | 
  ------------------------------------------->

  <div class="btnajout">
    <button onClick=" history.back();">Retour</button>
  </div>

  <!---------------------------
  |          TAB BAR          | 
  ---------------------------->

  <div class="btn-group">
    <a href="#" class="btn btn-primary">Liste des objets impactés</a>
    <a href="#" class="btn btn-primary">Evaluation</a>
    <a href="#" class="btn btn-primary">Recette</a>
    <a href="#" class="btn btn-primary">Mise en production</a>
  </div>
  <main>
    <!------------------------------------------
  |          DETAIL DE LA DEMANDE            | 
  ------------------------------------------->
    <div class="container">
      <section id="menuNouvelDmd">
        <form id="form_nvldemande" name="form_nvldemande" method="GET">
          <fieldset id="menuDmd">
            <div class="form-row">
              <div class="form-group">
                <label for="demCreePar">Domaine :</label>
                <input name="selectDom" id="selectDom" class="inputInfos" disabled pattern="[0-9]" value="">
              </div>

              <div class="form-group">
                <label for="demCreePar">Qualification :</label>
                <input name="selectQualif" id="selectQualif" class="inputInfos" disabled pattern="[0-9]" value="">
              </div>

              <div class="form-group">
                <label for="demCreePar">Priorité :</label>
                <input name="selectPrio" id="selectPrio" class="inputInfos" disabled pattern="[0-9]" value="">
              </div>

              <div class="form-group">
                <label for="numDemande">N° demande :</label>
                <input type="text" name="numDemande" id="numDemande" size="35" disabled pattern="[0-9]" value="">
              </div>
            </div>
          </fieldset>

          <fieldset id="coordo">
            <div class="libelleDemande">
              <label for="demLibelle">Libellé demande :</label>
              <input type="text" name="demLibelle" id="demLibelle" size="35"
                pattern="^[a-zA-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ�?ÀÂÄÃÅÇÉÈÊË�?ÌÎ�?ÑÓÒÔÖÕÚÙÛÜ�?ŸÆŒ\s\-]+$" disabled
                pattern="[0-9]" value="">
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="demCree">Demande créée le :</label>
                <input type="text" name="demCree" id="demCree" requiredc lass="inputInfos" disabled pattern="[0-9]"
                  value="">
              </div>

              <div class="form-group">
                <label for="demCreePar">Par :</label>
                <input name="selectDemandePar" id="selectDemandePar" class="inputInfos" disabled pattern="[0-9]"
                  value="">
              </div>

              <div class="form-group">
                <label for="demEmise">Demande émise le :</label>
                <input type="text" name="demEmise" id="demEmise" class="infosDate" disabled pattern="[0-9]" value="">
              </div>

              <div class="form-group">
                <label for="demEmisePar">Par :</label>
                <input name="selectDemandeEmisePar" id="selectDemandeEmisePar" class="inputInfos" disabled
                  pattern="[0-9]" value="">
              </div>

              <div class="form-group">
                <label for="demRecu">Demande reçue le :</label>
                <input type="text" name="demRecu" id="demRecu" class="infosDate" disabled pattern="[0-9]" value="">
              </div>

              <div class="form-group">
                <label for="beneficiaire">Bénéficiaire :</label>
                <input name="selectBeneficiaire" id="selectBeneficiaire" class="inputInfos" disabled pattern="[0-9]"
                  value="">
              </div>

              <div class="form-group">
                <label for="demCree">Etat de la demande au :</label>
                <input type="text" name="demEtat" id="demEtat" class="infosDate" disabled pattern="[0-9]" value="">
              </div>

              <div class="form-group">
                <label for="etat">Etat :</label>
                <input name="selectDemandeEtat" id="selectDemandeEtat" class="inputInfos" disabled pattern="[0-9]"
                  value="">
              </div>

              <div class="form-group">
                <label for="visaServEtude">Visa service étude au :</label>
                <input type="text" name="visaServEtude" id="visaServEtude" class="infosDate" disabled pattern="[0-9]"
                  value="">
              </div>

              <div class="form-group">
                <label for="signataire">Signataire :</label>
                <input name="selectSignataire" id="selectSignataire" class="inputInfos" disabled pattern="[0-9]"
                  value="">
              </div>

              <div class="form-group">
              </div>

              <div class="form-group">
                <label for="affection">Affectation de la demande :</label>
                <input name="selectAffectation" id="selectAffectation" class="inputInfos" disabled pattern="[0-9]"
                  value="">
              </div>

              <div class="form-group2">
                <label for="demEmise">Fin souhaitée le :</label>
                <input type="text" name="demFs" id="demFs" class="infosDate" disabled pattern="[0-9]" value="">
              </div>

              <div class="form-group2">
                <label for="demEmise">Mise en recette prévue le (optionnel) :</label>
                <input type="text" name="demRct" id="demRct" class="infosDate" disabled pattern="[0-9]" value="">
              </div>

              <div class="form-group">
                <label for="regroupement">Regroupement :</label>
                <input name="selectRegroupement" id="selectRegroupement" class="inputInfos" disabled pattern="[0-9]"
                  value="">
              </div>

              <div class="form-group-Amort">
                <label for="demAmortis">Demande amortissable</label>
                <input type="checkbox" name="demAmortis" id="demAmortis" disabled pattern="[0-9]" value="">
              </div>

              <div class="form-group">
                <label for="demArchiv">Demande archivée le :</label>
                <input type="text" name="demArchiv" id="demArchiv" class="infosDate" disabled pattern="[0-9]" value="">
              </div>
            </div>
          </fieldset>
        </form>
      </section>
    </div>
  </main>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/date.js"></script>

</body>

</html>