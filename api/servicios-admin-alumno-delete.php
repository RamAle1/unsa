<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

$conn = new mysqli("localhost", "root", "123456", "curso");
$IdUsr= $_DELETE['id'];


$result = $conn->query("select iD_USUARIO from usuario where iD_USUARIO='".$IdUsr."';");
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	   if ($outp != "") {$outp .= ",";}
	   $outp = $rs["iD_USUARIO"];
}
if($IdUsr==$outp){
	
	$result = $conn->query("DELETE FROM usuario WHERE iD_USUARIO = '".$IdUsr."';");
	
	if($result){
		$outp ='{"status":"true", "mensaje":"El usuario ha sido eliminado"}';
	}else{
		$outp ='{"status":"false", "mensaje":"Ha ocurrido un error en la eliminación"}';
	}	
}
else{
	$outp ='{"status":"false", "mensaje":"El usuario no existe"}';
}
	$conn->close();
	echo($outp);
?>
