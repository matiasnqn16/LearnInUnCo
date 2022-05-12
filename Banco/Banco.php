<?php
require_once('classes.php');
class Banco{ 

    private $colObjCC = [];
    private $colObjCA = [];
    private $colObjCliente = [];
    private $cuentaInicial = 1000;

/* Getters & Setters */

    public function getColObjCC(){
        return $this->colObjCC;
    }
    public function setColObjCC($new){
        $this->colObjCC = $new;
    }
    public function getColObjCA(){
        return $this->colObjCA;
    }
    public function setColObjCA($nColObjCA){
        $this->colObjCA = $nColObjCA;
    }
    public function getColObjCliente(){
        return $this->colObjCliente;
    }
    public function setColObjCliente($nColObj){
        $this->colObjCliente = $nColObj;
    }
    public function getCuentaInicial(){
        return $this->cuentaInicial;
    }
    public function setCuentaInicial($nCuenta){
        $this->cuentaInicial = $nCuenta;
    }
    
    

/* Metodos */

    /* public function __construct($colObjCC,$colObjCA,$colObjCliente){
        $this->colObjCC = $colObjCC;
        $this->colObjCA = $colObjCA;
        $this->colObjCliente = $colObjCliente;
    } */

    public function __toString(){
        return "Banco Fantasia S.A.";
    }

    /* permite agregar un nuevo cliente al Banco */
    /* @param object $objCliente */
    /* @return boolean */
    
    public function incorporarCliente($objCliente){
        $colObj = $this->getColObjCliente();
        //Buscar hasta que la condicion se cumpla
        $inicio = 0;
        $cantObj = count($colObj);
        $esFalso = true;
        while($inicio < $cantObj && $esFalso){
            if($objCliente->getNroCliente() == $colObj[$inicio]->getNroCliente()){
                $esFalso = false;
            }
        $inicio++;
        }
        if($esFalso){
            $retornar = true;
            array_push($colObj,$objCliente);
            $this->setColObjCliente($colObj);
        }else{
            $retornar = false;
        }
        return $retornar;
    }
    /* buscar cliente por numero de cliente haciendo un recorrido parcial sobre la coleccion de clientes
    y devuelve el objeto cliente */
    /* @param string $nroCliente */
    /* @return object */
    

    private function buscarCliente($nroCliente){
        $colObjClientes = $this->getColObjCliente();
        $inicio = 0;
        $cantObj = count($colObjClientes);
        $esFalso = true;
        while($inicio < $cantObj && $esFalso){
            if($nroCliente == $colObjClientes[$inicio]->getNroCliente()){
                $retObjCliente = $colObjClientes[$inicio];
                $esFalso = false;
            }
        $inicio++;
        }
        if($esFalso){
            $retornar = null;
        }else{
            $retornar = $retObjCliente;
        }
        return $retornar;
    }
    /* Agregar una nueva Cuenta a la colección de cuentas, verificando que el 
    cliente dueño de la cuenta es cliente del Banco. */
    /* @param string $nroCliente, int $montoDescubierto */
    /* @return boolean */

    public function incorporarCuentaCorriente($nroCliente,$montoDescubierto){
        $objCliente = $this->buscarCliente($nroCliente);
        $generarNroCuenta = "CC-00".$this->getCuentaInicial();
        $colObjCC = $this->getColObjCC();
        if($objCliente instanceof Cliente){
            $nuevaCuentaCorriente = new CCorriente($objCliente,0,$montoDescubierto,$generarNroCuenta);
            array_push($colObjCC,$nuevaCuentaCorriente);
            $this->setColObjCC($colObjCC);
            $retornar = true;
            $this->setCuentaInicial($this->getCuentaInicial()+1);
        }else{
            $retornar = false;
        }
        return $retornar;
    }

    /* Agregar una nueva Caja de Ahorro a la colección de cajas de ahorro, 
    verificando que el cliente dueño de la cuenta es cliente del Banco. */
    /* @param object $nroCliente */
    /* @return boolean */
    
    public function incorporarCajaAhorro($nroCliente){
        $objCliente = $this->buscarCliente($nroCliente);
        $generarNroCuenta = "CA-00".$this->getCuentaInicial();
        $colObjCA = $this->getColObjCA();
        if($objCliente instanceof Cliente){
            $nuevaCajaAhorro = new CAhorro($objCliente,0,$generarNroCuenta);
            array_push($colObjCA,$nuevaCajaAhorro);
            $this->setColObjCA($colObjCA);
            $retornar = true;
            $this->setCuentaInicial($this->getCuentaInicial()+1);
        }else{
            $retornar = false;
        }
        return $retornar;
    }

    /* Dado un número de Cuenta y un monto, realizar depósito. */
    /* @param string $numCuenta, int $monto */
    /* @return boolean */
    
    public function realizarDeposito($numCuenta,$monto){
        $ubicacionYTipoDeCuenta = $this->buscarCuenta($numCuenta); //busca ubicacion y tipo de cuenta
        $seConcreta = false;
        if($ubicacionYTipoDeCuenta['tipoCuenta'] == "CC"){
            $this->getColObjCC()[$ubicacionYTipoDeCuenta['ubicacion']]->realizarDeposito($monto);
            $seConcreta = true;
            }
        if($ubicacionYTipoDeCuenta['tipoCuenta'] == "CA"){
            $this->getColObjCA()[$ubicacionYTipoDeCuenta['ubicacion']]->realizarDeposito($monto);
            $seConcreta = true;
            }
        return $seConcreta;
    }


    /* Dado un número de Cuenta y un monto, realizar retiro. */
    /* @param string $numCuenta, int $monto */
    /* @return boolean */
    
    public function realizarRetiro($numCuenta,$monto){
        $ubicacionYTipoDeCuenta = $this->buscarCuenta($numCuenta); //busca ubicacion y tipo de cuenta
        $seConcreta = false;
        if($ubicacionYTipoDeCuenta['tipoCuenta'] == "CC"){
            if($this->getColObjCC()[$ubicacionYTipoDeCuenta['ubicacion']]->realizarRetiro($monto)){
                $seConcreta = true;
            }
        }
        if($ubicacionYTipoDeCuenta['tipoCuenta'] == "CA"){
            if($this->getColObjCA()[$ubicacionYTipoDeCuenta['ubicacion']]->realizarRetiro($monto)){
                $seConcreta = true;
            }
        }
        return $seConcreta;
    }

    /* buscar cuenta sea CC o CA y devuelve un arreglo con la ubicacion del arreglo de objetos mas el tipo de cuenta */
    /* @param string $numCuenta */
    /* @return array */
    
    private function buscarCuenta($numCuenta){
        $laUbicacionMasTipoCuenta = ['ubicacion','tipoCuenta'];
        $cuentasCC = $this->getColObjCC();
        $cuentasCA = $this->getColObjCA();
        
        //Buscar en cuenta corriente hasta que la condicion se cumpla
        $inicio = 0;
        $esFalso = true;
        do{
            if($numCuenta == $cuentasCC[$inicio]->getNroCuenta()){
                $laUbicacionMasTipoCuenta = ['ubicacion' => $inicio,'tipoCuenta' => "CC"];
                $esFalso = false;
            }
        $inicio++;
        }while($inicio < count($cuentasCC) && $esFalso);

        if($esFalso){
            //Buscar en caja de ahorro hasta que la condicion se cumpla
            $inicio = 0;
            do{
                if($numCuenta == $cuentasCA[$inicio]->getNroCuenta()){
                    $laUbicacionMasTipoCuenta = ['ubicacion' => $inicio,'tipoCuenta' => "CA"];
                    $esFalso = false;
                }
            $inicio++;
            }while($inicio < count($cuentasCA) && $esFalso);
        }
        //si no se encontro el numero de cuenta se retornara false
        if($esFalso){
            $retornar = null;
        }else{
        //de lo contrario devolvera true, ya que se cumplio una de las condiciones de CC o CA
            $retornar = $laUbicacionMasTipoCuenta;
        }
        return $retornar;
    }
    
}
?>