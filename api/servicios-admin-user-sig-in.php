<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');


$usuario= $_GET['nombreUsuario'];
$pwd=$_GET['pass'];
$pass=md5($pwd);


$conn = new mysqli("localhost", "root", "123456", "curso");

$result = $conn->query("select UPPER(NOMBRE_USUARIO) AS NOMBRE_USUARIO,iD_USUARIO, ESTATUS from usuario where NOMBRE_USUARIO='".$usuario."' and CONTRASENA='".$pass."';");

$outp = "";
$token = "";

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
	$token = $rs["iD_USUARIO"];
    $outp .= '{"nombreUsuario":"'. $rs["NOMBRE_USUARIO"]. '",';	
	$outp .= '"id":"'. $rs["iD_USUARIO"]. '",';	
	$outp .= '"estatus":"'. $rs["ESTATUS"]. '"}';	
}


if($outp != "")	{
	
session_start();

$_SESSION["JSESSIONID"]=$token;

}

echo($outp);
$conn->close();
?>