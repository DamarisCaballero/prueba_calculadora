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
  <!---prueba--->
<div class="card">
  <div class="card-header">
  <h3>Conversor de unidades de Masa</h3>
  </div>
  <div class="card-body">
    <form method="post">
      <div class="form-group">
        <label for="cantidad">Cantidad:</label>
        <input type="number" step="0.01" min="0" name="cantidad" id="cantidad" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="unidad_origen">De:</label>
        <select name="unidad_origen" id="unidad_origen" class="form-control" required>
          <option value="mg">Miligramo</option>
          <option value="g">Gramo</option>
          <option value="Kilog">Kilogramo</option>
          <option value="Libra">Libra</option>
          <option value="Onza">Onza</option>
        </select>
      </div>
      <div class="form-group">
        <label for="unidad_destino">A:</label>
        <select name="unidad_destino" id="unidad_destino" class="form-control" required>
          <option value="mg">Miligramo</option>
          <option value="g">Gramo</option>
          <option value="Kilog">Kilogramo</option>
          <option value="Libra">Libra</option>
          <option value="Onza">Onza</option>
        </select>
      </div>
      <div class="btn-container">
        <button type="submit" name="submit" class="btn btn-primary">Convertir</button>
      </div>
    </form>
    <?php
      // Definir tipos de unidades de masa
      require_once'./services/conection.php';
      $units = array(
        'mg' => 0.001,  // Miligramo
        'g' => 1,  // Gramo
        'Kilog' => 1000,  // Kilogramo
        'Libra' => 453.592,  // Libra
        'Onza' => 28.3495  // Onza
      );
    
      // Verificar si se ha enviado el formulario
      if (isset($_POST['submit'])) {
        // Obtener valores del formulario
        $amount = $_POST['cantidad'];
        $from = $_POST['unidad_origen'];
        $to = $_POST['unidad_destino'];

        // Verificar si las unidades son válidas
        if (!array_key_exists($from, $units) || !array_key_exists($to, $units)) {
          echo "<p>Error: Las unidades de masa seleccionadas no son válidas.</p>";
        } else {
          // Realizar cálculo de conversión
          $result = $amount * ($units[$to] / $units[$from]);

          // Mostrar resultado
          echo '<p>' . $amount . ' ' . $from . ' = ' . $result . ' ' . $to . '</p>';

          $query=$bd->prepare("INSERT INTO operaciones(dato,tipoDato, conversion,resultado) VALUES(?,?,?,?) ");
          $result= $query->execute([$amount,$from,$to,$result]);
        }
      }
    ?>
  </div>
</div>

