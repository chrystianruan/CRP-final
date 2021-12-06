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
    <link rel="stylesheet" type="text/css" href="./stylePro.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="imagex/png" href="../imagens/icon-siga.ico">
    <title>Filtro</title>
    
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<div>
    <?php

    require 'conexao.php';
    $sql = "SELECT * FROM objeto;";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, "SELECT * FROM orgao");

?> 

<div>
<li style="float:left;margin:10px;"> <a  href="./pedidos.php">  Pedidos  </a> </li>
</div>
<a style="margin:10px;float:right"  href="/crpRegistro/login/sair.php" class="btn btn-danger ">Sair</a>

<div class="dvForm">
     <form style = "margin-top: 1%; " action="./processos.php" method="POST">
                <h3 id="titulo" style="text-align:center;"> Processos - 
                <?php 
                    while ($dadosO = mysqli_fetch_assoc($result2)) {
                        if ($orgao == $dadosO['id']) {
                        echo $dadosO['nome'];
                        }
                    }
                    ?></h3>
                    <hr>
                    <br> 

                <div class="campo">
                    <div class="inputs"><label> <strong> Objeto<strong id="asterisco">*</strong>: </strong> </label>
                        <select id="objeto" name="objeto"  autocomplete="off">
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
                <div class="campo">
                    <div class="inputs"><label> <strong> N° Processo:   </label>
                        <input class="input-pro" type="text" name="n_Processo" placeholder=" 7777777.666666/AAAA-22"> </input>
                    </div>
                </div>
                
                <br>
                <button class="btn btn-primary" type="submit" style="margin-bottom:2%" name = "enviar">Enviar</button>
            </form>
</div>
            <?php if(isset($_POST['enviar'])) : ?>
    <?php
    require 'conexao.php';
    $objeto = $_POST["objeto"];
    $n_Processo = $_POST["n_Processo"];
    $result2 = mysqli_query($conn, "SELECT * FROM objeto");
    $sql = "SELECT * FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE r1.id_orgao = $orgao AND r1.id_objeto = $objeto;";
    $result = mysqli_query($conn, $sql);            

    ?>
    <div style=" background-color: rgba(0, 0, 0, 0.1); border-radius: 4%; padding:0.6%;" class="floatLeft">
      
                            
                            <h4 > Objeto:  <font style = "color:red"> <?php 
                             while ($dados1 = mysqli_fetch_assoc($result2)) {
                                if ($objeto == $dados1['id']):
                                    echo $dados1['nome'];
                                else:
                                    echo "";
                                endif;
                            }
                            ?> </font>
                            </h4>  

        </div>
        
   
    <div>
        <table class="table table-striped table-hover table-bordered"  style="border:5px;" >
            <thead>
                <tr id="tit"> 

                    <td>N° Item </td>
                    <td>Descrição item</td>
                    <td>N° do processo</td>
                    <td>Data do Processo</td>
                    <td>Qntd. utilizada </td>

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
                <td style="text-align: center"> <strong> <?php echo $numItem?> </strong> </td>
                <td id="desc"> <?php echo $descItem ?> </td>
                <td style="text-align: center"> <?php echo $n_Processo?> </td>
                <td style="width:100px;text-align: center"> <?php echo $data_processo ?> </td>
                <td style="text-align: center"> <?php echo $qtdUtilizadaProcesso ?> </td>
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
    </body>
</html>