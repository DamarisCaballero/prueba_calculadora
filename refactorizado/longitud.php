	<link rel="stylesheet" type="text/css" href="./style.css">
	
	<body>
	<!---prueba de navbar ---->
	<nav>
    <div class="logo">
      <a href="Calculadora_Completa.php">Mega Convertidor</a>
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
	</body>

	<!---este es el unico que tiene container, solo era prueba-->
	<h1>Convertidor de unidades de medida</h1>
	<div class="card">
  <div class="card-header">
  <h3>Conversor de unidades de Longitud</h3>
  </div>
  <div class="card-body">
    <form method="post">
      <div class="form-group">
		<label class="select" for="medida">Medida:</label>
		<input type="text" name="medida" required>
		<div class="form-group">
		<select class="select" name="unidad_origen">
			<option value="metros">metros</option>
			<option value="kilometros">kilometros</option>
			<option value="milimetros">milimetros</option>
			<option value="centimetros">centimetros</option>
			<option value="millas">millas</option>
			<option value="yardas">yardas</option>
			<option value="pies">pies</option>
			<option value="pulgadas">pulgadas</option>
			<option value="nauticas">nauticas</option>
		</select>
		</div>
		<div class="form-group">
		<label class="select" for="convertir_a">Convertir a:</label>
		<select name="unidad_destino">
			<option value="metros">metros</option>
			<option value="kilometros">kilometros</option>
			<option value="milimetros">milimetros</option>
			<option value="centimetros">centimetros</option>
			<option value="millas">millas</option>
			<option value="yardas">yardas</option>
			<option value="pies">pies</option>
			<option value="pulgadas">pulgadas</option>
			<option value="nauticas">nauticas</option>
		</select>
		</div>
		<div class="btn-container">
      <button type="submit" name="submit" class="btn btn-primary">Convertir</button>
     </div>
	</form>

	<?php

		include './services/conection.php';

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$medida = floatval($_POST['medida']);
			$unidad_origen = $_POST['unidad_origen'];
			$unidad_destino = $_POST['unidad_destino'];

			// Factor de conversión de la unidad origen a metros
			$factor_origen = 0;
			switch ($unidad_origen) {
				case 'metros':
					$factor_origen = 1;
					break;
				case 'kilometros':
					$factor_origen = 1000;
					break;
				case 'milimetros':
					$factor_origen = 0.001;
					break;
				case 'centimetros':
					$factor_origen = 0.01;
					break;
				case 'millas':
					$factor_origen = 1609.34;
					break;
				case 'yardas':
					$factor_origen = 0.9144;
					break;
				case 'pies':
					$factor_origen = 0.3048;
					break;
				case 'pulgadas':
					$factor_origen = 0.0254;
					break;
				case 'nauticas':
					$factor_origen = 1852;
					break;
				default:
					echo '<p>Unidad origen no válida</p>';
					exit;
			}

			// Factor de conversión de metros a la unidad destino
			$factor_destino = 0;
			switch ($unidad_destino) {
				case 'metros':
					$factor_destino = 1;
					break;
				case 'kilometros':
                    $factor_destino = 0.001;
                    break;
                case 'milimetros':
                    $factor_destino = 1000;
                    break;
                case 'centimetros':
                    $factor_destino = 100;
                    break;
                case 'millas':
                    $factor_destino = 0.000621371;
                    break;
                case 'yardas':
                    $factor_destino = 1.09361;
                    break;
                case 'pies':
                    $factor_destino = 3.28084;
                    break;
                case 'pulgadas':
                    $factor_destino = 39.3701;
                    break;
                case 'nauticas':
                    $factor_destino = 0.000539957;
                    break;
                default:
                    echo '<p>Unidad destino no válida</p>';
                exit;
            }

        	// Conversión de la medida a metros y luego a la unidad destino
		    $medida_en_metros = $medida * $factor_origen;
            $medida_en_unidad_destino = $medida_en_metros / $factor_destino;

		    // Mostrar resultado de la conversión
           echo '<p>' . $medida . ' ' . $unidad_origen . ' son ' . $medida_en_unidad_destino . ' ' . $unidad_destino . '</p>';
       

		   $query=$bd->prepare("INSERT INTO operaciones(dato,tipoDato, conversion,resultado) VALUES(?,?,?,?) ");
		   $result= $query->execute([$medida,$unidad_origen,$unidad_destino,$medida_en_unidad_destino]);
		}
    ?>
</div>
</div>

