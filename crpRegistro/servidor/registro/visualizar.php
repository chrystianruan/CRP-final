<?php
if(isset($_POST["user_id"])){
	include_once "conexao.php";
	
	$resultado = '';
	
	$sql = "SELECT * FROM registro AS r1 LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE id_item = '" . $_POST["user_id"] . "' LIMIT 1";
	$result = mysqli_query($conn, $query_user);
	$dados = mysqli_fetch_assoc($resultado_user);
	
	$resultado .= '<dl class="row">';
	
	$resultado .= '<dt class="col-sm-3">ID</dt>';
	$resultado .= '<dd class="col-sm-9">'.$dados['id_item'].'</dd>';
	
	$resultado .= '<dt class="col-sm-3">Nome</dt>';
	$resultado .= '<dd class="col-sm-9">'.$dados['numItemDG'].'</dd>';
	
	$resultado .= '<dt class="col-sm-3">E-mail</dt>';
	$resultado .= '<dd class="col-sm-9">'.$row_user['descItemDemo'].'</dd>';
		
	$resultado .= '</dl>';
	
	echo $resultado;
}