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
        header('Location: ../index.html');
    }
    $logado = $_SESSION['usuario'];
    $orgao = $_SESSION['nivelAcesso'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./stylePedidos.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="imagex/png" href="../imagens/icon-siga.ico">
    <title>Document</title>
</head>
<body>

<div>
    
    <?php

    require 'conexao.php';
    $sql = "SELECT * FROM objeto;";
    $result2 = mysqli_query($conn, "SELECT * FROM orgao");
    $result = mysqli_query($conn, $sql);


?>
    
    <div>
    <li style="float:left;margin:10px;"> <a  href="./processos.php">  Processos  </a> </li>
    </div>
    <a style="margin:10px;float:right"  href="/crpRegistro/login/sair.php" class="btn btn-danger ">Sair</a>
    <div class="dvForm">
        <form style = "font-size:medium;margin-top:1%;margin-bottom: 2%; border-radius: 10px"  action="./pedidos.php" method="POST" class="floatLeft">
                    
                        <br>
                    <h3 id="titulo" style="text-align:center;"> Pedidos - 
                    <?php 
                    $orgao = $_SESSION['nivelAcesso'];
                    while ($dadosO = mysqli_fetch_assoc($result2)) {
                        if ($orgao == $dadosO['id']) {
                        echo $dadosO['nome'];
                        }
                    }
                    ?>
                        </h3>
                    <hr>
            
                <div class="campo" style="margin:%">
                    <div class="inputs">
                        
                        <label> <strong> Objeto<strong id="asterisco">*</strong>: </strong> </label>
                        <select style="width:71%" id="objeto" name="objeto" required autocomplete="off">
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
                <button class="btn btn-primary" type="submit" name="enviar" >Enviar</button>
                <br>
                <br>      
            </form> 
        </div>
            
    <?php if(isset($_POST['enviar'])) : ?>

    <?php
    require 'conexao.php';
    $objeto = $_POST["objeto"];
    $sql = "SELECT * FROM registro AS r1 LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo  WHERE id_orgao = $orgao AND id_objeto = $objeto GROUP BY (numItemDg) HAVING qtdDemandaOrg";
    $result = mysqli_query($conn, $sql); 
    $result2 = mysqli_query($conn, "SELECT * FROM objeto");

    
    ?>

    

 
    <div>                   
                    <div style="background-color: rgba(0, 0, 0, 0.1); border-radius: 15px; padding:10px;" class="floatLeft" >
                            
                            <h4 > Objeto:  <font style = "color:red"> <?php 
                             while ($dados = mysqli_fetch_assoc($result2)) {
                                if ($objeto == $dados['id']):
                                    echo $dados['nome'];
                                else:
                                    echo "";
                                endif;
                            }
                
                            
                            ?> </font>
                            </h4>  
                           
                        
                        </div> 
    
    <table class="table table-striped table-hover table-bordered" style="border:5px;"> 
        <thead>
            <tr id="tit">

            <td>N° Item</td>
            <td>Descrição item</td>
            <td>Saldo total Global</td>
            <td>Qntd. Demanda</td>
            <td>Qntd. utilizada </td>
            <td>Saldo Órgão</td>

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

        <td style="text-align: center"> <strong> <?php echo $numItemDG?> </strong></td>
        <td id="desc"> <?php echo $descItemDemo ?> </td>
        <td style="text-align: center"> <?php echo $saldoTotal?> </td>
        <td style="text-align: center"> <?php echo $qtdDemandaOrg ?> </td>
        <td style="text-align: center"> <?php echo $qtdUtilizadaOrg ?> </td>
        <td style="text-align: center"> <?php if($saldoOrg > 0) : ?>
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
 
<?php 
else :
    echo "";
endif;
?>


    
</body>
</html>