<?php
    session_start();

    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true) or ($_SESSION['nivelAcesso'] != 29))
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
    <link rel="stylesheet" type="text/css" href="./css/inicio.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="/imagens/icon-siga.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Alteração</title>
</head>
<body>

<?php if(isset($_POST['alterar'])) : ?>
<?php

require 'config.php';

$id = $_POST['id'];
$user = $_POST['usuario'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$matricula= $_POST['matricula'];
$senha = $_POST['senha'];
$nivel = $_POST['nivelAcesso'];

$sql = "UPDATE usuarios SET usuario = '$user', nome = '$nome', email = '$email', senha = md5('$senha'), matricula = '$matricula', nivelAcesso = $nivel WHERE id = $id;";
$result = mysqli_query($conexao, $sql); 
?>

    
        <?php if($result == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green;"> <?php echo "Alterado com sucesso!" ?> </h2>
            <?php header( "refresh:0.2;url=usuarios.php" );?>
        <?php } else {
?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:red;"> <?php echo "ERRO!" ?> </h2> 
    <?php } ?>
    <?php else :
        echo ""; 
    endif; ?>

   
    
<?php 
    require 'config.php';
    $idG = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = $idG;";
    $result = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($result);
    $id = $dados['id'];
    $user = $dados['usuario'];
    $nome = $dados['nome'];
    $email = $dados['email'];
    $matricula= $dados['matricula'];
    $senha = $dados['senha'];
    $nivel = $dados['nivelAcesso'];


    ?>



    
<div class="row justify-content-center" style="margin-top: 1%"> 
<a href = "usuarios.php" ><img src="/imagens/back-arrow.png" width=35 height=35></a>
</div>
    
    <div class="container-second" style="height: 100; display: flex; flex-direction: row;justify-content: center;align-items: center; margin: 5%">
    <div class="box" style="padding: 10px -10px; background-color: #fff; border-radius: 15px; text-align: center;  width: 90%; box-shadow: 0 0 1em #808080;">
    <form class="row g-3" style="margin:3%;" action = "alterar.php?id=<?php echo $id?>" method = "POST">

    <h1 style = "text-align: center"> Formulário de <strong>Alteração</strong> </h1> <br> 
    <hr> <br>
    
    <div class="col-md-1" style="margin:1%;">
    <label for="id" class="form-label" > <strong>#</strong> </label> <br>
    <input type="number" class="form-control" readonly style = "font-size: medium;" name="id" value="<?php echo $id ?>"> 
    </div>

    <div class="col-md-4" style="margin:1%;">
    <label for="id" class="form-label" > <strong>Nome completo:</strong> </label> <br>
    <input class="form-control" style = "font-size: medium;" name="nome" value="<?php echo $nome ?>">
    </div>

    <div class="col-md-4" style="margin:1%;">
    <label for="qtdH"  class="form-label"> <strong>Email:</strong> </label> <br>
    <input type="email" class="form-control" style = "font-size: medium; " name="email" value="<?php echo $email ?>"> 
    </div>

    <div class="col-md-2" style="margin:1%;">
    <label for="qtdH"  class="form-label"> <strong>Matrícula:</strong> </label> <br>
    <input type="number" class="form-control" style = "font-size: medium; " name="matricula" value="<?php echo $matricula ?>"> 
    </div>

    <div class="col-md-2" style="margin:1%;">
    <label for="id" class="form-label" > <strong>Usuário:</strong> </label> <br>
    <input  rows = 4 cols=10  class="form-control" required style = "font-size: medium;" name="usuario" value="<?php echo $user?> ">
    </div>
<div class="col-md-2" style="margin:1%;">
<label class="form-label" for="">
                                <i class="fas fa-lock icon-modify"></i>
                                <input class="form-control" type="password" name="senha" placeholder="Senha" id="senha">
                                    <button type="button" class="btn-pass" onclick="mostrarSenha()">
                                        <i class="fas fa-eye"></i>
                                    </button>
                             </label>
 </div>
    <div class="inputBox col-md-2">
                        
                        <label class="form-label" style="margin-left:3%"> <strong> Nível de Acesso<strong id="asterisco">*</strong>: </strong> </label>
                        <select required autocomplete="off" id="orgao" name="nivelAcesso" class="form-select" autocomplete="off">
                          <option selected value="<?php echo $nivel ?>"><?php if ($nivel == 29) {
                                                                                echo"Administrador";
                                                                            } elseif ($nivel == 30) {
                                                                                echo"Servidor";
                                                                            } else {
                                                                                include_once('config.php');
                                                                                $result2 = mysqli_query($conexao, "SELECT * FROM orgao;");
                                                                                while ($dados2 = mysqli_fetch_assoc($result2)) {
                                                                                    if($nivel == $dados2['id']) {
                                                                                        echo $dados2['nome'];
                                                                                    }
                                                                            }
                                                                        }
                                                                            ?>                
                                                                        
                                                                        </option>
                          <option style="color:red;" value="29"> Administrador </option>
                          <option style="color:red;" value="30"> Servidor </option>
                          <?php
                            include_once('config.php');
                            $result2 = mysqli_query($conexao, "SELECT * FROM orgao ORDER BY nome;");
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
  
    <div class="row justify-content-center" style="margin-top: 10%">
    <div  class="col-md-5" >
    <button class="btn btn-dark" type="submit" name="alterar"> <strong> Alterar </strong> </button>
    </div>
    </div>

</form>
</div>
</div>


     <script>
        function mostrarSenha() {
            var tipo = document.getElementById("senha");
            if (tipo.type == "password") {
                tipo.type = "text";
            } else {
                tipo.type = "password";
            }
        }
</script>
</body>
</html>
