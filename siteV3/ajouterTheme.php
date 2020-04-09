<?php 
 session_start();
    require 'inc/db2.php';
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
<div class="container">
	<br>
	<?php echo "<div class='alert alert-success'>
					<br>
	  				<ul>
	  				<li>Merci de choisir parmis ces themes, lesquels vous interessent</li>
	  				<li>Plusieurs choix sont possibles</li>
	  				<li>Choisissez et cliquez sur valider pour enregistrer vos informations</li>
	  				</ul>
	  				<br>
	  				</div>
	  				"; ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">Liste des Themes </div>
          <div class="card-body">
           <form method="post" action="">
           	
           	<p><input type="checkbox" name="themes[]" value="Accueil des étudiants en France"> Accueil des étudiants en France</p>
           	<p><input type="checkbox" name="themes[]" value="Santé et Mutuelle"> Santé et Mutuelle</p>
           	<p><input type="checkbox" name="themes[]" value="Education"> Education</p>
           	<p><input type="checkbox" name="themes[]" value="Action Sociale et solidaire"> Action Sociale et solidaire</p>
           	<p><input class="btn btn-primary" type="submit" name="submit" value="submit"></p>
           </form>
         </div>
       </div>
     </div>
   </div>
</div>
</body>
</html>
<?php 
if (isset($_POST["submit"])) {
	{
		
		if (!empty($_POST["themes"])) {
			// echo "<div class='container'><br><div class='alert alert-warning col-md-12 '>Vous avez selectionné:</div></div> ";	
			foreach ($_POST["themes"] as $themes) {
				$req=$pdo->prepare("INSERT INTO theme_abonne SET id_user=?,nomTheme=?");
				$req->execute([$id,$themes]);
				// echo "<div class='container'><br><p>".$themes."</p></div>";
			}
			//une fois enregistré on redirige vers une page pour finir la connexion 
			header('Location: pageok.php?session='.$id);
				exit();

		}
		else{
			echo "<div class='container'><br><div class='alert alert-danger col-md-12 '>Merci de selectionner au moins un theme</div></div>";
		}
	}
}

 ?>
<?php require 'inc/footer.php';?>


 