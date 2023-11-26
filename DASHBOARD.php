<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS DO BOOTSTRAP -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- SCRIPTS DO BOOTSTRAP -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

<!-- JAVASCRIPT DO BOOTSTRAP -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>ANIMAL SECURITY</title>

</head>
<body>
  
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ANIMAL SECURITY</a>
  </div>
</nav>


<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Navbar</span>
  </div>
</nav>
</body>
</html>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        padding: 20px;
        background-color: #1e2b19;
        font-size: 16px;
    }

    h2{
      color: #b1b508;
    }

    .nav-link {
        color: #ffffff;
    }

    .content {
        margin-left: 250px;
        padding: 20px;
    }

.feedback-container {
  width: 1200px;
  margin: 30px auto;
  margin-left: 275px;
  padding: 20px;
  background-color: #ffg;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.feedback-container h2 {
  margin-top: 0;
  font-size: 18px;
}

#feedback-form {
  margin-top: 10px;
}

#feedback-input {
  width: 100%;
  height: 100px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

#feedback-input:focus {
  outline: none;
  border-color: #66afe9;
}

button[type="submit"] {
  width: 1160px;
  display: block;
  margin-top: 10px;
  padding: 5px 10px;
  background-color: #1e2b19;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #1e2b19;
}
.sidebar img {
        width: 200px;
        height: auto;
        margin-bottom: 10px;
    }


</style>
</head>
<body>
<div class="sidebar">
    <img src="/animalsecurity/images/logo.png" alt="LoSecuritygo Animal ">
    <br><br><br><br>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="machine.php">Reconhecimento de animais</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Animais em extinção</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Ultimas noticias</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Sobre nós</a>
        </li>
    </ul>
</div>

    <div class="content">
        <h2>Informações Importantes</h2>
        <p>A importância do cuidado com os animais em extinção é fundamental para preservar a biodiversidade e manter o equilíbrio dos ecossistemas. Os animais desempenham papéis vitais na cadeia alimentar, na polinização de plantas e na manutenção do ciclo dos nutrientes. Além disso, eles contribuem para a saúde dos ecossistemas e proporcionam benefícios essenciais para os seres humanos, como a produção de alimentos, medicamentos e recursos naturais.</p>
    </div>

    <div class="content">
        <h2>Manual do usuário</h2>
        <p>Para fazer o reconhecimento de animais em extinção usando a câmera, siga estas etapas simples:

Acesse o sistema dedicado de reconhecimento de animais em extinção.
Inicie a câmera do seu dispositivo dentro do sistema.
Posicione o dispositivo em direção ao animal que você deseja reconhecer.
Aguarde alguns instantes enquanto o sistema processa a imagem capturada.
O sistema utilizará inteligência artificial para identificar a espécie animal.
O resultado do reconhecimento será exibido na tela, mostrando o nome da espécie.
Lembre-se de que todas as imagens capturadas são armazenadas de forma segura em nosso servidor, garantindo a privacidade dos usuários.</p>
    </div>
    <div class="feedback-container">
  <h2>Deixe seu feedback, dúvidas e sujestões de melhorias:</h2>
  <form id="feedback-form">
    <textarea id="feedback-input" rows="4" placeholder="Digite seu feedback aqui"></textarea>
    <button type="submit">Enviar</button>
  </form>
</div>



<div>Teachable Machine Image Model</div>
<button type="button" onclick="init()">Start</button>
<div id="webcam-container"></div>
<div id="label-container"></div>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
<script type="text/javascript">
    // More API functions here:
    // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

    // the link to your model provided by Teachable Machine export panel
    const URL = "https://teachablemachine.withgoogle.com/models/e5REUhoWl/";

    let model, webcam, labelContainer, maxPredictions;

    // Load the image model and setup the webcam
    async function init() {
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";

        // load the model and metadata
        // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
        // or files from your local hard drive
        // Note: the pose library adds "tmImage" object to your window (window.tmImage)
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();

        // Convenience function to setup a webcam
        const flip = true; // whether to flip the webcam
        webcam = new tmImage.Webcam(200, 200, flip); // width, height, flip
        await webcam.setup(); // request access to the webcam
        await webcam.play();
        window.requestAnimationFrame(loop);

        // append elements to the DOM
        document.getElementById("webcam-container").appendChild(webcam.canvas);
        labelContainer = document.getElementById("label-container");
        for (let i = 0; i < maxPredictions; i++) { // and class labels
            labelContainer.appendChild(document.createElement("div"));
        }
    }

    async function loop() {
        webcam.update(); // update the webcam frame
        await predict();
        window.requestAnimationFrame(loop);
    }

    // run the webcam image through the image model
    async function predict() {
        // predict can take in an image, video or canvas html element
        const prediction = await model.predict(webcam.canvas);
        for (let i = 0; i < maxPredictions; i++) {
            const classPrediction =
                prediction[i].className + ": " + prediction[i].probability.toFixed(2);
            labelContainer.childNodes[i].innerHTML = classPrediction;
        }
    }
</script>
