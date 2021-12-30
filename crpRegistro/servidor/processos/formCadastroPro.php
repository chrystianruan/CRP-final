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
<h5> <a class="nav-link active" aria-current="page" href="../sistema.php">Início</a></h5></li>
 <li class="nav-item dropdown">
        <h5> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Cadastrar
          </a> 
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../objeto/cadastrar.php">Objeto</a></li>
            <li><a class="dropdown-item" href="../fornecedor/cadastrar.php">Fornecedor</a></li>
            <li><a class="dropdown-item" href="../demonstrativo/formCadastroDem.php">Itens</a></li>
            <li><a class="dropdown-item" href="../registro/formCadastroReg.php">Demandas</a></li>
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

<?php if(isset($_POST['cadastrar'])) : 


require 'conexao.php';
$item = $_POST['id_item'];
$n_Processo = $_POST['n_Processo'];
$data_processo = $_POST['data_processo'];
$qtdUtilizadaProcesso = $_POST['qtdUtilizadaProcesso'];
$sql = "INSERT INTO processo(n_Processo, data_processo, qtdUtilizadaProcesso, id_item) VALUES ('$n_Processo', '$data_processo', $qtdUtilizadaProcesso, $item);";
$resultA = mysqli_query($conn, $sql);

?>

    
        <?php if($resultA == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green;"> <?php echo "Cadastrado com sucesso!" ?> </h2>
        <?php } else { ?>
            <h2 id="msg1" style = "text-align: center;color:white;background-color:red;"> <?php echo "ERRO!" ?> </h2> 
    <?php } ?>
    <?php else :
        echo ""; 
    endif; ?>
    

    <?php 
    require 'conexao.php';
    $sql = "SELECT * FROM objeto;";
    $result = mysqli_query($conn, $sql);
    $sql2 = "SELECT * FROM orgao;";
    $result2 = mysqli_query($conn, $sql2);
    

    ?>
<div class="container-second" >
    <form class="form-pro" style="margin: 2% 32% 3% 32%;box-shadow: 0 0 1em #808080;" action = "./formCadastroPro.php"  method="POST">
                <fieldset>
                    
                    <h1 id="titulo">Cadastrar Uso</h1>
                    <hr>
                  
                <div class="row">

                 <div class="col">
                    <label class="form-label"> <strong> N° Processo: <strong id="asterisco">*</strong> </strong>  </label>
                        <input class="form-control" required autocomplete type="text" name="n_Processo" placeholder=" 7777777.666666/AAAA-22" <?php if(isset($_POST['cadastrar']) && $resultA == false) {?> value="<?php echo $n_Processo?>" <?php } elseif(isset($_POST['cadastrar']) && $resultA == true)  { ?> value="<?php echo $n_Processo?>" <?php } ?> > </input>
                    </div>
               
                    <div class="col">
                    <label class="form-label"> <strong> Data: <strong id="asterisco">*</strong>  </strong> </label> <br>
                        <input class="form-control" required autocomplete type="date" name = "data_processo" <?php if(isset($_POST['cadastrar']) && $resultA == false) {?> value="<?php echo $data_processo?>" <?php } elseif(isset($_POST['cadastrar']) && $resultA == true)  { ?> value="<?php echo $data_processo?>" <?php } ?>> </input>
                    </div>
                    </div>

                   <hr style="margin: 2%">

                   <div class=row> 
                    <div class="col" >
                    <label class="form-label"> <strong> Objeto: </strong> </label>
                        <select class="form-select" id="objeto"  name="objeto" autocomplete="off">
                          <option selected disabled value="">Selecionar</option>
                       
                        </select> 
                
                </div>

               

                <div class="col" >
                    <label class="form-label"> <strong> Fornecedor: </strong> </label>
                        <select class="form-select" id="fornecedor" name="fornecedor" autocomplete="off">
                          <option selected disabled value="">Selecionar</option>
                          

                        </select> 
                   
                    </div>

                    <div class="col" >
                    <label class="form-label"> <strong> Órgão: </strong> </label>
                        <select class="form-select" id="orgao" name="orgao"  autocomplete="off">
                          <option selected disabled value="">Selecionar</option>
                          

                        </select> 
                   
                    </div>
                    </div>
    <br>
                    <div class="col-md-5 clearfix" >
                        <label class="form-label">N° do Item<font style="color:red">* (selecione o objeto, fornecedor e órgão)</font>:</label>
                            <select id="item" name="id_item" required autocomplete="off" class="form-select">
                            <option selected disabled value=""> Selecionar </option>
                            <?php if(isset($_POST['cadastrar']) && $resultA == false) { ?>
                              <option selected value="<?php echo $item?>"><?php 
                                                                                require 'conexao.php';
                                                                                $result2 = mysqli_query($conn, "SELECT * FROM registro AS r1 LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo;");
                                                                                while ($dados2 = mysqli_fetch_assoc($result2)) {
                                                                                    if($item == $dados2['id_item']) {
                                                                                        echo $dados2['numItemDG'] , ". ", $dados2['descItemDemo'] ;
                                                                                    }
                                                                            }
                            ?> </option>
                              <?php } ?>
                        </select> 
                        </div>
            <br>
                    <div class="col-md-3">
                    <div class="inputs"><label class="form-label"> <strong> Qtd. utilizada: </strong>  </label>
                        <input class="form-control" required autocomplete type="number" name = "qtdUtilizadaProcesso" min="0"<?php if(isset($_POST['cadastrar']) && $resultA == false) {?> value="<?php echo $qtdUtilizadaProcesso?>" <?php } ?>> </input>
                   
                    </div>
                </div>
                 
              
                


                
               


                <br> 
                <div class="row justify-content-center">
                    <button type="submit" style = "margin: 1%;" name="cadastrar" class="btn btn-primary">Enviar</button>
                </div>
        
                
                        </fieldset>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      
            
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
  $.ajax({
    type: 'POST',
    url: 'buscaFornecedor.php',
    dataType: 'json',
    success: dados => {
        var option;	
        option += '<option selected disabled value="">'+ 'Selecionar' +'</option>';		
        if (dados.length > 0){
          $.each(dados, function(i, obj){
            option += `<option value =${obj.id}>${obj.nome}</option>`;
          })
        }
        $('#fornecedor').html(option).show();
    }		
  }) 
  
  $.ajax({
    type: 'POST',
    url: 'buscaOrgao.php',
    dataType: 'json',
    success: dados => {
        var option;	
        option += '<option selected disabled value="">'+ 'Selecionar' +'</option>';		
        if (dados.length > 0){
          $.each(dados, function(i, obj){
            option += `<option value =${obj.id}>${obj.nome}</option>`;
          })
        }
        $('#orgao').html(option).show();
    }		
  }) 

  $('#objeto, #orgao, #fornecedor').on('change', e => {	
    let objeto = $("#objeto").val();
    let orgao = $("#orgao").val();
    let fornecedor = $("#fornecedor").val();
    $.ajax({
        type: 'POST',
        url: 'buscaItem.php',
        data: {objeto: objeto, orgao: orgao, fornecedor: fornecedor}, 
        dataType: 'json',
        success: dados => {
            var option;	
            option += '<option selected disabled value="">'+ 'Selecionar' +'</option>';		
            if (dados.length > 0){
              $.each(dados, function(i, obj){
                option += `<option value =${obj.id_item}>${obj.numItemDG}. ${obj.descItemDemo}</option>`;
              })
            }
            $('#item').html(option).show();
        }		
    }) 
  }) 
})  ;

        setTimeout(function() {
            $('#msg').fadeOut('fast');
            }, 1500);
            setTimeout(function() {
            $('#msg1').fadeOut('fast');
            }, 3000);

  

  </script>

</body>
</html>
