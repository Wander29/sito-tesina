<?php
    require("dbinfo.php");
    session_start();
    $dati = array();   
    $connection = mysqli_connect("localhost", $username, $password, $database);
    if(!$connection){
        $dati["errore"] = "errore nella connessione";
        die();
    }
    $utente = $psw = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $utente = $_POST["utente"];
        $psw = md5($_POST["psw"]);
    }

    $query = "SELECT nomeUt, FkCodRel, nomeTipo, permessi FROM users, tipo_utente WHERE nomeUt = '$utente' AND psw = '$psw' AND CodTipoUt = FkTipoUtente"; 
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
    	if($row = mysqli_fetch_array()) {
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
			    	if($row2 = mysqli_fetch_array()) {
			    		$_SESSION['nome'] = $row2[0] . " " . $row2[1];
			    	}
	    		} else {
			        $data['query'] = "ERRORE: Non è stato possibile eseguire:  $query2." . mysqli_error($connection);
		            $data['errore'] = "ERRORE, autenticazione non riuscita";
			    }
    		} else { $_SESSION['nome'] = 'admin'; }
		}  
    } 

    if(!empty($_SESSION['permessi'])){
        if (strpos($_SESSION['permessi'], "HOME") !== false) { 
            $data['login'] = true;
        } else { 
            $data['login'] = false;
            $data['errore_login'] = "Non hai i permessi per accedere";
        }
    } else { 
        $data['login'] = false;
        $data['errore_login'] = "Utente non trovato. Riprova";
     }

    mysqli_close($connection); 
    echo json_encode($data);
?>