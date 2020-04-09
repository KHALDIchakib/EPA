<?php 
session_start();
require 'inc/db2.php';
$id=$_GET['session'];
$id_reunion=$_GET['reunion'];
try
{
	$req = $pdo->prepare('SELECT id_reunion,lieu,dat,objet FROM reunion');
	$req->execute();
	$reunions = $req->fetchAll(PDO::FETCH_ASSOC);
	$req1=$pdo->prepare('SELECT id_reunion,name,file_url FROM doc_reunion');
	$req1->execute();
	$docs= $req1->fetchAll(PDO::FETCH_ASSOC);
        // header('Content-type: application/pdf');

	/* Tu affiches le contenu du champ */
}
catch(PDOException $e)
{
	$errMsg = $e->getMessage();
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
            $req=$pdo->prepare('INSERT INTO doc_reunion(id_reunion,name,file_url) VALUES(?,?,?)');
            $req->execute([$id_reunion,$files_name,$file_dest]); 
            echo '<div class="alert alert-success" role="alert">
                 le chargement a été bien effectué .
                  </div>';
                }
			header('Location:reunion_doc.php?session='.$id.'&reunion='.$id_reunion);     
		   }
        else{
          echo "Seul les fichier PDF sont autorisées";
        }
}
     ?>
<?php 
if(isset($_POST['docASupprimer']))
{
    $req = $pdo->prepare('delete from doc_reunion where id_doc = :docASupprimer');
    $req->execute(array(
        ':docASupprimer' => $_POST['docASupprimer']
    ));
    header('Location: reunion_doc.php?session='.$id.'&reunion='.$id_reunion);
}
?>
<?php require 'header.php' ?>
<main class="py-4">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">Mes reunions </div>
					<div class="card-body">

						<table class="table table-responsive table-hover">
							<thead>
								<th>N°</th>
								<th></th>
								<th>Lieu</th>
								<th></th>
								<th>date</th>
								<th>Objet</th>
							</thead>
							<tbody>
								<?php foreach ($reunions as $reunion){ ?>
									<tr>
										<td><?php echo $reunion['id_reunion']; ?></td>
										<td></td>
										<td><?php echo $reunion['lieu']; ?></td>
										<td></td>
										<td><?php echo $reunion['dat']; ?></td>
										<td><?php echo $reunion['objet']; ?></td>
									</tr>
								<?php }; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
				<div class="col-md-5">
					<div class="card">
						<div class="card-header">Documents </div>
						<div class="card-body">
							<table class="table table-responsive table-hover">
							<thead>
								<th>N°Reunion</th>
								<th>nom</th>
								<th>consulter</th>
							</thead>
							<tbody>
								<?php foreach ($docs as $doc){ ?>
									<tr>
										<td><?php echo $doc['id_reunion']; ?></td>
										<td><?php echo $doc['name']; ?></td>
										<td><button class="btn btn-success"><a target="_blanck" style="color: white" href="<?php echo $doc['file_url']?>"><i class="fa fa-eye"></i>cliquez
                                        </a></button>
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
                            <div class="card-header">Ajouter des convocation</div>
                            <div class="card-body">
                             mes fichier a ajouter 
                                <p>Merci d'ajouter vos fichiers PDF</p>
                                <br>
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

<?php require 'inc/footer.php' ?>