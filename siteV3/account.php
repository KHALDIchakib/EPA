<?php 
   require 'inc/db2.php';
   session_start();
   try
   {
    $req = $pdo->prepare('SELECT * FROM adherent where email = :email');
    $req->execute(array(
     ':email' => $_SESSION['email'] 
   ));
    $utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);
    $req = $pdo->prepare('SELECT * FROM adherent where id_user = :id_user ' );
    $req->execute(array(
     ':id_user' => $_SESSION['id']
   ));
    $adherents = $req->fetchAll(PDO::FETCH_ASSOC);
     $req = $pdo->prepare('SELECT * FROM doc_paiement where id_user = :id_user ' );
    $req->execute(array(
     ':id_user' => $_SESSION['id']
   ));
    $documents = $req->fetchAll(PDO::FETCH_ASSOC);

   $req = $pdo->prepare('SELECT * FROM theme_abonne' );
    $req->execute();
    $themes=$req->fetchAll(PDO::FETCH_ASSOC);
    }
  catch(PDOException $e)

  {
    $errMsg = $e->getMessage();
  }
  if(isset($_POST['idAmodifier']))
  {   
    header('Location: modificationIP.php?session='.$_SESSION['id']);
  }
//abonnement aux themes
  if(isset($_POST['idAbonner']))
  {
    $req = $pdo->prepare('SELECT * FROM theme_abonne WHERE id_theme=?' );
    $req->execute([$_POST['idAbonner']]);
    $theme_ab=$req->fetchAll(PDO::FETCH_ASSOC);
   if($theme_ab == TRUE){
      $errors['nomTheme']="Vous etes déja abonné a ce theme ";    
    }
    else{
    $req = $pdo->prepare('INSERT INTO theme_abonne (id_theme,id_user,nomTheme) VALUES (?,?,?)');
    $req->execute([$_POST['idAbonner'],$id,$_POST['nomTheme']]);
    header('Location: account.php?session='.$id.'?'.'abonne=ok');
  }
}

// acces au forum
  if(isset($_POST['idForum']))
  {   
    header('Location:forum.php?session='.$_SESSION['id']);
  }

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
                <a class="nav-link" href="logoutok.php">Déconnexion</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
<?php 
    //on verifie si notre fichier est bien chargé dans notre page
  //var_dump($_FILES);

  //pour avoir acces au nom de mon fichier il suffit d'accedes via $_files
  if (!empty($_FILES)) {
    $files_name= $_FILES['fichier']['name'];
    // $files_type= $_FILES['fichier']['type'];
    $file_extension=strrchr($files_name,".");
    //echo "NOM: ".$files_name.'<br>';
    // echo "Type: ".$files_type;
    $extensions_autorisees=array('.pdf','.PDF');
    $file_tmp_name=$_FILES['fichier']['tmp_name'];
    $file_dest='doc/'.$files_name;

    if (in_array($file_extension, $extensions_autorisees)) {
      //pour envoyer le fichier on utilise la fonction move_upload_file on deplace le fichier du repertoir temporaire (chemin qu'on a visualisé a l'aide de var_dump) et on le mets dans le repertoire destinataire que j'ai crée nomé doc
      if (move_uploaded_file($file_tmp_name, $file_dest)) {
        $req=$pdo->prepare('INSERT INTO doc_paiement(id_user,name,file_url) VALUES(?,?,?)');
        $req->execute([$_SESSION['id'],$files_name,$file_dest]); 
        echo '<div class="alert alert-success" role="alert">
             le chargement a été bien effectué .
              </div>';
            }
    }
    else{
      echo "Seul les fichier PDF sont autorisées";
    }
}
 ?>
    <!-- je personnalise un peut mon message de bienvenue en l'adaptant à chaque utilisateur -->
    <div class="col-lg-8 offset-2 centered">
      <h1 class="text-center" style="color: black">Bonjour <?php echo $_SESSION['name'];?></h1>
      <h3>Vous etes connecté ainsi vous pouvez acceder à toutes vos informations</h3>
    </div>


    <main class="py-4">
      <div class="container">
        <div class="row">
              <?php  if(empty($documents)){?> 
        <div class="col-md-5">
         <div class="card">
          <div class="card-header">Important </div>
          <div class="card-body">
                <div class="alert alert-danger"> merci de renseigner les documents requis relatif a votre paiement
                <p>Merci de joindre votre RIB / mondat cheque</p>
                  <form method="POST" enctype="multipart/form-data">
                  <input type="file" name="fichier"/>
                  <input type="submit" name=" envoyer le fichier">
                </form>
              </div>
         </div>
       </div>
     </div>
   <?php };?>
          <div class="col-md-7">
            <div class="card">
             <?php
             if(isset($_GET['modif']) && $_GET['modif'] == 'ok')
             {
              echo '<div class="alert alert-success" role="alert">
              votre modificationvous a été bien effectué .
              </div>';
            }
            ?>          
            <div class="card-header">Informations personnelles</div>
            <div class="card-body">

              <table class="table table-responsive table-hover">
                <thead>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>numéro Tél</th>
                  <th>Email</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php foreach ($utilisateurs as $utilisateur){ ?>
                    <tr>
                      <td><?php echo $utilisateur['id_user'] ?></td>
                      <td><p><?php echo $utilisateur['nom'] ?></p></td>
                      <td><?php echo $utilisateur['prenom'] ?></td>
                      <td><?php echo $utilisateur['numtel'] ?></td>
                      <td><?php echo $utilisateur['email'] ?></td>
                      <td>
                        <button class="btn btn-sm btn-success" form="modificationIP" >
                          <i class="fa fa-edit"></i> modifier
                        </button>
                        <form method="post" action="" hidden id="modificationIP">
                          <input name="idAmodifier" value="<?php echo $utilisateur['id_user'] ?>">
                        </form>
                      </td>
                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
   </div>
   <br>
   <div class="row">
     <div class="col-md-6">
       <div class="card">
        <div class="card-header">
          <p class="text-center">Liste des abonnement aux themes </p>
        </div>
        <div class="card-body">
   
         <p></p>
         <table class="table table-responsive table-hover">
          <thead>
            <th>Themes</th>
            <th></th>
          </thead>
          <tbody>
           <?php foreach ($themes as $theme){ ?>
            <tr>
              <td> 
                <?php echo $theme['nomTheme'] ?>
                <form method="post" action="" hidden id="abonnementIP">
                <input name="nomTheme" value="<?php echo $theme['nomTheme'] ?>">
                </form></td>
              <td></td>
            </tr>
           <?php }; ?>
          </tbody>
         </table>
         <div class="card-footer text-center">
            <button class="btn btn-warning"><a style="color: white" href=<?php echo "ajoutetheme_mbr.php?session=".$_SESSION['id']?>>Ajouter un theme</a></button>
         </div>
       </div>
     </div>
   </div>
   <div class="col-md-6">
     <div class="card">
      <div class="card-header">Membres Disponnible</div>
      <div class="card-body">
         <table class="table table-responsive table-hover">
          <thead>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Numéro de téléphone</th>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
         </table>
      </div>
    </div>
  </div>
</div>
</main>
<main class="py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">Dernières activités de l'association</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <img src="images/im8.jpg">
              </div>
              <div class="col-md-6">
                <img src="images/im9.jpg">
              </div>
            </div>
         </div>
         <div class="card-footer">
          <p class="text-center">Activité culturelles</p>
          </div>
       </div>
     </div>
     <div class="col-md-6">
      <div class="card">
        <div class="card-header">Newsletter</div>
        <div class="card-body">
         <table class="table table-responsive table-hover">
           <!-- voir ce qu'on peut afficher d'autre  -->
         </table>
       </div>
     </div>
   </div>


 </div>

</main> 


</body>
</html>

<?php require 'inc/footer.php';?>