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
       
.p-sigla {
    color: #fde962; 
}

.p-siga {
    font-size: 15px;
    text-align: center;
    float: left;
    height: 15px;
    color: white;
    line-height: 0.2rem;
    margin-top: -2px;
}

.hr-p {
    color: white;
    width: 250px;
    float: center;
    margin-left: -10px;
}
</style>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/cadastrar.css" media="screen"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="imagex/png" href="/crpregistro/imagens/icon-siga.ico">
    <title> Cadastro de Processo </title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary " style="background: #54AEE6 !important; height: 105px !important;">
    <div class="container-fluid" style="background-color: #54AEE6; margin-bottom: auto !important; height: auto !important;">
                <a class="navbar-brand" href="#">
                    <div class="logo">
                        <img class="logo-siga" src="/crpRegistro/imagens/servidor.png">   
                        <br>
                        <hr class="hr-p">
                        <p class="p-siga"><strong class="p-sigla">Si</strong>stema de <strong class="p-sigla">G</strong>erenciamento das <strong class="p-sigla">A</strong>tas</p>
                    </div>
                    </a><font style="color:white; font-weight: normal; text-transform: uppercase; font-size: 20px; margin: 8px;">Servidor</font>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <h5> <a class="nav-link active" aria-current="page" href="#">Início</a></h5>
        </li>
        <li class="nav-item dropdown">
        <h5> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Cadastrar
          </a> 
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../demonstrativo/formCadastroDem.php">Itens</a></li>
            <li><a class="dropdown-item" href="../registro/formCadastroReg.php">Demandas</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><strong>Cadastrar</strong></a></li>
          </ul>
        </li>
        </h5>
        <h5>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Consultar
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../demonstrativo/filtroDemonstrativo.php">Demonstrativo</a></li>
            <li><a class="dropdown-item" href="../demo/filtroMostraDemo.php">Itens</a></li>
            <li><a class="dropdown-item" href="../registro/filtroRegistro.php">Alterar Demanda</a></li>
            <li><a class="dropdown-item" href="../processos/filtroProcesso.php">Processos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><strong>Consultar</strong></a></li>
          </ul>
        </li>
        </h5>
    </ul>
        <div class="d-flex">  
        <a class="navbar-brand" href="#"><strong style="font-size: 18px"><font style="color:white;">Usuário: <font style="color:#5C2085"><?php echo $logado?></strong></font>  </font></a>     
            <a href="/crpRegistro/login/sair.php" class="btn btn-outline-danger ">Sair</a>
            </div>
        </div>
    </div>
</nav>

<?php if(isset($_POST['cadastrar'])) : ?>

<?php
require 'conexao.php';
$item = $_POST['id_item'];
$n_Processo = $_POST['n_Processo'];
$data_processo = $_POST['data_processo'];
$qtdUtilizadaProcesso = $_POST['qtdUtilizadaProcesso'];
$sql = "INSERT INTO processo(n_Processo, data_processo, qtdUtilizadaProcesso, id_item) VALUES ('$n_Processo', '$data_processo', $qtdUtilizadaProcesso, $item);";
$result = mysqli_query($conn, $sql);

?>

    
        <?php if($result == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green;"> <?php echo "Cadastrado com sucesso!" ?> </h2>
        <?php } else { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:red;"> <?php echo "ERRO!" ?> </h2> 
    <?php } ?>
    <?php else :
        echo ""; 
    endif; ?>

    <?php 
    require 'conexao.php';
    $sql = "SELECT * FROM objeto;";
    $result = mysqli_query($conn, $sql);
    $sql2 = "SELECT * FROM orgao;";
    $result2 = mysqli_query($conn, $sql2);
    

    ?>
<div class="container-second">
    <form  class="form-pro" style="margin: 2% 30% 3% 30%;box-shadow: 0 0 1em #808080;" action = "./formCadastroPro.php"  method="POST">
                <fieldset>
                    
                    <h1 id="titulo">Cadastrar Processo</h1>
                    <hr>
                  
            
                 <div class="col-md-5" style="margin:1%; margin-left: 32.5%;">
                    <div class="inputs"><label class="form-label"> <strong> N° Processo: <strong id="asterisco">*</strong> </strong>  </label>
                        <input class="form-control" required autocomplete type="text" name="n_Processo" placeholder=" 7777777.666666/AAAA-22"> </input>
                    </div>
                </div>
                <br>
                    <div class="col-md-4" style="margin:1%;margin-left: 36%;">
                    <div class="inputs">
                        <label class="form-label"> <strong> Data: <strong id="asterisco">*</strong>  </strong> </label>
                        <input class="form-control" required autocomplete type="date" name = "data_processo" > </input>
                   
                    </div>
                    </div>
                   
                    <br>
                    <div class="col-md-3"style="margin:1%;margin-left: 40%;">
                    <div class="inputs"><label class="form-label"> <strong> Qtd. utilizada: </strong>  </label>
                        <input class="form-control" required autocomplete type="number" name = "qtdUtilizadaProcesso" min="0"> </input>
                   
                    </div>
                </div>
                 
              <br>
                <div class="col-md-3" style="margin:1%;margin-left: 40%;">
                    <div class="inputs"><label class="form-label"> <strong> Id <a href="../registro/filtroRegistro.php" style=" text-decoration: none;"target="_blank">Registro</a>: <span id="asterisco">*</span> </strong>  </label>
                    <input class="form-control" required autocomplete name = "id_item" placeholder = " Número do Id na tabela específica." type="number" > </input>
                </div>
            </div>

                <br> 
                <div class="row justify-content-center">
                    <button type="submit" style = "margin: 1%;" name="cadastrar" class="btn btn-primary">Enviar</button>
                </div>
        
                
                        </fieldset>
                        </form>

       </div>

       <footer>
    <div>
        <p class="p-footer"> 2021 &copy Governo do Estado do Rio Grande do Norte | Desenvolvimento <strong>COTIC</strong></p>
    </div>
    <hr>
    <div class="container-footer">
        <img class="img-compr" src="/crpRegistro/imagens/logo-compr.png" alt="Logo-COMPR">
        <img class="img-rn" src="/crpRegistro/imagens/logo-rn.png" alt="Logo-RN">
</div>
</footer>
       <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script>            
        setTimeout(function() {
            $('#msg').fadeOut('fast');
            }, 1500);
        </script>   
    
</body>
</html>