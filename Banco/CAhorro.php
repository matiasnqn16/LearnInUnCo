<?php
/* include ("Cuenta.php"); */
require_once('Classes.php');
class CAhorro extends Cuenta{ 

/* Getters & Setters */


/* Metodos */

    public function __construct($nobjCliente,$nsaldo,$nroCuenta){
        parent::__construct($nobjCliente,$nsaldo,$nroCuenta);
    }

    public function __toString(){
        $cuenta = parent::__toString();
        return $cuenta;
    }


}
?>