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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/filtrar.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="imagex/png" href="/crpregistro/imagens/icon-siga.ico">
    <title>Itens Cadastrados</title>
   
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" style="background: #54AEE6 !important; height: 105px !important;">
       <div class="container-fluid" style="background-color: #54AEE6; margin-bottom: auto !important; height: auto !important;">
                <a class="navbar-brand" href="../sistema.php" >
                  <div class="logo">
                    <img class="logo-siga" src="/crpRegistro/imagens/servidor.png"> 
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
        <h5> <a class="nav-link active" aria-current="page" href="#">Início</a></h5>
        </li>
        <li class="nav-item dropdown">
        <h5> <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Cadastrar
          </a> 
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../demonstrativo/formCadastroDem.php">Itens</a></li>
            <li><a class="dropdown-item" href="../registro/formCadastroReg.php">Demandas</a></li>
            <li><a class="dropdown-item" href="../processos/formCadastroPro.php">Processos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><strong>Consultar</strong></a></li>
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
            <li><a class="dropdown-item" href="../registro/filtroRegistro.php">Alterar Demandas</a></li>
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

    <?php

    require 'conexao.php';
    $sql = "SELECT * FROM objeto;";
    $result = mysqli_query($conn, $sql);
      
 

?> <div class="container-second">
    <div style="box-shadow: 0 0 0.5em #808080;"  class="box">
     <form action="filtroMostraDemo.php"  method="POST" class="floatLeft">
                <h3 id="titulo" style="text-align:center;">Itens cadastrados</h3>
                    <hr>
                    <br> 

                <div class="row" >  

                  <div class="col">
                   <label> <strong> Objeto<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select"  id="objeto" name="objeto" required autocomplete="off">
                          <option selected disabled value="">Selecionar</option>

                        </select> 
                  </div>
                
                  <div class="col">
                    <label> <strong> Empresa: </strong> </label>
                        <select class="form-select" id="empresa" name="empresa" autocomplete="off">
                          <option selected disabled value="">Selecionar</option>
                        </select> 
                    
                  </div>

                </div>
                <br>  
                
               
                <div class="container">
                <button type="submit" name = "enviar" class="btn btn-primary" style="text-align:center;">Enviar</button>
                 </div>   

            </form>

              </div>
            </div>
     
  <?php if(isset($_POST['enviar'])) : ?>
    <?php
    error_reporting(E_ERROR);
    require 'conexao.php';
    $empresa = $_POST["empresa"];
    $objeto = $_POST["objeto"];
   
    $resultObj = mysqli_query($conn, "SELECT * FROM objeto");
    if (isset($objeto) && empty($empresa)) :
        $sql = "SELECT * FROM demonstrativo_global  WHERE id_objetoOrg = $objeto;";
        $result = mysqli_query($conn, $sql); 
    elseif (isset($objeto) && isset($empresa)) :
        $sql = "SELECT * FROM demonstrativo_global WHERE id_objetoOrg = $objeto AND empresa = '$empresa';";
        $result = mysqli_query($conn, $sql);
    endif;

    ?>
      
        
        <div class="container-third">
        <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered caption-top" style="border:5px;">
        <caption style="border-top-left-radius: 15px !important; border-top-right-radius: 15px !important;"> 
        
                         <?php  if(isset($objeto) && empty($empresa)) { ?>

                            <h5> Objeto:  <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"> <?php
                             while ($dados = mysqli_fetch_assoc($resultObj)) {
                                if ($objeto == $dados['id']):
                                    echo $dados['nome'];
                                else:
                                    echo "";
                                endif;
                            }
                           ?> </font>
                          </h5>

                          <?php } elseif(isset($objeto) && isset($empresa)) { ?>
                            <h5> Objeto:  <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;">
                              <?php while ($dados = mysqli_fetch_assoc($resultObj)) {
                                if ($objeto == $dados['id']):
                                    echo $dados['nome'];
                                else:
                                    echo "";
                                endif;
                            } ?> </font> | Empresa: <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;">
                                  <?php echo $empresa;
                                  } ?>  </font>
                            </h5>
                                </caption>
        <thead>
        
            <tr id="tit"> 
                <td class="td-cabecalho">N° Item </td>
                <td class="td-cabecalho">Descrição item</td>
                <td class="td-cabecalho">Marca/Modelo</td>
                <td class="td-cabecalho">Empresa</td>
                <td class="td-cabecalho">Unidade de Medida</td>
                <td class="td-cabecalho">Qntd. Homologada </td>
                <td class="td-cabecalho">Total utilizado</td>
                <td class="td-cabecalho">Valor Unitário</td>
                <td class="td-cabecalho">Valor Total</td>
                <td class="td-cabecalho">Saldo Atual</td>
                <td class="td-cabecalho">Ação</td>
            </tr>
        
            </thead>
        <?php 

        while($dados = mysqli_fetch_assoc($result)) {
        $id_item = $dados['id_demonstrativo'];
        $numItem = $dados['numItemDG'];
        $descItem = $dados['descItemDemo'];
        $marca = $dados['marca'];
        $empresa = $dados['empresa'];
        $unidMedida = $dados['unidMedida'];
        $qtdHomologada = $dados['qtdHomologada'];
        $totalUtilizadaOrgs = $dados['totalUtilizadoOrgs'];
        $valorUnitário = $dados['valorUnit'];
        $valorTotal = $dados['valorTotal'];
        $saldoTotalOrgs = $dados['saldoTotalOrgs'];
        $saldoTotalRes = $qtdHomologada - $totalUtilizadaOrgs;
        
        
        
        
        ?>
        <tbody>
            <tr id="itens">
            <td class="td-corpo" style="text-align: center"> <strong> <?php if($numItem < 10) {
                                                            echo "0", $numItem;
                                                             } else {
                                                                  echo $numItem;
                                                             }
                                                                  ?> </strong> </td>
            <td id="desc"> <?php echo $descItem ?> </td>
            <td class="td-corpo" > <?php echo $marca?>  </td>
            <td class="td-corpo"> <?php echo $empresa?>  </td>
            <td class="td-corpo"> <?php echo $unidMedida?> </td>
            <td class="td-corpo"> <?php echo $qtdHomologada ?> </td>
            <td class="td-corpo"> <?php echo $totalUtilizadaOrgs?> </td>
            <td class="td-corpo"> R$  <?php echo $valorUnitário?> </td>
            <td class="td-corpo"> R$  <?php echo $valorTotal?> </td>
            <td class="td-corpo"> <?php echo $saldoTotalRes?> </td>
            <td class="td-corpo"> <a  href="../demonstrativo/formAlterarDem.php?id=<?php echo $id_item?>"> <img class=img-pen  src="/crpRegistro/imagens/update2.png">  </td>

            </tr>
            </tbody>
        
            <?php 
        }
        ?>
        </table>
        </div>
        </div>
        <?php 
else :
    echo "";
endif;
?>
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
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>    
    
    $(document).ready(() => {
      $.ajax({
        type: 'POST',
        url: 'buscaObjeto.php',
        dataType: 'json',
        success: dados => {
            var option;	
            option += '<option selected disabled value="">'+ 'Selecionar' +'</option>';		
            if (dados.length > 0){
              $.each(dados, function(i, obj){
                option += `<option value =${obj.id}>${obj.nome}</option>`;
              })
            }
            $('#objeto').html(option).show();
        }		
      }) 
    
      $('#objeto').on('change', e => {	
        let objeto = $(e.target).val()
        $.ajax({
            type: 'POST',
            url: 'buscaEmpresa.php',
            data: 'objeto='+objeto, //x-www-form-urlencoded	
            dataType: 'json',
            success: dados => {
                var option;	
                option += '<option selected disabled value="">'+ 'Selecionar' +'</option>';		
                if (dados.length > 0){
                  $.each(dados, function(i, obj){
                    option += `<option value ="${obj.empresa}">${obj.empresa}</option>`;
                  })
                }
                $('#empresa').html(option).show();
            }		
        }) 
      }) 
    })
      </script>
    
</body>
</html>