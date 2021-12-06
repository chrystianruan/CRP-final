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


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="./styleDem.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Alterar demonstrativo</title>
</head>
<body>

<?php if(isset($_POST['alterar'])) : ?>
<?php

require 'conexao.php';

$id_demonstrativo = $_POST['id_demonstrativo'];
$numItemDG = $_POST['numItemDG'];
$descItemDemo = $_POST['descItemDemo'];
$marca = $_POST['marca'];
$empresa = $_POST['empresa'];
$qtdHomologada = $_POST['qtdHomologada'];
$unidMedida = $_POST['unidMedida'];
$valorUnit = $_POST['valorUnit'];

$sql = "UPDATE demonstrativo_global SET numItemDG = $numItemDG, descItemDemo = '$descItemDemo', marca = '$marca', empresa = '$empresa', unidMedida = '$unidMedida', valorUnit = $valorUnit, qtdHomologada = $qtdHomologada  where id_demonstrativo = $id_demonstrativo;";
$result = mysqli_query($conn, $sql); 
?>

    
        <?php if($result == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green; margin-top:0%;"> <?php echo "Alterado com sucesso!" ?> </h2>
            <?php header( "refresh:0.2;url=../demo/filtroMostraDemo.php" );?>
        <?php } else { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:red; margin-top:0%;"> <?php echo "ERRO!" ?> </h2> 
    <?php } ?>
    <?php else :
        echo ""; 
    endif; ?>

   


<!-- Agenda Permanente com capa de papelão de no mínimo 705 g/m², revestida de material sintético, folhas internas em papel de no mínimo 63 g/m², com impressão em offset, formato aproximado de 14,5 cm x 20,5 cm, com aproximadamente 380 páginas, contendo, no mínimo uma página para cada dia útil do ano e agenda telefônica subdividida por ordem alfabética. -->


    
<?php 
    require 'conexao.php';
    $id_dem = $_GET['id'];
    $sql = "SELECT * FROM demonstrativo_Global WHERE id_demonstrativo = $id_dem;";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);
    $id_demonstrativo = $dados['id_demonstrativo'];
    $numItemDG = $dados['numItemDG'];
    $descItemDemo = $dados['descItemDemo'];
    $marca = $dados['marca'];
    $empresa = $dados['empresa'];
    $qtdHomologada = $dados['qtdHomologada'];
    $unidMedida = $dados['unidMedida'];
    $valorUnit = $dados['valorUnit'];
    $valorTotal = $dados['valorTotal'];
    $totalUtilizado = $dados['totalUtilizadoOrgs'];
    $saldoTotalRes = $dados['saldoTotalOrgs'];

    ?>



    

    <!--  <a href = "./filtroDemonstrativo.php"> <button style = "font-size: medium; padding: 8px; border-radius: 4%;"> Voltar para <strong> Tela Inicial</strong> </button> </a>-->

<div class="container-second" style="background-color: aliceblue; height: 100vh; display: flex; flex-direction: row;justify-content: center;align-items: center;">
<div class="box" style="padding: 50px 20px; background-color: #fff; border-radius: 15px; text-align: center; height: 80%; width: 80%; box-shadow: 0 0 1em #808080;">
    <form class="row g-3" style="margin:3%;" action = "formAlterarDem.php?id=<?php echo $id_demonstrativo?>" method = "POST">

    <h1 style = "text-align: center"> Formulário de <strong>Alteração</strong> </h1> <br> 
    <hr> <br>

    <div class="col-md-1" style="margin:1%;"> 
    <label for="id"  class="form-label"> <strong>Cód:</strong> </label> <br>
    <input type="number" class="form-control" style = "font-size: medium;" readonly name="id_demonstrativo" value="<?php echo $id_demonstrativo ?>"> 
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
    <label for="id" class="form-label" > <strong>Empresa:</strong> </label> <br>
    <textarea  rows = 6 cols=50    class="form-control" style = "font-size: medium;" name="empresa"><?php echo $empresa ?></textarea> 
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
    <label for="saldoT" class="form-label" > <strong>Saldo total:</strong> </label> <br>
    <input type="number"  class="form-control" style = "font-size: medium;" readonly name="saldoTotalOrgs" value="<?php echo $saldoTotalRes ?>"> 
    </div>

    <div class="col-md-1" style="margin:1%;">
    <label for="qtdH"  class="form-label"> <strong>Valor Unitário:</strong> </label> <br>
    <input type="number" class="form-control"  placeholder = "0.0" step="0.01"  min="0" style="color:red;font-size: medium"  name="valorUnit" value="<?php echo $valorUnit ?>"> 
    </div>

    <div class="col-md-1" style="margin:1%;">
    <label for="qtdH"  class="form-label"> <strong>Valor total:</strong> </label> <br>
    <input type="number" class="form-control" style = "font-size: medium; " readonly name="valorTotal" value="<?php echo $valorTotal ?>"> 
    </div>
    
  
    <div class="col-12" style="margin: 2% 0 2% 48%;">
    <button class="btn btn-dark" type="submit" name="alterar"> <strong> Alterar </strong> </button>
    
    </div>

</form>
</div>
</div>

<a href = "../demo/filtroMostraDemo.php"> <button style = "font-size: medium; padding: 8px; border-radius: 5%;margin: 0% 0 2% 46%;"> Voltar para <strong> Tela Inicial</strong> </button> </a>

    
</body>
</html>