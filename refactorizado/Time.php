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
  <h3>Conversor de unidades de Tiempo</h3>
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
						<option value="segundos">Segundos</option>
						<option value="minutos">Minutos</option>
						<option value="horas">Horas</option>
						<option value="días">Días</option>
						<option value="semanas">Semanas</option>
						<option value="meses">Meses</option>
						<option value="años">Años</option>
					</select>

					<label for="unidad_destino">A:</label>
					<select name="unidad_destino" id="unidad_destino" class="form-control">
						<option value="segundos">Segundos</option>
						<option value="minutos">Minutos</option>
						<option value="horas">Horas</option>
						<option value="días">Días</option>
						<option value="semanas">Semanas</option>
						<option value="meses">Meses</option>
						<option value="años">Años</option>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Convertir</button>
				</div>
			</form>

			<?php
        include './services/conection.php';

			if (isset($_POST['submit'])) {
				$cantidad = $_POST['cantidad'];
				$unidad_origen = $_POST['unidad_origen'];
				$unidad_destino = $_POST['unidad_destino'];

				// Definir los factores de conversión para cada unidad de tiempo
				$factors = array(
					"segundos" => 1,
					"minutos" => 60,
					"horas" => 3600,
					"días" => 86400,
					"semanas" => 604800,
					"meses" => 2592000,
					"años" => 31536000
				);

				// Convertir la unidad de tiempo y mostrar el resultado
				$resultado = $cantidad * $factors[$unidad_origen] / $factors[$unidad_destino];
				echo "<p>$cantidad $unidad_origen son $resultado $unidad_destino.</p>";

        $query=$bd->prepare("INSERT INTO operaciones(dato,tipoDato, conversion,resultado) VALUES(?,?,?,?) ");
           			 $result= $query->execute([$cantidad,$unidad_origen,$unidad_destino,$resultado]);

			}
			?>

		</div>
	</div>


</body>
</html>
