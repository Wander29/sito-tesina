<?php 
	require('dbinfo.php');
	session_start();
	$dati = array();
	$connection = mysqli_connect($server, $usr, $psw, $db) or die('Errore collegamento al DB');
	if(!$connection){
        $dati["error"] = "errore nella connessione";
        die();
    }

	if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
		$query = "SELECT permessi FROM tipo_utente WHERE nomeTipo = 'ospite'";
		$result = mysqli_query($connection, $query); 
		if(mysqli_num_rows($result) > 0) {
			if ($row = mysqli_fetch_array($result)) {
				$_SESSION['permessi'] = $row[0];
        		$_SESSION['tipoUt'] = 'ospite';
			}
		} 
		if (strpos($_SESSION['permessi'], "HOME") !== false) { 
	        header('Location: ../public/strumenti.html');
	    }
	    mysqli_close($connection); 
	}


	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
 ?>
