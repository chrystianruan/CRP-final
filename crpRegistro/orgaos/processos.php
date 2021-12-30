<?php
    session_start();

    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true) or ($_SESSION['nivelAcesso'] != 1 and $_SESSION['nivelAcesso'] != 2  and $_SESSION['nivelAcesso'] != 3 and $_SESSION['nivelAcesso'] != 4 
    and $_SESSION['nivelAcesso'] != 5 and $_SESSION['nivelAcesso'] != 6 and $_SESSION['nivelAcesso'] != 7 and $_SESSION['nivelAcesso'] != 8  
    and $_SESSION['nivelAcesso'] != 9 and $_SESSION['nivelAcesso'] != 10 and $_SESSION['nivelAcesso'] != 11 and $_SESSION['nivelAcesso'] != 12 
    and $_SESSION['nivelAcesso'] != 13 and $_SESSION['nivelAcesso'] != 14 and $_SESSION['nivelAcesso'] != 15 
    and $_SESSION['nivelAcesso'] != 17 and $_SESSION['nivelAcesso'] != 18 and $_SESSION['nivelAcesso'] != 19 and $_SESSION['nivelAcesso'] != 20 and
    $_SESSION['nivelAcesso'] != 21 and $_SESSION['nivelAcesso'] != 22 and $_SESSION['nivelAcesso'] != 23 and $_SESSION['nivelAcesso'] != 24 and
    $_SESSION['nivelAcesso'] != 25 and $_SESSION['nivelAcesso'] != 26 and $_SESSION['nivelAcesso'] != 27 and $_SESSION['nivelAcesso'] != 28 and
    $_SESSION['nivelAcesso'] != 41 and $_SESSION['nivelAcesso'] != 42 and $_SESSION['nivelAcesso'] != 43 and $_SESSION['nivelAcesso'] != 44 and
    $_SESSION['nivelAcesso'] != 45 and $_SESSION['nivelAcesso'] != 46 and $_SESSION['nivelAcesso'] != 47 and $_SESSION['nivelAcesso'] != 48 and
    $_SESSION['nivelAcesso'] != 49 and $_SESSION['nivelAcesso'] != 50 and $_SESSION['nivelAcesso'] != 51 and $_SESSION['nivelAcesso'] != 52 and
    $_SESSION['nivelAcesso'] != 53 and $_SESSION['nivelAcesso'] != 54 and $_SESSION['nivelAcesso'] != 55 and $_SESSION['nivelAcesso'] != 56 and
    $_SESSION['nivelAcesso'] != 57 and $_SESSION['nivelAcesso'] != 58 and $_SESSION['nivelAcesso'] != 59 and $_SESSION['nivelAcesso'] != 60 and
    $_SESSION['nivelAcesso'] != 61 and $_SESSION['nivelAcesso'] != 62 and $_SESSION['nivelAcesso'] != 63 and $_SESSION['nivelAcesso'] != 64 and
    $_SESSION['nivelAcesso'] != 65 and $_SESSION['nivelAcesso'] != 66 and $_SESSION['nivelAcesso'] != 67 and $_SESSION['nivelAcesso'] != 68 and
    $_SESSION['nivelAcesso'] != 69 and $_SESSION['nivelAcesso'] != 70 and $_SESSION['nivelAcesso'] != 71 and $_SESSION['nivelAcesso'] != 72 and
    $_SESSION['nivelAcesso'] != 73 and $_SESSION['nivelAcesso'] != 74))
    {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('Location: /crpRegistro/index.html');
    }
    $logado = $_SESSION['usuario'];
    $orgao = $_SESSION['nivelAcesso'];
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="/imagens/icon-siga.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Filtro</title>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" style="background: #54AEE6 !important;">
       <div class="container-fluid" style="background-color: #54AEE6; margin-bottom: auto !important; height: auto !important;">
                <a class="navbar-brand" href="pedidos.php" >
                  <div class="logo">
                    <img class="logo-siga" src="/imagens/servidor.png"> 
                    <br>
                    <hr class="hr-p">
                    <p class="p-siga"><strong class="p-sigla">Si</strong>stema de <strong class="p-sigla">G</strong>erenciamento das <strong class="p-sigla">A</strong>tas</p>
                  </div>
                </a><font style="color:white; font-weight: normal; font-size: 20px; margin: 8px;">  Órgão: <font style="color: red; font-weight: bold"> <?php 
                    $orgao = $_SESSION['nivelAcesso'];
                    require 'conexao.php'; 
                    $result2 = mysqli_query($conn, "SELECT * FROM orgao");
                    while ($dadosO = mysqli_fetch_assoc($result2)) {
                        if ($orgao == $dadosO['id']) {
                        echo $dadosO['nome'];
                        }
                    }
                    ?> </font> </font>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <h5> <a class="nav-link active" aria-current="page" href="#">Início</a></h5>
        </li>
        <li class="nav-item">
        <h5> <a class="nav-link active" aria-current="page" href="pedidos.php">Pedidos</a></h5>
        </li>
    </ul>
        <div class="d-flex">  
            <a class="navbar-brand" href="#"><strong style="font-size: 18px"><font style="color:white;">Usuário: <font style="color:#5C2085;text-transform:lowercase"><?php echo $logado?></strong></font>  </font></a>    
            <a href="/login/sair.php" class="btn btn-outline-danger ">Sair</a>
            </div>
        </div>
    </div>
</nav>



<div>
    <?php

    require 'conexao.php';
    $sql = "SELECT * FROM objeto;";
    $result = mysqli_query($conn, $sql);
    

?> 

<div class="container-second">
    <div class="box">
     <form style = "font-size:medium;margin-top:1%;margin-bottom: 2%; border-radius: 5px"  action="./processos.php" method="POST" class="floatLeft">
                <h3 id="titulo" style="text-align:center;margin-top: 5%"> Usos 
                </h3>
                    <hr>
                    

                  

                    <div class="campo">
                    <div class="inputs"><label> <strong> Objeto<strong id="asterisco">*</strong>: </strong> </label>
                        <select required id="objeto" name="objeto" class="form-select" autocomplete="off">
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
    $result2 = mysqli_query($conn, "SELECT * FROM objeto");
    $sql = "SELECT * FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE r1.id_orgao = $orgao AND r1.id_objeto = $objeto;";
    $result = mysqli_query($conn, $sql);            

    ?>
<?php if(mysqli_fetch_assoc($result) == null) { ?>
                 <div class="alert alert-primary d-flex align-items-center" style="padding: 20px; margin: 3% 20% 0 20%; text-align: center" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
  <div>
    <?php while ($dados = mysqli_fetch_assoc($result2)) {
                                if ($objeto == $dados['id']) {
                                    echo "Não existem processos para {$dados['nome']} ";
                                } else  {
                                    echo "";
                                }
                            }
                 ?>
  </div>
</div>
   <?php } else { ?>
    

   
<div class="container-third" style="margin-top:0.3%"> 
    <div class="table-responsive"> 
        <table class="table table-striped table-hover table-bordered caption-top"  style="border:5px;" >
            <thead>
            <caption style="border-top-left-radius: 15px !important; border-top-right-radius: 15px !important;"> <h5> Objeto:  <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"><?php 
                             while ($dados = mysqli_fetch_assoc($result2)) {
                                if ($objeto == $dados['id']):
                                    echo $dados['nome'];
                                else:
                                    echo "";
                                endif;
                            }
                
                            
                            ?> </font>
            
                        </caption>
   
                <tr id="tit"> 

                    <td class="td-cabecalho">N° Item </td>
                    <td class="td-cabecalho">Descrição item</td>
                    <td class="td-cabecalho">N° do processo</td>
                    <td class="td-cabecalho">Data do Processo</td>
                    <td class="td-cabecalho">Qntd. utilizada </td>

                </tr>
            </thead>
        <?php 
	$sql = "SELECT * FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE r1.id_orgao = $orgao AND r1.id_objeto = $objeto;";

        $result = mysqli_query($conn, $sql);
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
                <td class="td-corpo" > <strong> <?php echo $numItem?> </strong> </td>
                <td class="td-corpo"> <?php echo $descItem ?> </td>
                <td class="td-corpo"> <?php echo $n_Processo?> </td>
                <td class="td-corpo"> <?php echo date('d/m/Y', strtotime($data_processo)) ?> </td>
                <td class="td-corpo"> <?php echo $qtdUtilizadaProcesso ?> </td>
               
            

            </tr>
            <?php 
        }
	}
        ?>  
        </tbody>

       

        </table>

    </div>
    
    <?php 
else :
    echo "";
endif;
?>
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
</body>
</html>
