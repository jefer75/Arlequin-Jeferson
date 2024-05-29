<?php
   
   include 'plantilla.php';
       
    ?>



  <title>Ventas</title>
  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>ventas</h1>
      
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">cumpleaños</h5>

              <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">

    <dialog class="añadir_cont" id="añadir_cont">
      <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

      <h2 class="modal__title">Registrar venta</h2> 
      <form method="post" name="formreg" id="formreg" class="row g-3" action="" autocomplete="off">
        <!--Username -->
        <br>
        <br>
        <div class="col-md-6">
        <label for="inputEmail5" class="form-label">Seleccione el paquete</label>
        <select class="form-control" name="paquete">
            <option value ="">Seleccione</option>
            
            <?php
                $control = $con -> prepare ("SELECT * from paquetes Where id_paquetes != 0");
                $control -> execute();
            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
            {
                echo "<option value=" . $fila['id_paquetes'] . ">"
                . $fila['nombre_paquete'] . "</option>";
            } 
            ?>
        </select>
        </div>

        <div class="col-md-6">
        <label for="inputEmail5" class="form-label">Seleccione el tipo de evento</label>
        <select class="form-control" name="tipo_e">
            <option value ="">Seleccione</option>
            
            <?php
                $control = $con -> prepare ("SELECT * from tipo_e");
                $control -> execute();
            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
            {
                echo "<option value=" . $fila['id_tipo_e'] . ">"
                . $fila['tipo_evento'] . "</option>";
            } 
            ?>
        </select>
        </div>

        <div class="col-md-6">
          <label for="inputPassword5" class="form-label">Cedula de cliente</label>
          <input  class="form-control" type="text" name="cedula" pattern="[0-9]{7,12}" title="Solo se aceptan numeros" placeholder="Contacto" >
        </div>

        <div class="col-md-6">
          <label for="inputPassword5" class="form-label">Lugar</label>
          <input  class="form-control" type="text" name="lugar" pattern="[A-Za-z0-9#-/]{8,30}" title="Debe contener al menos 8 caracteres, incluyendo letras, números y caracteres especiales" placeholder="Lugar" >
        </div>

        <div class="col-md-6">
          <label for="inputPassword5" class="form-label">Cantidad de  niños</label>
          <input  class="form-control" type="text" name="cantidad" pattern="[0-9]{1,3}" title="Solo se aceptan numeros, minimo 1 caracter y maximo 3" placeholder="Cantidad de niños" >
        </div>

        <div class="col-md-6">
          <label for="inputPassword5" class="form-label">Fecha de inicio</label>
          <input  class="form-control" type="date" name="f_inicio"  placeholder="Fecha de inicio" >
        </div>

        <div class="col-md-6">
          <label for="inputPassword5" class="form-label">Fecha de fin</label>
          <input  class="form-control" type="date" name="f_fin"  placeholder="Fecha de fin" >
        </div>

        <div class="col-md-6">
          <label for="inputPassword5" class="form-label">Hora de inicio</label>
          <input  class="form-control" type="time" name="hora_inicio"  placeholder="Hora de inicio">
        </div>
        <div class="col-md-6">
          <label for="inputPassword5" class="form-label">Hora de fin</label>
          <input  class="form-control" type="time" name="hora_fin"  placeholder="Hora de fin" >
        </div>
        <div class="col-md-6">
          <label for="inputPassword5" class="form-label">Descripcion</label>
          <input  class="form-control" type="text" name="descripcion" pattern="[A-Za-z/s]{10,40}" title="Solo se aceptan letras, minimo 8 caracteres" placeholder="Descripcion">
        </div>
        
        <div class="col-md-6">
          <label for="inputPassword5" class="form-label">Contacto</label>
          <input  class="form-control" type="text" name="contacto" pattern="[0-9]{9,11}" title="Solo se aceptan numeros" placeholder="Contacto" >
        </div>
      
          <div class="text-center">
            <tr>
            <button class="btn" id="añadir_arti">Añadir articulo</button>

            <div id="añadir_articulo"></div>

            <input type="submit" name="registrar" value="Registro" class="btn btn-primary modal_close">
            </tr>
        </div>
      </form>
    </div>
</dialog>

<!-- Table with stripped rows -->
<table class="table datatable">
  <thead>
    <tr>
    <th><b>paquetes</b></th>
      <th>lugar</th>
      <th>cantidad de niños</th>
      <th>hora inicio</th>
      <th>contacto</th>
      <th>fecha de evento</th>
      <th>descripcion</th>
      <th>valor</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
        $con_paquetes = $con->prepare("SELECT eventos.id_eventos, paquetes.nombre_paquete, tipo_e.tipo_evento , eventos.lugar, eventos.cant_ninos,  eventos.f_inicio,  eventos.f_fin,  eventos.hora_inicio,  eventos.hora_fin,  eventos.descripcion,  eventos.contacto
        ,factura.valor_total FROM eventos INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes INNER JOIN tipo_e ON tipo_e.id_tipo_e = eventos.id_tipo_e INNER JOIN factura ON factura.valor_total  WHERE eventos.id_tipo_e = 1");
        $con_paquetes->execute();
        $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($paquetes as $fila) {

          $nombre_paquete = $fila['nombre_paquete'];
          $lugar = $fila['lugar'];
          $cant_ninos = $fila['cant_ninos'];
          $hora_inicio = $fila['hora_inicio'];
          $contacto = $fila['contacto'];
          $f_inicio = $fila['f_inicio'];
          $descripcion = $fila['descripcion'];
          $valor_total = $fila['valor_total'];
          
      ?>
      
    <tr>
    <td><?php echo $nombre_paquete?></td>
      <td><?php echo $lugar?></td>
      <td><?php echo $cant_ninos?></td>
      <td><?php echo $hora_inicio?></td>
      <td><?php echo $contacto?></td>
      <td><?php echo $f_inicio?></td>
      <td><?php echo $descripcion?></td>
      <td><?php echo $valor_total?></td>
      <td><a href="" class="boton" onclick="window.open
       ('../actualizar y eliminar/articulos.php?id=<?php echo $id_articulo ?>','','width= 600,height=500, toolbar=NO');void(null);"><i class="bi bi-arrow-counterclockwise"></i></a></td>

    </tr>
      <?php
        }
      ?>
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
  <script src="../../../js/modal.js"></script>
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