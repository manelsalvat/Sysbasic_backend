<?php

function __autoload($className) {
    include_once("modelo/$className.php");
}

$patatas = new Productos();

//$patatas->setCodigo(1)
//        ->setNombre('patatas')
//        ->setMarca('mackAin')
//        ->setDescuento(5)
//        ->setPrecio(5)
//        ->setFavorito('si')
//        ->setDescripcion('no desc')
//        ->setUnidad_de_medida('kg')
//        ->setVendible('si')
//        ->setEstoc(120)
//        ->setFavorito(1)
//        ->setId_Categoria(1)
//        ->setId_Iva(8)
//        ->save();
$patatas->get_from_table(1);
$patatas->setVendible('no')->update();

foreach ($patatas as $key => $value) {
    print $key . ' => ' . $value . '<br>';
}
