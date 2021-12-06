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
    <title>Processos</title>
    
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
                </a>
                <font style="color:white; font-weight: normal; text-transform: uppercase; font-size: 20px; margin: 8px">  Servidor </font>
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
           Cadastro 
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
            <li><a class="dropdown-item" href="../registro/filtroRegistro.php">Alterar Demanda</a></li>
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
    $sql2 = "SELECT * FROM orgao ORDER BY nome;";
    $result2 = mysqli_query($conn, $sql2);

?> 
<div class="container-second">
    <div class="box" style="box-shadow: 0 0 0.5em #808080;"> 
     <form  class="row g-3" action="./filtroProcesso.php" method="POST">
                
                <h3 id="titulo" style="text-align:center;"> Lista de Processos </h3>
                    <hr>
                    <br> 

                  
                    <div class=row> 
                    <div class="col" >
                    <label class="form-label"> <strong> Objeto<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select" required id="objeto" name="objeto"  autocomplete="off">
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

               

                <div class="col" >
                    <label class="form-label"> <strong> Órgão<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select" required id="orgao" name="orgao"  autocomplete="off">
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
                
                <hr>

                <div class="col-md-8"  style="text-align: left">
                    <label class="form-label"> <strong> N° Processo:   </strong></label>
                        <input class="form-control" type="text" name="n_Processo" placeholder=" 7777777.666666/AAAA-22">
                 </div>
               
            
                <div class="col" style="text-align: center">
                <button type="submit" class="btn btn-primary" name = "enviar">Enviar</button>
                </div>
                       
            </form>

                        </div>
                        </div>

            <?php if(isset($_POST['enviar'])) : ?>
    <?php
    require 'conexao.php';
    $objeto = $_POST["objeto"];
    $orgao = $_POST["orgao"]; 
    $n_Processo = $_POST["n_Processo"];
    $result2 = mysqli_query($conn, "SELECT * FROM objeto");
    $result3 = mysqli_query($conn, "SELECT * FROM orgao");
    
    if (isset($objeto) && isset($orgao) && empty($n_Processo)) :
        $sql = "SELECT * FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE r1.id_orgao = $orgao AND r1.id_objeto = $objeto;";
        $result = mysqli_query($conn, $sql); 
    elseif (isset($objeto) && isset($orgao) && isset($n_Processo)) :
        $sql = "SELECT * FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE r1.id_orgao = $orgao AND r1.id_objeto = $objeto AND n_Processo = '$n_Processo';";
        $result = mysqli_query($conn, $sql);
    elseif (empty($objeto) && empty($orgao) && isset($n_Processo)) :
        $sql = "SELECT * FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE n_Processo = '$n_Processo';";
        $result = mysqli_query($conn, $sql);
    endif;

    ?>
    
   
        <div>
        <div class="container-third">
        <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered caption-top"  style="border:5px;" >
        <caption style="border-top-left-radius: 15px !important; border-top-right-radius: 15px !important;">
      
      <?php if(isset($objeto) && isset($orgao) && empty($n_Processo)) : ?>
                              
                              <h5 > Objeto:  <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"><?php 
                               while ($dados = mysqli_fetch_assoc($result2)) {
                                  if ($objeto == $dados['id']):
                                      echo $dados['nome'];
                                  else:
                                      echo "";
                                  endif;
                              }
                  
                              
                              ?> </font>
                  
                          
                              | Órgão: <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"> <?php 
                              while ($dados1 = mysqli_fetch_assoc($result3)) {
                                  if ($orgao == $dados1['id']):
                                  echo $dados1['nome'];
                              else:
                                  echo "";
                              endif; 
                              } 
                          ?>
                              </h5>  
                             
                          
                         
      <?php elseif (isset($objeto) && isset($orgao) && isset($n_Processo)) :
          ?> 
       <h5 > Objeto:  <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"><?php 
                               while ($dados = mysqli_fetch_assoc($result2)) {
                                  if ($objeto == $dados['id']):
                                      echo $dados['nome'];
                                  else:
                                      echo "";
                                  endif;
                              }
                  
                              
                              ?> </font>
                  
                          
                              | Órgão: <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"> <?php 
                              while ($dados1 = mysqli_fetch_assoc($result3)) {
                                  if ($orgao == $dados1['id']):
                                  echo $dados1['nome'];
                              else:
                                  echo "";
                              endif; 
                          } 
                          ?></font>
                              
          | N° do processo:   <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"> <?php echo $n_Processo ?>  </font> </h5>
          <?php elseif (empty($objeto) && empty($orgao) && isset($n_Processo)) : ?>
              <h5> N° do processo:   <font style="color:red;"> <?php echo $n_Processo ?>  </font>  </h5>
      <?php endif; ?>  
  
          </caption>
            <thead>
                <tr id="tit"> 
                    <td class="td-cabecalho"> N° Item </td>
                    <td class="td-cabecalho">Descrição item</td>
                    <td class="td-cabecalho">ID Item<font style="color:blue"> (REGISTRO)</font></td>
                    <td class="td-cabecalho">N° do processo</td>
                    <td class="td-cabecalho">Data do Processo</td>
                    <td class="td-cabecalho">Qntd. utilizada </td>
                    <td class="td-cabecalho">Ações</td>
                </tr>
            </thead>
        <?php 

        while($dados = mysqli_fetch_assoc($result)) {
        $id_processo = $dados['id'];
        $numItem = $dados['numItemDG'];
        $id_item = $dados['id_item'];
        $descItem = $dados['descItemDemo'];
        $n_Processo = $dados['n_Processo'];
        $data_processo = $dados['data_processo'];
        $qtdUtilizadaProcesso = $dados['qtdUtilizadaProcesso'];
        
        
        ?>
        <tbody>
            <tr id="itens">
          
                <td class="td-corpo"> <strong> <?php echo $numItem?> </strong> </td>
                <td id="desc"> <?php echo $descItem ?> </td>
                <td class="td-corpo"> <strong style="color:blue"> <?php echo $id_item?> </strong>  </td>
                <td class="td-corpo"> <?php echo $n_Processo?> </td>
                <td class="td-corpo"> <?php echo $data_processo ?> </td>
                <td class="td-corpo"> <?php echo $qtdUtilizadaProcesso ?> </td>
                <td class="td-corpo"> <a  class="button-acao" style = "padding-right: 5px;" href="formAlterarPro.php?id=<?php echo $id_processo?>"> <img class="img-pen" src="/crpRegistro/imagens/update2.png">   </td>
            

            </tr>
        </tbody>

        <?php 
        }
        ?>

        </table>
</div>  
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
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>