# FileInOut

# Descripción

Con esta clase de PHP podemos obtener los datos en formato Array de un archivo .in y configurar el formato que queramos que tenga el Array.

Con esta clase de PHP podemos crear un archivo .out enviándole un parámetro tipo String a la función encargada.

# Description

With this kind of PHP we can get the data into a format Array .in file and set the format you want to have the Array.

With this kind of PHP we can create a .out file sent to you one type String parameter to the function responsible.

# Example of use 

$arrDatos = GenerateInOut::getFileInToArray('A-small-practice.in', array('first' => 1,'data'  => 3,));
$strResult = '';
foreach ($arrDatos['data'] as $i => $arrDato) {
    $intNCase = $i + 1;
    $arrProduct = explode(' ', $arrDato[2]);
    $strResult .= "Case #{$intNCase}: ";
    foreach ($arrProduct as $key => $producto) {
        if((int) $producto  <  (int) $arrDato[0]){
            $arrProductsFilter[$key] = $producto;
        }
    }
    $bln = false;
    foreach ($arrProductsFilter as $key => $productFilter) {
        foreach ($arrProductsFilter as $key2 => $productFilter2) {
            if ((int)$key < (int)$key2) {
                if (((int)$productFilter + (int)$productFilter2) == (int)$arrDato[0]) {
                    $value1 = $key + 1;
                    $value2 = $key2 + 1;
                    $strResult .= "{$value1} {$value2}" . PHP_EOL;
                    $bln = true;
                    //break;
                }
            }
        }
    }
}
echo GenerateInOut::setStringOutFile($strResult);
