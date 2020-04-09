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
<body style="background-image: url(images/im1.jpg)">
	<?php  echo "<br><div class='container text-center'><div class='alert alert-success col-md-12'>
	  				<ul>
	  				<li>Vos informations sont enregistré </li>
	  				<li>Pour finaliser votre Adhésion des documents vous seront demandées</li>
	  				<li>Vous ne pourrez profiter des avantages et services de la platforme que si toutes vos informations sont correctement renseigné</li>
	  				</ul>
	  				<br>
	  				<button class='btn btn-danger'><a href='login.php' style='color:white'>Se connecter</a></button>
	  				<button class='btn btn-primary'><a href='index.html' style='color:white'>Accueil</a></button>
	  				</div></div>
	  				";
 	?>
 </body>
 </html>
 <?php require 'inc/footer.php';?>