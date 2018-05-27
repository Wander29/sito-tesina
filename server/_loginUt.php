<?php
    require("dbinfo.php");
    session_start();
    session_destroy();
    session_start();
    $dati = array();   
    $connection = mysqli_connect($server, $usr, $psw, $db) or die('Errore collegamento al DB');
    $utente = $psw = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $utente = test_input($_POST["ut"]);
        $psw = test_input($_POST["psw"]);
    }

    $query = "SELECT nomeUt, FkCodRel, nomeTipo, permessi FROM users, tipo_utente WHERE nomeUt = '$utente' AND psw = MD5('$psw') AND CodTipoUt = FkTipoUtente"; 
    $dati['query'] = $query;
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
    	if($row = mysqli_fetch_array($result)) {
    		$_SESSION["nome_ut"] = $row[0];
    		$cod_ut_relativo = $row[1];
    		$table = $row[2];
    		$_SESSION['permessi'] = $row[3];
    		$_SESSION['tipoUt'] = $table;

    		if ($table != 'admin') {
    			switch ($table) {
		            case 'utente':
		                $codice_nome = "CodUt";
		                break;
		            default:
		                break;
		        }
		        $query2 = "SELECT nome, cognome FROM $table WHERE $cod_ut_relativo = $codice_nome";
		        $result2 = mysqli_query($connection, $query2);
			    if (mysqli_num_rows($result2) > 0) {
			    	if($row2 = mysqli_fetch_array($result2)) {
			    		$_SESSION['nome'] = $row2[0] . " " . $row2[1];
			    	}
	    		} else {
			        $dati['query'] = "ERRORE: Non è stato possibile eseguire:  $query2." . mysqli_error($connection);
		            $dati['errore'] = "ERRORE, autenticazione non riuscita";
			    }
    		} else { $_SESSION['nome'] = 'admin'; }
		}  
    } 

    if(!empty($_SESSION['permessi'])){
        if (strpos($_SESSION['permessi'], "HOME") !== false) { 
            $dati['login'] = true;
        } else { 
            $dati['login'] = false;
            $dati['errore_login'] = "Non hai i permessi per accedere";
        }
    } else { 
        $dati['login'] = false;
        $dati['errore_login'] = "Utente non trovato. Riprova";
     }

    mysqli_close($connection); 
    echo json_encode($dati);

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>