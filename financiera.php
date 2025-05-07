<?php
//clase financiera
class Financiera {
    //atributos
    private $denominacion;
    private $direccion;
    private $colecPrestOtorg;

    // método constructor
    public function __construct($denominacion, $direccion) {
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->colecPrestOtorg = []; // inicializa la colección de préstamos vacía
    }

    // métodos de acceso (getters)
    public function getDenominacion() { return $this->denominacion; }
    public function getDireccion() { return $this->direccion; }
    public function getColecPrestOtorg() { return $this->colecPrestOtorg; }

    // métodos de acceso (setters)
    public function setDenominacion($denominacion) { $this->denominacion = $denominacion; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setColecPrestOtorg($colecPrestOtorg) { $this->colecPrestOtorg = $colecPrestOtorg; }

    // método toString
    public function __toString() {
        $prestOtorg = "";

        //bucle para ir recorriendo y almacenando la coleccion de prestamos otorgados
        foreach ($this->getColecPrestOtorg() as $prestamo) {
            $prestOtorg = $prestOtorg . $prestamo. "\n"; //se va agregando un prestamo para mostrar en cada vuelta
        }

        //despues se retorna la informacion, incluyendo ahora si la coleccion de prestamos otorgados que haya en la nueva variable
        return ("Financiera: ".$this->getDenominacion()."\n".$this->getDireccion()."\n".$prestOtorg);
    }

    //metodo que crea un objeto Prestamo con la información recibida por parámetro y lo incorpora a la lista de prestamos de la financiera.
    public function otorgarPrestamo($objCliente, $cantCuotas, $monto, $interes) {
        // se crea el objeto Prestamo con la información recibida
        $prestamo = new Prestamo($monto, $cantCuotas, $interes, $objCliente);
    
        // llama al método otorgarPrestamo del objeto Prestamo para configurar la fecha y las cuotas
        $prestamo->otorgarPrestamo();
    
        // se agrega el préstamo a la colección de préstamos de la financiera
        $this->colecPrestOtorg[] = $prestamo;
    }



    //método que recorre la lista de prestamos que no han sido generadas sus cuotas.
    public function otorgarPrestamoSiCalifica() {
        // se recorre la lista de préstamos
        foreach ($this->colecPrestOtorg as $prestamo) {
            // se verifica si el préstamo no tiene cuotas generadas (si la colección de cuotas está vacía)
            if (count($prestamo->getColecCuotas()) == 0) {
                // entonces se calcula el monto de cada cuota
                $montoCuota = $prestamo->getMonto() / $prestamo->getCantCuotas();
    
                // se corrobora que el monto de la cuota no supere el 40% del neto del solicitante
                if ($montoCuota <= ($prestamo->getObjCliente()->getNeto() * 0.40)) {
                    // si califica, otorgamos el préstamo
                    $prestamo->otorgarPrestamo();
                }
            }
        }
    }
    
    //metodo que que recibe por parámetro la identificación del préstamo
    //, se busca el préstamo en la colección de prestamos y si es encontrado se obtiene la siguiente cuota a pagar.
    public function informarCuotaPagar($idPrestamo) {
        // se inicializa el índice
        $i = 0;
        $retorno = null; // se inicia en null por si no se encuentra
        // se recorre la colección de préstamos mientras no hayamos llegado al final
        while ($i < count($this->colecPrestOtorg)) {
            $prestamo = $this->colecPrestOtorg[$i];
    
            // si se encuentra el préstamo que coincide con el idPrestamo
            if ($prestamo->getIdentificación() == $idPrestamo) {
                // se llama al método darSiguienteCuotaPagar y retornamos la referencia de la cuota
                $retorno = $prestamo->darSiguienteCuotaPagar();
            }
            // se incrementa el índice para continuar buscando en el siguiente préstamo
            $i++;
        }
    
        // si no se encuentra el préstamo con la id proporcionada, retornamos null
        return $retorno;
    }
    
}
?>