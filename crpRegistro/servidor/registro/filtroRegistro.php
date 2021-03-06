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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="/imagens/icon-siga.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  

    <title>Consulta</title>
</head>

<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" style="background: #54AEE6 !important;">
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
        <h5> <a class="nav-link active" aria-current="page" href="../sistema.php ">In??cio</a></h5>
        </li>
        <li class="nav-item dropdown">
        <h5> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Cadastrar
          </a> 
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="../objeto/cadastrar.php">Objeto</a></li>
            <li><a class="dropdown-item" href="../fornecedor/cadastrar.php">Fornecedor</a></li>
            <li><a class="dropdown-item" href="../demonstrativo/formCadastroDem.php">Itens</a></li>
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
            <li><a class="dropdown-item" href="../processos/filtroProcesso.php">Usos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><strong>Consultar</strong></a></li>
          </ul>
        </li>
        </h5>
    </ul>
    <div class="d-flex">  
        <a class="navbar-brand" href="#"><strong style="font-size: 18px"><font style="color:white;">Usu??rio: <font style="color:#5C2085"><?php echo $logado?></strong></font>  </font></a>     
            <a href="/login/sair.php" class="btn btn-outline-danger ">Sair</a>
            </div>
        </div>
    </div>
</nav>



    
    <?php

    require 'conexao.php';
    $sql = "SELECT * FROM objeto;";
    $result = mysqli_query($conn, $sql);
    $sql2 = "SELECT * FROM orgao ORDER BY nome;";
    $result2 = mysqli_query($conn, $sql2);

?>
    
    
    <div class="container-second">
    <div class="box" style="box-shadow: 0 0 0.5em #808080;"> 
        <form class="row g-3" action="filtroRegistro.php" method="POST" >
                    
  
                    <h3 id="titulo" style="text-align:center;"> Demandas(alterar) </h3>
                    <hr>
                
                <div class="row" >  
                <div class="col" style="margin: 10px" >
                   
                        
                        <label class="form-label"> <strong> Objeto<strong id="asterisco">*</strong>: </strong> </label>
                        
                        <select class="form-select" id="objeto" name="objeto" required autocomplete="off">
                          <option selected disabled value="">Selecionar</option>
                        <?php
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

                <br> 

                <div class="col" style="margin: 10px">
                   
                        
                        <label class="form-label" > <strong> ??rg??o<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select"  id="orgao" name="orgao" required autocomplete="off">
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

                </div>
                <br> 

            
                <div class="col" style="text-align:center;">
                <button class="btn btn-primary" type="submit" name="enviar" >Enviar</button>
                </div>
                
            
                
                       
            </form> 
            </div>
        </div>
            
             

    <?php if(isset($_POST['enviar'])): ?>

    <?php
    require 'conexao.php';
    $objeto = $_POST["objeto"];
    $orgao = $_POST["orgao"]; 
    $sql = "SELECT * FROM registro AS r1 LEFT JOIN demonstrativo_global AS dg ON r1.id_demonstrativo = dg.id_demonstrativo LEFT JOIN fornecedor AS f ON dg.id_fornecedor = f.id WHERE id_orgao = $orgao AND id_objeto = $objeto";
    $result = mysqli_query($conn, $sql); 
    $result2 = mysqli_query($conn, "SELECT * FROM objeto");
    $result3 = mysqli_query($conn, "SELECT * FROM orgao");
    
    ?>

    

 
                   
   
    <div class="container-third">
        <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered caption-top" style="border:5px;"> 
    <caption style="border-top-left-radius: 15px !important; border-top-right-radius: 15px !important;">
                            
                            <h5> Objeto:  <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"> <?php 
                             while ($dados = mysqli_fetch_assoc($result2)) {
                                if ($objeto == $dados['id']):
                                    echo $dados['nome'];
                                else:
                                    echo "";
                                endif;
                            }
                
                            
                            ?> </font>
                
                        
                            | ??rg??o:  <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"> <?php 
                            while ($dados1 = mysqli_fetch_assoc($result3)) {
                                if ($orgao == $dados1['id']):
                                echo $dados1['nome'];
                            else:
                                echo "";
                            endif; 
                            } 
                        ?>
                            </h5>  
                           
                        
                        </caption> 
        <thead>
            <tr id="tit">
         
           
            <td class="td-cabecalho">N?? Item</td>
            <td class="td-cabecalho">Descri????o item</td>
            <td class="td-cabecalho">Empresa</td>
            <td class="td-cabecalho">Saldo total Global</td>
            <td class="td-cabecalho">Qntd. Demanda</td>
            <td class="td-cabecalho">Qntd. utilizada </td>
            <td class="td-cabecalho">Saldo ??rg??o</td>
            <td class="td-cabecalho">A????o</td>

            </tr>
        </thead>
    
    <tbody>
        <?php 

    while($dados = mysqli_fetch_assoc($result)) {
        $id_item = $dados['id_item'];
        $numItemDG = $dados['numItemDG'];
        $descItemDemo = $dados['descItemDemo'];
        $fornecedor = $dados['nome'];
        $situacao = $dados['situacao'];
        $saldoTotal = $dados['saldoTotalOrgs'];
        $qtdDemandaOrg = $dados['qtdDemandaOrg'];
        $sql1 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) AS qtd FROM processo WHERE id_item = $id_item;");
        $row = mysqli_fetch_assoc($sql1);
        $qtdUtilizadaOrg = $row['qtd'];
        $saldoOrg = $qtdDemandaOrg - $qtdUtilizadaOrg;
       

    
    ?>
    
    <tr id="itens" <?php if($situacao == 1) {?> style="background-color: red !important" <?php } ?> > 

        
     
        <td class="td-corpo" style="text-align: center"> <strong> <?php if($numItemDG < 10) {
                                                            echo "0", $numItemDG;
                                                             } else {
                                                                  echo $numItemDG;
                                                             }
                                                                  ?> </strong></td>
        <td id="desc"> <?php echo $descItemDemo ?> </td>
        <td class="td-corpo"> <?php echo $fornecedor ?> </td>
        <td class="td-corpo" style="text-align: center"> <?php echo $saldoTotal?> </td>
        <td class="td-corpo" style="text-align: center"> <?php echo $qtdDemandaOrg ?> </td>
        <td class="td-corpo" style="text-align: center"> <?php echo $qtdUtilizadaOrg ?> </td>
        <td class="td-corpo" style="text-align: center"> <?php if($saldoOrg > 0) : ?>
                                                   <strong style="color:green;"> <?php echo $saldoOrg; ?> </strong>
                                            <?php elseif($saldoOrg < 0) :?>
                                               <strong style="color:red;"> <?php echo $saldoOrg; ?> </strong>
                                               <?php else:
                                                        echo $saldoOrg;
                                                        endif;?>
            </td>  
        <td style="width:70px; height:30px;padding: 7px;"> <a class="button-acao" name="alterar1" href="formAlterar.php?id=<?php echo $id_item?>"> <img class="img-pen" style="margin-left:20%" src="/imagens/update2.png"> </td>
        
        
      
    </tr>
   
<?php
    }
?>
    </tbody>


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
        <img class="img-compr" src="/imagens/logo-compr.png" alt="Logo-COMPR">
        <img class="img-rn" src="/imagens/logo-rn.png" alt="Logo-RN">
</div>
</footer>
 

    
</body>
</html>
