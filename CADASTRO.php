<!-- INICIALIZACAO CODIGO PHP COM DECLARAÇÃO DAS VARIAVEIS -->
<?php
$IdBiologo = $Nome = $Cpf = $Registro = $Email = $Telefone = $Senha = '';
$mensagem = '';

// INCORPORANDO A CONEXÃO A SER UTILIZADA AO CODIGO PHP
include_once('conexao.php');

// PASSANDO AS VARIAVEIS PARA A SUA RESPECTIVA VARIAVEL QUE VAI ARMAZENAR AS INFORMAÇÕES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Nome = $_POST['nome'];
    $Cpf = $_POST['cpf'];
    $Registro = $_POST['registro'];
    $Email = $_POST['email'];
    $Telefone = $_POST['telefone'];
    $Senha = $_POST['senha'];

    $result = mysqli_query($conexao, "INSERT INTO biologo(idBiologo, Nome, Cpf, Registro, Email, Telefone, Senha)
        VALUES ('$IdBiologo', '$Nome', '$Cpf', '$Registro', '$Email', '$Telefone', '$Senha')");

    if ($result) {
        //EXIBIR ALERTA JAVASCRIPT COM A MENSAGEM E REDIRECIONAR APÓS 3 SEGUNDOS
        echo '<script>
                alert("Usuário cadastrado com sucesso! Você será redirecionado.");
                setTimeout(function() {
                    window.location.href = "index.php";
                }, 3000);
              </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="/ESTILIZACAO02.CSS" />
    
    <title>ANIMAL SECURITY</title>
    <style>
  body {
  background-image: url("/ANIMALSECURITY/IMAGES/FUNDOLOGIN.jpg");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  font-family: Arial, sans-serif;
}

.container {
  width: 550px;
  margin: 0 auto;
  margin-top: 50px;
  margin-left: 875px;
  background-color: rgba(255, 255, 255, 0.8);
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

h1 {
  text-align: center;
  color: #333;
}

h2 {
  text-align: center;
  color: #9a6708;
  font-size: 15px;
}

input[type="text"],
input[type="password"],
input[type="email"],
input[type="tel"] {
  width: 95%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

input[type="submit"] {
  width: 100%;
  padding: 10px;
  background-color: #304502;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem Vindo a Animal Security</h1>
        <h2>
            Para acessar nosso sistema é necessário ser credenciado, para isso basta
            preencher o formulário com os seguintes dados abaixo:
        </h2>

        <form method="POST" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required />

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required />

            <label for="registro">Número do Registro:</label>
            <input type="text" id="registro" name="registro" required />

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required />

            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required />

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required />

            <input type="submit" value="Cadastrar" />
        </form><br><br>
    </div>
</body>
</html>
