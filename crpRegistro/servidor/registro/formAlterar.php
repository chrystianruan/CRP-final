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
    <link rel="stylesheet" type="text/css" href="./css/cadastrar.css" media="screen"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="/imagens/icon-siga.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Alteração</title>
</head>
<body>
    
<?php 
    require 'conexao.php';
    $id_it= $_GET['id'];
    $sql = "SELECT * FROM registro AS r1 LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE id_item = $id_it;";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);
    $id_item = $dados['id_item'];
    $numItemDG = $dados['numItemDG'];
    $descItemDemo = $dados['descItemDemo'];
    $qtdDemandaOrg = $dados['qtdDemandaOrg'];
    $sql1 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) AS qtd FROM processo WHERE id_item = $id_item;");
    $row = mysqli_fetch_assoc($sql1);
    $qtdUtilizadaOrg = $row['qtd'];

    ?>

    <?php if(isset($_POST['alterar'])) : ?>
        <?php
        

    require 'conexao.php';

    $id_item = $_POST['id_item'];
    $qtdDemandaOrg = $_POST['qtdDemandaOrg'];
    $sql1 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) AS qtd FROM processo WHERE id_item = $id_item;");
    $row = mysqli_fetch_assoc($sql1);
    $qtdUtilizadaOrg = $row['qtd'];
    $sql = "UPDATE registro SET qtdDemandaOrg = $qtdDemandaOrg where id_item = $id_item;";
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

    
    
<div class="row justify-content-center" style="margin-top: 1%"> 
<a href = "../registro/filtroRegistro.php" ><img src="/imagens/back-arrow.png" width=35 height=35></a>
</div>

<div class="container-second" style="margin: 3% 18% 0 18%">
<div class="box">
    <form class="row g-3"  action = "formAlterar.php?id=<?php echo $id_item?>" method = "POST"> 
    <h1 style = "text-align: center"> Formulário de <strong>Alteração</strong> </h1> <br> 
    <hr> <br>

    <div class="col-md-2" style="margin:1%;">
    <label class="form-label"  for="id" > <strong>Cód:</strong> </label> <br>
    <input type="number" class="form-control" readonly style = "font-size: medium"  name="id_item" value="<?php echo $id_item ?>">
    </div> 

    <div class="col-md-1" style="margin:1%;" >
    <label class="form-label" for="id" > <strong>N° item:</strong> </label> <br>
    <input type="number" class="form-control" readonly style = "font-size: medium" name="numItemDG" value="<?php echo $numItemDG?>"> 
    </div> 

    <div class="col-md-6" style="margin:1%;">
    <label class="form-label"> <strong> Descrição: </strong> </label> <br>
    <textarea name="descItemDemo"  class="form-control" readonly style="padding:3px;" rows="6" cols="60" style = "font-size: medium"><?php echo$descItemDemo?></textarea> 
    </div>
    <hr>


     
    <div class="col-md-2">
    <label class="form-label"> <strong>Qntd. Demanda:</strong> </label><br>
    <input required autocomplete  type="number" min="0" class="form-control" style="color:red;font-size: medium" name= "qtdDemandaOrg" value="<?php echo $qtdDemandaOrg ?>">
    </div> 


            

            <br> 
    <div class="row justify-content-center">
    <button class="btn btn-dark" type="submit" name="alterar"> <strong> Alterar </strong> </button>
    
    </div>
    <br>
    
    </form>
</div>
</div>
   

</body>
</html>

