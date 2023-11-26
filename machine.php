<!DOCTYPE html>
<html>
<head>
    <title>ANIMAL SECURITY</title>
    <style>
        body {
            background-image: url("/ANIMALSECURITY/IMAGES/FUNDONEUTRO.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            margin-top: 45px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin: 0 0 20px;
            text-align: center;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #304502;
            color: #ffffff;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; 
        }

        #webcam-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        #label-container {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                margin: 5px 0;
                gap: 20px;
            }

            .label {
                padding: 10px;
                margin: 10px;
                background-color: #f2f2f2;
                border-radius: 4px;
                text-align: center;
                font-size: 14px;
            }

        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }

            h1 {
                font-size: 20px;
            }

            .button {
                font-size: 14px;
                padding: 1000px;
            }

            
                    }

    </style>
</head>
<body>
    <div class="container">
        <h1>IDENTIFICAÇÃO DE ESPÉCIE ENCONTRADA</h1>
       
        <button type="button" onclick="init()" class="button">Iniciar identificação</button>
        
        <div id="webcam-container"></div>
        <div id="label-container"></div>
        <BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>

    <script type="text/javascript">
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
            // predict can take in an image, video, or canvas html element
            const prediction = await model.predict(webcam.canvas);
            for (let i = 0; i < maxPredictions; i++) {
                const classPrediction =
                    prediction[i].className + ": " + prediction[i].probability.toFixed(2);
                labelContainer.childNodes[i].innerHTML = classPrediction;
            }
        }
    </script>
   
</body>