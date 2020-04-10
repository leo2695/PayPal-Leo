<?php

ini_set("display_errors", "1"); //para ver errores
error_reporting(E_ALL);

if(!isset($_POST['producto'], $_POST['precio'])){
    exit("Hubo un error");
}
//en php se puede tener muchas clases con ese nombre solo que con ruta distinta con los namespace se puede especificar
use PayPal\Api\Payer; //namespace
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details; //namespace
use PayPal\Api\Amount; //namespace
use PayPal\Api\Transaction; //namespace
use PayPal\Api\RedirectUrls; //namespace
use PayPal\Api\Payment; //namespace
require_once ('config.php');

$producto= htmlspecialchars($_POST['producto']);// htmlspecialchars para agregarle sanitizacion
$precio=htmlspecialchars($_POST['precio']);
$precio=(int) $precio; //float para que acepte decimales
$envio=0;
$iva=$precio*0.13;
$total=$precio+$envio+$iva;

/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/


//Payer
$compra=new Payer(); //enbloba todo lo del pago
$compra->setPaymentMethod('paypal'); //en Payer esta esa funcion

//echo $compra->getPaymentMethod();

$articulo=new Item(); //engloba lo del articulo
$articulo->setName($producto)
         ->setCurrency('USD')
         ->setQuantity(1)
         ->setPrice($precio);


//echo $articulo->getPrice();

//Itemlist 
$listaArticulos=new ItemList();//se pasa todos los articulos que se van a cobrar
$listaArticulos->setItems(array($articulo));

//Details
$detalles=new Details();
$detalles->setShipping($envio)
         ->setTax($iva)
         ->setSubtotal($precio);

/*  */
$cantidad=new Amount();
$cantidad->setCurrency('USD')
        ->setTotal($total)
        ->setDetails($detalles);

/*   */
$transaccion=new Transaction();
$transaccion->setAmount($cantidad)
->setItemList($listaArticulos)
->setDescription('Pago')
->setInvoiceNumber(uniqid());

//echo $transaccion->getInvoiceNumber();

/*  */
$redireccionar=new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO."pago-finalizado.php?exito=true")
->setCancelUrl(URL_SITIO."pago-finalizado.php?exito=false");

//echo $redireccionar->getReturnUrl();

/*  */
$pago=new Payment();
$pago->setIntent("sale")
->setPayer($compra)
->setRedirectUrls($redireccionar)
->setTransactions(array($transaccion));
try {
    $pago->create($apiContext);
} catch (PayPal\Exception\PayPalConnectionException $pce) {
    echo "<pre>";
    print_r(json_decode($pce->getData()));
    exit;//se encarga de que el programa no se ejecute
    echo "</pre>";
}

$aprobado=$pago->getApprovalLink();
header("Location: {$aprobado}"); //para redireccionar

?>