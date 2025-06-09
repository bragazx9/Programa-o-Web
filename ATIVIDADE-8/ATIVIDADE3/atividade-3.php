<?php

// Classe base: Item
class Item {
    protected $nome;
    protected $preco;

    public function __construct($nome, $preco) {
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function usar() {
        echo "Você usou {$this->nome}.\n";
    }

    public function mostrarInfo() {
        echo "Item: {$this->nome} | Preço: {$this->preco} moedas\n";
    }
}

// ItemCura
class ItemCura extends Item {
    private $quantidadeCura;

    public function __construct($nome, $preco, $quantidadeCura) {
        parent::__construct($nome, $preco);
        $this->quantidadeCura = $quantidadeCura;
    }

    public function usar() {
        echo "Você usou {$this->nome} e recuperou {$this->quantidadeCura} pontos de vida!\n";
    }
}

// ItemDano
class ItemDano extends Item {
    private $dano;

    public function __construct($nome, $preco, $dano) {
        parent::__construct($nome, $preco);
        $this->dano = $dano;
    }

    public function usar() {
        echo "Você usou {$this->nome} e causou {$this->dano} de dano ao inimigo!\n";
    }
}

// ItemBuff
class ItemBuff extends Item {
    private $tipoBuff;
    private $valor;

    public function __construct($nome, $preco, $tipoBuff, $valor) {
        parent::__construct($nome, $preco);
        $this->tipoBuff = $tipoBuff;
        $this->valor = $valor;
    }

    public function usar() {
        echo "Você usou {$this->nome} e ganhou um aumento de {$this->valor} em {$this->tipoBuff}!\n";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🎮 Loja Mágica</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Inter:wght@300;400;500;600&display=swap');

  :root {
    --primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --gold: linear-gradient(135deg, #ffd700 0%, #ffb347 100%);
    --dark: #0a0a0a;
    --card-dark: rgba(255, 255, 255, 0.05);
    --glass: rgba(255, 255, 255, 0.1);
    --text: #ffffff;
    --text-muted: rgba(255, 255, 255, 0.7);
    --shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    --glow: 0 0 20px rgba(102, 126, 234, 0.3);
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    background: var(--dark);
    background-image: 
      radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
      radial-gradient(circle at 80% 20%, rgba(118, 75, 162, 0.1) 0%, transparent 50%),
      radial-gradient(circle at 40% 80%, rgba(75, 172, 254, 0.1) 0%, transparent 50%);
    color: var(--text);
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    overflow-x: hidden;
  }

  /* Partículas flutuantes */
  .particles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
  }

  .particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(102, 126, 234, 0.6);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
    50% { transform: translateY(-100px) rotate(180deg); opacity: 1; }
  }

  header {
    background: var(--primary);
    backdrop-filter: blur(20px);
    text-align: center;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  header::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    animation: shine 3s infinite;
  }

  @keyframes shine {
    0% { left: -100%; }
    100% { left: 100%; }
  }

  header h1 {
    font-family: 'Orbitron', monospace;
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 900;
    background: var(--gold);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
    position: relative;
    z-index: 2;
  }

  .subtitle {
    font-size: 1.1rem;
    margin-top: 0.5rem;
    color: var(--text-muted);
    font-weight: 300;
  }

  .game-stats {
    position: fixed;
    top: 20px;
    right: 20px;
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    padding: 1.5rem;
    z-index: 1000;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
  }

  .game-stats:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
  }

  .stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0.8rem 0;
    font-weight: 500;
  }

  .stat-icon {
    width: 20px;
    text-align: center;
  }

  .container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 1400px;
    margin: 3rem auto;
    padding: 0 2rem;
    position: relative;
    z-index: 2;
  }

  .item {
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
  }

  .item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--accent);
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }

  .item:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 
      0 20px 60px rgba(0, 0, 0, 0.4),
      var(--glow);
    border-color: rgba(102, 126, 234, 0.5);
  }

  .item:hover::before {
    transform: scaleX(1);
  }

  .item-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
    background: var(--accent);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    filter: drop-shadow(0 0 10px rgba(75, 172, 254, 0.5));
  }

  .item h2 {
    font-family: 'Orbitron', monospace;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 1rem;
    background: var(--gold);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .item-stats {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 1rem;
    border-radius: 12px;
    margin: 1.5rem 0;
    backdrop-filter: blur(10px);
  }

  .stat-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0.5rem 0;
    font-weight: 500;
  }

  .stat-value {
    background: var(--secondary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 600;
  }

  .usar-btn {
    background: var(--primary);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 600;
    font-size: 1rem;
    width: 100%;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
  }

  .usar-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
  }

  .usar-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
  }

  .usar-btn:hover::before {
    left: 100%;
  }

  .usar-btn:active {
    transform: translateY(0);
  }

  .inventario {
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2rem;
    max-width: 1200px;
    margin: 3rem auto;
    box-shadow: var(--shadow);
    position: relative;
    z-index: 2;
  }

  .inventario h2 {
    font-family: 'Orbitron', monospace;
    text-align: center;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    background: var(--accent);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .inventario ul {
    list-style: none;
    max-height: 300px;
    overflow-y: auto;
  }

  .inventario li {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 1rem;
    margin: 0.5rem 0;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-weight: 500;
  }

  .inventario li:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
  }

  .animation {
    animation: useEffect 0.6s ease-out;
  }

  @keyframes useEffect {
    0% { transform: scale(1) rotate(0deg); }
    25% { transform: scale(1.1) rotate(2deg); }
    50% { transform: scale(1.15) rotate(-2deg); }
    75% { transform: scale(1.1) rotate(1deg); }
    100% { transform: scale(1) rotate(0deg); }
  }

  /* Toast notifications */
  .toast {
    position: fixed;
    top: 100px;
    right: 20px;
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 1rem 1.5rem;
    border-radius: 12px;
    color: white;
    font-weight: 500;
    transform: translateX(400px);
    transition: transform 0.3s ease;
    z-index: 1001;
    box-shadow: var(--shadow);
  }

  .toast.show {
    transform: translateX(0);
  }

  /* Scrollbar customizada */
  ::-webkit-scrollbar {
    width: 8px;
  }

  ::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
  }

  ::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 4px;
  }

  ::-webkit-scrollbar-thumb:hover {
    background: var(--secondary);
  }

  /* Responsividade */
  @media (max-width: 768px) {
    .game-stats {
      position: relative;
      top: 0;
      right: 0;
      margin: 1rem;
      width: calc(100% - 2rem);
    }

    .container {
      grid-template-columns: 1fr;
      padding: 0 1rem;
      gap: 1.5rem;
    }

    .item {
      padding: 1.5rem;
    }

    header {
      padding: 1.5rem;
    }
  }
</style>
</head>
<body>
  <!-- Partículas flutuantes -->
  <div class="particles" id="particles"></div>

  <header>
    <h1>🧙‍♂️ Loja Mágica</h1>
    <p class="subtitle">Descubra itens poderosos para sua aventura</p>
  </header>

  <div class="game-stats">
    <div class="stat-item">
      <span class="stat-icon">❤️</span>
      <span>HP: <span id="player-hp">100</span>/100</span>
    </div>
    <div class="stat-item">
      <span class="stat-icon">💰</span>
      <span>Moedas: <span id="player-gold">500</span></span>
    </div>
    <div class="stat-item">
      <span class="stat-icon">⚔️</span>
      <span>Força: <span id="player-strength">10</span></span>
    </div>
  </div>

  <div class="container">
    <div class="item">
      <span class="item-icon">🧪</span>
      <h2>Poção de Vida</h2>
      <div class="item-stats">
        <div class="stat-row">
          <span>❤️ Cura:</span>
          <span class="stat-value">+30 HP</span>
        </div>
        <div class="stat-row">
          <span>💰 Custo:</span>
          <span class="stat-value">50 moedas</span>
        </div>
      </div>
      <button class="usar-btn" onclick="usarItem('Poção de Vida', 50, 'heal', 30)">
        <i class="fas fa-magic"></i> Usar Item
      </button>
    </div>

    <div class="item">
      <span class="item-icon">💣</span>
      <h2>Granada Arcana</h2>
      <div class="item-stats">
        <div class="stat-row">
          <span>💥 Dano:</span>
          <span class="stat-value">40</span>
        </div>
        <div class="stat-row">
          <span>💰 Custo:</span>
          <span class="stat-value">100 moedas</span>
        </div>
      </div>
      <button class="usar-btn" onclick="usarItem('Granada Arcana', 100, 'damage', 40)">
        <i class="fas fa-bomb"></i> Usar Item
      </button>
    </div>

    <div class="item">
      <span class="item-icon">💍</span>
      <h2>Anel de Poder</h2>
      <div class="item-stats">
        <div class="stat-row">
          <span>💪 Força:</span>
          <span class="stat-value">+5</span>
        </div>
        <div class="stat-row">
          <span>💰 Custo:</span>
          <span class="stat-value">200 moedas</span>
        </div>
      </div>
      <button class="usar-btn" onclick="usarItem('Anel de Poder', 200, 'strength', 5)">
        <i class="fas fa-gem"></i> Usar Item
      </button>
    </div>

    <div class="item">
      <span class="item-icon">🧤</span>
      <h2>Luvas do Poder</h2>
      <div class="item-stats">
        <div class="stat-row">
          <span>💪 Força:</span>
          <span class="stat-value">+10</span>
        </div>
        <div class="stat-row">
          <span>💰 Custo:</span>
          <span class="stat-value">300 moedas</span>
        </div>
      </div>
      <button class="usar-btn" onclick="usarItem('Luvas do Poder', 300, 'strength', 10)">
        <i class="fas fa-fist-raised"></i> Usar Item
      </button>
    </div>

    <div class="item">
      <span class="item-icon">🧊</span>
      <h2>Elixir de Mana</h2>
      <div class="item-stats">
        <div class="stat-row">
          <span>❤️ Cura:</span>
          <span class="stat-value">+20 HP</span>
        </div>
        <div class="stat-row">
          <span>💪 Força:</span>
          <span class="stat-value">+2</span>
        </div>
        <div class="stat-row">
          <span>💰 Custo:</span>
          <span class="stat-value">150 moedas</span>
        </div>
      </div>
      <button class="usar-btn" onclick="usarElixirMana(150, 20, 2)">
        <i class="fas fa-flask"></i> Usar Item
      </button>
    </div>
  </div>

  <div class="inventario">
    <h2>📜 Registro de Ações</h2>
    <ul id="inventario-lista"></ul>
  </div>

  <script>
    let playerStats = {
      hp: 100,
      gold: 500,
      strength: 10
    };

    // Criar partículas flutuantes
    function createParticles() {
      const particlesContainer = document.getElementById('particles');
      
      for (let i = 0; i < 20; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 6 + 's';
        particle.style.animationDuration = (Math.random() * 3 + 4) + 's';
        particlesContainer.appendChild(particle);
      }
    }

    function atualizarStats() {
      document.getElementById('player-hp').textContent = playerStats.hp;
      document.getElementById('player-gold').textContent = playerStats.gold;
      document.getElementById('player-strength').textContent = playerStats.strength;
    }

    function mostrarToast(mensagem, tipo = 'info') {
      const toast = document.createElement('div');
      toast.className = 'toast';
      toast.textContent = mensagem;
      
      if (tipo === 'error') {
        toast.style.background = 'linear-gradient(135deg, #ff6b6b, #ee5a5a)';
      } else if (tipo === 'success') {
        toast.style.background = 'linear-gradient(135deg, #51cf66, #40c057)';
      }
      
      document.body.appendChild(toast);
      
      setTimeout(() => toast.classList.add('show'), 100);
      
      setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => document.body.removeChild(toast), 300);
      }, 3000);
    }

    function usarItem(nome, custo, tipo, valor) {
      if (playerStats.gold < custo) {
        mostrarToast('💰 Moedas insuficientes!', 'error');
        return;
      }

      playerStats.gold -= custo;
      let mensagem = '';

      switch(tipo) {
        case 'heal':
          const hpAntes = playerStats.hp;
          playerStats.hp = Math.min(100, playerStats.hp + valor);
          const hpGanho = playerStats.hp - hpAntes;
          mensagem = `❤️ Você recuperou ${hpGanho} de HP!`;
          break;
        case 'damage':
          mensagem = `💥 ${nome} causou ${valor + playerStats.strength} de dano!`;
          break;
        case 'strength':
          playerStats.strength += valor;
          mensagem = `💪 Força aumentada em ${valor}!`;
          break;
      }

      mostrarToast(mensagem, 'success');
      atualizarStats();
      registrarAcao(`${nome} usado!`);
      animarItem(nome);
    }

    function usarElixirMana(custo, cura, forcaExtra) {
      if (playerStats.gold < custo) {
        mostrarToast('💰 Moedas insuficientes!', 'error');
        return;
      }

      playerStats.gold -= custo;
      const hpAntes = playerStats.hp;
      playerStats.hp = Math.min(100, playerStats.hp + cura);
      const hpGanho = playerStats.hp - hpAntes;
      playerStats.strength += forcaExtra;

      mostrarToast(`🧊 +${hpGanho} HP e +${forcaExtra} Força!`, 'success');
      atualizarStats();
      registrarAcao(`Elixir de Mana usado: +${hpGanho} HP, +${forcaExtra} Força!`);
      animarItem('Elixir de Mana');
    }

    function registrarAcao(msg) {
      const lista = document.getElementById("inventario-lista");
      const item = document.createElement("li");
      const agora = new Date().toLocaleTimeString();
      item.innerHTML = `<strong>${agora}</strong> - ✨ ${msg}`;
      lista.insertBefore(item, lista.firstChild);

      if (lista.children.length > 15) {
        lista.removeChild(lista.lastChild);
      }
    }

    function animarItem(nome) {
      const items = document.querySelectorAll('.item');
      items.forEach(item => {
        const titulo = item.querySelector('h2').textContent;
        if (titulo.includes(nome.replace('🧪 ', '').replace('💣 ', '').replace('💍 ', '').replace('🧤 ', '').replace('🧊 ', ''))) {
          item.classList.add('animation');
          setTimeout(() => item.classList.remove('animation'), 600);
        }
      });
    }

    // Inicializar
    document.addEventListener('DOMContentLoaded', function() {
      createParticles();
      atualizarStats();
    });
  </script>
</body>
</html>