
<body>
<link rel="stylesheet" type="text/css" href="./style.css">
</body>
<nav>
    <div class="logo">
      <a href="#">Mega Convertidor</a>
    </div>
    <ul class="nav-links">
	<li><a href="Time.php">Tiempo</a></li>
      <li><a href="longitud.php">Longuitud</a></li>
      <li><a href="datos.php">Datos</a></li>
      <li><a href="masa.php">Masa</a></li>
      <li><a href="volumen.php">Volumen</a></li>
      <li><a href="Moneda.php">Moneda</a></li>
    </ul>
  </nav>
<!---prueba--->
 <h1>Convertidor de unidades de medida</h1>

<div class="card">
  <div class="card-header">
  <h3>Conversor de unidades de Datos</h3>
  </div>
  <div class="card-body">
    <form method="post">
      <div class="form-group">
        <label for="cantidad">Cantidad:</label>
        <input type="number" step="0.01" min="0" name="cantidad" id="cantidad" class="form-control">
      </div>
      <div class="form-group">
        <label for="unidad_origen">De:</label>
        <select name="unidad_origen" id="unidad_origen" class="form-control">
          <option value="b">bits (b)</option>
          <option value="B">bytes (B)</option>
          <option value="KB">kilobytes (KB)</option>
          <option value="MB">megabytes (MB)</option>
          <option value="GB">gigabytes (GB)</option>
          <option value="TB">terabytes (TB)</option>
        </select>
      </div>
      <div class="form-group">
        <label for="unidad_destino">A:</label>
        <select name="unidad_destino" id="unidad_destino" class="form-control">
          <option value="b">bits (b)</option>
          <option value="B">bytes (B)</option>
          <option value="KB">kilobytes (KB)</option>
          <option value="MB">megabytes (MB)</option>
          <option value="GB">gigabytes (GB)</option>
          <option value="TB">terabytes (TB)</option>
        </select>
      </div>
      <div class="btn-container">
      <button type="submit" name="submit" class="btn btn-primary">Convertir</button>
     
    </div>

    </form>
 
<?php
   require_once'./services/conection.php';

    if(isset($_POST['submit'])){
    $cantidad = $_POST['cantidad'];
    $unidad_origen = $_POST['unidad_origen'];
    $unidad_destino = $_POST['unidad_destino'];

    $resultado = convertir_datos($cantidad, $unidad_origen, $unidad_destino);

    echo '<p>' . $cantidad . ' ' . $unidad_origen . ' son equivalentes a ' . $resultado . ' ' . $unidad_destino . '</p>'; 
    }
?>

<?php

function convertir_datos($cantidad, $unidad_origen, $unidad_destino) {
    $unidades = array(
        'b' => 0,
        'B' => 1,
        'KB' => 2,
        'MB' => 3,
        'GB' => 4,
        'TB' => 5
    );

    // Convertir la cantidad a bytes
    $bytes = $cantidad * pow(1024, $unidades[$unidad_origen]);

    // Convertir bytes a la unidad de destino
    $resultado = $bytes / pow(1024, $unidades[$unidad_destino]);

    return $resultado;
  }

  // Ejemplo de uso
  $cantidad = 5;
  $unidad_origen = 'MB';
  $unidad_destino = 'GB';

  $resultado = convertir_datos($cantidad, $unidad_origen, $unidad_destino);

  echo $cantidad . ' ' . $unidad_origen . ' son equivalentes a ' . $resultado . ' ' . $unidad_destino;
  $query=$bd->prepare("INSERT INTO operaciones(dato,tipoDato, conversion,resultado) VALUES(?,?,?,?) ");
  $result= $query->execute([$cantidad,$unidad_origen,$unidad_destino,$resultado]);
  ?>

  </div>
  </div>