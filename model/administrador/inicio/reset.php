<?php
session_start();
require_once("../../../db/connection.php");
$db = new Database();
$con = $db->conectar();

if (isset($_POST['verificar'])) {
    $codigo = $_POST['codigo'];

    // Utilizar consultas preparadas para evitar SQL Injection
    $sql = $con->prepare("SELECT * FROM usuarios WHERE token=:codigo");
    $sql->bindParam(':codigo', $codigo);
    $sql->execute();
    $fila = $sql->fetch(PDO::FETCH_ASSOC);

    if ($fila) {
        // El código es válido, redirigir a la página de recuperación
        echo '<script>alert("Su código ha sido verificado correctamente");';
        echo 'window.location.href = "recuperacion2.php";</script>';
    } else {
        // El código no coincide, mostrar mensaje de error y redirigir a la página de reset
        echo '<script>alert("El código digitado no coincide con el código enviado");';
        echo 'window.location.href = "reset.php";</script>';
    }
}
?>





<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer Contraseña</title>
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="../../../css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="../../../css/style.css" rel="stylesheet">
        <link href="../../../css/recuperar_con.css" rel="stylesheet">

</head>
<body>

<div class="container-xxl bg-white p-0">

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
<img src="../../../imagenes/logos/Logo Arlequin Color.png" class="logo">
<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="../../../index.php" class="nav-item nav-link active">Inicio</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Recreación</a>
                        <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                            <a href="../../../infantil.php" class="dropdown-item">Infantil</a>
                            <a href="../../../adultos.php" class="dropdown-item">Adultos</a>
                        </div>
                    </div>

                    <a href="../../../decoracion.php" class="nav-item nav-link">Decoración</a>
                    <a href="../../../sobre_nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>                    
                    <a href="../../../contact.php" class="nav-item nav-link">Contáctanos</a>
                </div>
    <td>
    <form action="" method="POST">
    <div class="contenido">
    <td><input class="btn btn-primary rounded-pill px-3 d-none d-lg-block" type="submit" value="regresar" name="regresar" id="regresar"></td>
    <!-- <td href="" class="btn btn-primary rounded-pill px-3 d-none d-lg-block"  value="regresar" name="regresar" id="regresar"></>> Regresar<i class="fa fa-arrow-right ms-3"></i></td> -->
</div>
</nav>
<!-- Navbar End -->


<?php 

if (isset($_POST['regresar'])){
header('Location: ../../../index.php');
}

?>


<div class="container-xxl py-5">
      
          <div class="bg-light rounded">
            
                  <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                      <div class="h-100 d-flex flex-column justify-content-center p-5 contenido">
                          <h1 class="mb-4">Restablecer Contraseña</h1>
                          <form action="../../../controller/validar_codigo.php" method="POST" name="form1">
    <div class="row g-3 inputs">
        <div class="col-sm-6 user">
        <div class="container">
    <div class="form-floating">
        <input class="form-control border-0 gmail" name="codigo" id="codigo" type="text" placeholder="Código">
        <label for="codigo">Código</label>
    </div>
</div>

<script>
    const codigoInput = document.getElementById('codigo');

    codigoInput.addEventListener('input', function() {
        // Eliminar espacios en blanco y convertir a mayúsculas
        let codigo = this.value.trim().toUpperCase();
        
        // Eliminar caracteres no permitidos (dejar solo números y letras)
        codigo = codigo.replace(/[^a-zA-Z0-9]/g, '');

        // Limitar la longitud a 4 caracteres
        codigo = codigo.slice(0, 4);

        // Asignar el valor limpio de nuevo al campo de texto
        this.value = codigo;
    });
</script>
        </div>
        <div class="col-12">
            <button type="submit" name="verificar" class="btn btn-primary w-100 py-3 ingresar">Restablecer</button>
        </div>
    </div>
    
</form>

                      </div>
                  </div>
                 
              
          </div>
      </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


        <!-- <input class="effect-1" name= "email" id="c" type="hidden" placeholder="email" value="<?php //echo $email;?>">
        <input class="effect-1" name= "token" id="c" type="hidden" placeholder="email" value="<?php //echo $token;?>">
         -->

      <!-- <input type="submit" name="verificar" value="verificar">
      <input type="hidden" name="MM_insert" value="formreg"> -->


</body>
</html>