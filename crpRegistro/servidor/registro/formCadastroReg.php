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
    <link rel="stylesheet" type="text/css" href="./css/cadastrar.css" media="screen"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="/imagens/icon-siga.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cadastro</title>
</head>

<body>

<style>
  label{
    font-weight: bold;

}
  input[type="number"] {
        display: none;
    }

</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary " style="background: #54AEE6 !important;">
       <div class="container-fluid" style="background-color: #54AEE6; margin-bottom: auto !important; height: auto !important;">
                <a class="navbar-brand" href="../sistema.php" >
                  <div class="logo">
                    <img class="logo-siga"   src="/imagens/servidor.png"> 
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
<h5><a class="nav-link active" aria-current="page" href="../sistema.php">Início</a></h5></li>       
 <li class="nav-item dropdown">
        <h5> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Cadastrar
          </a> 
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="../objeto/cadastrar.php">Objeto</a></li>
            <li><a class="dropdown-item" href="../fornecedor/cadastrar.php">Fornecedor</a></li>
            <li><a class="dropdown-item" href="../demonstrativo/formCadastroDem.php">Itens</a></li>
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
            <li><a class="dropdown-item" href="#"><strong>Listar</strong></a></li>
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
    $id_objeto = $_POST['objeto'];
    $id_demonstrativo = $_POST['id_demonstrativo'];
    $ARSEP = $_POST['ARSEP'];
    $ASSECOM = $_POST['ASSECOM'];
    $CBM = $_POST['CBM'];
    $CONTROL = $_POST['CONTROL'];
    $DEI = $_POST['DEI'];
    $DER = $_POST['DER'];
    $FAPERN = $_POST['FAPERN'];
    $FUNDASE = $_POST['FUNDASE'];
    $GAC = $_POST['GAC'];
    $ITEP = $_POST['ITEP'];
    $JUCERN = $_POST['JUCERN'];
    $PC = $_POST['PC'];
    $PM = $_POST['PM'];
    $SAPE = $_POST['SAPE'];
    $SEMJIDH = $_POST['SEMJIDH'];
    $SEDRAF = $_POST['SEDRAF'];
    $SEAD = $_POST['SEAD'];
    $SEEC = $_POST['SEEC'];
    $SEMARH = $_POST['SEMARH'];
    $SEPLAN = $_POST['SEPLAN'];
    $SEAP = $_POST['SEAP'];
    $SESAP = $_POST['SESAP'];
    $SESED = $_POST['SESED'];
    $SET = $_POST['SET_RN'];
    $SETHAS = $_POST['SETHAS'];
    $SETUR = $_POST['SETUR'];
    $SIN = $_POST['SIN'];
    $UERN = $_POST['UERN'];
    $SEDEC = $_POST['SEDEC'];//41
    $DETRAN = $_POST['DETRAN']; //42
    $EMATER = $_POST['EMATER']; //43
    $IDEMA = $_POST['IDEMA']; //44
    $IGARN = $_POST['IGARN']; //45
    $IPEM = $_POST['IPEM'];//46
    $PMDS = $_POST['PMDS']; //47
    $IPERN = $_POST['IPERN']; //48
    $FUNDJA = $_POST['FUNDJA']; //49
    $IDIARN = $_POST['IDIARN']; //50
    $IFESP = $_POST['IFESP']; //51
    $PGE = $_POST['PGE']; //52
    $GVC = $_POST['GVC']; //53
    $EGOV = $_POST['EGOV']; //54
    $HLGV = $_POST['HLGV']; //55
    $HRMAB = $_POST['HRMAB']; //56
    $HRDTM = $_POST['HRDTM']; //57
    $HRF = $_POST['HRF']; //58
    $HRDAP = $_POST['HRDAP']; //59
    $HRHM = $_POST['HRHM']; //60
    $HRJC = $_POST['HRJC']; //61
    $HRTFF = $_POST['HRTFF']; //62
    $HDMC = $_POST['HDMC']; //63
    $HRME = $_POST['HRME']; //64
    $HDCCA = $_POST['HDCCA']; //65
    $CHWG = $_POST['CHWG']; //66
    $HDJPB = $_POST['HDJPB']; //67
    $HGT = $_POST['HGT']; //68
    $HCDJM = $_POST['HCDJM']; //69
    $HCCPG = $_POST['HCCPG']; //70
    $HPMAF = $_POST['HPMAF']; //71
    $HDDML = $_POST['HDDML']; //72
    $HRAM = $_POST['HRAM']; //73
    $HRNIS = $_POST['HRNIS']; //74
    $sql = "INSERT INTO registro(id_objeto, id_demonstrativo, qtdDemandaOrg, id_orgao) VALUES ($id_objeto, $id_demonstrativo, $ASSECOM, 1), ($id_objeto, $id_demonstrativo, $ARSEP, 2), ($id_objeto, $id_demonstrativo, $CBM, 3), ($id_objeto, $id_demonstrativo, $CONTROL, 4), ($id_objeto, $id_demonstrativo, $DEI, 5), ($id_objeto, $id_demonstrativo, $DER, 6),  ($id_objeto, $id_demonstrativo, $SET, 7), ($id_objeto, $id_demonstrativo, $FAPERN, 8), ($id_objeto, $id_demonstrativo, $FUNDASE, 9), ($id_objeto, $id_demonstrativo, $GAC, 10), ($id_objeto, $id_demonstrativo, $ITEP, 11), ($id_objeto, $id_demonstrativo, $JUCERN, 12), ($id_objeto, $id_demonstrativo, $PM, 13), ($id_objeto, $id_demonstrativo, $PC, 14), ($id_objeto, $id_demonstrativo, $SEMJIDH, 15), ($id_objeto, $id_demonstrativo, $SEDRAF, 16), ($id_objeto, $id_demonstrativo, $SESAP, 17), ($id_objeto, $id_demonstrativo, $SETUR, 18), ($id_objeto, $id_demonstrativo, $SIN, 19), ($id_objeto, $id_demonstrativo, $SEPLAN, 20), ($id_objeto, $id_demonstrativo, $SEAP, 21), ($id_objeto, $id_demonstrativo, $SEMARH, 22), ($id_objeto, $id_demonstrativo, $SEEC, 23), ($id_objeto, $id_demonstrativo, $SETHAS, 24), ($id_objeto, $id_demonstrativo, $SESED, 25), ($id_objeto, $id_demonstrativo, $SAPE, 26), ($id_objeto, $id_demonstrativo, $UERN, 27), ($id_objeto, $id_demonstrativo, $SEAD, 28), 
    ($id_objeto, $id_demonstrativo, $SEDEC, 41), ($id_objeto, $id_demonstrativo, $DETRAN, 42), ($id_objeto, $id_demonstrativo, $EMATER, 43), 
    ($id_objeto, $id_demonstrativo, $IDEMA, 44), ($id_objeto, $id_demonstrativo, $IGARN, 45), ($id_objeto, $id_demonstrativo, $IPEM, 46), 
    ($id_objeto, $id_demonstrativo, $PMDS, 47), ($id_objeto, $id_demonstrativo, $IPERN, 48), ($id_objeto, $id_demonstrativo, $FUNDJA, 49), 
    ($id_objeto, $id_demonstrativo, $IDIARN, 50), ($id_objeto, $id_demonstrativo, $IFESP, 51), ($id_objeto, $id_demonstrativo, $PGE, 52) , 
    ($id_objeto, $id_demonstrativo, $GVC, 53), ($id_objeto, $id_demonstrativo, $EGOV, 54), ($id_objeto, $id_demonstrativo, $HLGV, 55), 
    ($id_objeto, $id_demonstrativo, $HRMAB, 56), ($id_objeto, $id_demonstrativo, $HRDTM, 57),($id_objeto, $id_demonstrativo, $HRF, 58), 
    ($id_objeto, $id_demonstrativo, $HRDAP, 59),($id_objeto, $id_demonstrativo, $HRHM, 60), ($id_objeto, $id_demonstrativo, $HRJC, 61),
    ($id_objeto, $id_demonstrativo, $HRTFF, 62), ($id_objeto, $id_demonstrativo, $HDMC, 63), ($id_objeto, $id_demonstrativo,  $HRME, 64), 
    ($id_objeto, $id_demonstrativo, $HDCCA, 65), ($id_objeto, $id_demonstrativo, $CHWG, 66), ($id_objeto, $id_demonstrativo, $HDJPB, 67),
    ($id_objeto, $id_demonstrativo, $HGT, 68), ($id_objeto, $id_demonstrativo, $HCDJM, 69), ($id_objeto, $id_demonstrativo, $HCCPG, 70), 
    ($id_objeto, $id_demonstrativo, $HPMAF, 71), ($id_objeto, $id_demonstrativo, $HDDML, 72), ($id_objeto, $id_demonstrativo, $HRAM, 73), 
    ($id_objeto, $id_demonstrativo, $HRNIS, 74);";
    $result = mysqli_query($conn, $sql);

    

    ?>

    <?php if($result == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green;"> <?php echo "Cadastrado com sucesso!" ?> </h2>
        <?php } else { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:red;"> <?php echo "ERRO!" ?> </h2> 
    <?php } ?>
    <?php else :
        echo ""; 
    endif; ?>



<div class="container-second" >
<div class="box">
<form class="row g-3" style="margin:2%;box-shadow: 0 0 1em #808080;" action = "./formCadastroReg.php" method="POST"> 
<h2 id="titulo" style="text-align:center;">Cadastrar Demanda</h2>
<hr>

<div class="col-md-3 clearfix" >
    <label for="inputState" class="form-label">Objeto</label>
    <select id="objeto" name="objeto" required autocomplete="off" class="form-select">
    <option selected disabled value="">Selecionar</option>
 
                        </select> 
  </div>

  <div class="col-md-5 clearfix" >
  <label class="form-label">N° do Item <font style="color:red">(selecione o objeto)</font> </label>
    <select id="id_demonstrativo" name = "id_demonstrativo" required autocomplete="off" class="form-select">
    <option selected disabled value="">Selecionar</option>


                        </select> 
  </div>
 
  <hr> <h4 style="text-align:center">  Quantidade de demanda por Órgão:  </h4>
  <div class="col-md-1">
    <label for="inputAddress" class="form-check-label">ARSEP</label>
    <input id="check1" class="form-check-input" type="checkbox"> <input id="op1" type="number" name = "ARSEP" value="0" required class="form-control">
  </div>
  <div class="col-md-1" data-label="auditoria">
    <label for="inputPassword4" class="form-check-label">ASSECOM</label>
    <input id="check" class="form-check-input" type="checkbox"> <input id="op" type="number" name = "ASSECOM" value="0" required class="form-control">
  </div>
  <div class="col-md-1">
    <label for="inputAddress2" class="form-check-label">CBM</label>
    <input id="check2" class="form-check-input" type="checkbox"> <input id="op2" type="number" name = "CBM" value="0" required class="form-control">
  </div>
  <div class="col-md-1">
    <label for="inputCity" class="form-check-label">CONTROL</label>
    <input id="check3" class="form-check-input" type="checkbox"> <input id="op3" type="number" name = "CONTROL" value="0" required class="form-control">
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">DEI</label>
    <input id="check4" class="form-check-input" type="checkbox"> <input id="op4" type="number" name = "DEI" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputPassword4" class="form-check-label">DER</label>
    <input id="check5" class="form-check-input" type="checkbox"> <input id="op5" type="number" name = "DER" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputPassword4" class="form-check-label">DETRAN</label>
    <input id="check30" class="form-check-input" type="checkbox"> <input id="op30" type="number" name = "DETRAN" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">EGOV</label>
    <input id="check42" class="form-check-input" type="checkbox"> <input id="op42" type="number" name = "EGOV" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputAddress" class="form-check-label">EMATER</label>
    <input id="check31" class="form-check-input" type="checkbox"> <input id="op31" type="number" name = "EMATER" value="0" required class="form-control">
  </div>
  <div class="col-md-1">
    <label for="inputAddress" class="form-check-label">FAPERN</label>
    <input id="check6" class="form-check-input"type="checkbox"> <input id="op6" type="number" name = "FAPERN" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">FUND. J.A.</label>
    <input id="check37" class="form-check-input" type="checkbox"> <input id="op37" type="number" name = "FUNDJA" value="0"  required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputAddress2" class="form-check-label">FUNDASE</label>
    <input id="check7" class="form-check-input" type="checkbox"> <input id="op7" type="number" name = "FUNDASE" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputCity" class="form-check-label">GAC</label>
    <input id="check8" class="form-check-input" type="checkbox"> <input id="op8" type="number" name = "GAC" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">GVG</label>
    <input id="check41" class="form-check-input" type="checkbox"> <input id="op41" type="number" name = "GVC" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputAddress2" class="form-check-label">IDEMA</label>
    <input id="check32" class="form-check-input" type="checkbox"> <input id="op32" type="number" name = "IDEMA" value="0" required  class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">IDIARN</label>
    <input id="check38" class="form-check-input" type="checkbox"> <input id="op38" type="number" name = "IDIARN" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">IFESP</label>
    <input id="check39" class="form-check-input" type="checkbox"> <input id="op39" type="number" name = "IFESP" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputCity" class="form-check-label">IGARN</label>
    <input id="check33" class="form-check-input" type="checkbox"> <input id="op33" type="number" name = "IGARN" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">IPEM</label>
    <input id="check34" class="form-check-input" type="checkbox"> <input id="op34" type="number" name = "IPEM" value="0" required class="form-control">
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">IPERN</label>
    <input id="check36" class="form-check-input" type="checkbox"> <input id="op36" type="number" name = "IPERN" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">ITEP</label>
    <input id="check9" class="form-check-input" type="checkbox"> <input id="op9" type="number" name = "ITEP" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputPassword4" class="form-check-label">JUCERN</label>
    <input id="check10" class="form-check-input" type="checkbox"> <input id="op10" type="number" name = "JUCERN" value="0" required class="form-control">
  </div>
  <div class="col-md-1">
    <label for="inputAddress2" class="form-check-label">PC</label>
    <input id="check12" class="form-check-input" type="checkbox"> <input id="op12" type="number" name = "PC" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">PGE</label>
    <input id="check40" class="form-check-input" type="checkbox"> <input id="op40" type="number" name = "PGE" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputAddress" class="form-check-label">PM</label>
    <input id="check11" class="form-check-input" type="checkbox"> <input id="op11" type="number" name = "PM" value="0" required class="form-control" >
  </div> 
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">PM/DS</label>
    <input id="check35" class="form-check-input" type="checkbox"> <input id="op35" type="number" name = "PMDS" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">SAPE</label>
    <input id="check24" class="form-check-input" type="checkbox"> <input id="op24" type="number" name = "SAPE" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">SEAD</label>
    <input id="check26" class="form-check-input" type="checkbox"> <input id="op26" type="number" name = "SEAD" value="0" required  class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">SEAP</label>
    <input id="check18" class="form-check-input" type="checkbox"> <input id="op18" type="number" name = "SEAP" value="0" required class="form-control">
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">SEDEC</label>
    <input id="check29" class="form-check-input" type="checkbox"> <input id="op29" type="number" name = "SEDEC" value="0" required  class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">SEDRAF</label>
    <input id="check14" class="form-check-input" type="checkbox"> <input id="op14" type="number" name = "SEDRAF" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">SEEC</label>
    <input id="check20" class="form-check-input" type="checkbox"> <input id="op20" type="number" name = "SEEC" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">SEMARH</label>
    <input id="check19" class="form-check-input" type="checkbox"> <input id="op19" type="number" name = "SEMARH" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputCity" class="form-check-label">SEMJIDH</label>
    <input id="check13" class="form-check-input" type="checkbox"> <input id="op13" type="number" name = "SEMJIDH" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputCity" class="form-check-label">SEPLAN</label>
    <input id="check27" class="form-check-input" type="checkbox"> <input id="op27" type="number" name = "SEPLAN" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputPassword4" class="form-check-label">SESAP</label>
    <input id="check15" class="form-check-input" type="checkbox"> <input id="op15" type="number" name = "SESAP" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">SESED</label>
    <input id="check22" class="form-check-input" type="checkbox"> <input id="op22" type="number" name = "SESED" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">SET</label>
    <input id="check23" class="form-check-input" type="checkbox"> <input id="op23" type="number" name = "SET_RN" value="0"  required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">SETHAS</label>
    <input id="check21" class="form-check-input" type="checkbox"> <input id="op21" type="number" name = "SETHAS" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputAddress" class="form-check-label">SETUR</label>
    <input id="check16" class="form-check-input" type="checkbox"> <input id="op16" type="number" name = "SETUR" value="0" required class="form-control">
  </div>
  <div class="col-md-1">
    <label for="inputAddress2" class="form-check-label">SIN</label>
    <input id="check17" class="form-check-input" type="checkbox"> <input id="op17" type="number" name = "SIN" value="0" required class="form-control" >
  </div>
  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">UERN</label>
    <input id="check25" class="form-check-input" type="checkbox"> <input id="op25" type="number" name = "UERN" value="0"  required class="form-control" >
  </div>
  
<br>
  <ul>
   <li> <h5 style="text-align:center; text-decoration: underline; margin-top: 1%">    Hospitais:  </h5> </li>
  </ul>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. L.G. Vidal - <font style="color:blue">SA</font></label>
    <input id="check43" class="form-check-input" type="checkbox"> <input id="op43" type="number" name = "HLGV" value="0" required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Regional M.A. Barros - <font style="color:blue">SJM</font></label>
    <input id="check44" class="form-check-input" type="checkbox"> <input id="op44" type="number" name = "HRMAB" value="0" required class="form-control" >
  </div>

  <div class="col-md-1
">
    <label for="inputZip" class="form-check-label">H. Regional Dr. T. Maia - <font style="color:blue">Mossoró</font></label>
    <input id="check45" class="form-check-input" type="checkbox"> <input id="op45" type="number" name = "HRDTM" value="0" required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. R. Fernandes - <font style="color:blue">Mossoró</font></label>
    <input id="check46" class="form-check-input" type="checkbox"> <input id="op46" type="number" name = "HRF" value="0"  required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Regional Dr. A. Pereira - <font style="color:blue">Caraúbas</font></label>
    <input id="check47" class="form-check-input" type="checkbox"> <input id="op47" type="number" name = "HRDAP" value="0"  required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Regional H. Morais - <font style="color:blue">Apodi</font></label>
    <input id="check48" class="form-check-input" type="checkbox"> <input id="op48" type="number" name = "HRHM" value="0"  required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Regional de <font style="color:blue">João Câmara</font></label>
    <input id="check49" class="form-check-input" type="checkbox"> <input id="op49" type="number" name = "HRJC" value="0"  required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Regional T.F. Fontes - <font style="color:blue">Caicó</font></label>
    <input id="check50" class="form-check-input" type="checkbox"> <input id="op50" type="number" name = "HRTFF" value="0"  required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Dr. M. Coelho - <font style="color:blue">Currais Novos</font></label>
    <input id="check51" class="form-check-input" type="checkbox"> <input id="op51" type="number" name = "HDMC" value="0"  required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Regional M. Expedito - <font style="color:blue">SPP</font></label>
    <input id="check52" class="form-check-input" type="checkbox"> <input id="op52" type="number" name = "HRME" value="0" required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Dr. C. C. de Andrade - <font style="color:blue">PF</font></label>
    <input id="check53" class="form-check-input" type="checkbox"> <input id="op53" type="number" name = "HDCCA" value="0"  required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">Compl. Hosp. M.W. Gurgel | P.S. Clóvis Sarinho - <font style="color:blue">Natal</font></label>
    <input id="check54" class="form-check-input" type="checkbox"> <input id="op54" type="number" name = "CHWG" value="0" required  class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Dr. J.P. Bezerra - <font style="color:blue">Natal</font></label>
    <input id="check55" class="form-check-input" type="checkbox"> <input id="op55" type="number" name = "HDJPB" value="0"  required class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. G. Trigueiro - <font style="color:blue">Natal</font></label>
    <input id="check56" class="form-check-input" type="checkbox"> <input id="op56" type="number" name = "HGT" value="0" required  class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Colônia Dr. J. Machado - <font style="color:blue">Natal</font></label>
    <input id="check57" class="form-check-input" type="checkbox"> <input id="op57" type="number" name = "HCDJM" value="0" required  class="form-control" >
  </div>

  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Central Cel. P. Germano (HPM) - <font style="color:blue">Natal</font></label>
    <input id="check58" class="form-check-input" type="checkbox"> <input id="op58" type="number" name = "HCCPG" value="0" required  class="form-control" >
  </div>


  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Pediátrico M. Alice F. - <font style="color:blue">Natal</font></label>
    <input id="check59" class="form-check-input" type="checkbox"> <input id="op59" type="number" name = "HPMAF" value="0" required  class="form-control" >
  </div>


  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Dr. D. Marques de L. - <font style="color:blue">Parnamirim</font></label>
    <input id="check60" class="form-check-input" type="checkbox"> <input id="op60" type="number" name = "HDDML" value="0" required class="form-control" >
  </div>


  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Regional A. Mesquita - <font style="color:blue">Macaíba</font></label>
    <input id="check61" class="form-check-input" type="checkbox"> <input id="op61" type="number" name = "HRAM" value="0" required class="form-control" >
  </div>


  <div class="col-md-1">
    <label for="inputZip" class="form-check-label">H. Regional N.I. dos Santos - <font style="color:blue">Assú</font></label>
    <input id="check62" class="form-check-input" type="checkbox"> <input id="op62" type="number" name = "HRNIS" value="0" required class="form-control" >
  </div>


  
  
  <div class="row justify-content-center">
    <button type="submit" style = "margin: 1%;" name="cadastrar" class="btn btn-primary">Enviar</button>
    
  </div>

  
  
</form>
</div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>


       <script type="text/javascript">
      $('[id="check"]').change(function() {
      $('[id="op"]').toggle(100);
      });

      $('[id="check1"]').change(function() {
      $('[id="op1"]').toggle(100);
      });

      $('[id="check2"]').change(function() {
      $('[id="op2"]').toggle(100);
      });

      $('[id="check3"]').change(function() {
      $('[id="op3"]').toggle(100);
      });

      $('[id="check4"]').change(function() {
      $('[id="op4"]').toggle(100);
      });

      $('[id="check5"]').change(function() {
      $('[id="op5"]').toggle(100);
      });

      $('[id="check6"]').change(function() {
      $('[id="op6"]').toggle(100);
      });

      $('[id="check7"]').change(function() {
      $('[id="op7"]').toggle(100);
      });

      $('[id="check8"]').change(function() {
      $('[id="op8"]').toggle(100);
      });

      $('[id="check9"]').change(function() {
      $('[id="op9"]').toggle(100);
      });

      $('[id="check10"]').change(function() {
      $('[id="op10"]').toggle(100);
      });

      $('[id="check11"]').change(function() {
      $('[id="op11"]').toggle(100);
      });

      $('[id="check12"]').change(function() {
      $('[id="op12"]').toggle(100);
      });

      $('[id="check13"]').change(function() {
      $('[id="op13"]').toggle(100);
      });

      $('[id="check14"]').change(function() {
      $('[id="op14"]').toggle(100);
      });

      $('[id="check15"]').change(function() {
      $('[id="op15"]').toggle(100);
      });

      $('[id="check16"]').change(function() {
      $('[id="op16"]').toggle(100);
      });

      $('[id="check17"]').change(function() {
      $('[id="op17"]').toggle(100);
      });

      $('[id="check18"]').change(function() {
      $('[id="op18"]').toggle(100);
      });

      $('[id="check19"]').change(function() {
      $('[id="op19"]').toggle(100);
      });

      $('[id="check20"]').change(function() {
      $('[id="op20"]').toggle(100);
      });

      $('[id="check21"]').change(function() {
      $('[id="op21"]').toggle(100);
      });

      $('[id="check22"]').change(function() {
      $('[id="op22"]').toggle(100);
      });

      $('[id="check23"]').change(function() {
      $('[id="op23"]').toggle(100);
      });

      $('[id="check24"]').change(function() {
      $('[id="op24"]').toggle(100);
      });

      $('[id="check25"]').change(function() {
      $('[id="op25"]').toggle(100);
      });

      $('[id="check26"]').change(function() {
      $('[id="op26"]').toggle(100);
      });

      $('[id="check27"]').change(function() {
      $('[id="op27"]').toggle(100);
      });

      $('[id="check29"]').change(function() {
      $('[id="op29"]').toggle(100);
      });

      $('[id="check30"]').change(function() {
      $('[id="op30"]').toggle(100);
      });

      $('[id="check31"]').change(function() {
      $('[id="op31"]').toggle(100);
      });

      $('[id="check32"]').change(function() {
      $('[id="op32"]').toggle(100);
      });


      $('[id="check33"]').change(function() {
      $('[id="op33"]').toggle(100);
      });

      $('[id="check34"]').change(function() {
      $('[id="op34"]').toggle(100);
      });

       $('[id="check35"]').change(function() {
      $('[id="op35"]').toggle(100);
      });

      $('[id="check36"]').change(function() {
      $('[id="op36"]').toggle(100);

      }); $('[id="check37"]').change(function() {
      $('[id="op37"]').toggle(100);
      });

      $('[id="check38"]').change(function() {
      $('[id="op38"]').toggle(100);
      });

      $('[id="check39"]').change(function() {
      $('[id="op39"]').toggle(100);
      });

      $('[id="check40"]').change(function() {
      $('[id="op40"]').toggle(100);
      });

      $('[id="check41"]').change(function() {
      $('[id="op41"]').toggle(100);
      });

      $('[id="check42"]').change(function() {
      $('[id="op42"]').toggle(100);
      });

      $('[id="check43"]').change(function() {
      $('[id="op43"]').toggle(100);
      });

      $('[id="check44"]').change(function() {
      $('[id="op44"]').toggle(100);
      });

      $('[id="check45"]').change(function() {
      $('[id="op45"]').toggle(100);
      });

      $('[id="check46"]').change(function() {
      $('[id="op46"]').toggle(100);
      });

      $('[id="check47"]').change(function() {
      $('[id="op47"]').toggle(100);
      });

      $('[id="check48"]').change(function() {
      $('[id="op48"]').toggle(100);
      });

      $('[id="check49"]').change(function() {
      $('[id="op49"]').toggle(100);
      });

      $('[id="check50"]').change(function() {
      $('[id="op50"]').toggle(100);
      });

      $('[id="check51"]').change(function() {
      $('[id="op51"]').toggle(100);
      });

      $('[id="check52"]').change(function() {
      $('[id="op52"]').toggle(100);
      });

      $('[id="check53"]').change(function() {
      $('[id="op53"]').toggle(100);
      });

      $('[id="check54"]').change(function() {
      $('[id="op54"]').toggle(100);
      });

      $('[id="check55"]').change(function() {
      $('[id="op55"]').toggle(100);
      });

      $('[id="check56"]').change(function() {
      $('[id="op56"]').toggle(100);
      });

      $('[id="check57"]').change(function() {
      $('[id="op57"]').toggle(100);
      });

      $('[id="check58"]').change(function() {
      $('[id="op58"]').toggle(100);
      });

      $('[id="check59"]').change(function() {
      $('[id="op59"]').toggle(100);
      });

      $('[id="check60"]').change(function() {
      $('[id="op60"]').toggle(100);
      });

      $('[id="check61"]').change(function() {
      $('[id="op61"]').toggle(100);
      });

      $('[id="check62"]').change(function() {
      $('[id="op62"]').toggle(100);
      });

  
    </script>  
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
        url: 'buscaDemonstrativo.php',
        data: 'objeto='+objeto, //x-www-form-urlencoded	
        dataType: 'json',
        success: dados => {
            var option;	
            option += '<option selected disabled value="">'+ 'Selecionar' +'</option>';		
            if (dados.length > 0){
              $.each(dados, function(i, obj){
                option += `<option value =${obj.id_demonstrativo}>${obj.numItemDG}. ${obj.descItemDemo}</option>`;
              })
            }
            $('#id_demonstrativo').html(option).show();
        }		
    }) 
  })

})


setTimeout(function() {
   $('#msg').fadeOut('fast');
}, 1500);
  </script>

    
</body>
</html>
