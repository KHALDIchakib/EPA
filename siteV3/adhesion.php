<?php 
	require_once 'inc/db.php';
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Ensemble pour l'Afrique</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
<body>
<?php 
/*on va d'abord vérifier est et ce que des données ont été postés*/
if(!empty($_POST)){
	/*phase de traitement*/
	$errors=array();
	
	if(empty($_POST['nom']) and empty($_POST['prenom'])  || !preg_match('/^[a-zA-Z0-9_]+$/',$_POST['nom'])){
		$errors['nom']="Le nom entré n'est pas valide (alphanumerique)";
	 }
	 /*MAINTENANT ON VALIDE L EMAIL POUR CELA ON FAIT UN TEST AVEC UNE FONCTION PHP FILTER_VAR QUI RENVERRA TRUE SI C4EST VALIDE ET FALSE SINON*/
	if(empty($_POST['password']) || ($_POST['password'] != $_POST['password_confirm'])){
		$errors['password']=" le mot de passe n'est pas valide";
	}
	if (empty($errors)){
		$nom=htmlspecialchars($_POST['nom']);
		$prenom=htmlspecialchars($_POST['prenom']);
		$dnaissance=htmlspecialchars($_POST['dnaissance']);
		$email=htmlspecialchars($_POST['email']);
		$tel=htmlspecialchars($_POST['tel']);
		$cpaiement=htmlspecialchars($_POST['paiement']);	
		$sexe=htmlspecialchars($_POST['sexe']);		
		$payso=htmlspecialchars($_POST['payso']);					
		$password=md5($_POST['password']);

		$stmt = $pdo->prepare('SELECT id_user, nom, prenom, date_naissance, email, password,choix_paiement FROM adherent WHERE email = :email');
		$stmt->execute(array(
			':email' => $email
		));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		if($data == TRUE){
			$errors['email']="L'email est déja utilisé ";
			
		}
		// je veux tester si la date saisie est bien valide ou pas dans ce cas j'effectue ce test
		else{
			$datefor="2020-01-01";
			$datesaisie=$_POST['dnaissance'];
			$stdatefor=strtotime($datefor);
			$stdatesaisie=strtotime($datesaisie);
			$nbj=$stdatefor-$stdatesaisie;
			if( $nbj=== 0)
			{
				$errors['dnaissance']="erreur de saisie de votre date de naissance";
			}
			else{
	     		
			/*j'utilise des requetes préparé ici si tout se passe bien et que l'utilisateur rentre des données accepté j'insert ses informations dans ma base de données*/
			$req=$pdo->prepare("INSERT INTO adherent SET nom=?,prenom=?,date_naissance=?,sexe=?,pays_origine=?, password=?, numtel=?, email=?,choix_paiement=?, dateInscription=CURRENT_DATE, valide=FALSE");
			/*on va eviter de stocker le mot de passe en claire dans la base de données on va donc hacher le mot de passe pour que le compte soit plus sécurisé on va utiliser les fonctions de hashage disponible sur php password_hash ou crypt on va utiliser le mode BCRYPT car en lisant la doc le mode par defaut change dans le temps et ce n'est pas ce qu'on veut*/
			$req->execute([$nom,$prenom,$dnaissance,$sexe,$payso,$password,$tel,$email,$cpaiement]);
		}
		/*une fois que tout est bon on va rediriger l'utilisateur vers la page d'accueil il ne sera pas 
		possible de se connecter jusqu'à validation du compte par le service*/
		 if (isset($_POST['submit'])){
	      if ($_POST['dnaissance']=="2018-07-22") {
	        $errors['dnaissance']="<div class='alert alert-warning'>
	  <p>Erreur lors de la saisie de la Période </p></div>";
    }}
		$req=$pdo->prepare("SELECT MAX(id_user) as maxy FROM adherent");
          $resp=$req->execute();
          if($resp!== FALSE)
          {
            while ($data = $req->fetch()) 
            {
			  $id_user=$data['maxy'];
			   header('Location: ajoutetheme_mbr.php?session='.$id_user);
            }
          }
        /*et on met la fin de notre script*/
		exit();
		}
	}

	/*je vais créer une fonction afin de debeguer les erreurs*/
	
}
?>
<div class="super_container">
	
	    <header class="header1" style="background-color: white">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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

	<div class="container w" style="background-color: white; color: black; margin-top: 100px">
    <div class="row centered">
		      <br><br>
		<div class="col-lg-8  monform">
		<form action="" method="POST">
				<p style="color: red">Les champs marqués d'un astérisque (*) doivent etre renseigné</p>
				<?php if ( !empty($errors) AND $_POST): ?>
							<div class="alert alert-warning">
								<p>Le formulaire n'a pas été rempli correctement</p>
								<ul>
									<?php foreach ($errors as $error): ?>
										<li><?= $error; ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
							<?php endif; ?>
				<br>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for=""> Sexe </label>
						<!--ici required indique que le champ est obligatoire -->
						<select name="sexe" class="form-control">
							<option value="">--</option>
							<option value="F">Féminin</option>
							<option value="M">Masculin</option>
						</select>
					</div>	
					<div class="form-group col-md-4">
						<label for="">NOM  </label>
						<!--ici required indique que le champ est obligatoire -->
						<input type="text" name="nom" placeholder="entrez votre Nom" class="form-control" />
					</div>
					<div class="form-group 4">
						<label for="">PRENOM </label>
						<!--ici required indique que le champ est obligatoire -->
						<input type="text" name="prenom" placeholder="entrez votre Prénom" class="form-control"/>
					</div>		
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="">Date de naissance  </label>
					<!--ici required indique que le champ est obligatoire -->
					<input type="date" name="dnaissance" value="2020-01-01"class="form-control" />
				</div>
				<div class="form-group col-md-6">
					<label for="">Pays d'origine  </label>
					<!--ici required indique que le champ est obligatoire -->
					<input type="text" name="payso" placeholder="entrez votre pays d'origine" class="form-control" required="" />
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="">Email * </label>
					<input type="text" name="email" class="form-control" placeholder="entrez une adresse mail valide" required="" />
				</div>
				<div class="form-group col-md-6">
					<label for="">Téléphone * </label>
					<input type="text" name="tel" placeholder="entrez votre numero de telephone" class="form-control" /> <h5>numéro de téléphone mobile</h5>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="">Mot de passe *</label>
					<input type="password" name="password" placeholder="saisissez un mot de passe" class="form-control" required="" />
				</div>
				<div class="form-group col-md-6">
					<label for="">Confirmation du Mot de passe *</label>
					<input type="password" name="password_confirm" placeholder="" class="form-control" required="" />
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="">Choix de paiement * </label>
							<!--ici required indique que le champ est obligatoire -->
							<select name="paiement" class="form-control">
								<option value="" disabled selected>Choisissez votre mode de paiement</option>
								<option value="cheque">Chèque</option>
								<option value="prelevement">Prélèvement</option>
							</select>
				</div>
			</div>
			<button type="submit" class="btn btn-danger"> Renseigner</button>
			<button type="reset" class="btn btn-success"> Effacer</button>
			<button class="btn btn-warning	"><a class="btn-warning" href="index.html">Annuler</a></button>
		</form><br>
		</div>
		<div class="col-lg-4 ">
			<div class="alert alert-success">
				<h3>Important </h3>
				<br><br>
				<div>
					Merci de renseigner toutes les informations demandées afin que nous puissions valider votre inscription
				</div>
				<br>
				<ul style="list-style: square;">
					<br>
						<li> Renseigner vos Information personnelles</li>
						<br>
						<li> Contactez nous pour valider si vous rencontrez des difficulté d'inscription dans la rubrique <a href="contact.html">"Contact"</a></li><br>
						<li> Consultez et modifiez vos information si besoin </li><br>
						<li> Le désabonnement se fait par les directives mise en <a href="annex.html">"Annexe"</a></li>
					</ul>
					<br>
					<p class="text-center">Merci <i class="fa fa-heart"></i></p>
				</div>
		</div>
	</div>
</div>

<?php require 'inc/footer.php'; ?>