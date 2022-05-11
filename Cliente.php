<?php
include ("Persona.php");
class Cliente extends Persona{ 

    private $nroCliente;

/* Getters & Setters */

    public function getNroCliente(){
        return $this->nroCliente;
    }
    public function setNroCliente($new){
        $this->nroCliente = $new;
    }

/* Metodos */

    public function __construct($dni,$nombre,$apellido,$nroCliente){
        parent::__construct($dni,$nombre,$apellido);
        $this->nroCliente = $nroCliente;
    }

    public function __toString(){
        $texto = parent::__toString();
        return $texto."\nNroCliente: ". $this->getNroCliente();
    }
}
?>