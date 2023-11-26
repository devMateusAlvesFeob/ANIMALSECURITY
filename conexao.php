<!--CRIAÇÃO DA CONEÇÃO COM O BANCO DE DADOS, FORNECENDO AS INFORMAÇÕES DE ACESSO-->
    
<?php
 $dbHost = 'localhost';
 $dbUsername = 'root';
 $dbPassword = '';
 $dbName = 'desenvolvimentoweb';
 $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
?>
