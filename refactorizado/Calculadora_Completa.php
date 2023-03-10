<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis cartas de juego</title>
  <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<!---prueba de navbar ---->
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


    <h1 class="header">Convertidor de medidas</h1>

    <h3>Convertidor de datos  </h3>
    <div class="contenedor-card">
        <?php
        require_once 'datos.php';
        ?>
    </div>

    <h3>Convertidor de longitudes</h3>
    <div class="contenedor-card">
        <?php
        require_once 'longitud.php'; 
        ?>
    </div>

    <h3>Convertidor de masas</h3>
    <div class="contenedor-card">
          <?php
          require_once 'masa.php';  
          ?>
    </div>

     <section class="contenedor-card">
      <?php
      require_once 'Moneda.php';  
      ?>
     </section>
     <section class="contenedor-card">
      <?php
      require_once 'Time.php';  
      ?>
     </section>
     <section class="contenedor-card">
      <?php
      require_once 'volumen.php'; 
      ?>
    </section>  
</body>
</html>

