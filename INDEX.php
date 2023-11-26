<?php
$mensagem = '';

include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Email = $_POST['username'];
    $Senha = $_POST['password'];

    $query = "SELECT * FROM biologo WHERE Email = '$Email' AND Senha = '$Senha'";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) == 1) {
        echo '<script>alert("Acesso liberado! Aguarde, em breve voce será redirecionado");</script>';
        echo '<script>setTimeout(function(){ window.location.href = "DASHBOARD.php"; }, 3000);</script>';
        exit();
    } else {
        echo '<script>alert("Login Bloqueado! Email ou senha incorretos.");</script>';
        echo '<script>setTimeout(function(){ window.location.href = "INDEX.php"; }, 1000);</script>';
        $mensagem = 'Email ou senha incorretos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="/ANIMALSECURITY/ESTILIZACAOPRINCIPAL.CSS" />
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
  width: 280px;
  height: 620px;
  margin: 50px auto 0;
  margin-left: 1040px;
  background-color: rgba(255, 255, 255, 0.8);
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

h1 {
  text-align: center;
  color: #333;
  font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
  font-size: 40px;
}

h2 {
  text-align: center;
  color: #9a6708;
  font-size: 15px;
}

input[type="text"],
input[type="password"] {
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

footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #1e2b19;
  color: #fff;
  padding: 12px;
  text-align: center;
}

footer ul {
  display: flex;
  justify-content: center;
  list-style: none;
  padding: 0;
}

footer li {
  margin: 0 15px;
}

footer li a {
  color: #b1b508;
}
    </style>

</head>
<body>

    <div class="container">
        <form action="INDEX.php" method="POST">
            <br />
            <h1>Login de acesso</h1>
            <h2>
                Os animais em extinção são espécies que correm o risco de desaparecer
                completamente da Terra. A extinção é uma manifestação natural que
                ocorre ao longo da história da vida na Terra, mas o ritmo atual de
                extinção é alarmante e está diretamente relacionado às atividades
                humanas.
            </h2>
            <br /><br /><br /><br /><br /><br />
            <input
                type="text"
                id="username"
                name="username"
                placeholder="E-mail"
                required
            /><br />
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Senha"
              required
          /><br />
<?php if (!empty($mensagem)) : ?>
    <p><?php echo $mensagem; ?></p>
<?php endif; ?>
<input type="submit" value="Entrar" /><br /><br />
<a href="/ANIMALSECURITY/CADASTRO.php">Sou novo aqui</a>
        </form>
    </div>
    <footer>
        <ul>
            <li><a href="#">Serviços sem Login</a></li>
            <li><a href="#">Administração</a></li>
        </ul>
    </footer>
</body>
</html>