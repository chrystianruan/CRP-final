<?php
    session_start();

    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true) or ($_SESSION['nivelAcesso'] != 30))
    {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('Location: /index.html');
        session_destroy();
    }
    
    $logado = $_SESSION['usuario'];
    
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="./css/cadastrar.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="/crpRegistro/imagens/icon-siga.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Alteração</title>
</head>
<body>

<?php if(isset($_POST['alterar'])) : ?>
<?php

require 'conexao.php';

$id_demonstrativo = $_POST['id_demonstrativo'];
$numItemDG = $_POST['numItemDG'];
$descItemDemo = $_POST['descItemDemo'];
$marca = $_POST['marca'];
$fornecedor = $_POST['fornecedor'];
$motivo = $_POST['motivo'];
$qtdHomologada = $_POST['qtdHomologada'];
$unidMedida = $_POST['unidMedida'];
$valorUnit = $_POST['valorUnit'];
$situacao = $_POST['situacao'];
$sql = "UPDATE demonstrativo_global SET numItemDG = $numItemDG, situacao = $situacao, descItemDemo = '$descItemDemo', motivo = '$motivo', marca = '$marca', id_fornecedor = $fornecedor, unidMedida = '$unidMedida', valorUnit = $valorUnit, qtdHomologada = $qtdHomologada  WHERE id_demonstrativo = $id_demonstrativo;";
$result = mysqli_query($conn, $sql);
$erro = mysqli_errno($conn); 
?>

    
        <?php if($result == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green;"> <?php echo "Alterado com sucesso!" ?> </h2>
            <?php header( "refresh:0.2;url=../demo/filtroMostraDemo.php" );?>
        <?php } else {
echo $erro; ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:red;"> <?php echo "ERRO!" ?> </h2> 
    <?php } ?>
    <?php else :
        echo ""; 
    endif; ?>

   
    
<?php 
    require 'conexao.php';
    $id_dem = $_GET['id'];
    $sql = "SELECT * FROM demonstrativo_global WHERE id_demonstrativo = $id_dem;";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, "SELECT * FROM fornecedor");
    $dados = mysqli_fetch_assoc($result);
    $id_demonstrativo = $dados['id_demonstrativo'];
    $numItemDG = $dados['numItemDG'];
    $descItemDemo = $dados['descItemDemo'];
    $marca = $dados['marca'];
    $fornecedor = $dados['id_fornecedor'];
$motivo = $dados['motivo'];
    $qtdHomologada = $dados['qtdHomologada'];
    $unidMedida = $dados['unidMedida'];
    $valorUnit = $dados['valorUnit'];
    $valorTotal = $dados['valorTotal'];
    $totalUtilizado = $dados['totalUtilizadoOrgs'];
    $saldoTotalRes = $dados['saldoTotalOrgs'];
	$situacao = $dados['situacao'];

    ?>



    
<div class="row justify-content-center" style="margin-top: 1%"> 
<a href = "../demo/filtroMostraDemo.php" ><img src="/crpRegistro/imagens/back-arrow.png" width=35 height=35></a>
</div>
    
    <div class="container-second" style="background-color: aliceblue; height: 100; display: flex; flex-direction: row;justify-content: center;align-items: center;">
    <div class="box" style="padding: 10px -10px; background-color: #fff; border-radius: 15px; text-align: center;  width: 90%; box-shadow: 0 0 1em #808080;">
    <form class="row g-3" style="margin:3%;" action = "formAlterarDem.php?id=<?php echo $id_demonstrativo?>" method = "POST">

    <h1 style = "text-align: center"> Formulário de <strong>Alteração</strong> </h1> <br> 
    <hr> <br>
    
    <div class="col-md-1" style="margin:1%;">
    <label for="id" class="form-label" > <strong>#</strong> </label> <br>
    <input type="number" readonly class="form-control" style = "font-size: medium;" name="id_demonstrativo" value="<?php echo $id_demonstrativo ?>"> 
    </div>
    <div class="col-md-1" style="margin:1%;">
    <label for="id" class="form-label" > <strong>N° Item:</strong> </label> <br>
    <input type="number" class="form-control" style = "font-size: medium;" name="numItemDG" value="<?php echo $numItemDG ?>"> 
    </div>

    <div class="col-md-4" style="margin:1%;">
    <label for="id" class="form-label" > <strong>Descrição:</strong> </label> <br>
    <textarea  rows = 6 cols=50   class="form-control" style = "font-size: medium;" name="descItemDemo"><?php echo $descItemDemo ?></textarea> 
    </div>

    <div class="col-md-3" style="margin:1%;">
    <label for="id" class="form-label" > <strong>Marca/Modelo:</strong> </label> <br>
    <textarea  rows = 4 cols=10  class="form-control" style = "font-size: medium;" name="marca"><?php echo $marca?></textarea> 
    </div>

    <div class="col-md-2" style="margin:1%;">
    <label class="form-label" > <strong> Fornecedor<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select" id="fornecedor" name="fornecedor" required autocomplete="off">
                        <option selected value="<?php echo $fornecedor ?>"><?php 
                                                                                include_once('conexao.php');
                                                                                $result2 = mysqli_query($conn, "SELECT * FROM fornecedor;");
                                                                                while ($dados2 = mysqli_fetch_assoc($result2)) {
                                                                                    if($fornecedor == $dados2['id']) {
                                                                                        echo $dados2['nome'];
                                                                                    }
                                                                                }
                                                                            ?>                
                                                                        
                                                                        </option>
                        <?php
                            $result2 = mysqli_query($conn, "SELECT * FROM fornecedor;");
                            while ($dados2 = mysqli_fetch_assoc($result2)) {

                        ?>
                        <option value="<?php echo $dados2['id'] ?>">
                                <?php echo $dados2['nome'] ?>
                        </option>
                                <?php 
                            }
                            ?>
                        </select> 
    </div>

    <div class="col-md-1" style="margin:1%;">
    <label for="qtdH"  class="form-label"> <strong>Unidade de medida:</strong> </label> <br>
    <input type="text" class="form-control" style = "font-size: medium; " name="unidMedida" value="<?php echo $unidMedida ?>"> 
    </div>

    <div class="col-md-1" style="margin:1%;">
    <label for="qtdH"  class="form-label"> <strong>Quantidade homologada:</strong> </label> <br>
    <input type="number" class="form-control" style = "font-size: medium; " name="qtdHomologada" value="<?php echo $qtdHomologada ?>"> 
    </div>

    <div class="col-md-1" style="margin:1%;">
    <label for="totalUti" class="form-label" > <strong>Total utilizado:</strong> </label> <br>
    <input type="number" class="form-control" style = "font-size: medium; " readonly name="totalUtilizadoOrgs" value="<?php echo $totalUtilizado?>"> 
    </div>

    <div class="col-md-1" style="margin:1%;">
    <label for="saldoT" class="form-label" > <strong>Saldo <br>total:</strong> </label> <br>
    <input type="number"  class="form-control" style = "font-size: medium;" readonly name="saldoTotalOrgs" value="<?php echo $saldoTotalRes ?>"> 
    </div>

    <div class="col-md-1" style="margin:1%;">
    <label for="qtdH"  class="form-label"> <strong>Valor Unitário:</strong> </label> <br>
    <input type="number" class="form-control"  placeholder = "0.0" step="0.01"  min="0" style="color:red;font-size: medium"  name="valorUnit" value="<?php echo $valorUnit ?>"> 
    </div>

    <div class="col-md-1" style="margin:1%;">
    <label for="qtdH"  class="form-label"> <strong>Valor <br>total:</strong> </label> <br>
    <input type="number" class="form-control" style = "font-size: medium; " readonly name="valorTotal" value="<?php echo $valorTotal ?>"> 
    </div>
 <div class="col-md-2" style="margin:1%;">
    <label class="form-label" > <strong> Atender?<strong id="asterisco">*</strong>: </strong> </label>
            <select class="form-select" name="situacao" required autocomplete="off">
                <option selected value="<?php echo $situacao?>"> <?php if($situacao == 1) {
                                                                            echo "Não";
                                                                } else {
                                                                    echo "Sim";
                                                                } ?> </option>
                                                                 <option value="0"> Sim</option>
                                                                 <option value="1"> Não</option>
            </select>
                                                            </div>
<div class="col-md-5" style="margin:1%;">
    <label for="qtdH"  class="form-label"> <strong>Motivo:</strong> </label> <br>
    <input type="text" class="form-control" style = "font-size: medium; " name="motivo" value="<?php echo $motivo ?>"> 
    </div>

    <div class="row justify-content-center" style="margin-top: 3%">
    <button class="btn btn-dark" type="submit" name="alterar"> <strong> Alterar </strong> </button>
    </div>

</form>
</div>
</div>



    
</body>
</html>
