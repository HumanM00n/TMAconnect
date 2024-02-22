<!DOCTYPE html>

<html>

<head>
  <title>TC3</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link href="css/csshome.css" rel="stylesheet" type="text/css" />
  <link href="css/test3.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="img/NLogo2.png" />
</head>

<body>
  <?php include('includes/connexion.inc.php') ?>

  <?php

  // // Requ�tes SQL pour le filtre de recherche des demandes 
  // $sql0 = "SELECT IdDomaine , libelle FROM tc_domaine";
  // $stmt0 = $pdo->query($sql0);
  // $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);
  
  // // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_etat
  // $sql1 = "SELECT IdEtat , libelle FROM tc_etat";
  // $stmt1 = $pdo->query($sql1);
  // $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
  
  ?>
  <main>

    <section id="modif">
      <img src="img/NLogo2.png" alt="">
      <form class="formmodif" name="formmodif" action="" method="POST">
        <fieldset class="infos">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>

        </fieldset>
      </form>
    </section>

  </main>

  <!-- LINK JS BOOTSTRAP -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>