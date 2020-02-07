<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');



		$clave= $_GET['clave'];
		$nombre= $_GET['nombre'];
		$costo= $_GET['costo'];
		$estatus= $_GET['estatus'];

$conn = new mysqli("localhost", "root", "123456", "curso");

$queryConcat="SELECT UUID, CLAVE, NOMBRE, DESCRIPCION, COSTO, FECHA_CREACION, FECHA_MODIFICACION, ESTATUS FROM SERVICIOS WHERE 1=1 ";
					   
				if($clave != null){
					$queryConcat .=" AND CLAVE='".$clave."'";
				}	   
				if($nombre != null){
					$queryConcat .=" AND NOMBRE LIKE '%".$nombre."%'";
				}	
				if($costo != null){
					$queryConcat .=" AND COSTO=".$costo."";
				}	
				if($estatus != null){
					$queryConcat .=" AND ESTATUS =".$estatus."";
				}	   
		
$result = $conn->query($queryConcat);

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
	
    $outp .= '{"id":"'. $rs["UUID"]. '",';
	$outp .= '"clave":"'. $rs["CLAVE"]. '",';	
	$outp .= '"servicio":"'. $rs["NOMBRE"]. '",';	
	$outp .= '"descripcion":"'. $rs["DESCRIPCION"].'",';
	$outp .= '"costo":"'. $rs["COSTO"].'",';
	$outp .= '"fcreacion":"'. $rs["FECHA_CREACION"].'",';
	$outp .= '"fmodificacion":"'. $rs["FECHA_MODIFICACION"].'",';
	$outp .= '"estatus":"'. $rs["ESTATUS"]. '"}';	
	
}
$outp ='{"records":['.$outp.']}';


echo($outp);
$conn->close();
?>