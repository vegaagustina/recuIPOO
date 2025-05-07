<?php
//clase 
class Cuota {
    //atributos
    private $numero;
    private $montoCuota;
    private $montoInteres;
    private $cancelada; //va a contener un valor true, si la cuota esta paga y false en caso contrario

    //metodo constructor
    public function __construct($numero, $montoCuota, $montoInteres){
        $this->numero = $numero;
        $this->montoCuota = $montoCuota;
        $this->montoInteres = $montoInteres;
        $this->cancelada = false; // Por defecto todas las cuotas deben ser generadas como canceladas = false.
    }

    
    //metodos de acceso
    //getters
    public function getNumero() { return $this->numero; }
    public function getMontoCuota() { return $this->montoCuota; }
    public function getMontoInteres() { return $this->montoInteres; }
    public function getCancelada() { return $this->cancelada; }

    //setters
    public function setNumero($numero) { $this->numero = $numero; }
    public function setMontoCuota($montoCuota) { $this->montoCuota = $montoCuota; }
    public function setMontoInteres($montoInteres) { $this->montoInteres = $montoInteres; }
    public function setCancelada($cancelada) { $this->cancelada = $cancelada; }

      // método toString
    public function __toString() {
       return ("Cuota: ".$this->getNumero()."\n".$this->getMontoCuota()."\n".$this->getMontoInteres()."\n".$this->getCancelada()."\n");
    }


    //metodo que retorna el importe de la cuota mas los intereses que deben ser aplicados.
    public function darMontoFinalCuota (){ 
        $cuotaFinal = $this->getMontoCuota() * (1 + $this->getMontoInteres());
        return $cuotaFinal;  
    }
}

?>