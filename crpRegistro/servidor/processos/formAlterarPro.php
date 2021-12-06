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
    <link rel="stylesheet" type="text/css" href="./css/cadastrar.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        form{
        background-color: #fff;
        border-radius: 15px;
        height: 70%; 
        width: auto;
        padding: 10px 40px;
    }
    </style>
    <?php if(isset($_POST['alterar'])) : ?>
    <?php

    require 'conexao.php';
    $id = $_POST['id'];
    $id_item = $_POST['id_item'];
    $n_Processo= $_POST['n_Processo'];
    $data_processo = $_POST['data_processo'];
    $qtdUtilizadaProcesso = $_POST['qtdUtilizadaProcesso'];
    $sql = "UPDATE processo SET id_item = $id_item, n_Processo = '$n_Processo', data_processo = '$data_processo', qtdUtilizadaProcesso = $qtdUtilizadaProcesso WHERE id = $id;";
    $result = mysqli_query($conn, $sql);



?>

    
        <?php if($result == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green;"> <?php echo "Alterado com sucesso!" ?> </h2>
            <?php header( "refresh:0.2;url=./filtroProcesso.php" );?>
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
    $id_pro= $_GET['id'];
    $sql = "SELECT * FROM processo WHERE id = $id_pro;";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);
    $id = $dados['id'];
    $id_item = $dados['id_item'];
    $n_Processo= $dados['n_Processo'];
    $data_processo = $dados['data_processo'];
    $qtdUtilizadaProcesso = $dados['qtdUtilizadaProcesso'];

    ?>


<div class="container-second" style="background-color: aliceblue; height: 100vh; display: flex; flex-direction: row;justify-content: center;align-items: center;">
<div class="box" style="padding: 50px 20px; background-color: #fff; border-radius: 15px; text-align: center; height: 80%; width: 80%; box-shadow: 0 0 1em #808080;">
    <form style="text-align:center; margin-bottom: 2%;" class = "row g-3" action = "formAlterarPro.php?id=<?php echo $id?>" method = "POST"> 
    <h1 style = "text-align: center;padding-left:-1.5%; color: #54AAE6;"> Formulário de Alteração</h1> 
    <hr> <br>
    
    <div class="col-md-4" style="margin:1%;margin-left: 33%;">
    <label class="form-label" for="id" > <strong>#</strong> </label> 
    <input class="form-control" type="number" style = "font-size: medium;" readonly name="id" value="<?php echo $id?>"> 
    </div><br>

    <div class="col-md-4" style="margin:1%;margin-left: 33%;">
    <label class="form-label" for="id"> <strong>ID Item</strong> </label> 
    <input class="form-control"type="number" style = "font-size: medium;" name="id_item" value="<?php echo $id_item?>"> 
    </div><br>

    <div class="col-md-5" style="margin:1%;margin-left: 29%;">
    <label class="form-label" for="id" > <strong>N° Processo:</strong> </label> 
    <input class="form-control" type="text" style = "font-size: medium;" name="n_Processo" value="<?php echo $n_Processo ?>"> 
    </div><br>

    <div class="col-md-4" style="margin:1%;margin-left: 33%;">
    <label class="form-label"  for="descricao" > <strong> Data do Processo: </strong> </label> 
    <input class="form-control" type="date" name="data_processo" style="padding:3px; font-size: medium"  style = "font-size: medium" value="<?php echo $data_processo?>">
    </div><br>

    <div class="col-md-4" style="margin:1%;margin-left: 33%;">
    <label class="form-label" for="qtdD" > <strong>Qntd. Utilizada Processo:</strong> </label>
    <input class="form-control" type="number" min="0" style="color:red;font-size: medium" name="qtdUtilizadaProcesso" value="<?php echo $qtdUtilizadaProcesso?>">
    </div>
    <br>

    <div class="col-12" style="margin: 2% 0 2% 0%;">
    <button class="btn btn-primary" type="submit" name="alterar"> <strong> Alterar </strong> </button>
    
    </div>
    <br>


    </form>
</div>
</div>
</div>
    <a href = "./filtroProcesso.php"> <button class="btn btn-primary" style = "font-size: medium; padding: 8px; border-radius: 5%; float: left;"><strong><< Voltar</strong></button> </a>
    
</body>
</html>