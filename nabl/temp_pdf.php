 <?php // INCLUDE THE phpToPDF.php FILE
/*require("phpToPDF.php"); 

// SET YOUR PDF OPTIONS
// FOR ALL AVAILABLE OPTIONS, VISIT HERE:  http://phptopdf.com/documentation/

$pdf_options = array(
  "source_type" => 'url',
  "source" => 'http://localhost/aanand_new/10_20_mm.php',
  "action" => 'view',
   "file_name" => 'url_google.pdf');

// CALL THE phptopdf FUNCTION WITH THE OPTIONS SET ABOVE
phptopdf($pdf_options);

// OPTIONAL - PUT A LINK TO DOWNLOAD THE PDF YOU JUST CREATED
echo ("<a href='url_google.pdf'>$_GET[dt]</a>");*/
/*$fullPath = "http://localhost/aanand_new/10_20_mm.php";

if ($fd = fopen ($fullPath, "r")) {

    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);

    header("Content-type: application/pdf");
    header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");            
    header("Content-length: $fsize");
    header("Cache-control: private");

    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}

fclose ($fd);
exit;*/
 
										?>
