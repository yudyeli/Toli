
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error // login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/style1.css"> -->

    <!-- Favicon -->
    <link href="../../assets/img/logo.png" rel="icon">
</head>

<body>
    <!-- mt es margin top; l left; b buttom y asi con todas las partes del margin -->
    <div class="container mt-5">
        <h2>ERROR AL INICIAR SESION</h2>
        <button type="submit" class="btn btn-danger btn-re"><a href="../../index.html">ATRAS</a></button>
        <br><br>

        <form method="POST" enctype="multipart/form-data" autocomplete="off" action="../../controller/inicio.php">
            <div class="row">
                <div class="form-group col">
                    <input type="email" placeholder="Correo Electronico" class="form-control" name="correo_electronico" required onkeyup="espacios(this)" maxlength="40">
                </div>

                <div class="col">
                    <div class="input-group">
                        <input type="password" placeholder="Contraseña" name="password" pattern="[a-zA-Z0-9]{6,12}" class="form-control input-text clave" title="Debe tener de 6 a 12 dígitos" required onkeyup="espacios(this)" minlength="6" maxlength="12" id="passwordField">
                        <div class="input-group-append">
                            <button type="button" class="icono fas fa-eye-slash mostrarClave w-20 bg-gradient" id="togglePassword"></button>
                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" value="registrar" name="btn-ingresar" class="btn btn-warning btn-re">INGRESAR</button>
            <a class="ingresar" href="registro.php">Registrar</a><br>
        </form>
    </div>

</body>

</html>

<script>
    // SE CREA UNA FUNCION PARA QUE SE OCULTE Y SE PUEDA VER LA CONTRASEÑA
    const passwordField = document.getElementById("passwordField");
    const togglePassword = document.getElementById("togglePassword");

    togglePassword.addEventListener("click", function() {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            togglePassword.classList.remove("fa-eye-slash");
            togglePassword.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            togglePassword.classList.remove("fa-eye");
            togglePassword.classList.add("fa-eye-slash");
        }
    });

    // FUNCION PARA QUE EN EL INPUT NO HAYA ESPACIOS
    function espacios(e) {
        e.value = e.value.replace(/ /g, '');
    }
</script>