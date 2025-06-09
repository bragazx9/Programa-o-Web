<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corrida de Veículos Autônomos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --success: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning: linear-gradient(135deg, #fc4a1a 0%, #f7b733 100%);
            --dark: #0f0f23;
            --card-bg: rgba(255, 255, 255, 0.1);
            --glass: rgba(255, 255, 255, 0.15);
            --text: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.8);
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            --glow: 0 0 20px rgba(102, 126, 234, 0.4);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(102, 126, 234, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(118, 75, 162, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 50% 10%, rgba(75, 172, 254, 0.1) 0%, transparent 50%);
            color: var(--text);
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Elementos de fundo animados */
        .bg-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .road-line {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            height: 2px;
            width: 100px;
            animation: roadMove 3s linear infinite;
        }

        .road-line:nth-child(1) { top: 20%; animation-delay: 0s; }
        .road-line:nth-child(2) { top: 40%; animation-delay: 1s; }
        .road-line:nth-child(3) { top: 60%; animation-delay: 2s; }
        .road-line:nth-child(4) { top: 80%; animation-delay: 0.5s; }

        @keyframes roadMove {
            0% { left: -100px; opacity: 0; }
            50% { opacity: 1; }
            100% { left: 100%; opacity: 0; }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: var(--shadow);
            position: relative;
            z-index: 2;
        }

        h1 {
            font-family: 'Orbitron', monospace;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            text-align: center;
            margin-bottom: 2rem;
            background: var(--accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(75, 172, 254, 0.5);
            position: relative;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--accent);
            border-radius: 2px;
        }

        .section-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 2.5rem 0 1.5rem 0;
            background: var(--warning);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .vehicles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .vehicle-card {
            background: var(--card-bg);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .vehicle-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .vehicle-card:hover {
            transform: translateY(-8px) rotate(1deg);
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.4),
                var(--glow);
            border-color: rgba(102, 126, 234, 0.5);
        }

        .vehicle-card:hover::before {
            transform: scaleX(1);
        }

        .vehicle-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
            text-align: center;
        }

        .tesla-icon { color: #ff4757; }
        .drone-icon { color: #3742fa; }
        .scooter-icon { color: #2ed573; }

        .vehicle-name {
            font-family: 'Orbitron', monospace;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            background: var(--success);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .vehicle-stats {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.2);
            padding: 1rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .stat-value {
            font-weight: 700;
            font-size: 1.1rem;
            background: var(--accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .race-section {
            margin-top: 3rem;
            text-align: center;
        }

        .start-race-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 1.5rem 3rem;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .start-race-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .start-race-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .start-race-btn:hover::before {
            left: 100%;
        }

        .winner-section {
            margin-top: 2rem;
            padding: 2rem;
            background: var(--success);
            border-radius: 20px;
            text-align: center;
            transform: scale(0);
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            opacity: 0;
        }

        .winner-section.show {
            transform: scale(1);
            opacity: 1;
            animation: celebrateWin 2s ease-in-out;
        }

        @keyframes celebrateWin {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.05) rotate(1deg); }
            75% { transform: scale(1.05) rotate(-1deg); }
        }

        .winner-title {
            font-family: 'Orbitron', monospace;
            font-size: 2rem;
            font-weight: 900;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .winner-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            padding: 1rem;
            border-radius: 12px;
            margin-top: 1rem;
        }

        .race-track {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            border: 2px dashed rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .race-progress {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .vehicle-lane {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        .vehicle-progress {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .progress-bar {
            flex: 1;
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: var(--accent);
            width: 0%;
            transition: width 2s ease-out;
            border-radius: 4px;
        }

        .vehicle-time {
            margin-left: 1rem;
            font-weight: 600;
            min-width: 80px;
            text-align: right;
        }

        .floating-emoji {
            position: absolute;
            font-size: 2rem;
            animation: float 3s ease-in-out infinite;
            pointer-events: none;
        }

        .floating-emoji:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
        .floating-emoji:nth-child(2) { top: 20%; right: 15%; animation-delay: 1s; }
        .floating-emoji:nth-child(3) { bottom: 15%; left: 20%; animation-delay: 2s; }
        .floating-emoji:nth-child(4) { bottom: 25%; right: 10%; animation-delay: 0.5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.7; }
            50% { transform: translateY(-20px) rotate(10deg); opacity: 1; }
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                padding: 2rem 1rem;
            }

            .vehicles-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .vehicle-card {
                padding: 1.5rem;
            }

            .start-race-btn {
                padding: 1rem 2rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Elementos de fundo -->
    <div class="bg-elements">
        <div class="road-line"></div>
        <div class="road-line"></div>
        <div class="road-line"></div>
        <div class="road-line"></div>
    </div>

    <!-- Emojis flutuantes -->
    <div class="floating-emoji">🏎️</div>
    <div class="floating-emoji">🚁</div>
    <div class="floating-emoji">🛴</div>
    <div class="floating-emoji">🏁</div>

    <div class="container">
        <?php
        abstract class Veiculo {
            protected $modelo;
            protected $velocidadeMaxima;
            
            public function __construct($modelo, $velocidadeMaxima) {
                $this->modelo = $modelo;
                $this->velocidadeMaxima = $velocidadeMaxima;
            }
            
            public function getModelo() {
                return $this->modelo;
            }
            
            public function getVelocidadeMaxima() {
                return $this->velocidadeMaxima;
            }
            
            public function mostrarInfo() {
                return [
                    'modelo' => $this->modelo,
                    'velocidade' => $this->velocidadeMaxima
                ];
            }

            abstract public function mover();
        }

        class CarroAutonomo extends Veiculo {
            public function mover() {
                return $this->velocidadeMaxima * 0.2;
            }
        }

        class Drone extends Veiculo {
            private $autonomia;
            
            public function __construct($modelo, $velocidadeMaxima, $autonomia) {
                parent::__construct($modelo, $velocidadeMaxima);
                $this->autonomia = $autonomia;
            }
            
            public function mover() {
                return $this->velocidadeMaxima * 0.3;
            }

            public function getAutonomia() {
                return $this->autonomia;
            }
        }

        class PatineteEletrico extends Veiculo {
            public function mover() {
                return 5;
            }
        }

        // Criando os veículos
        $carro = new CarroAutonomo("Tesla Model X", 150);
        $drone = new Drone("DJI Phantom", 80, 100);
        $patinete = new PatineteEletrico("Xiaomi M365", 25);

        echo "<h1><i class='fas fa-flag-checkered'></i> Corrida de Veículos Autônomos</h1>";
        
        // Mostrando informações dos veículos
        echo "<h3 class='section-title'><i class='fas fa-info-circle'></i> Competidores</h3>";
        echo "<div class='vehicles-grid'>";
        
        // Tesla
        $carroInfo = $carro->mostrarInfo();
        echo "<div class='vehicle-card'>";
        echo "<div class='vehicle-icon tesla-icon'><i class='fas fa-car'></i></div>";
        echo "<div class='vehicle-name'>{$carroInfo['modelo']}</div>";
        echo "<div class='vehicle-stats'>";
        echo "<div class='stat-item'>";
        echo "<span class='stat-label'><i class='fas fa-tachometer-alt'></i> Velocidade Máx.</span>";
        echo "<span class='stat-value'>{$carroInfo['velocidade']} km/h</span>";
        echo "</div>";
        echo "<div class='stat-item'>";
        echo "<span class='stat-label'><i class='fas fa-cogs'></i> Velocidade na Corrida</span>";
        echo "<span class='stat-value'>" . $carro->mover() . " km/h</span>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        // Drone
        $droneInfo = $drone->mostrarInfo();
        echo "<div class='vehicle-card'>";
        echo "<div class='vehicle-icon drone-icon'><i class='fas fa-helicopter'></i></div>";
        echo "<div class='vehicle-name'>{$droneInfo['modelo']}</div>";
        echo "<div class='vehicle-stats'>";
        echo "<div class='stat-item'>";
        echo "<span class='stat-label'><i class='fas fa-tachometer-alt'></i> Velocidade Máx.</span>";
        echo "<span class='stat-value'>{$droneInfo['velocidade']} km/h</span>";
        echo "</div>";
        echo "<div class='stat-item'>";
        echo "<span class='stat-label'><i class='fas fa-battery-full'></i> Autonomia</span>";
        echo "<span class='stat-value'>{$drone->getAutonomia()} min</span>";
        echo "</div>";
        echo "<div class='stat-item'>";
        echo "<span class='stat-label'><i class='fas fa-cogs'></i> Velocidade na Corrida</span>";
        echo "<span class='stat-value'>" . $drone->mover() . " km/h</span>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        // Patinete
        $patineteInfo = $patinete->mostrarInfo();
        echo "<div class='vehicle-card'>";
        echo "<div class='vehicle-icon scooter-icon'><i class='fas fa-motorcycle'></i></div>";
        echo "<div class='vehicle-name'>{$patineteInfo['modelo']}</div>";
        echo "<div class='vehicle-stats'>";
        echo "<div class='stat-item'>";
        echo "<span class='stat-label'><i class='fas fa-tachometer-alt'></i> Velocidade Máx.</span>";
        echo "<span class='stat-value'>{$patineteInfo['velocidade']} km/h</span>";
        echo "</div>";
        echo "<div class='stat-item'>";
        echo "<span class='stat-label'><i class='fas fa-cogs'></i> Velocidade na Corrida</span>";
        echo "<span class='stat-value'>" . $patinete->mover() . " km/h</span>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        echo "</div>";

        // Seção da corrida
        echo "<div class='race-section'>";
        echo "<h3 class='section-title'><i class='fas fa-flag-checkered'></i> Pista de Corrida</h3>";
        echo "<div class='race-track'>";
        echo "<p style='margin-bottom: 1rem; font-size: 1.1rem;'><i class='fas fa-route'></i> Distância da corrida: <strong>50 km</strong></p>";
        
        // Função para rodar a corrida
        function corrida($veiculos, $distancia) {
            $resultados = [];
            foreach ($veiculos as $veiculo) {
                $tempo = $distancia / $veiculo->mover();
                $resultados[$veiculo->getModelo()] = $tempo;
            }
            asort($resultados);
            
            echo "<div class='race-progress'>";
            $posicao = 1;
            foreach ($resultados as $modelo => $tempo) {
                $icon = '';
                $bgColor = '';
                if (strpos($modelo, 'Tesla') !== false) {
                    $icon = '🚗';
                    $bgColor = 'rgba(255, 71, 87, 0.2)';
                } elseif (strpos($modelo, 'DJI') !== false) {
                    $icon = '🚁';
                    $bgColor = 'rgba(55, 66, 250, 0.2)';
                } else {
                    $icon = '🛴';
                    $bgColor = 'rgba(46, 213, 115, 0.2)';
                }
                
                echo "<div class='vehicle-lane' style='background: {$bgColor};'>";
                echo "<div class='vehicle-progress'>{$icon}</div>";
                echo "<div style='flex: 1; display: flex; align-items: center; gap: 1rem;'>";
                echo "<span style='font-weight: 600; min-width: 150px;'>{$modelo}</span>";
                echo "<div class='progress-bar'>";
                echo "<div class='progress-fill' style='width: " . (100 - ($posicao - 1) * 20) . "%;'></div>";
                echo "</div>";
                echo "</div>";
                echo "<div class='vehicle-time'>" . number_format($tempo, 2) . " h</div>";
                echo "</div>";
                $posicao++;
            }
            echo "</div>";
            
            $vencedor = key($resultados);
            $tempoVencedor = number_format($resultados[$vencedor], 2);
            
            echo "</div>";
            echo "<div class='winner-section show'>";
            echo "<div class='winner-title'><i class='fas fa-trophy'></i> VENCEDOR DA CORRIDA!</div>";
            echo "<div class='winner-name'>{$vencedor}</div>";
            echo "<p style='color: white; margin-top: 1rem; font-size: 1.1rem;'>";
            echo "<i class='fas fa-stopwatch'></i> Tempo: {$tempoVencedor} horas";
            echo "</p>";
            echo "</div>";
        }

        // Rodar a corrida
        corrida([$carro, $drone, $patinete], 50);
        echo "</div>";
        ?>
    </div>

    <script>
        // Adicionar animações interativas
        document.addEventListener('DOMContentLoaded', function() {
            // Animar as barras de progresso
            setTimeout(() => {
                const progressBars = document.querySelectorAll('.progress-fill');
                progressBars.forEach(bar => {
                    const width = bar.style.width;
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 100);
                });
            }, 500);

            // Animar entrada dos cards
            const cards = document.querySelectorAll('.vehicle-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>
</body>
</html>