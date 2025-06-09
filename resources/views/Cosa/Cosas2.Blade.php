<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables de Página</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #43cea2, #185a9d);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }
        
        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
            position: relative;
            overflow: hidden;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(to right, #43cea2, #185a9d);
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #185a9d;
            text-align: center;
        }
        
        .variables-container {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #43cea2;
        }
        
        .variable {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .variable:last-child {
            margin-bottom: 0;
        }
        
        .variable-name {
            font-weight: bold;
            color: #185a9d;
            background-color: rgba(24, 90, 157, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            margin-right: 1rem;
            min-width: 110px;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .variable-value {
            font-size: 1.1rem;
            word-break: break-all;
            padding: 0.5rem;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            width: 100%;
        }
        
        .result {
            font-size: 1.3rem;
            background-color: #333;
            color: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .absent {
            color: #999;
            font-style: italic;
        }
        
        @media (max-width: 600px) {
            h1 {
                font-size: 1.8rem;
            }
            
            .variable {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .variable-name {
                margin-bottom: 0.5rem;
                margin-right: 0;
                width: 100%;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Resultado</h1>
        
        <div class="variables-container">
            <div class="variable">
                <span class="variable-name">$pagina</span>
                <span class="variable-value">{{ $pagina }}</span>
            </div>
            
            <div class="variable">
                <span class="variable-name">$pagina2</span>
                <span class="variable-value">
                @if(isset($pagina2) && $pagina2 !== null)
                    bienvenido a la pagina : {{ $pagina }} y {{ $pagina2 }}
                @else
                    bienvenido a la pagina : {{ $pagina }}
                @endif
                </span>
            </div>
        </div>
        
        <div class="result">
            @if($pagina2)
                bienvenido a la pagina : {{ $pagina }} y {{ $pagina2 }}
            @else
                bienvenido a la pagina : {{ $pagina }}
            @endif
        </div>
    </div>
</body>
</html>