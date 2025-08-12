<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola xd</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: float 3s ease-in-out infinite;
            position: relative;
            z-index: 10;
            max-width: 90%;
            width: 600px;
        }
        
        h1 {
            font-size: 4rem;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            animation: colorChange 5s infinite alternate;
        }
        
        .php-tag {
            color: #8a2be2;
            font-family: 'Courier New', monospace;
            background-color: #f8f9fa;
            padding: 5px 10px;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
            font-size: 1.2rem;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }
        
        .emoji {
            font-size: 2rem;
            margin-left: 10px;
            display: inline-block;
            animation: wave 1s infinite;
        }
        
        .bubbles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            top: 0;
            left: 0;
        }
        
        .bubble {
            position: absolute;
            bottom: -100px;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            opacity: 0.5;
            animation: rise 10s infinite ease-in-out;
        }
        
        .bubble:nth-child(1) {
            width: 40px;
            height: 40px;
            left: 10%;
            animation-duration: 8s;
        }
        
        .bubble:nth-child(2) {
            width: 60px;
            height: 60px;
            left: 20%;
            animation-duration: 10s;
            animation-delay: 1s;
        }
        
        .bubble:nth-child(3) {
            width: 30px;
            height: 30px;
            left: 35%;
            animation-duration: 7s;
            animation-delay: 2s;
        }
        
        .bubble:nth-child(4) {
            width: 50px;
            height: 50px;
            left: 55%;
            animation-duration: 11s;
            animation-delay: 1s;
        }
        
        .bubble:nth-child(5) {
            width: 35px;
            height: 35px;
            left: 65%;
            animation-duration: 6s;
            animation-delay: 3s;
        }
        
        .bubble:nth-child(6) {
            width: 45px;
            height: 45px;
            left: 80%;
            animation-duration: 9s;
            animation-delay: 2s;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        @keyframes colorChange {
            0% {
                color: #333;
            }
            25% {
                color: #6e8efb;
            }
            50% {
                color: #a777e3;
            }
            75% {
                color: #ff758c;
            }
            100% {
                color: #333;
            }
        }
        
        @keyframes wave {
            0%, 100% {
                transform: rotate(0);
            }
            50% {
                transform: rotate(20deg);
            }
        }
        
        @keyframes rise {
            0% {
                bottom: -100px;
                transform: translateX(0);
            }
            50% {
                transform: translateX(100px);
            }
            100% {
                bottom: 1080px;
                transform: translateX(-100px);
            }
        }
    </style>
</head>
<body>
    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>
    
    <div class="container">
        <?php
        // Define el mensaje
        $mensaje = "Hola xd";
        
        // Muestra el mensaje
        echo "<h1>$mensaje</h1>";
        ?>
        
        <div class="php-tag">
            &lt;?php echo "¡PHP en acción!"; ?&gt;
            <span class="emoji">👋</span>
        </div>
    </div>
</body>
</html>