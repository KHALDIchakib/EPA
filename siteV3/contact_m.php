<?php 
session_start();
require 'inc/db2.php';
$id=$_GET['session'];
$id_membre=$_GET['membre'];
try
{
	$req = $pdo->prepare('SELECT * FROM membrebureau where id_membre!=?');
	$req->execute([$id]);
	$membres = $req->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	$errMsg = $e->getMessage();
}
if(isset($_POST['submit'])){ 

	$objet=$_POST['objet'];
	$message=$_POST['th'];
	if(!empty($_POST) ){
	    $req=$pdo->prepare('INSERT INTO messagemembre(id_membre,objet,message) VALUES(?,?,?)');
	            $req->execute([$id_membre,$objet,$message]);               
	            header('Location: contact_m.php?session='.$id.'&membre='.$id_membre.'?&env=ok');
	        }
}
//diffuser a tous les membres
if(isset($_POST['diffuser'])){ 

	$objet=$_POST['objet'];
	$message=$_POST['th'];
	if(!empty($_POST) ){
		foreach ($membres as $membre) {
	   	 $req=$pdo->prepare('INSERT INTO messagemembre(id_membre,objet,message) VALUES(?,?,?)');
	            $req->execute([$membre['id_membre'],$objet,$message]);               
	           
	        }
	        header('Location:contact_m.php?session='.$id.'&membre='.$id_membre.'&diff=ok');
	    }
}
     ?>
<?php require 'header.php' ?>

<main >
	<div class="container">
	<div class="row">
     <div class="col-md-7">
       <div class="card">
       	<?php
             if(isset($_GET['diff']) && $_GET['diff'] == 'ok')
             {
              echo '<div class="alert alert-success" role="alert">
              votre message a bien été diffusé .
              </div>';
            }?>
            <?php
             if(isset($_GET['env']) && $_GET['env'] == 'ok')
             {
              echo '<div class="alert alert-warning" role="alert">
              votre message a été envoyé au membre.
              </div>';
            }?>
        <div class="card-header">Envoyer un message au membre selectionné:</div>
        <div class="card-body">
        	 <form action="" method="POST">
         <table class="table table-responsive table-hover">
           <thead>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
                    <tr>
                    	<td>L'objet:</td>
                      <td>
                      	<div class="form-group">
                            <input type="text" name="objet" class="form-control" placeholder="Entrez l'objet" />
                        </div></td>
                    </tr>
                    <tr>
                    	<td>Message</td>
                    	<td>
                      	<div class="form-group">
		              		<textarea name="th" class="form-control" rows="5" cols="33">Cordialement, La Présidente - EPA
		              		</textarea>
		              		<br>
                		</div>
                      </td>
                    </tr>
              </tbody>
         </table>
         <button type="submit" name="submit" class="btn btn-primary"> Envoyer le message</button>
     	  <button name="diffuser" class="btn btn-success">Diffuser a tous les membres</button>
     </form>
       </div>
     </div>
   </div>
    <div class="col-md-5">
       <div class="card">
        <div class="card-header">Liste des membres du bureau</div>
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
                  <?php foreach ($membres as $membre){ ?>
                    <tr>
                      <td><?php echo $membre['id_membre'] ?></td>
                      <td><p><?php echo $membre['nomM'] ?></p></td>
                      <td><?php echo $membre['prenomM'] ?></td>
                      <td><?php echo $membre['phone'] ?></td>
                      <td><?php echo $membre['email'] ?></td>
                    </tr>
                  <?php }; ?>
              </tbody>
         </table>
       </div>
     </div>
   </div>
</div>
</div>
</main>
<?php require 'inc/footer.php' ?>