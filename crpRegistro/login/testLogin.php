<?php
    session_start();
    // print_r($_REQUEST);
    if(isset($_POST['submit']) && !empty($_POST['usuario']) && !empty($_POST['senha']))
    {
        // Acessa
        include_once('config.php');
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $sql = "SELECT * FROM usuarios WHERE BINARY usuario = '$usuario' and BINARY senha = md5('$senha')";
        $result = $conexao->query($sql);
        $dados = mysqli_fetch_assoc($result);
        $nivelAcesso = $dados['nivelAcesso'];

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['usuario']);
            unset($_SESSION['senha']);
            unset($_SESSION['nivelAcesso']);
            header('Location: ../index.html');
            
        }
        else
        {
            
            if ($nivelAcesso == 29) { 
                $_SESSION['usuario'] = $usuario;
                $_SESSION['senha'] = $senha;
                $_SESSION['nivelAcesso'] = 29;
                header('Location: ../admin/inicio.php');
                
            } elseif ($nivelAcesso == 30) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['senha'] = $senha;
                $_SESSION['nivelAcesso'] = 30;
                header('Location: ../servidor/sistema.php'); 

            } elseif ($nivelAcesso != 29 or $nivelAcesso != 30) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['senha'] = $senha;
                $_SESSION['nivelAcesso'] = $nivelAcesso;
                header('Location: ../orgaos/pedidos.php'); 
      
            } else {
                header('Location: ../index.html'); 
                session_destroy();
            }
        }
    }
    else
    {
        // Não acessa
        header('Location: ../index.html');
        session_destroy();
    }
?>