<?php
require '../../../../vendor/autoload.php';
require_once "../../../../db/connection.php";

$db = new DataBase();
$con = $db->conectar();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['luc_excel'])) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agrega los encabezados de columna
    // $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Nombre');
    $sheet->setCellValue('C1', 'Descripción');
    $sheet->setCellValue('D1', 'Cantidad');
    $sheet->setCellValue('E1', 'Valor');
    $sheet->setCellValue('F1', 'Estado');

    $stmt = $con->prepare("SELECT articulos.id_articulo, articulos.nombre_A, articulos.descripcion, articulos.cantidad, articulos.valor, estados.estado FROM articulos INNER JOIN estados ON estados.id_estado = articulos.id_estado WHERE articulos.id_tipo_art = 2");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Llena la hoja de cálculo con los datos
    $row = 2;
    foreach ($result as $data) {
        // $sheet->setCellValue('A' . $row, $data['id_articulo']);
        $sheet->setCellValue('B' . $row, $data['nombre_A']);
        $sheet->setCellValue('C' . $row, $data['descripcion']);
        $sheet->setCellValue('D' . $row, $data['cantidad']);
        $sheet->setCellValue('E' . $row, $data['valor']);
        $sheet->setCellValue('F' . $row, $data['estado']);
        $row++;
    }

    // Establecer encabezados para la descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Articulos Luces.xlsx"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1'); 
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
    header('Cache-Control: cache, must-revalidate'); 
    header('Pragma: public'); 

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
?>