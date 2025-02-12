<?php
include 'plantilla.php'; 

if (isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "formreg") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nombre_comp = $nombre . " " . $apellido;
    $cedula = $_POST['cedula'];
    $celular = $_POST['celular'];
    $contrasena = $_POST['contrasena'];
    $correo = $_POST['correo'];
    $tipo_user= 1;
    $id_estado = 1;
    $nit = $_POST['nit'];

    $sql = $con->prepare("SELECT * FROM usuarios WHERE cedula=:cedula");
    $sql->bindParam(':cedula', $cedula);
    $sql->execute();
    $fila = $sql->fetch(PDO::FETCH_ASSOC);

    if ($fila) {
        die("Ya existe un usuario con ese documento. Por favor, utilice otro.");
    }

    $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT);

    $insertSQL = $con->prepare("INSERT INTO usuarios(cedula, nombre, celular, contrasena, correo, id_tipo_user, id_estado, nit) 
                               VALUES(:cedula, :nombre_comp, :celular, :pass_cifrado, :correo, :tipo_user, :id_estado, :nit)");
    $insertSQL->bindParam(':cedula', $cedula);
    $insertSQL->bindParam(':nombre_comp', $nombre_comp);
    $insertSQL->bindParam(':celular', $celular);
    $insertSQL->bindParam(':pass_cifrado', $pass_cifrado);
    $insertSQL->bindParam(':correo', $correo);
    $insertSQL->bindParam(':tipo_user', $tipo_user);
    $insertSQL->bindParam(':id_estado', $id_estado);
    $insertSQL->bindParam(':nit', $nit);
    $insertSQL->execute();

    echo '<script> alert ("Registro exitoso");</script>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Administradores</title>
    <link rel="stylesheet" href="css/regis.css">
</head>
<body>
    <div class="container" id="registrate">
        <h1>Registrar Administradores</h1>
        <form method="post" name="formreg" id="formreg" class="signup-form" autocomplete="off" onsubmit="return validarFormulario()">
            <div class="form-row">
                <div class="form-column">
                    <div class="form-floating">
                        <label for="nombres">Nombres</label>
                        <input class="form-control" type="text" name="nombre" id="nombres" placeholder="Digite Nombre" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-floating">
                        <label for="apellidos">Apellidos</label>
                        <input class="form-control" type="text" name="apellido" id="apellidos" placeholder="Apellidos" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-floating">
                        <label for="documento">N° Documento</label>
                        <input class="form-control" type="text" name="cedula" id="documento" placeholder="Digite Documento" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-floating">
                        <label for="telefono">Contacto</label>
                        <input class="form-control" type="text" name="celular" id="telefono" placeholder="Digite Telefono" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-floating">
                        <label for="correo">Correo</label>
                        <input class="form-control" type="email" name="correo" id="correo" placeholder="Digite Correo" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-floating">
                        <label for="contrasena">Contraseña</label>
                        <input class="form-control" type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
                    </div>
                </div>

                <div class="form-column full-width">
                    <div class="form-floating">
                        <select class="form-control" name="nit" id="nit" required>
                            <option value="">Seleccione Empresa</option>
                            <?php
                            $control = $con->prepare("SELECT * FROM empresa");
                            $control->execute();
                            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $fila['nit'] . "'>" . $fila['nombre_emp'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" type="submit" name="registrarse">Registro</button>
            <input type="hidden" name="MM_insert" value="formreg">
        </form>
    </div>

    <script>
        function validarFormulario() {
            var nombresInput = document.getElementById('nombres');
            var apellidosInput = document.getElementById('apellidos');
            var documentoInput = document.getElementById('documento');
            var telefonoInput = document.getElementById('telefono');
            var correoInput = document.getElementById('correo');
            var contrasenaInput = document.getElementById('contrasena');
            var nitInput = document.getElementById('nit');

            // Validación de nombres y apellidos
            if (!validarTexto(nombresInput.value)) {
                alert('Ingrese un nombre válido (solo letras y espacios).');
                return false;
            }
            if (!validarTexto(apellidosInput.value)) {
                alert('Ingrese apellidos válidos (solo letras y espacios).');
                return false;
            }

            // Validación de documento (cedula)
            if (!/^\d{8,10}$/.test(documentoInput.value)) {
                alert('El número de documento debe contener solo números y tener entre 8 y 10 caracteres.');
                return false;
            }

            // Validación de teléfono
            if (!/^\d{10}$/.test(telefonoInput.value)) {
                alert('El número de teléfono debe contener solo números y tener exactamente 10 dígitos.');
                return false;
            }

            // Validación de correo electrónico
            if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,}$/.test(correoInput.value)) {
                alert('Ingrese un correo electrónico válido.');
                return false;
            }

            // Validación de contraseña
            var contrasenaValue = contrasenaInput.value.trim();
            if (contrasenaValue.length < 8 || contrasenaValue.length > 11) {
                alert('La contraseña debe tener entre 8 y 11 caracteres.');
                return false;
            }

            // Validación de empresa seleccionada
            if (nitInput.value === '') {
                alert('Seleccione una empresa.');
                return false;
            }

            return true;
        }

        function validarTexto(texto) {
            return /^[a-zA-Z\s]{1,20}$/.test(texto);
        }
    </script>
</body>
</html>
