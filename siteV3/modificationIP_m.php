<?php
session_start();
require 'inc/db2.php';
$id=$_GET['session'];

try
{
    $req = $pdo->prepare('SELECT * FROM membrebureau where id_membre = :id_membre');
    $req->execute(array(
        ':id_membre' => $id 
    ));
    $utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);


}
catch(PDOException $e)
{
    $errMsg = $e->getMessage();
}


if(isset($_POST['submit'])){

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    if(!empty($nom)){
        $req=$pdo->prepare('UPDATE membrebureau SET nomM=:nom where id_membre = :id_membre')->execute(array(     
            ':nom' => $nom,
            ':id_membre' => $id
        ));
        header('Location: presidente.php?session='.$id.'modif=ok');
    }
    else {
        if(!empty($prenom)){
            $req=$pdo->prepare('UPDATE membrebureau SET prenomM=:prenom where id_membre = :id_membre')->execute(array(     
                ':prenom' => $prenom,
                ':id_user' => $id));  
            header('Location: presidente.php?session='.$id.'modif=ok');

        }
        else{
            if(!empty($tel)){
                $req=$pdo->prepare('UPDATE membrebureau SET phone=:numtel where id_membre = :id_membre')->execute(array(     
                    ':numtel' => $tel,
                    ':id_membre' => $id));

                header('Location: presidente.php?session='.$id.'modif=ok');
                }
                else{
                    header('Location: modificationIP_m.php?session='.$_SESSION['id'].'&modif=notok');
                }
            }
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
                <div class="logo"><a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="50" height="50"></div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item active">
                        <a class="nav-link" href="account.php">Profil </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?php echo" modificationIP_m.php?session=".$_SESSION['id']?>>Modifier mon profil<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mon forum</a>
                        <form method="post" action="" hidden id="forum">
                          <input name="idForum" value="<?php echo $utilisateur['id_user'] ?>">
                      </form>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Acceder a mes docoments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
</header>  


<main class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if(isset($_GET['modif']) && $_GET['modif'] == 'notok')
                    {
                        echo '<div class="alert alert-danger" role="alert">
                        vous avez rien saisie .
                        </div>';
                    }
                    if(isset($_GET['email']) && $_GET['email'] == 'notok')
                    {
                        echo '<div class="alert alert-danger" role="alert">
                        l\'adresse mail est déja utilisé.
                        </div>';
                    }    

                    ?> 
                    <div class="card-header">Informations personnelles</div>
                    <div class="card-body">
                        <?php foreach ($utilisateurs as $utilisateur){ ?>
                            <form action="" method="POST">
                                <table class="table table-responsive table-hover">
                                    <thead>
                                        <th>ID</th>
                                        <th><?php echo $utilisateur['id_membre'] ?></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nom</td>
                                            <td><?php echo $utilisateur['nomM'] ?></td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="nom" class="form-control" placeholder="nouveau nom" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prénom</td>
                                            <td><?php echo $utilisateur['prenomM'] ?></td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="prenom" class="form-control" placeholder="nouveau prenom" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>numéro Tél</td>                                 
                                            <td><?php echo $utilisateur['phone'] ?></td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="tel" class="form-control" placeholder="nouveau num tel" />
                                                </div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>

                                <button type="submit" name="submit" class="btn btn-success"> OK</button>&emsp;&emsp;&emsp;&emsp;
                                <button type="reset" class="btn btn-warning"> Effacer</button>&emsp;&emsp;&emsp;&emsp;
                                <a class="btn btn-danger" href="account.php" >Annuler</a>
                            </form>
                        <?php }; ?>
                        <br>
                        <p> ** Pour retourner a votre profile cliquez sur Annuler</p>

                    </div>
                </div>
            </div>
        </div>
    </main>



</body>
</html>

<?php require 'inc/footer.php';?>