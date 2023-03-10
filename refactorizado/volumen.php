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
  <h3>Conversor de unidades de Volumen</h3>
  </div>
  <div class="card-body">
    <form method="post">
      <div class="form-group">

		<label>Cantidad:</label>
		<input type="text" name="cantidad"><br><br>
		<label>Unidad de medida:</label>
		<select name="unidad1">
			<option value="ml">Mililitros (ml)</option>
			<option value="cl">Centilitros (cl)</option>
			<option value="dl">Decilitros (dl)</option>
			<option value="l">Litros (l)</option>
		</select><br><br>
		<label>Convertir a:</label>
		<select name="unidad2">
			<option value="ml">Mililitros (ml)</option>
			<option value="cl">Centilitros (cl)</option>
			<option value="dl">Decilitros (dl)</option>
			<option value="l">Litros (l)</option>
		</select><br><br>
		<input type="submit" name="convertir" value="Convertir">
	</form>

	<?php
  include './services/conection.php';

	if(isset($_POST['convertir'])) {
		$cantidad = $_POST['cantidad'];
		$unidad1 = $_POST['unidad1'];
		$unidad2 = $_POST['unidad2'];

		if($unidad1 == "ml") {
			switch ($unidad2) {
				case 'ml':
					$resultado = $cantidad;
					break;
				case 'cl':
					$resultado = $cantidad / 10;
					break;
				case 'dl':
					$resultado = $cantidad / 100;
					break;
				case 'l':
					$resultado = $cantidad / 1000;
					break;
			}
		} elseif($unidad1 == "cl") {
			switch ($unidad2) {
				case 'ml':
					$resultado = $cantidad * 10;
					break;
				case 'cl':
					$resultado = $cantidad;
					break;
				case 'dl':
					$resultado = $cantidad / 10;
					break;
				case 'l':
					$resultado = $cantidad / 100;
					break;
			}
		} elseif($unidad1 == "dl") {
			switch ($unidad2) {
				case 'ml':
					$resultado = $cantidad * 100;
					break;
				case 'cl':
					$resultado = $cantidad * 10;
					break;
				case 'dl':
					$resultado = $cantidad;
					break;
				case 'l':
					$resultado = $cantidad / 10;
					break;
			}
		} elseif($unidad1 == "litros") {
			switch ($unidad2) {
				case 'ml':
					$resultado = $cantidad * 1000;
					break;
				case 'cl':
					$resultado = $cantidad * 100;
					break;
				case 'dl':
					$resultado = $cantidad * 10;
					break;
				case 'l':
					$resultado = $cantidad;
					break;
			}
		}

		echo "<br><br>";
		echo "<b>$cantidad $unidad1</b> equivale a <b>$resultado $unidad2</b>";
	
    $query=$bd->prepare("INSERT INTO operaciones(dato,tipoDato, conversion,resultado) VALUES(?,?,?,?) ");
    $result= $query->execute([$cantidad,$unidad1,$unidad2,$resultado]);

  }
	?>

    </div>
	  </div>


</body>
</html>