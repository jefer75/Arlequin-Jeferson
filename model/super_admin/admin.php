<?php
 include 'plantilla.php';
?>
    <title>ELITECH</title>
    <link rel="stylesheet" href="css/tabl.css">
</head>

<body>



        <div class="dash-content"  >
            
            <div class="activity">
                <div class="title">
                    <i class="uil uil-user"></i>
                    <span class="text">Administradores</span>
                </div>
                <div class="formulario">
                <form method="POST" action="">
                
                <table class="custom-table">
                <tr class="buscarable">
                        <th><b>Cedula</b></th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Empresa</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </tr>
                        <?php
                            $con_paquetes = $con->prepare("SELECT usuarios.cedula, usuarios.nombre AS nombre_usuario, usuarios.celular, usuarios.correo, estados.estado, empresa.nombre_emp
                            FROM usuarios
                            INNER JOIN estados ON estados.id_estado = usuarios.id_estado
                            INNER JOIN empresa ON empresa.nit = usuarios.nit
                            WHERE usuarios.id_tipo_user = 1;");
                            $con_paquetes->execute();
                            $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($paquetes as $fila) {
                                $cedula = $fila['cedula'];
                                $nombre = $fila['nombre_usuario'];
                                $celular = $fila['celular'];
                                $correo = $fila['correo'];
                                $empresa = $fila['nombre_emp'];
                                $estado = $fila['estado'];
                            ?>
                        <tr>
                        <td><?php echo $cedula ?></td>
                                <td><?php echo $nombre ?></td>
                                <td><?php echo $celular ?></td>
                                <td><?php echo $correo ?></td>
                                <td><?php echo $empresa ?></td>
                                <td><?php echo $estado?></td>
                                <td><a href="" class="boton" onclick="window.open
                                ('actualizar y eliminar/admin.php?id=<?php echo $cedula ?>','','width= 600,height=400, toolbar=NO');void(null);"><i class="bi bi-arrow-counterclockwise"></i>
                                <i class="uil uil-edit"></i>
                                </a></td>

                        </tr>
                            <?php
                            }
                            ?>
        </table>

        </form>   
            </div>
        </div>
        <br><br>
        <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>ELITECH JYDT</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://yourwebsite.com/">Your Company</a>
        </div>
    </footer>
    </section>