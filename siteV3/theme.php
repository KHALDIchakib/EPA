<?php 
session_start();
require 'inc/db2.php';
$id=$_GET['session'];
try
{
	$req = $pdo->prepare('SELECT * FROM themes' );
    $req->execute();
    $themes=$req->fetchAll(PDO::FETCH_ASSOC);
    
}
catch(PDOException $e)
{
	$errMsg = $e->getMessage();
}
//ajouter un nouveau theme

if(isset($_POST['submit']))
{
    $req = $pdo->prepare('INSERT INTO themes (nomTheme) VALUES (?)');
    $req->execute([$_POST['th']]);
    header('Location: theme.php?session='.$id);
}
?>
 <?php require 'header.php' ?>
 <main>
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
       </div>
     </div>
 </div>
     <div class="col-md-6">
       <div class="card">
        <div class="card-header">
          <p class="text-center">ajouter un theme</p>
        </div>
        <div class="card-body">
   
         <p></p>
         <table class="table table-responsive table-hover">
          <thead>
            <th>Themes</th>
            <th></th>
          </thead>
          <tbody>
            <tr>
              	<td>Nouveau Theme</td> 
             	<td>
              	<form method="post" action="" class="form-control text-center">
              		<input type="text" name="th" class="form-control">
              		<br>
                	<input type="submit" name="submit" class="btn-lg btn-primary" >
                </form>
              </td>
            </tr>
          </tbody>
         </table>
         <div class="card-footer text-center">
         </div>
       </div>
     </div>
   </div>
   </div>


 </main>
 <?php require 'inc/footer.php' ?>