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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/cadastrar.css" media="screen"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="/imagens/icon-siga.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Cadastro</title>
</head>

<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="background: #54AEE6 !important;">
       <div class="container-fluid" style="background-color: #54AEE6; margin-bottom: auto !important; height: auto !important;">
                <a class="navbar-brand" href="../sistema.php" >
                  <div class="logo">
                    <img class="logo-siga" src="/imagens/servidor.png"> 
                    <br>
                    <hr class="hr-p">
                    <p class="p-siga"><strong class="p-sigla">Si</strong>stema de <strong class="p-sigla">G</strong>erenciamento das <strong class="p-sigla">A</strong>tas</p>
                  </div>
                </a><font style="color:white; font-weight: normal; text-transform: uppercase; font-size: 20px; margin: 8px;">  Servidor </font>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      
       <li class="nav-item">
<h5> <a class="nav-link active" aria-current="page" href="../sistema.php">Início</a></h5>
</li>

<li class="nav-item dropdown">
        <h5> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Cadastrar 
          </a> 
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="../objeto/cadastrar.php">Objeto</a></li>
            <li><a class="dropdown-item" href="../fornecedor/cadastrar.php">Fornecedor</a></li>
            <li><a class="dropdown-item" href="../registro/formCadastroReg.php">Demandas</a></li>
            <li><a class="dropdown-item" href="../processos/formCadastroPro.php">Usos</a></li>
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
            <li><a class="dropdown-item" href="../registro/filtroRegistro.php">Demandas(alterar)</a></li>
            <li><a class="dropdown-item" href="../processos/filtroProcesso.php">Usos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><strong>Consultar</strong></a></li>
          </ul>
        </li>
        </h5>
    </ul>
        <div class="d-flex">  
        <a class="navbar-brand" href="#"><strong style="font-size: 18px"><font style="color:white;">Usuário: <font style="color:#5C2085"><?php echo $logado?></strong></font>  </font></a>      
            <a href="/login/sair.php" class="btn btn-outline-danger ">Sair</a>
            </div>
        </div>
    </div>
</nav>

<?php if(isset($_POST['cadastrar'])) : ?>

<?php
require 'conexao.php';
$numItemDG = $_POST['numItemDG'];
$descItemDemo = $_POST['descItemDemo'];
$marca = $_POST['marca'];
$fornecedor = $_POST['fornecedor'];
$objeto = $_POST['objeto'];
$unidMedida = $_POST['unidMedida'];
$qtdHomologada = $_POST['qtdHomologada'];
$valorUnit = $_POST['valorUnit'];
$sql = "INSERT INTO demonstrativo_global(numItemDG, situacao, descItemDemo, marca, id_fornecedor, unidMedida, qtdHomologada, valorUnit, id_objetoOrg) VALUES ($numItemDG, 0, '$descItemDemo', '$marca', $fornecedor, '$unidMedida', $qtdHomologada, $valorUnit, $objeto);";
$resultA = mysqli_query($conn, $sql);

?>


    
        <?php if($resultA == true) { ?>
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
    

    

    ?>
<div style="height: 80%; justify-content: center;
        align-items: center; margin: 2%">
        <form  class="row g-3" action = "./formCadastroDem.php"  style="margin:3%;box-shadow: 0 0 1em #808080;" method="POST">
        <h2 style="text-align:center;" id="titulo">Cadastrar Item</h2>
                    <hr>
                    
        <div style = "position: relative; margin-left: auto; margin-right: auto;" class="col-md-2">
                        <label class="form-label" > <strong> Objeto<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select" id="objeto" name="objeto" required autocomplete="off">
                          <option selected disabled value="">Selecionar</option>
                              <?php if((isset($_POST['cadastrar']) && $resultA == false) || (isset($_POST['cadastrar']) && $resultA == true))  { ?>
                                <option selected value="<?php echo $objeto ?>">  <?php 
                                                                                include_once('conexao.php');
                                                                                $result2 = mysqli_query($conn, "SELECT * FROM objeto;");
                                                                                while ($dados2 = mysqli_fetch_assoc($result2)) {
                                                                                    if($objeto == $dados2['id']) {
                                                                                        echo $dados2['nome'];
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>                
                                                                        
                                                                        </option>
                        
                        <?php
                        $result2 = mysqli_query($conn, "SELECT * FROM fornecedor");
                            while ($dados = mysqli_fetch_assoc($result)) {

                        ?>
                        <option value="<?php echo $dados['id'] ?>">
                                <?php echo $dados['nome'] ?>
                        </option>
                                <?php 
                            }
                            ?>
                        </select> 
                </div>
    <hr>          

    <div class="col-md-1" style="margin:1%;">
    <label class="form-label" > <strong>N° Item:</strong> </label> <br>
    <input type="number" class="form-control" required style = "font-size: medium;" name="numItemDG" <?php if(isset($_POST['cadastrar']) && $resultA == false) {?> value="<?php echo $numItemDG?>" <?php }  ?> > 
    </div>

    <div class="col-md-4" style="margin:1%;">
    <label class="form-label" > <strong>Descrição:</strong> </label> <br>
    <textarea  rows = 6 cols=50 required class="form-control" style = "font-size: medium;" name="descItemDemo" > <?php if(isset($_POST['cadastrar']) && $resultA == false) {?> <?php echo $descItemDemo?> <?php } ?></textarea> 
    </div>

    <div class="col-md-3" style="margin:1%;">
    <label class="form-label" > <strong>Marca/Modelo:</strong> </label> <br>
    <textarea  rows = 4 cols=10 class="form-control" style = "font-size: medium;" name="marca" > <?php if(isset($_POST['cadastrar']) && $resultA == false) {?> <?php echo $marca?> <?php } ?></textarea> 
    </div>

    <div class="col-md-3" style="margin:1%;">
                        <label class="form-label" > <strong> Fornecedor<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select" id="fornecedor" name="fornecedor" required autocomplete="off">
                          <option selected disabled value="">Selecionar</option>
                        <?php
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
    <label class="form-label"> <strong>Unidade de medida:</strong> </label> <br>
    <input type="text" required class="form-control" style = "font-size: medium; " name="unidMedida" <?php if(isset($_POST['cadastrar']) && $resultA == false) {?> value="<?php echo $unidMedida?>" <?php } elseif(isset($_POST['cadastrar']) && $resultA == true)  { ?> value="<?php echo $unidMedida?>" <?php } ?> > 
    </div>

    <div class="col-md-1" style="margin:1%;">
    <label class="form-label"> <strong>Quantidade homologada:</strong> </label> <br>
    <input type="number" required class="form-control" min="0" style = "font-size: medium; " name="qtdHomologada"  <?php if(isset($_POST['cadastrar']) && $resultA == false) {?> value="<?php echo $qtdHomologada?>" <?php } ?>> 
 
    </div>
          

    <div class="col-md-1" style="margin:1%;">
    <label for="qtdH"  class="form-label"> <strong>Valor Unitário:<font style="color:green">(R$)</font></strong> </label> <br>
    <input type="number" required class="form-control"  placeholder = "0.0" step="0.01"  min="0" style="color:red;font-size: medium"  name="valorUnit" <?php if(isset($_POST['cadastrar']) && $resultA == false) {?> value="<?php echo $valorUnit?>" <?php }?>> 
    </div>


    <div class="col-12" style="text-align:center;">
    <button type="submit" name = "cadastrar" style = "margin: 1%;" class="btn btn-primary">Enviar</button>
    
    </div>
    

            
                   
                        </div>
            </form>
            </div>
            <footer>
    <div>
        <p class="p-footer"> 2021 &copy Governo do Estado do Rio Grande do Norte | Desenvolvimento <strong>COTIC</strong></p>
    </div>
    <hr>
    <div class="container-footer">
        <img class="img-compr" src="/imagens/logo-compr.png" alt="Logo-COMPR">
        <img class="img-rn" src="/imagens/logo-rn.png" alt="Logo-RN">
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
setTimeout(function() {
   $('#msg').fadeOut('fast');
}, 2000);
</script>

</body>
</html>
