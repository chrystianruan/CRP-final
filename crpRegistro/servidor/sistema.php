<?php
    session_start();

    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true) or ($_SESSION['nivelAcesso'] != 30))
    {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('Location: ../index.html');
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
   <link rel="stylesheet" type="text/css" href="./style.css" media="screen" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="shortcut icon" type="imagex/png" href="/crpregistro/imagens/icon-siga.ico">
   <title>Home</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" style="background: #54AEE6 !important; margin-bottom: 2%; height: 105px; ">
    <div class="container-fluid" style="background-color: #54AEE6; margin-bottom: auto !important; height: auto !important;">
                <a class="navbar-brand" href="#">
                    <div class="logo">
                        <img class="logo-siga" src="../imagens/servidor.png"> 
                        
                        <br>
                        <hr class="hr-p">
                        <p class="p-siga"><strong class="p-sigla">Si</strong>stema de <strong class="p-sigla">G</strong>erenciamento das <strong class="p-sigla">A</strong>tas</p>
                    </div>
                </a><font style="color:white; font-weight: normal; text-transform: uppercase; font-size: 20px; margin: 8px;">  Servidor </font>  </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item dropdown">
        <h5> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Cadastrar
          </a> 
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../servidor/objeto/cadastrar.php">Objeto</a></li>
            <li><a class="dropdown-item" href="../servidor/demonstrativo/formCadastroDem.php">Itens</a></li>
            <li><a class="dropdown-item" href="../servidor/registro/formCadastroReg.php">Demandas</a></li>
            <li><a class="dropdown-item" href="../servidor/processos/formCadastroPro.php">Processos</a></li>  
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
            <li><a class="dropdown-item" href="../servidor/demonstrativo/filtroDemonstrativo.php">Demonstrativo</a></li>
            <li><a class="dropdown-item" href="../servidor/demo/filtroMostraDemo.php">Itens</a></li>
            <li><a class="dropdown-item" href="../servidor/registro/filtroRegistro.php">Alterar Demanda</a></li>
            <li><a class="dropdown-item" href="../servidor/processos/filtroProcesso.php">Processos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><strong>Listar</strong></a></li>
          </ul>
        </li>
        </h5>
    </ul>
        <div class="d-flex">  
            <a class="navbar-brand" href="#"><strong style="font-size: 18px"><font style="color:white;">Usuário: <font style="color:#5C2085"><?php echo $logado?></strong></font>  </font></a>    
            <a href="../login/sair.php" class="btn btn-outline-danger ">Sair</a>
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
    
   
    <div class="container-second" style="height: 90% !important;">
    <div class="box">
       
        <form action="sistema.php" style="box-shadow: 0 0 0.5em #808080; width: 100%;" method="POST" class="floatLeft">
                    
                        <br>
                    <h3 id="titulo" style="text-align:center;"> Consulta Demanda </h3>
                    <hr>
                
                    <div class="row" >

                    <div class="col">

                         <label> <strong> Objeto<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select"  id="objeto" name="objeto" required autocomplete="off">
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


                  <div class="col">
 
                        <label> <strong> Órgão<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select" id="orgao" name="orgao" required autocomplete="off">
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

            
                <div class="row justify-content-center">
                <button style="text-align:center" class="btn btn-primary" type="submit" name="enviar" >Enviar</button>
                </div>
                
                       
            </form>
         </div>

         </div>

    

            <?php if(isset($_POST['enviar'])) : ?>
    <?php
    require 'conexao.php';
    $objeto = $_POST["objeto"];
    $orgao = $_POST["orgao"]; 
    $sql = "SELECT * FROM registro AS r1 LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo  WHERE id_orgao = $orgao AND id_objeto = $objeto GROUP BY (numItemDg) HAVING qtdDemandaOrg";
    $result = mysqli_query($conn, $sql); 
    $result2 = mysqli_query($conn, "SELECT * FROM objeto");
    $result3 = mysqli_query($conn, "SELECT * FROM orgao");
   
    
    ?>
    <div>  

    <div class="container-third" style="margin-top:0.3%"> 
    <div class="table-responsive"> 
    <table class="table table-striped table-hover table-bordered caption-top" style="border:5px;"> 
    <caption style="border-top-left-radius: 15px !important; border-top-right-radius: 15px !important;"> 
                <h5> Objeto:  <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;">
                            <?php 
                             while ($dados = mysqli_fetch_assoc($result2)) {
                                if ($objeto == $dados['id']):
                                    echo $dados['nome'];
                                else:
                                    echo "";
                                endif;
                            }
                
                            
                            ?> </font>
                
                        
                            | Órgão:  <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"><?php 
                            while ($dados1 = mysqli_fetch_assoc($result3)) {
                                if ($orgao == $dados1['id']):
                                echo $dados1['nome'];
                            else:
                                echo "";
                            endif; 
                            } 
                        ?></h5>
                    </th>
                        </caption>   
    <thead>
           
            <tr id="tit">
            <td class="td-cabecalho">N° Item</td>
            <td class="td-cabecalho">Descrição item</td>
            <td class="td-cabecalho">Saldo total Global</td>
            <td class="td-cabecalho">Qntd. Demanda</td>
            <td class="td-cabecalho">Qntd. utilizada </td>
            <td class="td-cabecalho">Saldo Órgão</td>
            

            </tr>
        </thead>
    
    <tbody>
        <?php 

    while($dados = mysqli_fetch_assoc($result)) {
        $id_item = $dados['id_item'];
        $numItemDG = $dados['numItemDG'];
        $descItemDemo = $dados['descItemDemo'];
        $saldoTotal = $dados['saldoTotalOrgs'];
        $qtdDemandaOrg = $dados['qtdDemandaOrg'];
        $sql1 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) AS qtd FROM processo WHERE id_item = $id_item;");
        $row = mysqli_fetch_assoc($sql1);
        $qtdUtilizadaOrg = $row['qtd'];
        $saldoOrg = $qtdDemandaOrg - $qtdUtilizadaOrg;
    
       
        
       

    
    ?>
    
    <tr id="itens">

        <td  class="td-corpo" style="text-align: center"> <strong> <?php if($numItemDG < 10) {
                                                            echo "0", $numItemDG;
                                                             } else {
                                                                  echo $numItemDG;
                                                             }
                                                                  ?>  </strong></td>
        <td id="desc"> <?php echo $descItemDemo?> </td>
        <td class="td-corpo"> <?php echo $saldoTotal?> </td>
        <td class="td-corpo"> <?php echo $qtdDemandaOrg ?> </td>
        <td class="td-corpo"> <?php echo $qtdUtilizadaOrg ?> </td>
        <td class="td-corpo" > <?php if($saldoOrg > 0) : ?>
                                                   <strong style="color:green;"> <?php echo $saldoOrg; ?> </strong>
                                            <?php elseif($saldoOrg < 0) :?>
                                               <strong style="color:red;"> <?php echo $saldoOrg; ?> </strong>
                                               <?php else:
                                                        echo $saldoOrg;
                                                        endif;?>
            </td>  
        
        
        
      
    </tr>
   
<?php
    }
?>
    </tbody>


    </table>
   
    </div>
    </div>  
</div>   
</div>
<?php 
else :
    echo "";
endif;
?>
<footer style="height: 90px !important">
    <div>
        <p class="p-footer"> 2021 &copy Governo do Estado do Rio Grande do Norte | Desenvolvimento <strong>COTIC</strong></p>
    </div>
    <hr>
    <div class="container-footer" style="background-color: #54AAE6 !important;">
        <img class="img-compr" src="../imagens/logo-compr.png" alt="Logo-COMPR">
        <img class="img-rn" src="../imagens/logo-rn.png" alt="Logo-RN">
</div>
</footer>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   
</body>
</html>
