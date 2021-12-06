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
   
.logo-siga{
    padding: 0 5px;
    margin: 4px;
    height: 45px;
    width: auto;
    float:left;
    margin-left: 30px;;
}

.logo-desc{
    align-items: center;
    margin: 4px;
    padding: 2px 10px;
    vertical-align: middle;
}

.logo{
    color: #00008b;
    height: 45px !important;
    margin-top: 10px !important;
}


.navbar{
    position: sticky !important;
    top: 0 !important;
}

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

.img-rn {
    width: auto;
    height: 60px;
    margin: 8px;
    margin-top: 2px;
    padding: 0 20px;
}

.img-compr{
    width: auto;
    height: 140px;
    margin: 8px;
    margin-top: 2px;
    padding: 0 20px;
}

footer{
    color: white;
    background-color: #54AEE6;
    text-align: center;
    margin-top: auto;
    position: relative;
    height: auto;
    width: 100 !important;
}

.space{
    height: 50%;
    width: 100;
}

.text-footer{
    height: 3.5%;
}

.p-footer{
    vertical-align: middle;
    padding-top: 20px;
    width: auto;
    position: relative;
    font-weight: normal;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styleDem.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="imagex/png" href="../imagens/icon-siga.ico">
    <link rel="shortcut icon" type="imagex/png" href="/crpregistro/imagens/icon-siga.ico">
    <title>Cadastrar Objeto</title>
</head>

<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary " style="background: #54AEE6 !important; height: 90px !important; ">
    <div class="container-fluid" style="background-color: #54AEE6; margin-bottom: auto !important; height: auto !important;">
                <a class="navbar-brand" href="../sistema.php" >
                <div class="logo">
                <img class="logo-siga" src="/crpRegistro/imagens/servidor.png">
                <br>
                
                <hr class="hr-p">
                <p class="p-siga"><strong class="p-sigla">Si</strong>stema de <strong class="p-sigla">G</strong>erenciamento das <strong class="p-sigla">A</strong>tas</p>
            </div>
            </a><font style="color:white; font-weight: normal; text-transform: uppercase; font-size: 20px; margin: 8px">  Servidor </font>  
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
            <li><a class="dropdown-item" href="../processos/formCadastroPro.php">Processos</a></li>
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
            <li><a class="dropdown-item" href="../registro/filtroRegistro.php">Demandas</a></li>
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
$nome = $_POST['nome'];
$result = mysqli_query($conn, "INSERT INTO objeto(nome) VALUES ('$nome');");

?>

        <?php if($result == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green;"> <?php echo "Cadastrado com sucesso!" ?> </h2>
        <?php } else { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:red;"> <?php echo "ERRO!" ?> </h2> 
    <?php } ?>
    <?php else :
        echo ""; 
    endif; ?>
<div class="container-second" style="padding-top: 200px;">
    <div class="box">
        <form  class="row g-3" style="border-radius: 15px; margin-top: 2%"action = "./cadastrar.php"  method="POST">
        <h3 id="titulo" style="text-align:center;">Cadastrar objeto</h3>
                    <hr>

    <div class="col-md-11" style="justify-content: center;
    align-items: center;" >
    <label for="qtdH" style="width: 80% !important; padding: 0 40px !important;" class="form-label"> <strong>Nome:</strong>
    <br>
    <input type="text" required class="form-control" style = "font-size: medium; " name="nome" > 
</label>
    <br>
    <br>
    <div class="col-12" style="text-align:center;">
    <button type="submit" name = "cadastrar" style = "margin: 1%;"class="btn btn-primary">Enviar</button>
    
    </div>
    </form>
</div>
</div> 


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script>            
        setTimeout(function() {
            $('#msg').fadeOut('fast');
            }, 750);
        </script>  

          
</body>
</html>