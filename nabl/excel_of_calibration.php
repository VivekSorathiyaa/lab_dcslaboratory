<?php
include("connection.php");
$gets=base64_decode($_GET["id"]);
$sele_materials="select * from calibration_document where `is_deleted`=0 AND `calibration_id`=".$gets;
$result_materials = mysqli_query($conn,$sele_materials);
$rows =mysqli_fetch_array($result_materials);

require('PHPExcel.php');
$phpExcel = new PHPExcel;
// Setting font to Arial Black
$phpExcel->getDefaultStyle()->getFont()->setName('Arial Black');
// Setting font size to 14
$phpExcel->getDefaultStyle()->getFont()->setSize(8);
//Setting description, creator and title
$phpExcel ->getProperties()->setTitle("Vendor list");
$phpExcel ->getProperties()->setCreator("Robert");
$phpExcel ->getProperties()->setDescription("Excel SpreadSheet in PHP");
// Creating PHPExcel spreadsheet writer object
// We will create xlsx file (Excel 2007 and above)
$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007"); 
// When creating the writer object, the first sheet is also created
// We will get the already created sheet
$sheet = $phpExcel ->getActiveSheet();
// Setting title of the sheet
$sheet->setTitle('My product list');
$sheet->mergeCells('B1:C6');
$sheet->mergeCells('D1:I3');
$sheet->mergeCells('D4:I6');
$sheet->mergeCells('K1:N1');
$sheet->mergeCells('J4:K4');
$sheet->mergeCells('L4:N4');
$sheet->mergeCells('J5:K5');
$sheet->mergeCells('L5:N5');
$sheet->mergeCells('J6:K6');
$sheet->mergeCells('L6:N6');

// Creating spreadsheet header
$sheet->getStyle('D1')->getFont()->setBold(true)->setSize(16);
$sheet ->getCell('D1')->setValue('RAJKOT METLAB SERVICES
NH-27, Opp. Tulip Party Plot Nr. JCB Showoom, Rajkot');

$sheet->getStyle('D4')->getFont()->setBold(true)->setSize(16);
$sheet ->getCell('D4')->setValue('Calibration Request & Certificate Review Record');

$sheet->getStyle('J1')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('J1')->setValue('Doc.No.');

$sheet->getStyle('K1')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('K1')->setValue('F/6.4/03');

$sheet->getStyle('J2')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('J2')->setValue('Issue No.');

$sheet->getStyle('K2')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('K2')->setValue('01');

$sheet->getStyle('L2')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('L2')->setValue('Issue Date');

$sheet->getStyle('M2')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('M2')->setValue('1/8/2014');

$sheet->getStyle('J3')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('J3')->setValue('Amend  No.');

$sheet->getStyle('K3')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('K3')->setValue('00');

$sheet->getStyle('L3')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('L3')->setValue('Amend  Dtd');

$sheet->getStyle('M3')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('M3')->setValue('-');

$sheet->getStyle('J4')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('J4')->setValue('Prepared & Issued by');

$sheet->getStyle('L4')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('L4')->setValue('Quality Manager');

$sheet->getStyle('J5')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('J5')->setValue('Reviewed & Approved by');

$sheet->getStyle('L5')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('L5')->setValue('CEO');

$sheet->getStyle('J6')->getFont()->setBold(false)->setSize(8);
$sheet ->getCell('J6')->setValue('Page No. 1 of 1');

$sheet->getStyle('L6')->getFont()->setSize(8);
$sheet ->getCell('L6')->setValue('Controlled Document');

$sheet->mergeCells('B7:M7');
$sheet->mergeCells('B8:M8');
$sheet->getStyle('B8')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '#e4e3f4')
        )
    )
);
 
$sheet->getStyle('B8')->getFont()->setBold(true)->setSize(14);
$sheet ->getCell('B8')->setValue('Details of Equipment');

$sheet->getDefaultStyle()->getFont()->setSize(8);

$sheet ->getCell('B9')->setValue('Name of Equipment');
$sheet ->getCell('C9')->setValue(':');
$sheet ->getCell('D9')->setValue($rows["equipment_name"]);

$sheet ->getCell('B10')->setValue('Unique ID of Equipment');
$sheet ->getCell('C10')->setValue(':');
$sheet ->getCell('D10')->setValue($rows["unique_id"]);

$sheet ->getCell('B11')->setValue('Make/ Model/ Serial no/ Year');
$sheet ->getCell('C11')->setValue(':');
$sheet ->getCell('D11')->setValue($rows["make"]."/".$rows["model"]."/".$rows["man_ser_no"]."/".$rows["manufacture_year"]);
                   
$sheet ->getCell('B12')->setValue('Range(s)');
$sheet ->getCell('C12')->setValue(':');
$sheet ->getCell('D12')->setValue($rows["ranges"]);
                   
$sheet ->getCell('B13')->setValue('Accuracy / LC');
$sheet ->getCell('C13')->setValue(':');
$sheet ->getCell('D13')->setValue($rows["accuracy"]);
                   
$sheet ->getCell('B14')->setValue('Location of Use');
$sheet ->getCell('C14')->setValue(':');
$sheet ->getCell('D14')->setValue($rows["location_of_use"]);
                   
$sheet ->getCell('B15')->setValue('Required Cali. Interval (Year)');
$sheet ->getCell('C15')->setValue(':');
$sheet ->getCell('D15')->setValue('-');
                   
$sheet ->getCell('B16')->setValue('Date / Mode of Forwarding ');
$sheet ->getCell('C16')->setValue(':');
$sheet ->getCell('D16')->setValue('-');
                   
$sheet ->getCell('B17')->setValue('Date of Receipt of Equipment');
$sheet ->getCell('C17')->setValue(':');
$sheet ->getCell('D17')->setValue('-');
                   
$sheet ->getCell('B18')->setValue('Date of Receipt of Certificate');
$sheet ->getCell('C18')->setValue(':');
$sheet ->getCell('D18')->setValue('-');
                   
$sheet ->getCell('B19')->setValue('Range / Spots / Points required to be calibrated');
$sheet ->getCell('C19')->setValue(':');
$sheet ->getCell('D19')->setValue('-');

$sheet->mergeCells('B20:M20');
$sheet->getStyle('B20')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '#e4e3f4')
        )
    )
);
$sheet->getStyle('B20')->getFont()->setBold(true)->setSize(14);
$sheet ->getCell('B20')->setValue('Certificate Verification');

$sheet ->getCell('B21')->setValue('Date of Calibration');
$sheet ->getCell('C21')->setValue(':');
$sheet ->getCell('D21')->setValue('-');

$sheet ->getCell('B22')->setValue('Certificate carries NABL logo');
$sheet ->getCell('C22')->setValue(':');
$sheet->mergeCells('D22:F22');
$sheet ->getCell('D22')->setValue('     Yes     No');

$sheet ->getCell('B23')->setValue('Due Date mentioned in Calibration Reports ?');
$sheet ->getCell('C23')->setValue(':');
$sheet->mergeCells('D23:F23');
$sheet ->getCell('D23')->setValue('     Yes     No');

$sheet ->getCell('B24')->setValue('Correct ID and Sr. No: Mentioned?');
$sheet ->getCell('C24')->setValue(':');
$sheet->mergeCells('D24:F24');
$sheet ->getCell('D24')->setValue('     Yes     No');

$sheet ->getCell('B25')->setValue('Results reported are as per required points/spots/standards?');
$sheet ->getCell('C25')->setValue(':');
$sheet->mergeCells('D25:F25');
$sheet ->getCell('D25')->setValue('     Yes     No');

$sheet ->getCell('B26')->setValue('Results are within specified Accuracy?');
$sheet ->getCell('C26')->setValue(':');
$sheet->mergeCells('D26:F26');
$sheet ->getCell('D26')->setValue('     Yes     No');

$sheet ->getCell('B27')->setValue('Uncertainty');
$sheet ->getCell('C27')->setValue(':');
$sheet ->getCell('D27')->setValue('Reported:');
$sheet ->getCell('E27')->setValue('');
$sheet ->getCell('F27')->setValue('Last Year :');
$sheet ->getCell('G27')->setValue('');

$sheet ->getCell('B28')->setValue('Results & Certificates are within specified?');
$sheet ->getCell('C28')->setValue(':');
$sheet->mergeCells('D28:F28');
$sheet ->getCell('D28')->setValue('     Yes     No');

$sheet ->getCell('B29')->setValue('Any Limitations / Corrections to be considered');
$sheet ->getCell('C29')->setValue(':');
$sheet->mergeCells('D29:F29');
$sheet ->getCell('D29')->setValue('');

$sheet->mergeCells('B30:G33');
$sheet ->getCell('B30')->setValue('Reviewed by');
$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
// Save the spreadsheet
//$writer->save('products.xlsx');

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="file.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');

?>