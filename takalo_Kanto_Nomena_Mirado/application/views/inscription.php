<!DOCTYPE html>
<!-- Designined by CodingLab - youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Dentiste </title>
    <link rel="stylesheet" href="<?php echo site_url("assets/css/inscription.css"); ?>">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Inscription</div>
    <div class="content">
    <form action="inscription" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Nom</span>
            <input type="text" name="nom" placeholder="Entrer votre nom" required>
          </div>
          <div class="input-box">
            <span class="details">Prenom</span>
            <input type="text" name="prenom" placeholder="Entrer votre prenom" required>
          </div>
          <div class="input-box">
            <span class="details">Date de Naissance</span>
            <input type="date" name="nee" required>
          </div>
          <div class="input-box">
            <span class="details">Mail</span>
            <input type="mail" name="mail" required>
          </div>
          <div class="input-box">
            <span class="details">Mots de passe</span>
            <input type="password" name="pwd" placeholder="Entrer votre mots de passe" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Inscrire">
        </div>
      </form>
    </div>
  </div>

</body>
</html>
