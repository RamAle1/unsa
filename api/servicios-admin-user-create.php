<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

$conn = new mysqli("localhost", "root", "123456", "curso");

$usuario= $_GET['nombre'];
$pwd=$_GET['contrasena'];

function uuid(){
   	$data = random_bytes(16);
   	$data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
   	$data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

$result = $conn->query("SELECT NOMBRE_USUARIO FROM USUARIO WHERE NOMBRE_USUARIO='".$usuario."';");
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
   if ($outp != "") {$outp .= ",";}
   $outp = $rs["NOMBRE_USUARIO"];
}

if($usuario!=$outp){
	
	$hoy = date("Y-m-d H:i:s");  
	$pass=md5($pwd);
	$result = $conn->query("insert into usuario values('".uuid()."','".$usuario."','".$pass."','".$hoy."','".$hoy."',0);");
	
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
