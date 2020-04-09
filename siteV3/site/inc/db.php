<?php 
	$pdo=new PDO('mysql:dbname=espace_membre;host=localhost','root','');

	/*JE VEUX ACCEDER  a la constante attr_errmode qui se situe dans pdo*/
	/*je fais ça pour qu'a chaque fois qu'il rencontre une erreur ça me renvoie une exception */
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	/*JE veux récuperer mes attribut sous forme d'objet pour cela je fais*/
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);