<?php
class Cuenta{

    private $objCliente;
    private $saldo;

/* Getters & Setters */

    public function getSaldo(){
        return $this->saldo;
    }
    public function setSaldo($nSaldo){
        $this->saldo = $nSaldo;
    }
    public function getObjCliente(){
        return $this->objCliente;
    }
    public function setObjCliente($new){
        $this->objCliente = $new;
    }
    

/* Metodos */

    public function __construct($nobjCliente,$nsaldo){
        $this->objCliente = $nobjCliente;
        $this->saldo = $nsaldo;
    }

    public function __toString(){
        return $this->getObjCliente()."\nsaldo: ". $this->getSaldo();
    }

    public function saldoCuenta(){
        return $this->getSaldo();
    }

    public function realizarDeposito($montoDeposito){
        $saldoActual = $this->getSaldo();
        $saldoMasDeposito = $montoDeposito + $saldoActual;
        $this->setSaldo($saldoMasDeposito);
    }

    public function realizarRetiro($montoRetiro){
        $saldoActual = $this->getSaldo();
        $retiroConcretado = false;
        if($saldoActual > $montoRetiro){
            $nuevoSaldo = $saldoActual - $montoRetiro;
            $this->setSaldo($nuevoSaldo);
            $retiroConcretado = true;
        }
        return $retiroConcretado;
    }
}
?>