<?php 
 session_start();
    require 'inc/db2.php';
    $id=$_GET['session'];
     $req = $pdo->prepare('SELECT nomTheme FROM themes WHERE nomTheme not in (SELECT nomTheme from theme_abonne) ' );
    $req->execute();
    $themes=$req->fetchAll(PDO::FETCH_ASSOC);
  ?>
 <!DOCTYPE html>
  <html lang="fr">
  <head>
    <title>Mon compte Ensemble pour l'Afrique</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/responsive.css">
    <script href="../reserver.js"></script>
  </head>
  <body style="color: black">

    <div class="super_container" style="color: black">
      <header class="header1" style="background-color: white">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">
            <div class="logo"><a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="150" height="150" style="margin-right: 100px"></div>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="#">Profil <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo" modificationIP.php?session=".$_SESSION['id']?>>Modifier mon profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Mon forum</a>
                <form method="post" action="" hidden id="forum">
                  <input name="idForum" value="<?php echo $utilisateur['id_user'] ?>">
                </form>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo "accesDoc.php?session=".$_SESSION['id']?>>Acceder a mes docoments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout">Déconnexion</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
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
          	<?php 
          	$req = $pdo->prepare('SELECT DISTINCT nomTheme FROM themes WHERE nomTheme not in (SELECT DISTINCT nomTheme from theme_abonne) ' );
   			 $req->execute();
    		$themes=$req->fetchAll(PDO::FETCH_ASSOC);
           	echo "<form method='post' action=''>";
			foreach ($themes as $donnees)
			{
				$t=$donnees['nomTheme'];
				echo "<p><input type='checkbox' name='themes[]' value='".$t."'/>".$t."></p>";
			}
				if (isset($_POST["submit"])) {	
					if (!empty($_POST["themes"])) {
						foreach ($_POST["themes"] as $themes) {
						$req=$pdo->prepare("INSERT INTO theme_abonne SET id_user=?,nomTheme=?");
						$req->execute([$id,$themes]);
							
						}
					}	
					else{
						echo "<div class='container'><br><div class='alert alert-danger col-md-12 '>Vous vous etes abonnée a ce theme </div></div>";	
					}
					echo "<script type='text/javascript'>document.location.replace('account.php?session=".$id."');</script>";
				}
			?>
	           	
           	<p><input class="btn btn-primary" type="submit" name="submit" value="submit"></p>
           </form>
         </div>
       </div>
     </div>
   </div>
</div>
</body>
</html>

<?php require 'inc/footer.php';?>


 