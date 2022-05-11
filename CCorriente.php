<?php
include ("Cuenta.php");
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

    public function __construct($nobjCliente,$nsaldo,$nmontoMaxDeExtraccion){
        parent::__construct($nobjCliente,$nsaldo);
        $this->montoMaxDeExtraccion = $nmontoMaxDeExtraccion;
    }

    public function __toString(){
        $cuenta = $this->getObjCliente();
        return $cuenta. "\n\n". "Saldo: ". $this->getSaldo(). 
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