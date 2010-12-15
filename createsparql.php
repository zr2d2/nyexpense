<?php
$filename  = strtolower(str_replace("'","",str_replace(".","",str_replace(" ","_",urldecode($_GET["name"])))));
$filename .= ".sparql";

$data = "PREFIX nys: <http://logd.tw.rpi.edu/source/nysenate-gov/dataset/expenditure/vocab/enhancement/1/>\n";
$data .= "PREFIX g09: <http://logd.tw.rpi.edu/source/nysenate-gov/dataset/expenditure/version/2009-09-30>\n";
$data .= "PREFIX g10: <http://logd.tw.rpi.edu/source/nysenate-gov/dataset/expenditure/version/2010-03-31>\n";

$data .= "SELECT ?node09 ?node10 ?senator ?type ?amount\n";
$data .= "WHERE{\n";

$data .= " {\n";

$data .= "GRAPH  g10:   {\n";
$data .= "	?node10 nys:amount ?amount .\n";

$data .= '	?node10 nys:office ?senator  FILTER (?senator= "SENATOR ';

$data .= strtoupper(urldecode($_GET["name"]));

$data .= "\").\n";
 
$data .= "	?node10 nys:expense_type ?type .\n";
$data .= "	}\n";
$data .= " }UNION{\n";
$data .= " GRAPH g09:	{\n";
$data .= "	?node09 nys:amount ?amount .\n";
$data .= '	?node09 nys:office ?senator  FILTER (?senator= "SENATOR ';
$data .= strtoupper(urldecode($_GET["name"]));
$data .= "\").\n";
$data .= "	?node09 nys:expense_type ?type .\n";
$data .= "	}\n";
$data .= " }\n";
$data .= "}\n";

print $data;

/*$fh = fopen($filename, "w");
fwrite($fh, $data);*/

?>
