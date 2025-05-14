<?php

class carro {
    public $marca;
    public $modelo;
    public $ano;

    public function exibirInformacoes() {
        return "Marca:" . $this->marca . "Modelo:" . $this->modelo . "Ano:" . $this->ano;
    
    }
}
   

    $carro1 = new carro();
    $carro1->marca = "Toyota";
    $carro1->modelo = "Supra";
    $carro1->ano = 1992;

    echo "Marca:" . $carro1->marca . ", Modelo:" . $carro1->modelo . ", Ano:" . $carro1->ano;

   


    echo $carro1->exibirInformacoes();

    


?>