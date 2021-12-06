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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/usuarios.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="../imagens/icon-siga.ico">
<style>
body {
    background-color: aliceblue;
}
      
.p-sigla {
    color: #fde962; 
}

.p-siga {
    font-size: 15px;
    text-align: center;
    float: left;
    height: 15px;
}

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
    <title>Document</title>
</head>
<body>

<?php 
    include_once('config.php');
    $result = mysqli_query($conexao, "SELECT * FROM usuarios ;");
?>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary" style="background-color: #99d4c4 !important; height: 105px !important; margin-bottom: 2%;">
    <div class="container-fluid" style="background-color: #99d4c4; margin-bottom: auto !important; height: auto !important;">
                <a class="navbar-brand" href="#" >
                    <div class="logo">
                        <img class="logo-master" src="../imagens/admin1.png" >
                        <br>
                        <hr> 
                        <p class="p-siga"><strong class="p-sigla">Si</strong>stema de <strong class="p-sigla">G</strong>erenciamento das <strong class="p-sigla">A</strong>tas</p>
                    </div>
                </a> <font style="color:#fff; font-weight: normal; text-transform: uppercase; font-size: 20px">Administração </font>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <h5> <a class="nav-link active" aria-current="page" href="./inicio.php"><strong>Cadastrar usuário</strong></a></h5>

        </li>
        </ul>
        <div class="d-flex" style="float:right;">  
            <a class="navbar-brand" href="#"><strong><font style="color: #fff"> Usuário: </font> <font style="color: #008b8b"><?php echo $logado?></strong></font></a>    
            <a href="../login/sair.php" class="btn btn-danger">Sair</a>
        </div>
        </div>
    </div>
</nav>
<div class="container-table" style="margin: 0 3% 2% 3%;">
    <div class="table-responsive" style="background-color: transparent !important">
        <table class="table table-hover table-dark caption-top" > 
        <caption style=" text-align: center;border-top-left-radius: 15px !important; border-top-right-radius: 15px !important; background-color: white; width:250px; margin: auto"><h5>Usuários Cadastrados</h5></caption>
            <thead>
            <tr id="tit">
            <td class="td-cabecalho">#</td>
            <td class="td-cabecalho">Nome</td>
            <td class="td-cabecalho">Email</td>
            <td class="td-cabecalho">Usuário</td>
            <td class="td-cabecalho">Matrícula</td>
            <td class="td-cabecalho">Senha</td>
            <td class="td-cabecalho">Nível de Acesso</td>
            <td class="td-cabecalho">Ação</td>
            </tr>
        </thead>

        <tbody>
        <?php 
    
    

    while($dados = mysqli_fetch_assoc($result)) {
        $id = $dados['id'];
        $nome = $dados['nome'];
        $email = $dados['email'];
        $usuario = $dados['usuario'];
        $matricula = $dados['matricula'];
        $senha = $dados['senha'];
        $nivelAcesso= $dados['nivelAcesso'];

       

    
    ?>
    
    <tr class="tr-table-user" id="itens">
        <td class="td-corpo"><strong style="text-align: center;"> <font style="color:red;"><?php echo $id?></font></strong></td>
        <td class="td-corpo"><?php echo $nome?></td>
        <td class="td-corpo"><?php echo $email?></td>
        <td class="td-corpo"><font style="color: #54AEE6;"><?php echo $usuario?></font></td>
        <td class="td-corpo"><?php echo $matricula?></td>
        <td class="td-corpo"><font style="color:red"><?php echo $senha ?></font></td>
        <td class="td-corpo"><?php 
                                                    $result1 = mysqli_query($conexao, "SELECT * FROM orgao");
                                                    if ($nivelAcesso == 29) {
                                                        echo "Administrador";
                                                    }
                                                    elseif($nivelAcesso == 30) {
                                                        echo "Servidor";
                                                    } else {
                                                        while ($dados1 = mysqli_fetch_assoc($result1)) {
                                                           if ($nivelAcesso == $dados1['id']) {
                                                                echo $dados1['nome'];
                                                            
                                                        }
                                                    }
                                                }
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        ?>
                                                        
                                                    
                                                    
                                                    </td>
        <td class="td-corpo" style="text-align:center; vertical-align:middle;width:70px; height:30px;padding: 7px;"> <a class="button floatLeft" href="formAlterar.php?id=<?php echo $id_item?>">Alterar<!--  <img style="margin-left:45%"src="../imagens/update2.png">--> </td>
        
        
      
    </tr>
   
<?php
    }
?>
    </tbody>


    </table>
    </div>
    </div>

    
<footer class="footer" style="background-color: #99d4c4;">
    <div class="text-footer">
        <p class="p-footer">2021 &copy  Governo do Estado do Rio Grande do Norte | Desenvolvimento <strong>COTIC</strong></p>
    </div>
    <hr>
    <div class="container-footer">
        <img class="img-compr" src="../imagens/logo-compr.png" alt="Logo-COMPR">
        <img class="img-rn" src="../imagens/logo-rn.png" alt="Logo-RN">
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>