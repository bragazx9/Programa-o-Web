<?php
 
class conta {
    private $titular;
    private $saldo = 0;
    private $saldoInicial = 0;

    function __construct($titular,$saldoInicial){

        $this->titular = $titular;
        $this->saldoInicial = $saldoInicial;
        $this->saldo = $saldoInicial;

    }

    public function setTitular($nome){
      $this->titular = $nome;
    }
    public function depositar($valor){
        $this->saldo += $valor;
    }
    
    public function sacar($valor){
        if ($valor > 0 && $valor <= $this->saldo) {
            $this->saldo -= $valor;
            
            echo "Valor de: R$" . $valor . "foi sacado.";
        } else {
            echo "Saldo não disponivel para saque";
        }
    }

    public function getSaldo(){
        return "O valor que tem na conta é:" . $this->saldo;
    }

   }

   $conta1 = new conta("Bernardo", 300);
   $conta1->sacar(100);

   echo $conta1->getSaldo();




?>