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
    <header class="header1" style="background-color: white">
        <div class="header_content d-flex flex-column align-items-center justify-content-lg-end justify-content-center">
            
            <!-- Logo -->
            <div class="logo"><a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="200" height="200"></div>

            <!-- Main Nav -->
            <nav class="main_nav">
                <ul class="d-flex flex-row align-items-center justify-content-start">
                    <li><button class="btn btn-warning  "> <a href="logout.php">Déconnexion</a></button></li>
                     <li> <button class="btn btn-danger" form="forum" ><i class="fa fa-edit"></i> Accéder au forum</button>
   <form method="post" action="" hidden id="forum">
      <input name="idForum" value="<?php echo $utilisateur['id_user'] ?>">
   </form></li>

                </ul>
            </nav>
        </div>  
    </header>
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
    }
    catch(PDOException $e)
    {
        $errMsg = $e->getMessage();
	}
?>