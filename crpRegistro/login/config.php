<?php

    $dbHost = 'localhost';
    $dbUsername = 'compras';
    $dbPassword = '#compr@s20';
    $dbName = 'crp';
    
    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    // if($conexao->connect_errno)
    // {
    //     echo "Erro";
    // }
    // else
    // {
    //     echo "Conexão efetuada com sucesso";
    // }

?>
