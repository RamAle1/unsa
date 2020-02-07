<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

$conn = new mysqli("localhost", "root", "123456", "curso");
$newestatus=$_GET['newestatus'];
$IdUsr= $_GET['id'];
$edo= $_GET['estatus'];

$result = $conn->query("select UUID from alumnos where UUID='".$IdUsr."';");
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	   if ($outp != "") {$outp .= ",";}
	   $outp = $rs["UUID"];
}
/*FECHA_MODIFICACION='".$hoy."'*/
if($IdUsr==$outp){
	$hoy = date("Y-m-d H:i:s"); 
	$result = $conn->query("UPDATE alumnos SET ESTATUS=".$newestatus."  WHERE UUID='".$IdUsr."' AND ESTATUS=".$edo.";");	
		
	/*echo "UPDATE alumnos SET ESTATUS=".$newestatus."  WHERE UUID='".$IdUsr."' AND ESTATUS=".$edo.";";*/

	if($result){
		$outp ='{"status":"true", "mensaje":"El usuario ha sido modificado"}';
	}else{
		$outp ='{"status":"false", "mensaje":"Ha ocurrido un error en la actualización"}';
	}	
}
else{
	$outp ='{"status":"false", "mensaje":"El usuario no existe"}';
}
	$conn->close();
	echo($outp);
?>
