<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

$conn = new mysqli("localhost", "root", "123456", "curso");


$calumno= $_GET['calumno'];
$capellidop= $_GET['capellidop'];
$capellidom= $_GET['capellidom'];
$carrera= $_GET['carrera'];
$cestatus=$_GET['cestatus'];

function uuid(){
   	$data = random_bytes(16);
   	$data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
   	$data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

$result = $conn->query("SELECT NOMBRE FROM ALUMNOS WHERE NOMBRE='".$calumno."';");
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
   if ($outp != "") {$outp .= ",";}
   $outp = $rs["NOMBRE"];
}

if($calumno!=$outp){
	
	$hoy = date("Y-m-d H:i:s");  
	
	$result = $conn->query("insert into alumnos values('".uuid()."',1920,'".$carrera."','".$calumno."','".$capellidop."','".$capellidom."',".$cestatus.");");
	
	
	if($result){
			$outp ='{"status":"true"}';
		}else{
			$outp ='{"status":"false", "mensaje":"Ha ocurrido un error en el regustro del usuario".$usuario."}';
		}
}else{
	$outp ='{"status":"false", "mensaje":"El usuario ya existe"}';
}
	$conn->close();
	echo($outp);
?>
