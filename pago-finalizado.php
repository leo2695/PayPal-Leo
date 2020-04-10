<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/5.0.0/normalize.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
  <div class="formulario">
    <h2>Pagos con Paypal</h2>
    <?php
    $resultado = (bool) $_GET['exito']; //para que solo sea true o false

    echo "<pre>";
    var_dump($_GET);
    echo "</pre>";

    $paymentId = $_GET['paymentId'];

    if ($resultado == 'true') { //entre comillas porque lo toma como un string 
      //aqui es donde se le enviaria a la pagina donde esta lo que compro o asi
      echo "El pago fue correcto <br>";
      echo "El ID es {$paymentId}";
    } else {
      echo "El pago no se realizó";
    }

    ?>
  </div>
</body>


</html>