<?php //este archivo es donde se van a guardar las llaves


require_once ('paypalsdk/autoload.php');

define('URL_SITIO','http://localhost/PagosPaypal/paypal/');

//instalar el API de paypal
$apiContext=new \PayPal\Rest\ApiContext( //$apiContext se puede llamar como yo quiera pero asi es lo normal
new \PayPal\Auth\OAuthTokenCredential( //instanciando
//Cliente ID
'AcLKxeka0w5xgmile3yhqF39Au-V1PXey0An6stJSezItQZIKYy0Ki-aKqvlV9jSCotzkI4HtwLgEmJa',
//Secret
'EOAoSIHlxaeic9n6tHjWNU0LpndpGS0e-0mppuIvGRTsdafRMvSbZeSxLXhc8zN9lC2Xgc7SXTPVTgoF'
)
);

//var_dump($apiContext);
?>