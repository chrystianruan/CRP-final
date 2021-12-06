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
function getFilterDemonstrativo($objeto){
	$pdo = new PDO("mysql:host=127.0.0.1; dbname=crp;", "root", "@cRIS2003");
	$sql = 'SELECT DISTINCT empresa FROM demonstrativo_global WHERE id_objetoOrg = ?  ORDER BY numItemDG';
	$stm = $pdo->prepare($sql);
	$stm->bindValue(1, $objeto);
	$stm->execute();
	sleep(1);
	echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
	$pdo = null;
}

if(isset($_POST['objeto'])){
	$objeto = $_POST['objeto'];
	getFilterDemonstrativo($objeto);	
}

?>