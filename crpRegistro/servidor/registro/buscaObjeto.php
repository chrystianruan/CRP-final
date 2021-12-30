<?php
    session_start();

    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true) or ($_SESSION['nivelAcesso'] != 30))
    {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('Location: /crpRegistro/index.html');
        session_destroy();
    }
  
    $logado = $_SESSION['usuario'];
    
?>

<?php
function getFilterObjeto(){
	$pdo = new PDO("mysql:host=127.0.0.1; dbname=crp;", "compras", "#compr@s20");
	$sql = 'SELECT * FROM objeto';
	$stm = $pdo->prepare($sql);
	$stm->execute();
	
	echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
	$pdo = null;
}
getFilterObjeto();
?>