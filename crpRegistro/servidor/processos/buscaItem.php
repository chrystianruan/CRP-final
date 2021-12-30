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
function getFilterDemonstrativo($orgao, $objeto, $fornecedor){
	$pdo = new PDO("mysql:host=127.0.0.1; dbname=crp;", "compras", "#compr@s20");
	$sql = "SELECT * FROM registro AS r1 LEFT JOIN demonstrativo_global AS dg ON r1.id_demonstrativo = dg.id_demonstrativo WHERE id_orgao = ? AND id_objeto = ? AND id_fornecedor = ?";
	$stm = $pdo->prepare($sql);
	$stm->bindValue(1, $orgao);
	$stm->bindValue(2, $objeto);
	$stm->bindValue(3, $fornecedor);
	$stm->execute();
	
	echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
	$pdo = null;
}

if(isset($_POST['objeto']) && isset($_POST['orgao']) && isset($_POST['fornecedor']) ){
	$objeto = $_POST['objeto'];
	$orgao = $_POST['orgao'];
	$fornecedor = $_POST['fornecedor'];
	getFilterDemonstrativo($orgao, $objeto, $fornecedor);	
}

?>
