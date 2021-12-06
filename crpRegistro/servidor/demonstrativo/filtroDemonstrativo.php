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
    <title>Demonstrativo filtro</title>
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
            <font style="color:white; font-weight: normal; text-transform: uppercase; font-size: 20px; margin: 8px;">  Servidor </font>
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
            <a href="/crpRegistro/login/sair.php" class="btn btn-danger ">Sair</a>
            </div>
        </div>
    </div>
</nav>

    
    <?php 
    
    require 'conexao.php';
    $sql = "SELECT * FROM objeto;";
    $result = mysqli_query($conn, $sql);
    
    
    ?>
    <div class="container-second">
    <div style="box-shadow: 0 0 0.5em #808080;" class="box">     
    <form  action="./filtroDemonstrativo.php" method="POST">

                        <h3 id="titulo" style="text-align:center;">Demonstrativo</h3>
                    <hr>
                    <br> 
                
                <div class="campo">
                    <div class="inputs"><label> <strong> Objeto<strong id="asterisco">*</strong>: </strong> </label>
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
                </div>
                <br>
                <div class="container">
                 <button class="btn btn-primary" type="submit" name = "enviar">Enviar</button>
            <br>     
            </div>
    

           
      </form>
                        </div>
                        </div>
          


    
            <?php if(isset($_POST['enviar'])) : ?>
    <?php 
     require 'conexao.php';
     $objeto = $_POST["objeto"];
     $sql = "SELECT * FROM demonstrativo_Global AS dg  WHERE id_objetoOrg = $objeto;";
     $result = mysqli_query($conn, $sql);
     $result1 = mysqli_query($conn, "SELECT * FROM objeto;");
    
    ?>
      

        

        
      <div style="font-size: medium;border:5px; margin: 1% 3% 2% 3%; height: 800px; max-width: 100%; min-height: 80%; max-height: 80%; overflow: scroll;">                  
      <table class="table table-striped table-hover table-bordered caption-top"  style="border:5px;" name="tabela"> 
      <caption style="border-top-left-radius: 15px !important; border-top-right-radius: 15px !important;"> <h5> Objeto:  <font style = "color:#54AEE6; font-weight: bold; text-transform: capitalize;"><?php 
                             while ($dados = mysqli_fetch_assoc($result1)) {
                                if ($objeto == $dados['id']):
                                    echo $dados['nome'];
                                else:
                                    echo "";
                                endif;
                            }
                
                            
                            ?> </font>
            
                        </caption>
      <thead >
     
        <tr id="tit" >
       
            <td  class="td-cabecalho">N° Item</td>
            <td  class="td-cabecalho" style="text-align:center;" >Descrição</td>
            <td  class="td-cabecalho">Qntd. Homologada</td>
            <td  class="td-cabecalho">Total utilizado</td>
            <td  class="td-cabecalho">Saldo Total </td>
            <td  class="td-cabecalho"> ARSEP </td>
            <td  class="td-cabecalho"> ASSECOM </td>
            <td  class="td-cabecalho"> CBM </td>
            <td  class="td-cabecalho"> CONTROL </td>
            <td  class="td-cabecalho"> DEI </td>
            <td  class="td-cabecalho"> DER </td>
            <td  class="td-cabecalho"> FAPERN </td>
            <td  class="td-cabecalho"> FUNDASE </td>
            <td  class="td-cabecalho"> GAC </td>
            <td  class="td-cabecalho"> ITEP </td>
            <td  class="td-cabecalho"> JUCERN</td>
            <td  class="td-cabecalho"> PC </td>
            <td  class="td-cabecalho"> PM </td>
            <td  class="td-cabecalho"> SAPE </td>
            <td  class="td-cabecalho"> SEMJIDH</td>
            <td  class="td-cabecalho"> SEDRAF </td>
            <td  class="td-cabecalho"> SEAD </td>
            <td  class="td-cabecalho"> SEEC</td>
            <td  class="td-cabecalho"> SEMARH </td>
            <td  class="td-cabecalho"> SEPLAN</td>
            <td  class="td-cabecalho"> SEAP</td>
            <td  class="td-cabecalho"> SESAP </td>
            <td  class="td-cabecalho"> SESED </td>
            <td  class="td-cabecalho"> SET</td>
            <td  class="td-cabecalho"> SETHAS</td>
            <td  class="td-cabecalho"> SETUR </td>
            <td  class="td-cabecalho"> SIN</td>
            <td  class="td-cabecalho"> UERN </td>
            <td  class="td-cabecalho"> SEDEC </td>
            <td  class="td-cabecalho"> DETRAN </td>
            <td  class="td-cabecalho"> EMATER </td>
            <td  class="td-cabecalho"> IDEMA</td>
            <td  class="td-cabecalho"> IGARN </td>
            <td  class="td-cabecalho"> IPEM </td>
            <td  class="td-cabecalho"> PM/DS </td>
            <td  class="td-cabecalho"> IPERN </td>
            <td  class="td-cabecalho"> FUND. J.A. </td>
            <td  class="td-cabecalho"> IDIARN </td>
            <td  class="td-cabecalho"> IFESP </td>
            <td  class="td-cabecalho"> PGE </td>
            <td  class="td-cabecalho"> GVC </td>
            <td  class="td-cabecalho"> EGOV </td>
            <td  class="td-cabecalho"> H. L.G. Vidal - SA</td>
            <td  class="td-cabecalho"> H. Regional M.A. Barros - SJM</td>
            <td  class="td-cabecalho"> H. Regional Dr. T. Maia - Mossoró</td>
            <td  class="td-cabecalho"> H. R. Fernandes - Mossoró</td>
            <td  class="td-cabecalho"> H. Regional Dr. A. Pereira - Caraúbas</td>
            <td  class="td-cabecalho"> H. Regional H. Morais - Apodi </td>
            <td  class="td-cabecalho"> H. Regional de João Câmara </td>
            <td  class="td-cabecalho"> H. Regional T.F. Fontes - Caicó </td>
            <td  class="td-cabecalho"> H. Dr. M. Coelho - Currais Novos</td>
            <td  class="td-cabecalho"> H. Regional M. Expedito - SPP </td>
            <td  class="td-cabecalho"> H. Dr. C. C. de Andrade - PF</td>
            <td  class="td-cabecalho"> Compl. Hosp. M.W. Gurgel | P.S. Clóvis Sarinho - Natal </td>
            <td  class="td-cabecalho"> H. Dr. J.P. Bezerra - Natal</td>
            <td  class="td-cabecalho"> H. G. Trigueiro - Natal</td>
            <td  class="td-cabecalho"> H. Colônia Dr. J. Machado - Natal</td>
            <td  class="td-cabecalho"> H. Central Cel. P. Germano (HPM) - Natal</td>
            <td  class="td-cabecalho"> H. Pediátrico M. Alice F. - Natal</td>
            <td  class="td-cabecalho"> H. Dr. D. Marques de L. - Parnamirim</td>
            <td  class="td-cabecalho"> H. Regional A. Mesquita - Macaíba</td>
            <td  class="td-cabecalho"> H. Regional N.I. dos Santos - Assú</td>

            


        </tr>
      </thead>

<?php 

    while($dados = mysqli_fetch_assoc($result)) {
    $id_demonstrativo = $dados['id_demonstrativo'];
    $id_objetoOrg = $dados['id_objetoOrg'];
    $numItemDG = $dados['numItemDG'];
    $descItemDemo = $dados['descItemDemo'];
    $qtdHomologada = $dados['qtdHomologada'];
    
    $sql1 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 1 AND r1.id_objeto = $objeto;");
    $row1 = mysqli_fetch_assoc($sql1);

    $sql2 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 2 AND r1.id_objeto = $objeto;");
    $row2 = mysqli_fetch_assoc($sql2);

    $sql3 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 3 AND r1.id_objeto = $objeto;");
    $row3 = mysqli_fetch_assoc($sql3);

    $sql4 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 4 AND r1.id_objeto = $objeto;");
    $row4 = mysqli_fetch_assoc($sql4);

    $sql5 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 5 AND r1.id_objeto = $objeto;");
    $row5 = mysqli_fetch_assoc($sql5);

    $sql6 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 6 AND r1.id_objeto = $objeto;");
    $row6 = mysqli_fetch_assoc($sql6);

    $sql7 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 7 AND r1.id_objeto = $objeto;");
    $row7 = mysqli_fetch_assoc($sql7);

    $sql8 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 8 AND r1.id_objeto = $objeto;");
    $row8 = mysqli_fetch_assoc($sql8);

    $sql9 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 9 AND r1.id_objeto = $objeto;");
    $row9 = mysqli_fetch_assoc($sql9);

    $sql10 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 10 AND r1.id_objeto = $objeto;");
    $row10 = mysqli_fetch_assoc($sql10);

    $sql11 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 11 AND r1.id_objeto = $objeto;");
    $row11 = mysqli_fetch_assoc($sql11);

    $sql12 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 12 AND r1.id_objeto = $objeto;");
    $row12 = mysqli_fetch_assoc($sql12);

    $sql13 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 13 AND r1.id_objeto = $objeto;");
    $row13 = mysqli_fetch_assoc($sql13);

    $sql14 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 14 AND r1.id_objeto = $objeto;");
    $row14 = mysqli_fetch_assoc($sql14);

    $sql15 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo  AND r1.id_orgao = 15 AND r1.id_objeto = $objeto;");
    $row15 = mysqli_fetch_assoc($sql15);

    $sql16 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 16 AND r1.id_objeto = $objeto;");
    $row16 = mysqli_fetch_assoc($sql16);

    $sql17 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 17 AND r1.id_objeto = $objeto;");
    $row17 = mysqli_fetch_assoc($sql17);

    $sql18 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 18 AND r1.id_objeto = $objeto;");
    $row18 = mysqli_fetch_assoc($sql18);

    $sql19 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 19 AND r1.id_objeto = $objeto;");
    $row19 = mysqli_fetch_assoc($sql19);

    $sql20 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 20 AND r1.id_objeto = $objeto; ");
    $row20 = mysqli_fetch_assoc($sql20);

    $sql21 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 21 AND r1.id_objeto = $objeto;");
    $row21 = mysqli_fetch_assoc($sql21);

    $sql22 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 22 AND r1.id_objeto = $objeto;");
    $row22 = mysqli_fetch_assoc($sql22);

    $sql23 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 23 AND r1.id_objeto = $objeto;");
    $row23 = mysqli_fetch_assoc($sql23);
    
    $sql24 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 24 AND r1.id_objeto = $objeto;");
    $row24 = mysqli_fetch_assoc($sql24);

    $sql25 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 25 AND r1.id_objeto = $objeto;");
    $row25 = mysqli_fetch_assoc($sql25);

    $sql26 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 26 AND r1.id_objeto = $objeto;");
    $row26 = mysqli_fetch_assoc($sql26);

    $sql27 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 27 AND r1.id_objeto = $objeto;");
    $row27 = mysqli_fetch_assoc($sql27);

    $sql28 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 28 AND r1.id_objeto = $objeto;");
    $row28 = mysqli_fetch_assoc($sql28);

    $sql29 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 41 AND r1.id_objeto = $objeto;");
    $row29 = mysqli_fetch_assoc($sql29);
    
    $sql30 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 42 AND r1.id_objeto = $objeto;");
    $row30 = mysqli_fetch_assoc($sql30);
    
    $sql31 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 43 AND r1.id_objeto = $objeto;");
    $row31 = mysqli_fetch_assoc($sql31);

    $sql32 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 44 AND r1.id_objeto = $objeto;");
    $row32 = mysqli_fetch_assoc($sql32);

    $sql33 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 45 AND r1.id_objeto = $objeto;");
    $row33 = mysqli_fetch_assoc($sql33);

    $sql34 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 46 AND r1.id_objeto = $objeto;");
    $row34 = mysqli_fetch_assoc($sql34);

    $sql35 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 47 AND r1.id_objeto = $objeto;");
    $row35 = mysqli_fetch_assoc($sql35);

    $sql36 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 48 AND r1.id_objeto = $objeto;");
    $row36 = mysqli_fetch_assoc($sql36);

    $sql37 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 49 AND r1.id_objeto = $objeto;");
    $row37 = mysqli_fetch_assoc($sql37);

    $sql38 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 50 AND r1.id_objeto = $objeto;");
    $row38 = mysqli_fetch_assoc($sql38);

    $sql39 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 51 AND r1.id_objeto = $objeto;");
    $row39 = mysqli_fetch_assoc($sql39);

    $sql40 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 52 AND r1.id_objeto = $objeto;");
    $row40 = mysqli_fetch_assoc($sql40);

    $sql41 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 53 AND r1.id_objeto = $objeto;");
    $row41 = mysqli_fetch_assoc($sql41);

    $sql42 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 54 AND r1.id_objeto = $objeto;");
    $row42 = mysqli_fetch_assoc($sql42);

    $sql43 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 55 AND r1.id_objeto = $objeto;");
    $row43 = mysqli_fetch_assoc($sql43);

    $sql44= mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 56 AND r1.id_objeto = $objeto;");
    $row44 = mysqli_fetch_assoc($sql44);

    $sql45 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 57 AND r1.id_objeto = $objeto;");
    $row45 = mysqli_fetch_assoc($sql45);

    $sql46 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 58 AND r1.id_objeto = $objeto;");
    $row46 = mysqli_fetch_assoc($sql46);

    $sql47 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 59 AND r1.id_objeto = $objeto;");
    $row47 = mysqli_fetch_assoc($sql47);

    $sql48 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 60 AND r1.id_objeto = $objeto;");
    $row48 = mysqli_fetch_assoc($sql48);

    $sql49 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 61 AND r1.id_objeto = $objeto;");
    $row49 = mysqli_fetch_assoc($sql49);

    $sql50 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 62 AND r1.id_objeto = $objeto;");
    $row50 = mysqli_fetch_assoc($sql50);

    $sql51 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 63 AND r1.id_objeto = $objeto;");
    $row51 = mysqli_fetch_assoc($sql51);

    $sql52 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 64 AND r1.id_objeto = $objeto;");
    $row52 = mysqli_fetch_assoc($sql52);

    $sql53 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 65 AND r1.id_objeto = $objeto;");
    $row53 = mysqli_fetch_assoc($sql53);

    $sql54 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 66 AND r1.id_objeto = $objeto;");
    $row54 = mysqli_fetch_assoc($sql54);

    $sql55 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 67 AND r1.id_objeto = $objeto;");
    $row55 = mysqli_fetch_assoc($sql55);

    $sql56 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 68 AND r1.id_objeto = $objeto;");
    $row56 = mysqli_fetch_assoc($sql56);

    $sql57 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 69 AND r1.id_objeto = $objeto;");
    $row57 = mysqli_fetch_assoc($sql57);

    $sql58 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 70 AND r1.id_objeto = $objeto;");
    $row58 = mysqli_fetch_assoc($sql58);

    $sql59 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 71 AND r1.id_objeto = $objeto;");
    $row59 = mysqli_fetch_assoc($sql59);

    $sql60 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 72 AND r1.id_objeto = $objeto;");
    $row60 = mysqli_fetch_assoc($sql60);

    $sql61 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 73 AND r1.id_objeto = $objeto;");
    $row61 = mysqli_fetch_assoc($sql61);

    $sql62 = mysqli_query($conn, "SELECT SUM(qtdUtilizadaProcesso) as qtd FROM processo AS p LEFT JOIN registro AS r1 ON p.id_item = r1.id_item LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo WHERE dg.id_demonstrativo = $id_demonstrativo AND r1.id_orgao = 74 AND r1.id_objeto = $objeto;");
    $row62 = mysqli_fetch_assoc($sql62);






    $ASSECOM = $row1['qtd'];//1
    $ARSEP = $row2['qtd'];//2
    $CBM = $row3['qtd'];//3
    $CONTROL = $row4['qtd'];//4
    $DEI = $row5['qtd'];//5
    $DER = $row6['qtd'];//6
    $SET = $row7['qtd'];//7
    $FAPERN = $row8['qtd'];//8
    $FUNDASE = $row9['qtd'];//9
    $GAC = $row10['qtd'];//10
    $ITEP = $row11['qtd'];//11
    $JUCERN = $row12['qtd'];//12
    $PM = $row13['qtd'];//13
    $PC = $row14['qtd'];//14
    $SEMJIDH = $row15['qtd'];//15
    $SEDRAF = $row16['qtd'];//16
    $SESAP = $row17['qtd'];//17
    $SETUR = $row18['qtd'];//18
    $SIN = $row19['qtd'];//19
    $SEPLAN = $row20['qtd'];//20
    $SEAP = $row21['qtd'];//21
    $SEMARH = $row22['qtd'];//22
    $SEEC = $row23['qtd'];//23
    $SETHAS = $row24['qtd'];//24
    $SESED = $row25['qtd'];//25
    $SAPE = $row26['qtd'];//26
    $UERN = $row27['qtd'];//27
    $SEAD = $row28['qtd'];//28
    $SEDEC = $row29['qtd'];//41
    $DETRAN = $row30['qtd']; //42
    $EMATER = $row31['qtd']; //43
    $IDEMA = $row32['qtd']; //44
    $IGARN = $row33['qtd']; //45
    $IPEM = $row34['qtd']; //46
    $PMDS = $row35['qtd']; //47
    $IPERN = $row36['qtd']; //48
    $FUNDJA = $row37['qtd']; //49
    $IDIARN = $row38['qtd']; //50
    $IFESP = $row39['qtd']; //51
    $PGE = $row40['qtd']; //52
    $GVC = $row41['qtd']; //53
    $EGOV = $row42['qtd']; //54

    $HLGV = $row43['qtd']; //55
    $HRMAB = $row44['qtd']; //56
    $HRDTM = $row45['qtd']; //57
    $HRF = $row46['qtd']; //58
    $HRDAP = $row47['qtd']; //59
    $HRHM= $row48['qtd']; //60
    $HRJC = $row49['qtd']; //61
    $HRTFF = $row50['qtd']; //62
    $HDMC = $row51['qtd']; //63
    $HRME = $row52['qtd']; //64
    $HDCCA = $row53['qtd']; //65
    $CHWG = $row54['qtd']; //66
    $HDJPB = $row55['qtd']; //67
    $HGT = $row56['qtd']; //68
    $HCDJM = $row57['qtd']; //69
    $HCCPG = $row58['qtd']; //70
    $HPMAF = $row59['qtd']; //71
    $HDDML = $row60['qtd']; //72
    $HRAM = $row61['qtd']; //73
    $HRNIS = $row62['qtd']; //74




       
    $totalUtilizado = $ARSEP + $ASSECOM + $CBM + $CONTROL + $DEI + $DER + $FAPERN + $FUNDASE + $GAC + $ITEP + $JUCERN + $PC + $PM + 
    $SAPE + $SEMJIDH + $SEDRAF + $SEAD + $SEEC + $SEMARH + $SEPLAN + $SEAP + $SESAP + $SESED + $SET + 
    $SETHAS + $SETUR + $SIN + $UERN + $SEDEC + $DETRAN + $EMATER + $IDEMA + 
    $IGARN + $IPEM + $PMDS + $IPERN + $FUNDJA + $IDIARN + $IFESP + $PGE + $GVC + $EGOV + $HLGV + $HRMAB + $HRDTM + $HRF + $HRDAP + 
    $HRHM + $HRJC + $HRTFF + $HDMC + $HRME + $HDCCA  + $CHWG +  $HCDJM + $HDJPB + $HGT + $HCCPG + $HPMAF + $HDDML + $HRAM  + $HRNIS;
    $saldoTotalRes = $qtdHomologada - $totalUtilizado;

    $sqlUp = "UPDATE demonstrativo_global SET totalUtilizadoOrgs = $totalUtilizado, saldoTotalOrgs = $saldoTotalRes  WHERE id_demonstrativo = $id_demonstrativo;";
    $resultUp = mysqli_query($conn, $sqlUp); 

    
    ?>
    
<tbody>

    <tr id="itens">


        <td   class="td-corpo"style="text-align: center"> <?php if($numItemDG < 10) {
                                                            echo "0", $numItemDG;
                                                             } else {
                                                                  echo $numItemDG;
                                                             }
                                                                  ?>  </td>
        <td   class="td-corpo"style="width:25%;text-align: left;font-size:medium;"> <?php echo $descItemDemo?> </td>
        <td  class="td-corpo"style="text-align: center"> <?php echo $qtdHomologada?> </td>
        <td  class="td-corpo"style="text-align: center"> <?php echo $totalUtilizado?> </td>
        <td  class="td-corpo"style="text-align: center;"><font style="color:red;"><?php echo $saldoTotalRes?></font></td>
        <td  class="td-corpo"style="text-align: center"> <?php if($ARSEP > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $ARSEP?> </strong>
                                            <?php elseif($ARSEP < 0 ): ?> 
                                                <strong style ="color:red;"> <?php  echo $ARSEP?> </strong>
                                                  <?php else:
                                                        echo $ARSEP;
                                                        endif;                              
                                                        ?>          </td>
      <td  class="td-corpo"style="text-align: center"> <?php if($ASSECOM > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $ASSECOM?> </strong>
                                           
                                                  <?php else:
                                                        echo $ASSECOM;
                                                        endif;                              
                                                        ?>  </td>
        <td  class="td-corpo"style="text-align: center"> <?php if($CBM > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $CBM?> </strong>
                                        
                                                  <?php else:
                                                        echo $CBM;
                                                        endif;                              
                                                        ?>  </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($CONTROL > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $CONTROL?> </strong>
                            
                                                  <?php else:
                                                        echo $CONTROL;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"><?php if($DEI > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $DEI?> </strong>
                    
                                                  <?php else:
                                                        echo $DEI;
                                                        endif;                              
                                                        ?>  </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($DER > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $DER?> </strong>
                        
                                                  <?php else:
                                                        echo $DER;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($FAPERN > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $FAPERN?> </strong>
                           
                                                  <?php else:
                                                        echo $FAPERN;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($FUNDASE > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $FUNDASE?> </strong>
                           
                                                  <?php else:
                                                        echo $FUNDASE;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($GAC > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $GAC?> </strong>
                                 
                                                  <?php else:
                                                        echo $GAC;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($ITEP > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $ITEP?> </strong>
                               
                                                  <?php else:
                                                        echo $ITEP;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($JUCERN > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $JUCERN?> </strong>
                                         
                                                  <?php else:
                                                        echo $JUCERN;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center; padding:4px"> <?php if($PC > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $PC?> </strong>
                              
                                                  <?php else:
                                                        echo $PC;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center; padding:4px"> <?php if($PM > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $PM?> </strong>
                                   
                                                  <?php else:
                                                        echo $PM;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SAPE > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SAPE?> </strong>
                                        
                                                  <?php else:
                                                        echo $SAPE;
                                                        endif;                              
                                                        ?>  </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SEMJIDH > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SEMJIDH?> </strong>
                                   
                                                  <?php else:
                                                        echo $SEMJIDH;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SEDRAF > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SEDRAF?> </strong>
                               
                                                  <?php else:
                                                        echo $SEDRAF;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SEAD > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SEAD?> </strong>
                                            
                                                  <?php else:
                                                        echo $SEAD;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SEEC> 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SEEC?> </strong>
                                          
                                                  <?php else:
                                                        echo $SEEC;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SEMARH > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SEMARH?> </strong>
                                           
                                                  <?php else:
                                                        echo $SEMARH;
                                                        endif;                              
                                                        ?>  </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SEPLAN > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SEPLAN?> </strong>
                                          
                                                  <?php else:
                                                        echo $SEPLAN;
                                                        endif;                              
                                                        ?>   </td> 
      <td  class="td-corpo"style="text-align: center"> <?php if($SEAP  > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SEAP ?> </strong>
                                          
                                                  <?php else:
                                                        echo $SEAP ;
                                                        endif;                              
                                                        ?>   </td> 

        <td s class="td-corpo"tyle="text-align: center"> <?php if($SESAP> 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SESAP?> </strong>
                                          
                                                  <?php else:
                                                        echo $SESAP;
                                                        endif;                              
                                                        ?>  </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SESED > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SESED?> </strong>
                                 
                                                  <?php else:
                                                        echo $SESED;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"><?php if($SET> 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SET?> </strong>
                                         
                                                  <?php else:
                                                        echo $SET;
                                                        endif;                              
                                                        ?>  </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SETHAS> 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SETHAS?> </strong>
                                            
                                                  <?php else:
                                                        echo $SETHAS;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SETUR> 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SETUR?> </strong>
                                         
                                                  <?php else:
                                                        echo $SETUR;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($SIN > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SIN?> </strong>
                                        
                                                  <?php else:
                                                        echo $SIN;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($UERN > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $UERN?> </strong>
                                          
                                                  <?php else:
                                                        echo $UERN;
                                                        endif;                              
                                                        ?>   </td> 
       <td  class="td-corpo"style="text-align: center"><?php if($SEDEC> 0):?>
                                            <strong style ="color:blue;"> <?php  echo $SEDEC?> </strong>
                                         
                                                  <?php else:
                                                        echo $SEDEC;
                                                        endif;                              
                                                        ?>  </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($DETRAN> 0):?>
                                            <strong style ="color:blue;"> <?php  echo $DETRAN?> </strong>
                                            
                                                  <?php else:
                                                        echo $DETRAN;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($EMATER> 0):?>
                                            <strong style ="color:blue;"> <?php  echo $EMATER?> </strong>
                                         
                                                  <?php else:
                                                        echo $EMATER;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($IDEMA > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $IDEMA?> </strong>
                                        
                                                  <?php else:
                                                        echo $IDEMA;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($IGARN > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $IGARN?> </strong>
                                          
                                                  <?php else:
                                                        echo $IGARN;
                                                        endif;                              
                                                        ?>   </td> 

         <td  class="td-corpo"style="text-align: center"><?php if($IPEM> 0):?>
                                            <strong style ="color:blue;"> <?php  echo $IPEM?> </strong>
                                         
                                                  <?php else:
                                                        echo $IPEM;
                                                        endif;                              
                                                        ?>  </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($PMDS > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $PMDS?> </strong>
                                            
                                                  <?php else:
                                                        echo $PMDS;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($IPERN> 0):?>
                                            <strong style ="color:blue;"> <?php  echo $IPERN?> </strong>
                                         
                                                  <?php else:
                                                        echo $IPERN;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($FUNDJA > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $FUNDJA?> </strong>
                                        
                                                  <?php else:
                                                        echo $FUNDJA;
                                                        endif;                              
                                                        ?>   </td> 
        <td  class="td-corpo"style="text-align: center"> <?php if($IDIARN > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $IDIARN?> </strong>
                                          
                                                  <?php else:
                                                        echo $IDIARN;
                                                        endif;                              
                                                        ?>   </td>
      
      <td  class="td-corpo"style="text-align: center"> <?php if($IFESP > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $IFESP?> </strong>
                                          
                                                  <?php else:
                                                        echo $IFESP;
                                                        endif;                              
                                                        ?>   </td>  

       <td  class="td-corpo"style="text-align: center"> <?php if($PGE > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $PGE?> </strong>
                                          
                                                  <?php else:
                                                        echo $PGE;
                                                        endif;                              
                                                        ?>   </td>  

       <td  class="td-corpo"style="text-align: center"> <?php if($GVC > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $GVC?> </strong>
                                          
                                                  <?php else:
                                                        echo $GVC;
                                                        endif;                              
                                                        ?>   </td>    
      <td  class="td-corpo"style="text-align: center"> <?php if($EGOV > 0):?>
                                            <strong style ="color:blue;"> <?php  echo $EGOV?> </strong>
                                          
                                                  <?php else:
                                                        echo $EGOV;
                                                        endif;                              
                                                        ?>   </td> 

                                                <!-- HOSPITAIS -->
        
      <td  class="td-corpo"style="text-align: center"> <?php if($HLGV > 0): //1?>
                                            <strong style ="color:blue;"> <?php  echo $HLGV?> </strong>
                                          
                                                  <?php else:
                                                        echo $HLGV;
                                                        endif;                              
                                                        ?>   </td>                                                                                                                                                              
      <td  class="td-corpo"style="text-align: center"> <?php if($HRMAB > 0): //2?>
                                            <strong style ="color:blue;"> <?php  echo $HRMAB?> </strong>
                                          
                                                  <?php else:
                                                        echo $HRMAB;
                                                        endif;                              
                                                        ?>   </td>  
      <td  class="td-corpo"style="text-align: center"> <?php if($HRDTM > 0): //3?>
                                            <strong style ="color:blue;"> <?php  echo $HRDTM?> </strong>
                                          
                                                  <?php else:
                                                        echo $HRDTM;
                                                        endif;                              
                                                        ?>   </td>                                                              
      <td  class="td-corpo"style="text-align: center"> <?php if($HRF > 0): //4?>
                                            <strong style ="color:blue;"> <?php  echo $HRF?> </strong>
                                          
                                                  <?php else:
                                                        echo $HRF;
                                                        endif;                              
                                                        ?>   </td>      
      <td  class="td-corpo"style="text-align: center"> <?php if($HRDAP > 0): //5?>
                                            <strong style ="color:blue;"> <?php  echo $HRDAP?> </strong>
                                          
                                                  <?php else:
                                                        echo $HRDAP;
                                                        endif;                              
                                                        ?>   </td>  
      <td  class="td-corpo"style="text-align: center"> <?php if($HRHM > 0): //6?>
                                            <strong style ="color:blue;"> <?php  echo $HRHM?> </strong>
                                          
                                                  <?php else:
                                                        echo $HRHM;
                                                        endif;                              
                                                        ?>   </td>   
      <td  class="td-corpo"style="text-align: center"> <?php if($HRJC > 0): //7?>
                                            <strong style ="color:blue;"> <?php  echo $HRJC?> </strong>
                                          
                                                  <?php else:
                                                        echo $HRJC;
                                                        endif;                              
                                                        ?>   </td>     
      <td  class="td-corpo"style="text-align: center"> <?php if($HRTFF > 0): //8?>
                                            <strong style ="color:blue;"> <?php  echo $HRTFF?> </strong>
                                          
                                                  <?php else:
                                                        echo $HRTFF;
                                                        endif;                              
                                                        ?>   </td>      
      <td  class="td-corpo"style="text-align: center"> <?php if($HDMC > 0): //9?>
                                            <strong style ="color:blue;"> <?php  echo $HDMC?> </strong>
                                          
                                                  <?php else:
                                                        echo $HDMC;
                                                        endif;                              
                                                        ?>   </td>      
      <td  class="td-corpo"style="text-align: center"> <?php if($HRME> 0): //10?>
                                            <strong style ="color:blue;"> <?php  echo $HRME?> </strong>
                                          
                                                  <?php else:
                                                        echo $HRME;
                                                        endif;                              
                                                        ?>   </td>    
      <td  class="td-corpo"style="text-align: center"> <?php if($HDCCA> 0): //11?>
                                            <strong style ="color:blue;"> <?php  echo $HDCCA?> </strong>
                                          
                                                  <?php else:
                                                        echo $HDCCA;
                                                        endif;                              
                                                        ?>   </td>     
      <td  class="td-corpo"style="text-align: center"> <?php if($CHWG> 0): //12?>
                                            <strong style ="color:blue;"> <?php  echo $CHWG?> </strong>
                                          
                                                  <?php else:
                                                        echo $CHWG;
                                                        endif;                              
                                                        ?>   </td>       
                                                        
      <td  class="td-corpo"style="text-align: center"> <?php if($HDJPB> 0): //14?>
                                            <strong style ="color:blue;"> <?php  echo $HDJPB?> </strong>
                                          
                                                  <?php else:
                                                        echo $HDJPB;
                                                        endif;                              
                                                        ?>   </td>     
      <td  class="td-corpo"style="text-align: center"> <?php if($HGT> 0): //15?>
                                            <strong style ="color:blue;"> <?php  echo $HGT?> </strong>
                                          
                                                  <?php else:
                                                        echo $HGT;
                                                        endif;                              
                                                        ?>   </td>  
                                                        
      <td  class="td-corpo"style="text-align: center"> <?php if($HCDJM> 0): //13?>
                          <strong style ="color:blue;"> <?php  echo $HCDJM?> </strong>
      
                                          <?php else:
                                          echo $HCDJM;
                                          endif;                              
                                          ?>   </td>   
      <td  class="td-corpo"style="text-align: center"> <?php if($HCCPG> 0): //16?>
                                            <strong style ="color:blue;"> <?php  echo $HCCPG?> </strong>
                                          
                                                  <?php else:
                                                        echo $HCCPG;
                                                        endif;                              
                                                        ?>   </td>     
      <td  class="td-corpo"style="text-align: center"> <?php if($HPMAF> 0): //17?>
                                            <strong style ="color:blue;"> <?php  echo $HPMAF?> </strong>
                                          
                                                  <?php else:
                                                        echo $HPMAF;
                                                        endif;                              
                                                        ?>   </td>     
      <td  class="td-corpo"style="text-align: center"> <?php if($HDDML> 0): //18?>
                                            <strong style ="color:blue;"> <?php  echo $HDDML?> </strong>
                                          
                                                  <?php else:
                                                        echo $HDDML;
                                                        endif;                              
                                                        ?>   </td>     
      <td  class="td-corpo"style="text-align: center"> <?php if($HRAM> 0): //19?>
                                            <strong style ="color:blue;"> <?php  echo $HRAM?> </strong>
                                          
                                                  <?php else:
                                                        echo $HRAM;
                                                        endif;                              
                                                        ?>   </td>     
      <td  class="td-corpo"style="text-align: center"> <?php if($HRNIS> 0): //20?>
                                            <strong style ="color:blue;"> <?php  echo $HRNIS?> </strong>
                                          
                                                  <?php else:
                                                        echo $HRNIS;
                                                        endif;                              
                                                        ?>   </td>                                                    
    </tr>
  </tbody>
<?php
    }
?>



    </table>
    <?php 
else : ?>

<?php endif;
?>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    
</body>
</html>