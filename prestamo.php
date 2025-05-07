<?php
//clase prestamo
class Prestamo {
    //atributos
    //identificación, código del electrodoméstico, fecha otorgamiento, 
    //monto, cantidad_de_cuotas, taza de interés, la colección de cuotas y la referencia a la persona que solicito el préstamo. 
    private $identificación;
    private $codElectrodomestico;
    private $fechaOtorg;
    private $monto;
    private $cantCuotas;
    private $tazaInteres;
    private $colecCuotas;
    private $objCliente;
    private static $contadorPrestamos = 0;
    
    //metodo constructor
    public function __construct($monto, $cantCuotas, $tazaInteres, $objCliente) {
        self::$contadorPrestamos++;
        $this->identificación = self::$contadorPrestamos;
        $this->monto = $monto;
        $this->cantCuotas = $cantCuotas;
        $this->tazaInteres = $tazaInteres;
        $this->objCliente = $objCliente;
        $this->colecCuotas = [];
    }


    //metodos de acceso
    //getters
    public function getIdentificación() { return $this->identificación; }
    public function getFechaOtorg() { return $this->fechaOtorg; }
    public function getMonto() { return $this->monto; }
    public function getCantCuotas() { return $this->cantCuotas; }
    public function getTazaInteres() { return $this->tazaInteres; }
    public function getObjCliente() { return $this->objCliente; }
    public function getCodElectrodomestico () { return $this->codElectrodomestico;}

    //setters
    public function setMonto($monto) { $this->monto = $monto; }
    public function setFechaOtorg($fechaOtorg) { $this->fechaOtorg = $fechaOtorg; }
    public function setCantCuotas($cantCuotas) { $this->cantCuotas = $cantCuotas; }
    public function setTazaInteres($tazaInteres) { $this->tazaInteres = $tazaInteres; }
    public function setObjCliente($objCliente) { $this->objCliente = $objCliente; }

   //metodo toString
   public function __toString(){
    return ("Préstamo: ".$this->getIdentificación()."\n".$this->getCodElectrodomestico()."\n".$this->getFechaOtorg()."\n".$this->getMonto()."\n".$this->getCantCuotas()."\n".$this->getTazaInteres()."\n".$this->getObjCliente()."\n");
}

    // método privado que recibe por parámetro el numero de la cuota y calcula el importe del interés sobre el saldo deudor. 
    private function calcularInteresPrestamo($numCuota) {
        // formula para calcular el interes de la cuota
        $saldoDeudor = $this->getMonto() - (($this->getMonto() / $this->getCantCuotas()) * ($numCuota - 1));
        $interes = $saldoDeudor * $this->getTazaInteres();  // el interes de la cuota

        return $interes;
    }

    //método otorgarPrestamo
    public function otorgarPrestamo() {
        // setea la fecha de otorgamiento con la fecha actual
        $fechaActual = getdate();
        $this->setFechaOtorg($fechaActual['year'] . '-' . $fechaActual['mon'] . '-' . $fechaActual['mday']);  // fecha en formato año - mes- dia
        // calcula el monto de cada cuota
        $montoCuota = $this->getMonto() / $this->getCantCuotas();

        // genera cada una de las cuotas
        for ($i = 1; $i <= $this->getCantCuotas(); $i++) {
            // calcula el interes de cada cuota
            $montoInteres = $this->calcularInteresPrestamo($i);

            // se crea la cuota con el monto, interés y si está cancelada o no
            $cuota = new Cuota($i, $montoCuota, $montoInteres);
            
            // se añade la cuota a la coleccion de cuotas
            $this->colecCuotas[] = $cuota;
        }
    }

    // método que retorna la referencia a la siguiente cuota que debe ser abonada de un préstamo, si el préstamo tiene todas sus cuotas canceladas retorna null
    public function darSiguienteCuotaPagar() {
        $i = 0;
        $retorno = null; //inicia en null por si no se encuentra una cuota no cancelada, retorna el valor inicial
        // bucle para recorrer la colección de cuotas
        while ($i < count($this->colecCuotas)) {
            // si se encuentra una cuota no cancelada
            if ($this->colecCuotas[$i]->getCancelada() == false) {
                $retorno = $this->colecCuotas[$i]; // se cambia el null y retorna la primera cuota no cancelada
            }
            $i++; // si la cuota está cancelada, vuelve y sigue buscando
        }

        // si sale del bucle y no se encontró ninguna cuota no cancelada, se retorna el null del inicio
        return $retorno;
    }
}






?>