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
    <link rel="stylesheet" type="text/css" href="../registro/css/cadastrar.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="/crpRegistro/imagens/icon-siga.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração</title>
    <style>
        form{
        background-color: #fff;
        border-radius: 15px;
        height: 70%; 
        width: auto;
        padding: 10px 40px;
    }
    </style>
    <?php if(isset($_POST['alterar'])) : ?>
    <?php

    require 'conexao.php';
    $id = $_POST['id'];
    $id_item = $_POST['id_item'];
    $n_Processo= $_POST['n_Processo'];
    $data_processo = $_POST['data_processo'];
    $qtdUtilizadaProcesso = $_POST['qtdUtilizadaProcesso'];
    $sql = "UPDATE processo SET id_item = $id_item, n_Processo = '$n_Processo', data_processo = '$data_processo', qtdUtilizadaProcesso = $qtdUtilizadaProcesso WHERE id = $id;";
    $result = mysqli_query($conn, $sql);



?>

    
        <?php if($result == true) { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:green;"> <?php echo "Alterado com sucesso!" ?> </h2>
            <?php header( "refresh:0.2;url=./filtroProcesso.php" );?>
        <?php } else { ?>
            <h2 id="msg" style = "text-align: center;color:white;background-color:red;"> <?php echo "ERRO!" ?> </h2> 
    <?php } ?>
    <?php else :
        echo ""; 
    endif; ?>
    <title>Alterar</title>
</head>
<body>
    
<?php 
    require 'conexao.php';
    $id_pro= $_GET['id'];
    $sql = "SELECT * FROM processo WHERE id = $id_pro;";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);
    $id = $dados['id'];
    $id_item = $dados['id_item'];
    $n_Processo= $dados['n_Processo'];
    $data_processo = $dados['data_processo'];
    $qtdUtilizadaProcesso = $dados['qtdUtilizadaProcesso'];

    ?>

    
    
<div class="row justify-content-center" style="margin-top: 1%"> 
<a href = "../processos/filtroProcesso.php" ><img src="/imagens/back-arrow.png" width=35 height=35></a>
</div>

<div class="container-second" style="margin: 3% 18% 0 18%">
<div class="box">

    <form style="text-align:center;" class = "row g-3" action = "formAlterarPro.php?id=<?php echo $id?>" method = "POST"> 
    <h1 style = "text-align: center;padding-left:-1.5%"> Formulário de <strong>Alteração</strong> </h1> 
    <hr> <br>
    
    <div class="col-md-4" style="margin:1%;">
    <label class="form-label" for="id" > <strong>#</strong> </label> 
    <input class="form-control" type="number" style = "font-size: medium;" readonly name="id" value="<?php echo $id?>"> 
    </div><br>

    <hr>
   
    <div class="col-md-5" style="margin:1%;">
    <label class="form-label" for="id" > <strong>N° Processo:</strong> </label> 
    <input class="form-control" type="text" style = "font-size: medium;" name="n_Processo" value="<?php echo $n_Processo ?>"> 
    </div><br>

    <div class="col-md-4" style="margin:1%;">
    <label class="form-label"  for="descricao" > <strong> Data do Processo: </strong> </label> 
    <input class="form-control" type="date" name="data_processo" style=" font-size: medium"  style = "font-size: medium" value="<?php echo $data_processo?>">
    </div><br>

    <hr> 
    <div class=row> 
                    <div class="col" >
                    <label class="form-label"> <strong> Objeto<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select" id="objeto"  name="objeto" autocomplete="off">
                          <option selected disabled value="">Selecionar</option>
                       
                        </select> 
                
                </div>

               

                <div class="col" >
                    <label class="form-label"> <strong> Órgão<strong id="asterisco">*</strong>: </strong> </label>
                        <select class="form-select" id="orgao" name="orgao" autocomplete="off">
                          <option selected disabled value="">Selecionar</option>
                          

                        </select> 
                   
                    </div>
                    </div>
    <br>
                    <div class="col-md-5 clearfix" >
                        <label class="form-label">N° do Item <font style="color:red">(selecione o objeto e órgão)</font> </label>
                            <select id="item" name="id_item" required autocomplete="off" class="form-select">
                            <option selected value="<?php echo $id_item ?>"> <?php 
                                                                                require 'conexao.php';
                                                                                $result2 = mysqli_query($conn, "SELECT * FROM registro AS r1 LEFT JOIN demonstrativo_global AS dG ON r1.id_demonstrativo = dG.id_demonstrativo;");
                                                                                while ($dados2 = mysqli_fetch_assoc($result2)) {
                                                                                    if($id_item == $dados2['id_item']) {
                                                                                        echo $dados2['numItemDG'] , ". ", $dados2['descItemDemo'] ;
                                                                                    }
                                                                            }
                            ?>


                        </select> 
                        </div>
            <br>

    <div class="col-md-4" style="margin:1%;">
    <label class="form-label" for="qtdD" > <strong>Qntd. Utilizada Processo:</strong> </label>
    <input class="form-control" type="number" min="0" style="color:red;font-size: medium" name="qtdUtilizadaProcesso" value="<?php echo $qtdUtilizadaProcesso?>">
    </div>
    <br>

    <div class="col-12" style="margin: 2% 0 2% 0%;">
    <button class="btn btn-dark" type="submit" name="alterar"> <strong> Alterar </strong> </button>
    
    </div>
    <br>



   

    </form>
</div>
</div>
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

  

  </script>
</body>
</html>
