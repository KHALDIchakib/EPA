 <?php 
    
    require_once 'inc/db2.php';
/*on va verifier si des données ont été posté*/
if(isset($_POST['acceder'])){
   
  $email = $_POST['email'];
  $password = $_POST['password'];
  try{
            $stmt = $pdo->prepare('SELECT id_membre, nomM, email, password FROM membrebureau WHERE email = :email');
            $stmt->execute(array(
                ':email' => $email
            ));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if($data == false)
            {
              $errors['email']="<div class='alert alert-warning'>
              <p>E-mail ou mot de passe erroné </p></div>"; 

            }
            else
            {
                if($password == $data['password'])
                {
                  echo "nooooooooooooooooooooooooooooo";
                    session_start();
                    $_SESSION['name'] = $data['nomM'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['id'] = $data['id_membre'];                   
                    // acces de la présiente à son espace
                    if($email =="presidente@epa.fr" and $password == "epa" ){
                      header('Location: presidente.php?session='.$_SESSION['id']);
                      exit;
                    }
                      // acces de la compta à son espace
                    if($email =="compta@epa.fr" and $password == "goungoungahelene" ){
                        header('Location: compta.php?session='.$_SESSION['id']);
                        exit;
                    }
                      // acces de la secrétaire à son espace
                    if($email =="secretaire@epa.fr" and $password == "chanlouisette" ){
                      header('Location: secretaire.php?session='.$_SESSION['id']);
                      exit;
                     }
                     //acces membre d'accueil
                    if($email =="accueil_etudiant@epa.fr" and $password == "atanganasymphorien" ){
                      header('Location: accueiletudiant.php?session='.$_SESSION['id']);
                      exit;
                     }
                }
                else
                {
                  $errors['password']="<div class='alert alert-warning'>
                  <p>E-mail ou mot de passe erroné  iciiii</p></div>";            
                    }
            }
        }
        catch(PDOException $e)
        {
            $errMsg = $e->getMessage();
        }


  }
    
 ?> 
<!DOCTYPE html>
<html>
<head>
    <title>Compte membre</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="EPA">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->

    <!-- Custom styles -->
    <link href="login.css" rel="stylesheet">
  </head>
  <body class="text-center">

    <form class="form-reserv" action="" method="POST">
     <br>
      <p> <?php echo "<div class='alert alert-success' role='alert'>
                Vous allez vous connecter à l'espace Membre
                  </div>"; ?> </p>
      <img class="mb-4" src="images/logo.jpg" alt="" width="200" height="200">
      <input type="email" name="email" class="form-control" placeholder="Votre email" required autofocus>
      <br>
      <input type="password" name="password" class="form-control" placeholder="Votre mot de passe" required autofocus>
      <br>     
      <input type="submit" name="acceder" class="btn btn-lg btn-danger btn-block" value="Accéder"> <br> 
       <a href="index.html" class="btn btn-success btn-lg btn-block"> retour à l'accueil</a>    
        <?php if (!empty($errors) AND $_POST): ?>
            <div class="alert alert-warning">
              <p>Le formulaire n'a pas été rempli correctement</p>
              <ul>
                <?php foreach ($errors as $error): ?>
                  <li><?= $error; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?> 
      <p class="mt-5 mb-3 text-muted">&copy; 2020 by Web Factory <i class="fa fa-heart-o" aria-hidden="true"></i></p>
     
    </form>
  </body>
</html> 