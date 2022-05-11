<?php
class Persona{ 

    private $dni;
    private $nombre;
    private $apellido;

/* Getters & Setters */

    public function getDni(){
        return $this->dni;
    }
    public function setDni($new){
        $this->dni = $new;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($new){
        $this->nombre = $new;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($new){
        $this->apellido = $new;
    }

/* Metodos */

    public function __construct($ndni,$nnombre,$napellido){
        $this->dni = $ndni;
        $this->nombre = $nnombre;
        $this->apellido = $napellido;
    }

    public function __toString(){
        return "Nombre y Apellido: ". $this->getNombre(). " ". 
        $this->getApellido(). 
        "\tDni ". $this->getDni();
    }


}
?>