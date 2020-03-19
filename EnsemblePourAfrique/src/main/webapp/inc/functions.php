<?php 
function debug($variable){
	echo'<pre>'.print_r($variable,true).'</pre>';
}
/*je ne ferme pas ici php afin d'éviter de laisser des espaces à la fin ces espaces me provoqueront des erreurs php comprend que c'est la fin du script */
/*on va généré une chaine de caractère avec une fonction pseudo aléatoire*/

function err_log_only(){
	
	if(session_status() == PHP_SESSION_NONE){
	  session_start();
	}
	/*si j'essaie d'acceder au compte sans etre connecté je dois traiter cela*/
	if(!isset($_SESSION['auth'])){
		$_SESSION['flash']['danger']="OUPS!! tu n'as pas le droit d'acceder à cette page";
		header('Location:login.php');
		exit();
	}
}