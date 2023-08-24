<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="registro-form">
  <h2>Registro</h2>
  <form action="procesar-registro.php" method="post">
    <label for="nombre" class="registro-label">Nombre:</label>
    <input type="text" id="nombre" name="nombre" class="registro-input" required>

    <label for="apellido" class="registro-label">Apellido:</label>
    <input type="text" id="apellido" name="apellido" class="registro-input" required>

    <label for="ciudad" class="registro-label">Ciudad:</label>
    <input type="text" id="ciudad" name="ciudad" class="registro-input" required>

    <label for="direccion" class="registro-label">Dirección:</label>
    <input type="text" id="direccion" name="direccion" class="registro-input" required>

    <label for="correo" class="registro-label">Correo Electrónico:</label>
    <input type="email" id="correo" name="correo" class="registro-input" required>

    <button type="submit" class="registro-submit">Registrarse</button>
  </form>
</div>
</body>
</html>