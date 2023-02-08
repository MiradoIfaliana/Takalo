<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Login Form | CodingLab </title>--->
    <link rel="stylesheet" href="<?php echo site_url("assets/css/styl.css"); ?>">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="container">
      <form action="controlle1/login" method="POST">
        <div class="title">Login</div>
        <div class="input-box underline">
          <input type="text" name="mail" placeholder="Entrer votre Email" required>
          <div class="underline"></div>
        </div>
        <div class="input-box">
          <input type="password" name="pwd" placeholder="Mots de passe" required>
          <div class="underline"></div>
        </div>
        <div class="input-box button">
          <input type="submit" name="" value="Se connecter">
        </div>
      </form>
        <div class="option">
          <a href="controlle1/toinscrire">S'inscrire</a> 
        </div>
    </div>
  </body>
</html>

