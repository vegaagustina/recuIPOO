<?php
//test
require_once 'financiera.php';
require_once 'prestamo.php';
require_once 'cliente.php';  
require_once 'cuota.php'; 

// se crea un un objeto Financiera
$financiera = new Financiera("ElectroCash", "Av. Arg 1234");
echo $financiera;

// crear objetos Persona
$cliente1 = new cliente("Pepe", "Florez", "Bs As 12", "dir@mail.com", "26390637", "299 444567", 40000);
$cliente2 = new cliente("Luis", "Suarez", "Bs As 123", "dir@mail.com", "26390637", "299 4455", 4000);

// crear objetos Prestamo
$prestamo1 = new prestamo(1, 50000, 5, 0.1, $cliente);
$prestamo2 = new prestamo(2, 10000, 4, 0.1, $cliente2);
$prestamo3 = new prestamo(3, 10000, 2, 0.1, $cliente2);

// incorporar préstamos a la financiera
$financiera->otorgarPrestamo($prestamo1);
$financiera->otorgarPrestamo($prestamo2);
$financiera->otorgarPrestamo($prestamo3);

// mostrar información de la financiera
echo $financiera;
?>

