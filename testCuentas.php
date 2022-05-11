<?php
include ("CCorriente.php");
include ("Cliente.php");
/* include ("CAhorro.php"); */
$nuevoCliente = new Cliente(523462345,"cuco","oeste","dfg-2345");
$cuentaCorriente = new CCorriente($nuevoCliente,50,50);
/* $cajaAhorros = new CAhorro($nuevoCliente,500); */

if($cuentaCorriente->realizarRetiro(100)){
    echo "Ud ha retirado dinero de CC\n";
}else{
    echo "No tiene fondos en CC\n";
}

echo $cuentaCorriente;

/* 
if($cajaAhorros->realizarRetiro(100)){
    echo "Ud ha retirado dinero de CA\n";
}else{
    echo "No tiene fondos en CA\n";
}

echo $cajaAhorros;
 */
?>