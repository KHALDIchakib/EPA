<?php
session_start();
require 'inc/db2.php';
$id=$_GET['session'];

try
{
    $req = $pdo->prepare('SELECT * FROM membrebureau ');
    $req->execute();
    $membres = $req->fetchAll(PDO::FETCH_ASSOC);

}
catch(PDOException $e)
{
    $errMsg = $e->getMessage();
}


if(isset($_POST['submit'])){

    $lieu = $_POST['lieu'];
    $date = $_POST['date'];
    $objet = $_POST['objet'];
    if(!empty($_POST)){
        $req=$pdo->prepare('INSERT INTO reunion (lieu,dat,objet) VALUES (?,?,?)')->execute([$lieu,$date,$objet]);
        header('Location: presidente.php?session='.$id.'reunion=ok');
    }
    
 }

?>
<?php require "header.php" ?> 


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
                    <div class="card-header">Informations reunion</div>
                    <div class="card-body">
                            <form action="" method="POST">
                                <table class="table table-responsive table-hover">
                                    <thead>
                                        <th>id</th>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>lieu</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="lieu" class="form-control" placeholder="Entrez le lieux" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="date" name="date" class="form-control"/>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Objet</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="objet" class="form-control" placeholder="Entrez l'objet de la reunion" />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button type="submit" name="submit" class="btn btn-success"> OK</button>&emsp;&emsp;&emsp;&emsp;
                                <button type="reset" class="btn btn-warning"> Effacer</button>&emsp;&emsp;&emsp;&emsp;
                                <a class="btn btn-danger" href=<?php echo "presidente.php?session=".$id?> >Annuler</a>
                            </form>
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