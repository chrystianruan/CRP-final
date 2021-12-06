<?php
    session_start();

    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true) or ($_SESSION['nivelAcesso'] != 29))
    {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('Location: ../index.html');
        session_destroy();
    }
    $logado = $_SESSION['usuario'];
    
?>
<style>
    
.container-second{
    height: 90%;
    width: 100vw;
    background-color: #ecf1f0;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    padding: 50px 50px;
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/inicio.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="../imagens/icon-siga.ico"> <!-- /crpregistro/imagens/icon-siga.ico -->
    <title>Cadastro</title>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="background-color: #99d4c4 !important; border-bottom: 0.5px solid #99d4c4 !important">
    <div class="container-fluid">
            <a class="navbar-brand" href="#" >
                <div class="logo">
                    <img class="logo-master" src="../imagens/admin1.png">  
                    <br>
                    <hr>
                    <p class="p-siga"><strong class="p-sigla">Si</strong>stema de <strong class="p-sigla">G</strong>erenciamento das <strong class="p-sigla">A</strong>tas</p>
                </div>
            </a><font style="color:#fff; font-weight: normal; text-transform: uppercase; font-size: 20px"> Administração </font> 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <h5> <a class="nav-link active" aria-current="page" href="./usuarios.php">Consultar usuário</a></h5>

        </li>
        </ul>
        <div class="d-flex" style="float: right;">  
            <a class="navbar-brand" href="#"><strong> Usuário: <font style="color: #008b8b;"><?php echo $logado?></strong></font>  </a>    
            <a href="../login/sair.php" class="btn btn-danger">Sair</a>
            </div>
        </div>
        </div>
</nav>

<?php

    if(isset($_POST['cadastrar']))
    {


        include_once('config.php');

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $usuario = $_POST['usuario'];
        $matricula = $_POST['matricula'];
        $senha = $_POST['senha'];
        $nivelAcesso = $_POST['nivelAcesso'];

        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, usuario, matricula, senha, nivelAcesso) VALUES ('$nome','$email','$usuario','$matricula',md5('$senha'), $nivelAcesso);");
        $result2 = mysqli_query($conexao, "SELECT * FROM orgao;");
    

?>


        <?php if($result == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green;"> <?php echo "Cadastrado com sucesso!" ?> </h2>
        <?php } else { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:red;"> <?php echo "ERRO!" ?> </h2> 
             
    <?php } 
    } else {
        echo "";  
    }
        ?> 
<div class="container-second">
    <div class="box">
        <form action="inicio.php" style=""method="POST" autocomplete="off" >
            
                <legend>Cadastrar Usuário</legend>
                <br><hr><br>
                <div style="margin: 6%;" > 
                <div  style="margin: 1%;"class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" >
                    <label for="nome"  class="labelInput">Nome completo</label>
                </div>
                <br>
                <div style="margin: 1%;" class="inputBox">
                    <input type="email" name="email" id="email" class="inputUser" >
                    <label for="email"  class="labelInput">E-mail</label>
                </div>
                <br>
                <div style="margin: 1%;" class="inputBox">
                    <input type="text" autocomplete="off" name="usuario" id="usuario" class="inputUser" required>
                    <label for="usuario" required  class="labelInput">Usuário (sem espaços)</label>
                </div>
                <br>
                <div style="margin: 1%;" class="inputBox ">
                    <input type="text" name="matricula" id="matricula" class="inputUser" >
                    <label for="matricula"  class="labelInput">Matrícula</label>
                </div>
                <br>
                <div style="margin: 1%;" class="inputBox">
                    <input type="password" autocomplete="off" name="senha" id="senha" class="inputUser" required>
                    <button type="button" class="btn-pass" onclick="mostrarSenha()">
                                        <i class="fas fa-eye"></i>
                    </button>
                    <label for="senha"  class="labelInput">Senha</label>
                   
                </div>
                </div>  

                <br><br>

                
                    <div class="inputBox col-md-11">
                        
                        <label class="form-label" style="margin-left:3%"> <strong> Nível de Acesso<strong id="asterisco">*</strong>: </strong> </label>
                        <select style="margin: 10px !important; margin-left: 13px !important;" required autocomplete="off" id="orgao" name="nivelAcesso" class="form-select" autocomplete="off">
                          <option selected disabled value="">Selecionar</option>
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
             
                <br>
                <div class="col-12" style="text-align:center;">
                <input type="submit" name="cadastrar" id="submit">
                </div>
            </div>
           
        </form>
    </div>
</div>
    <footer style="background-color: #99d4c4" class="footer">
    <div class="text-footer">
        <p class="p-footer">2021 &copy Governo do Estado do Rio Grande do Norte | Desenvolvimento <strong>COTIC</strong></p>
    </div>
    <hr>
    <div class="container-footer">
        <img class="img-compr" src="../imagens/logo-compr.png" alt="Logo-COMPR">
        <img class="img-rn" src="../imagens/logo-rn.png" alt="Logo-RN">
</div>
</footer>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</body>
</html>