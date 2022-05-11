<?php
include ("Cuenta.php");
class CAhorro extends Cuenta{ 

/* Getters & Setters */


/* Metodos */

    public function __construct($nobjCliente,$nsaldo){
        parent::__construct($nobjCliente,$nsaldo);
    }

    public function __toString(){
        $cuenta = parent::__toString();
        return $cuenta;
    }


}
?>