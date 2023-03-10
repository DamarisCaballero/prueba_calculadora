
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
    <h3>Conversor de moneda</h3>
  </div>
  <div class="card-body">
    <form method="post">
      <div class="form-group">
        <label for="amount">Cantidad:</label>
        <input type="number" step="0.01" min="0" name="amount" id="amount" class="form-control">
      </div>
      <div class="form-group">
        <label for="from">De:</label>
        <select name="from" id="from" class="form-control">
          <option value="USD">Dólar estadounidense (USD)</option>
          <option value="EUR">Euro (EUR)</option>
          <option value="GBP">Libra esterlina (GBP)</option>
          <option value="JPY">Yen japonés (JPY)</option>
          <option value="CAD">Dólar canadiense (CAD)</option>
          <option value="AUD">Dólar australiano (AUD)</option>
        </select>
      </div>
      <div class="form-group">
        <label for="to">A:</label>
        <select name="to" id="to" class="form-control">
          <option value="USD">Dólar estadounidense (USD)</option>
          <option value="EUR">Euro (EUR)</option>
          <option value="GBP">Libra esterlina (GBP)</option>
          <option value="JPY">Yen japonés (JPY)</option>
          <option value="CAD">Dólar canadiense (CAD)</option>
          <option value="AUD">Dólar australiano (AUD)</option>
        </select>
      </div>
      <div class="btn-container">
      <button type="submit" name="submit" class="btn btn-primary">Convertir</button>
     </div>
    </form>


    <?php
    // Definir tipos de cambio
    include './services/conection.php';

    $exchange_rates = array(
        'USD' => 1,
        'EUR' => 0.84,
        'GBP' => 0.72,
        'JPY' => 109.23,
        'CAD' => 1.26,
        'AUD' => 1.30,
        'MXN' => 20.27 // Tipo de cambio de MXN a USD
    );

    // Invierta los valores de la tabla para obtener la tasa de conversión inversa
    $inverse_rates = array();
    foreach ($exchange_rates as $currency => $rate) {
        $inverse_rates[$currency] = 1 / $rate;
    }

    // Verificar si se ha enviado el formulario
    if (isset($_POST['submit'])) {
        // Obtener valores del formulario
        $amount = $_POST['amount'];
        $from = $_POST['from'];
        $to = $_POST['to'];

        // Realizar cálculo de conversión
        if (isset($exchange_rates[$from]) && isset($exchange_rates[$to])) {
            // Conversión directa
            if ($from == 'USD') {
                $result = $amount * $exchange_rates[$to];
            } elseif ($to == 'USD') {
                $result = $amount * $inverse_rates[$from];
            } else {
                $result = $amount * $inverse_rates[$from] * $exchange_rates[$to];
            }

  

            // Mostrar resultado
            echo '<p>' . $amount . ' ' . $from . ' = ' . $result . ' ' . $to . '</p>';
            $query=$bd->prepare("INSERT INTO operaciones(dato,tipoDato, conversion,resultado) VALUES(?,?,?,?) ");
            $result= $query->execute([$amount,$from,$to,$result]);

        } else {
            // Mostrar mensaje de error
            echo '<p>Las monedas seleccionadas no son convertibles.</p>';
        }
    }
?>

</div>
</div>
