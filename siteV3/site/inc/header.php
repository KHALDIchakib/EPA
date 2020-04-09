<?php
if(session_status() == PHP_SESSION_NONE){
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   
    
    <title>Espace Membre</title>

    <!-- Bootstrap  CSS -->
    <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styleM.css">
   
    <script>
    $(document).ready(function(){
      $("button").click(function(){
        $("p").toggle();
      });
    });
    </script>
  </head>

  <body>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Espace memebre</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="./img/beW.png"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if(isset($_SESSION['auth'])): ?>
              <li id="idlist"><a href="logout.php">Se déconnecter</a></li>
              <?php endif; ?>
            <?php if (!isset($_SESSION['auth'])): ?>
              <li  id="idlist"><a href="register.php">S'inscrire</a></li>
              <li id="idlist"><a href="login.php">Se connecter</a></li>
            <?php endif; ?>
           </ul>
        </div>
      </div>
    </nav>

    <div class="container">
    <?php if(isset($_SESSION['flash'])): ?>
      <?php foreach ($_SESSION['flash'] as $type=>$message) : ?>
        <div class="alert alert-<?=$type;?>">
          <?= $message;?>
        </div>
      <?php endforeach; ?>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>