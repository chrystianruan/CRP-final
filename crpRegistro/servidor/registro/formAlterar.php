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
<style>
body{
    background-color: aliceblue !important;
}
.btn {
    border-radius: 10px !important;
    text-transform: uppercase !important;
    color: #fff !important;
    font-size: 15px !important;
    padding: 10px 20px !important;
    cursor: pointer !important;
    font-weight: bold !important;
    width: 10% !important;
    align-self: center !important;
    border: 1px solid !important;
    margin: 4px;
}

.btn-primary{
    background-color: #54AEE6 !important;
    transition: 0.5s !important;
    width: 150px !important;
}

.btn-primary:hover{
    background-color: transparent !important;
	color: #54AEE6 !important;
    transition: 0.5s !important;
    border-color: #54AEE6 !important;
    outline: 1px solid;
} 
</style>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="./styleReg.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   
 <?php if(isset($_POST['alterar'])) : ?>
    <?php
    

require 'conexao.php';

$id_item = $_POST['id_item'];
$id_demonstrativo = $_POST['id_demonstrativo'];
$qtdDemandaOrg = $_POST['qtdDemandaOrg'];
$sql1 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) AS qtd FROM processo WHERE id_item = $id_item;");
$row = mysqli_fetch_assoc($sql1);
$qtdUtilizadaOrg = $row['qtd'];
$sql = "UPDATE registro SET id_demonstrativo = $id_demonstrativo, qtdDemandaOrg = $qtdDemandaOrg where id_item = $id_item;";
$result = mysqli_query($conn, $sql); 
?>


        <?php if($result == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green;"> <?php echo "Alterado com sucesso!" ?> </h2>
            <?php header( "refresh:0.2;url=./filtroRegistro.php" );?>
        <?php } else { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:red;"> <?php echo "ERRO!" ?> </h2> 
    <?php } ?>
    <?php else :
        echo ""; 
    endif; ?>
    
    <title>Alterar</title>
</head>
<body>
    
<?php 
    require 'conexao.php';
    $id_it= $_GET['id'];
    $sql = "SELECT * FROM registro AS r1 LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE id_item = $id_it;";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);
    $id_item = $dados['id_item'];
    $id_demonstrativo = $dados['id_demonstrativo'];
    $numItemDG = $dados['numItemDG'];
    $descItemDemo = $dados['descItemDemo'];
    $qtdDemandaOrg = $dados['qtdDemandaOrg'];
    $sql1 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) AS qtd FROM processo WHERE id_item = $id_item;");
    $row = mysqli_fetch_assoc($sql1);
    $qtdUtilizadaOrg = $row['qtd'];
    $saldoOrg = $qtdDemandaOrg - $qtdUtilizadaOrg;

    ?>

    

<div class="container-second" style="background-color: aliceblue; height: 100vh; display: flex; flex-direction: row;justify-content: center;align-items: center;">
<div class="box" style="padding: 50px 20px; background-color: #fff; border-radius: 15px; text-align: center; height: 80%; width: 80%; box-shadow: 0 0 1em #808080;">
    <form class="row g-3" style="float: center; margin:1% 20% 1% 20%; justify-content: center;"  action = "formAlterar.php?id=<?php echo $id_item?>" method = "POST"> 
    <h1 style = "text-align: center; color: #54AAE6;"> Formulário de Alteração </h1> <br> 
    <hr> <br>

    <div class="col-md-1" style="margin:8px;">
    <label class="form-label"  for="id" > <strong>Cód:</strong> </label> <br>
    <input type="number" class="form-control" readonly style = "font-size: medium"  name="id_item" value="<?php echo $id_item ?>">
    </div> 

    <div class="col-md-1" style="margin:8px;" >
    <label class="form-label" for="id" > <strong>N° item:</strong> </label> <br>
    <input type="number" class="form-control" readonly style = "font-size: medium" name="numItemDG" value="<?php echo $numItemDG?>"> 
    </div> 

    <div class="col-md-6" style="margin:8px;">
    <label class="form-label"> <strong> Descrição: </strong> </label> <br>
    <textarea name="descItemDemo"  class="form-control" readonly style="padding:3px;" rows="6" cols="60" style = "font-size: medium"><?php echo$descItemDemo?></textarea> 
    </div>
    <hr>

    <div class="col-md-2" style="marging: 8px;">
    <label class="form-label" style="margin: 8px;"> <strong> Id do Demonstrativo Global:</strong> </label> <br>
    <input required autocomplete  class="form-control" style="font-size: medium;" type="number" name = "id_demonstrativo"  min="0" value="<?php echo $id_demonstrativo?>"> 
    </div> 
     
    <div class="col-md-1" style="margin: 8px;">
    <label class="form-label" style="margin: 8px;"> <strong>Qntd. Demanda:</strong> </label><br>
    <input required autocomplete  type="number" min="0" class="form-control" style="color:red;font-size: medium" name= "qtdDemandaOrg" value="<?php echo $qtdDemandaOrg ?>">
    </div> 
    
    <br> 
    <div class="col-12" style="margin: 2% 0 2% 0%;">
    <button class="btn btn-primary" type="submit" name="alterar"> <strong> Alterar </strong> </button>
    
    </div>
    <br>
    
    </form>
</div>
</div>  
    <a href = "./filtroRegistro.php"> <button class="btn btn-primary" style = "font-size: medium; padding: 8px; border-radius: 5%;"> <strong> << Voltar</strong> </button> </a>
    
</body>
</html>

