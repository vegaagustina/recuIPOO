<?php
//clase persona 1
class Cliente {
    //atributos
    private $nombre;
    private $apellido;
    private $dni;
    private $direccion;
    private $mail;
    private $telefono;
    private $importeNeto;
    
    //metodo constructor
    public function __construct($nombre, $apellido, $dni, $direccion, $mail, $telefono, $importeNeto){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->direccion = $direccion;
        $this->mail = $mail;
        $this-> telefono = $telefono;
        $this->importeNeto = $importeNeto;
     }
 
     //metodos de acceso
     //getters
     public function getNombre() { return $this->nombre;}
     public function getApellido () { return $this->apellido; }
     public function getDni () { return $this->dni; }
     public function getDireccion() { return $this->direccion; }
     public function getMail() { return $this->mail; }
     public function getTelefono() { return $this->telefono; }
     public function getImporteNeto() { return $this->importeNeto; }
   
 
     //setters
     public function setNombre ($nombre) { $this->nombre = $nombre; }
     public function setApellido($apellido)  { $this->apellido = $apellido; }
     public function setDni ($dni) { $this->dni = $dni; }
     public function setDireccion ($direccion) { $this->direccion = $direccion; }
     public function setMail ($mail) {$this->mail = $mail; }
     public function setTelefono ($telefono) { $this->telefono = $telefono; }
     public function setImporteNeto($importeNeto) { $this->importeNeto = $importeNeto; }


     //metodo toString
     public function __toString(){
        return ("Cliente: ".$this->getNombre()."\n".$this->getApellido()."\n".$this->getDni()."\n".$this->getDireccion()."\n".$this->getMail()."\n".$this->getTelefono()."\n".$this->getImporteNeto()."\n");
    } 
}
?>