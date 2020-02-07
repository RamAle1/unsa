<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

/*

$method = $_SERVER['REQUEST_METHOD'];
echo $method;


switch ($method) {
  case 'GET':
    echo 'Here Handle GET Request';
    break;
  case 'POST':
    echo 'Here Handle POST Request';
    break;
  case 'DELETE':
    echo 'Here Handle DELETE Request ';
    break;
  case 'PUT':
    echo 'Here Handle PUT Request';
  break;
}

*/
		$clave= $_GET['clave'];
		$nombre= $_GET['nombre'];
		$carrera= $_GET['carrera'];
		$estatus= $_GET['estatus'];
		

$conn = new mysqli("localhost", "root", "123456", "curso");

$queryConcat="SELECT UUID, CLAVE,CARRERA, CONCAT(APELLIDO_PATERNO,' ',APELLIDO_MATERNO,' ',NOMBRE) AS NOMBRE, ESTATUS  FROM ALUMNOS WHERE 1=1 ";
					   
				if($clave != null){
					$queryConcat .=" AND CLAVE=".$clave;
				}	   
				if($nombre != null){
					$queryConcat .=" AND NOMBRE='".$nombre."'";
				}	
				if($carrera != null){
					$queryConcat .=" AND CARRERA='".$carrera."'";
				}	
				if($estatus != null){
					$queryConcat .=" AND ESTATUS =".$estatus."";
				}	   
		
$result = $conn->query($queryConcat);

//echo($queryConcat);

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
	
    $outp .= '{"id":"'. $rs["UUID"]. '",';
	$outp .= '"clave":"'. $rs["CLAVE"]. '",';
	$outp .= '"carrera":"'. $rs["CARRERA"].'",';
	$outp .= '"nombre":"'. $rs["NOMBRE"]. '",';	
	$outp .= '"estatus":"'. $rs["ESTATUS"]. '"}';	
	
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>