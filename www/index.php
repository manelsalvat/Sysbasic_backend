<?php

function __autoload($className) {
    include_once("modelo/$className.php");
}



$patatas = new Productos();

$patatas->setCodigo(6)
        ->setNombre('fedasd')
        ->setMarca('gfhg-gh')
        ->setDescuento(5)
        ->setPrecio(5)
        ->setFavorito('si')
        ->setDescripcion('no desc')
        ->setUnidad_de_medida('kg')
        ->setVendible('si')
        ->setEstoc(14)
        ->setFavorito(1)
        ->setId_Categoria(3)
        ->setId_Iva(8)
        ->save();
$patatas->get_from_table(1);
$patatas->setVendible('no')->update();

foreach ($patatas as $key => $value) {
    print $key . ' => ' . $value . '<br>';
}
