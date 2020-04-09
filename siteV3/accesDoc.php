<?php
    session_start();
    require 'inc/db2.php';
    $id=$_GET['session'];

    try
    {
        $req = $pdo->prepare('SELECT * FROM adherent where id_user = :id_user');
        $req->execute(array(
            ':id_user' => $id 
        ));
        $utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);
        $req1=$pdo->prepare('SELECT * FROM docPDF where id_user=:id_user');
         $req1->execute(array(
            ':id_user' => $id 
        ));
        $fichiers= $req1->fetchAll(PDO::FETCH_ASSOC);
        // header('Content-type: application/pdf');

        /* Tu affiches le contenu du champ */
        
    }
    catch(PDOException $e)
    {
        $errMsg = $e->getMessage();
    }
if(isset($_POST['docASupprimer']))
{
    $req = $pdo->prepare('delete from docpdf where idFile = :docASupprimer');
    $req->execute(array(
        ':docASupprimer' => $_POST['docASupprimer']
    ));
   
    
    header('Location: accesDoc.php?session='.$id.'?'.'annuler=ok');
}
?>

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
            $req=$pdo->prepare('INSERT INTO docpdf(id_user,name,file_url) VALUES(?,?,?)');
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
        <script href="../reserver.js"></script>
    </head>
    <body>

        <div class="super_container" style="color: black">
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
         <main class="py-4" style="color: black">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Documents annexes</div>
                            <div class="card-body">
                               <table class="table table-responsive table-hover">
                                  <thead>
                                    <th>Numéro du fichier</th>
                                    <th>Decription</th>
                                    <th>Visualiser</th>
                                  </thead>
                                    <tbody>
                                    <?php foreach ($fichiers as $fichier){ ?> 
                                    <tr>
                                        <td><?php echo $fichier['idFile'] ;?></td> 
                                        <td><?php echo $fichier['name'] ;?></td>
                                        <td><button class="btn btn-success"><a target="_blanck" style="color: white" href=<?php echo $fichier['file_url']?>><i class="fa fa-eye"></i>cliquez
                                        </a></button>
                                        </td>
                                        <td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" form="suppression" onclick="return confirm('Voulez vous vraiment supprimer ce document ?');">
                                                    <i class="fa fa-trash"></i> annuler
                                                </button>
                                                <form method="post" action="" hidden id="suppression">
                                                    <input name="docASupprimer" value="<?php echo $fichier['idFile'] ?>">
                                                </form>
                                            </td>
                                    <?php }; ?>
                                    </tr>
                                  </tbody>    
                              </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Ajouter des documents</div>
                            <div class="card-body">
                            <!-- mes fichier a ajouter -->
                                <p>Merci d'ajouter vos fichiers PDF</p>
                               <form method="POST" enctype="multipart/form-data">
                                  <input type="file" name="fichier"/>
                                  <br><br>
                                  <input type="submit" value =" Enregistrer le fichier"  class="btn btn-primary">
                               </form>
                            </div>
                        </div>
                    </div>
                   </div>
               </div>
           </main>
       </div>
    </div>
    </body>
    </html>
