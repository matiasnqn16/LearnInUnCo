<?php
/* include ("Classes.php"); */
require_once('Classes.php');
class CCorriente extends Cuenta{ 

    private $montoMaxDeExtraccion;

/* Getters & Setters */

    public function getMontoMaxDeExtraccion(){
        return $this->montoMaxDeExtraccion;
    }
    public function setMontoMaxDeExtraccion($nMontMax){
        $this->montoMaxDeExtraccion = $nMontMax;
    }
    


/* Metodos */

    public function __construct($nobjCliente,$nsaldo,$nmontoMaxDeExtraccion,$nroCuenta){
        parent::__construct($nobjCliente,$nsaldo,$nroCuenta);
        $this->montoMaxDeExtraccion = $nmontoMaxDeExtraccion;
    }

    public function __toString(){
        $cuenta = $this->getObjCliente();
        return $cuenta."\tNroCuenta ". $this->getNroCuenta(). "\n". "Saldo: ". $this->getSaldo(). 
        "\t Monto Max de Extraccion: ". $this->getMontoMaxDeExtraccion();
    }

    public function realizarRetiro($montoRetiro){
        $saldoActual = $this->getSaldo();
        $saldoNegativoMax = -$this->getMontoMaxDeExtraccion();
        $saldoConRetiroEfectivo = $saldoActual - $montoRetiro;
        $retiroConcretado = false;
        if($saldoNegativoMax <= $saldoConRetiroEfectivo){
            $this->setSaldo($saldoConRetiroEfectivo);
            $retiroConcretado = true;
        }
        return $retiroConcretado;
    }

}
?>