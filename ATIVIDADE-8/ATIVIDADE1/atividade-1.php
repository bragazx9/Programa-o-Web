<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batalha de Personagens</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #1a1a1a 0%, #303030 100%);
            color: #fff;
        }

        .battle-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        .character-select {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 20px;
        }

        .character-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 10px;
            width: 45%;
            transition: transform 0.3s ease;
        }

        .character-card:hover {
            transform: translateY(-5px);
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            cursor: pointer;
        }

        .status-bar {
            height: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin: 10px 0;
            overflow: hidden;
        }

        .health-bar {
            height: 100%;
            background: linear-gradient(90deg, #4CAF50, #45a049);
            border-radius: 10px;
            transition: width 0.5s ease-in-out;
        }

        .battle-log {
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            height: 350px;
            overflow-y: auto;
            margin-top: 30px;
            font-family: 'Courier New', monospace;
            line-height: 1.6;
        }

        button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 15px 30px;
            background: linear-gradient(90deg, #4CAF50, #45a049);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(76, 175, 80, 0.4);
        }

        /* Scrollbar personalizada */
        .battle-log::-webkit-scrollbar {
            width: 8px;
        }

        .battle-log::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .battle-log::-webkit-scrollbar-thumb {
            background: #4CAF50;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="battle-container">
        <h1>⚔️ Batalha de Personagens ⚔️</h1>
        
        <div class="character-select">
            <div class="character-card">
                <h2>🦹‍♂️ Personagem 1</h2>
                <select name="player1" id="player1">
                    <option value="guerreiro">⚔️ Guerreiro (Thor)</option>
                    <option value="mago">🧙‍♂️ Mago (Merlin)</option>
                    <option value="arqueiro">🏹 Arqueiro (Legolas)</option>
                </select>
                <div class="status-bar">
                    <div class="health-bar" style="width: 100%"></div>
                </div>
            </div>

            <div class="character-card">
                <h2>🦹‍♂️ Personagem 2</h2>
                <select name="player2" id="player2">
                    <option value="mago">🧙‍♂️ Mago (Merlin)</option>
                    <option value="guerreiro">⚔️ Guerreiro (Thor)</option>
                    <option value="arqueiro">🏹 Arqueiro (Legolas)</option>
                </select>
                <div class="status-bar">
                    <div class="health-bar" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <button onclick="iniciarBatalha()">⚔️ Iniciar Batalha</button>

        <div class="battle-log">
            <?php
            include 'atividade-1.php';
            ob_start();
            $guerreiro = new Guerreiro("Thor", 100, 20, 10);
            $mago = new Mago("Merlin", 80, 15, 5, 40);
            batalha($guerreiro, $mago);
            $battleLog = ob_get_clean();
            echo nl2br($battleLog);
            ?>
        </div>
    </div>

    <script>
        function iniciarBatalha() {
            location.reload();
        }
    </script>
</body>
</html>
