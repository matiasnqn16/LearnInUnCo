<?php
require_once('classes.php');
include ("Banco.php");
include ("Cliente.php");

$clientes = [];
$clientes[0] = new Cliente(13312,"Alario","Aldo","C-001");
$clientes[1] = new Cliente(42345,"benicio","bueno","C-004");

//1. Crear un objeto de la clase Banco.
$unBanco = new Banco;

//2. Crear dos nuevos clientes Cliente1 y Cliente2, y agregarlos al banco.
incClient($unBanco,$clientes[0]);
incClient($unBanco,$clientes[1]);

//3. Crear dos Cuentas Corrientes, una asociada al cliente A y otra al cliente B, y agregarlas al Banco .
incCC($unBanco,"C-001",5000); //CC-001000
incCC($unBanco,"C-004",4000); //CC-001001

//4. Crear tres Cajas de Ahorro, dos asociadas al cliente A y una asociada al cliente B, y agregarlas al Banco .
$unBanco->incorporarCajaAhorro("C-001"); //CA-001002
$unBanco->incorporarCajaAhorro("C-001"); //CA-001003
$unBanco->incorporarCajaAhorro("C-004"); //CA-001004

//5. Depositar $300 en cada una de las Cajas de Ahorro.
$unBanco->realizarDeposito("CA-001002",300);
$unBanco->realizarDeposito("CA-001003",300);
$unBanco->realizarDeposito("CA-001004",300);

//6. Transferir $150 de la Cuenta Corriente de Cliente1, a la Caja de Ahorro de Cliente2.
if($unBanco->realizarRetiro("CC-001000",150)){
    $unBanco->realizarDeposito("CA-001004",150);
}else{
    echo "no se pudo concretar la transferencia";
}

//7. Mostrar los datos de todas las cuentas.
echo "\n---------\n".$unBanco->getColObjCC()[0]."\n---------\n";
echo "\n---------\n".$unBanco->getColObjCC()[1]."\n---------\n";

echo "\n---------\n".$unBanco->getColObjCA()[0]."\n---------\n";
echo "\n---------\n".$unBanco->getColObjCA()[1]."\n---------\n";
echo "\n---------\n".$unBanco->getColObjCA()[2]."\n---------\n";

echo $unBanco;




//----------------------Funciones----------------------------
function incClient($banco,$objClient){
    if($banco->incorporarCliente($objClient)){
        echo "\n\tse incorporo el cliente\n".$objClient."\n--------------------\n";
    }else{
        echo "\testa repetido\n";
    }
}

function incCC($banco,$nroCliente,$max){
    if($banco->incorporarCuentaCorriente($nroCliente,$max)){
        echo "\n\tNueva CC asignada con el numero de cliente \n".$nroCliente;
    }else{
        echo "No Existe el numero de cuenta asociado a un cliente";
    }
}

?>

