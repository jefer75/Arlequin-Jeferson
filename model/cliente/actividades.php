<?php
    include 'plantilla.php';
?>

<title>actividades</title>

<main id="main" class="main">

<style>
    table img{
        width: 35vh;
    }

</style>

  <div class="pagetitle">
    <h1>Actividades</h1>

  </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                  
                    <th>Actividades</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $actividades = $con->prepare("SELECT * FROM actividades");
                       $actividades->execute();
                       $actividades = $actividades->fetchAll(PDO::FETCH_ASSOC);
                       foreach ($actividades as $fila) {
                       
                        $id_actividad = $fila['id_actividad'];
                        $nombre = $fila['nombre'];
                        $descripcion = $fila['descripcion'];
                       
                    ?>
                  <tr>
                    
                  <td><?php echo $nombre?></td>
                    <td><?php echo $descripcion?></td>
                    <td> <img src="actualizar/<?php echo $fila['imagen']?>"></td>
                    
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
  <script src="../administrador/pages/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../administrador/pages/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../administrador/pages/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../administrador/pages/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../administrador/pages/assets/vendor/quill/quill.js"></script>
  <script src="../administrador/pages/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../administrador/pages/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../administrador/pages/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../administrador/pages/assets/js/main.js"></script>

</body>

</html>