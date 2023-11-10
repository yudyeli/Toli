
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/stylelo.css"> 

    <!-- Favicon -->
    <link href="../../assets/img/logo.png" rel="icon">
</head>

<body>
    <!-- mt es margin top; l left; b buttom y asi con todas las partes del margin -->
    <div class="container mt-5">
        <h2>Inicio de Sesion</h2>

    <button type="submit" class="btn btn-success btn-re" style="background-color: #00B894;">
        <a href="../../index.html" style="color: #000000;" class="d-flex align-items-center">
        <i class="fas fa-arrow-left mr-2"></i>
        </a>
    </button>



        <br><br>

        <form method="POST" enctype="multipart/form-data" autocomplete="off" action="../../controller/inicio.php">
            <div class="">

                <div class="form-group col">
                    <label for="correo_electronico">Correo Electrónico:</label>
                    <input type="email" placeholder="Digite Su Correo Electronico" class="form-control" name="correo_electronico" required onkeyup="espacios(this)" maxlength="40">
                </div>

                <div class="input-group col">
                    <label for="password">Contraseña:</label>
                    <input type="password" placeholder="Digite Su Contraseña" name="password" pattern="[a-zA-Z0-9]{6,12}" class="form-control input-text clave" title="Debe tener de 6 a 12 dígitos" required onkeyup="espacios(this)" minlength="6" maxlength="12" id="passwordField">
                    <div class="input-group-append">
                        <button type="button" class="icono fas fa-eye-slash mostrarClave w-20 bg-gradient" id="togglePassword"></button>
                    </div>
                </div>

            </div>

            <button type="submit" value="registrar" name="btn-ingresar" class="btn_ing">INGRESAR</button><br>
            <a class="ingresar" href="registro.php">Registrarse</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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