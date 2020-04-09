<?php 
session_start();
$id=$_GET['session'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ensemble pour l'Afrique</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/responsive.css">
    <script href="../reserver.js"></script></head>
<body>
	 <header class="header1" style="background-color: white">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
          <a class="navbar-brand" href="#">
            <div class="logo"><a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="150" height="150" style="margin-right: 100px"></a></div>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
       			<li class="nav-item">
			  	<div class="header_link" style="background-color:#229954; margin-right: 5px"><a href="index.html"> Accueil</a></div>
			 	</li>
			 	<li class="nav-item">
			  	<div class="header_link" style="background-color:#229954; margin-right: 5px"><a href="about.html">EPA?</a></div>
			 	</li>
			 	<li class="nav-item">
			  	<div class="header_link" style="background-color:#229954; margin-right: 5px"><a href="projets.html">Projets</a></div>
			 	</li>
			 	<li class="nav-item">
			  	<div class="header_link" style="background-color:#229954; margin-right: 5px"><a href="contact.html"> Contacte</a></div>
			 	</li>
              	<li class="nav-item">
			  	<div class="header_link" style="background-color:#229954; margin-right: 5px"><a href="login.php"> Adhérent</a></div>
			 	</li>
              	<li class="nav-item">
					<div class="header_link" style="background-color:#DF3A01; margin-right: 5px "><a href="login_admin.php">Membre</a></div>
				</li>
              	<li class="nav-item">
					<div class="header_link"><a href="adhesion.php" style="margin-right: 5px">Adhésion</a></div>
				</li>
				<li class="nav-item">
					<div class="header_link" style="background-color:red; margin-left:5px "><a href="forum.php">Forum</a></div>
				</li>
            </ul>
        </div>
    </div>
	</nav>
</header>
	<br>
	<div class='container text-center'>
		<div><br><br><br></div>
		<div class='alert alert-success col-md-12'>
	  		<ul>
	  			<li>Vous etes déconnecté </li>
	  			<li>pour retourner à la page d'Accueil </li>
	  		</ul>
	  				<br>
	  		<button class='btn btn-primary'><a href='index.html' style='color:white'>Accueil</a></button>
	  				</div></div>
 </body>
 </html>
 <?php require 'inc/footer.php';?>