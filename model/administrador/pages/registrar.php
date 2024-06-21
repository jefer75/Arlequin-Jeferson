<?php
  include "plantilla.php";

   if (isset($_POST['registrar']))
   {
    $cedula= $_POST['cedula'];
    $nombre= $_POST['nombre'];
    $celular= $_POST['celular'];
    $contrasena= $_POST['contrasena'];
    $correo= $_POST['correo'];
    $tipo_user= $_POST['tipo_user'];
    $id_estado= $_POST['id_estado'];
   

     $sql= $con -> prepare ("SELECT * FROM usuarios WHERE cedula='$cedula' or correo = '$correo'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("DOCUMENTO YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="registrar.php"</script>';
     }

     else
   
     if ($cedula=="" || $nombre=="" || $correo=="" || $celular=="" || $contrasena=="" || $tipo_user=="" || $id_estado=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="registrar.php"</script>';
      }
      
      else{

        $pass_cifrado = password_hash($contrasena,PASSWORD_DEFAULT, array("pass"=>12));
        
        $insertSQL = $con->prepare("INSERT INTO usuarios(cedula, nombre, celular, contrasena , correo, id_tipo_user, id_estado, nit) VALUES('$cedula', '$nombre', '$celular', '$pass_cifrado', '$correo', '$tipo_user', '$id_estado', 123456789)");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="registrar.php"</script>';
     }  
    }
    ?>

  <title>Registro-Persona</title>

  <main id="main" class="main">
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Crear cuenta</h5>
                    <p class="text-center small">Ingresa los datos</p>
                  </div>

                  <form class="row g-3 needs-validation" name="formreg" id="formreg" method="POST" novalidate>

                  <div class="col-12">
    <label for="cedula" class="form-label">Cédula</label>
    <input type="text" class="form-control" id="cedula" name="cedula">
    <div class="invalid-feedback">Ingresa tu cédula (solo números entre 8 y 10).</div>
</div>

<div class="col-12">
    <label for="nombre" class="form-label">Nombre completo</label>
    <input type="text" name="nombre" class="form-control" id="nombre" >
    <div class="invalid-feedback">Ingresa tu nombre</div>
</div>

<div class="col-12">
    <label for="celular" class="form-label">Celular</label>
    <input type="text" name="celular" class="form-control" id="celular">
    <div class="invalid-feedback">Ingresa tu teléfono</div>
</div>

<div class="col-12">
    <label for="correo" class="form-label">Correo electrónico</label>
    <div class="input-group has-validation">
        <input type="email" name="correo" class="form-control" id="correo" >
        <div class="invalid-feedback">Ingresa un correo electrónico válido.</div>
    </div>
</div>

<script>
   document.getElementById('formreg').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío automático del formulario

    // Realizar todas las validaciones aquí
    var cedulaInput = document.getElementById('cedula');
    var nombreInput = document.getElementById('nombre');
    var celularInput = document.getElementById('celular');
    var correoInput = document.getElementById('correo');

    var cedulaValue = cedulaInput.value.trim();
    var nombreValue = nombreInput.value.trim();
    var celularValue = celularInput.value.trim();
    var correoValue = correoInput.value.trim();

    var isValid = true;

    // Validación de cédula
    if (!/^\d{8,10}$/.test(cedulaValue)) {
        cedulaInput.classList.add('is-invalid');
        cedulaInput.nextElementSibling.style.display = 'block';
        isValid = false;
    } else {
        cedulaInput.classList.remove('is-invalid');
        cedulaInput.nextElementSibling.style.display = 'none';
    }

    // Validación de nombre
    if (!/^[A-Za-z\s]{1,20}$/.test(nombreValue)) {
        nombreInput.classList.add('is-invalid');
        nombreInput.nextElementSibling.style.display = 'block';
        isValid = false;
    } else {
        nombreInput.classList.remove('is-invalid');
        nombreInput.nextElementSibling.style.display = 'none';
    }

    // Validación de celular
    if (!/^\d{10}$/.test(celularValue)) {
        celularInput.classList.add('is-invalid');
        celularInput.nextElementSibling.style.display = 'block';
        isValid = false;
    } else {
        celularInput.classList.remove('is-invalid');
        celularInput.nextElementSibling.style.display = 'none';
    }

    // Validación de correo electrónico
    if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(correoValue)) {
        correoInput.classList.add('is-invalid');
        correoInput.parentElement.querySelector('.invalid-feedback').style.display = 'block';
        isValid = false;
    } else {
        correoInput.classList.remove('is-invalid');
        correoInput.parentElement.querySelector('.invalid-feedback').style.display = 'none';
    }

    // Si todas las validaciones son exitosas, enviar el formulario
    if (isValid) {
        this.submit();
    }
});

</script>

                    <select class="cont" name="tipo_user">
                    <option value ="">Seleccione Tipo Usuario</option>
                     <br>

                    <?php
                        $control = $con -> prepare ("SELECT * from tipo_user WHERE id_tipo_user= 2 OR id_tipo_user=3");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_tipo_user'] . ">"
                        . $fila['tipo_user'] . "</option>";
                    } 
                    ?>
                </select>
                <br>
                <select class="cont"  name="id_estado">
                    <option  value ="">Seleccione el estado</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from estados where id_estado <= 2");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_estado'] . ">"
                        . $fila['estado'] . "</option>";
                    } 
                    ?>
                </select>

                <div class="col-12">
    <label for="contrasena" class="form-label">Contraseña</label>
    <input type="password" name="contrasena" class="form-control" id="contrasena">
    <div class="invalid-feedback">Ingresa tu contraseña (entre 8 y 11 caracteres).</div>
</div>

<script>
    // Validación de contraseña (entre 8 y 11 caracteres)
    document.getElementById('contrasena').addEventListener('blur', function() {
        var contrasenaInput = this;
        var contrasenaValue = contrasenaInput.value.trim();
        var feedback = contrasenaInput.nextElementSibling;

        if (contrasenaValue.length < 8 || contrasenaValue.length > 11) {
            contrasenaInput.classList.add('is-invalid');
            feedback.style.display = 'block';
        } else {
            contrasenaInput.classList.remove('is-invalid');
            feedback.style.display = 'none';
        }
    });
</script>


                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" >
                        <label class="form-check-label" for="acceptTerms">Estoy de acuerdo con los <a href="#">Terminos y condiciones</a></label>
                        <div class="invalid-feedback">Debes estar de acuerdo para continuar</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <td><input class="btn btn-primary w-100"  type="submit" name="registrar" value="registrar"></td>
                    </div>
                    
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Diseñada por<a href="https://bootstrapmade.com/">Elitech JYD</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>